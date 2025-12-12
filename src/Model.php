<?php

namespace App;

/**
 * Classe Model
 * Classe base abstrata para todos os modelos da aplicação
 */
abstract class Model {
    
    protected string $table;
    protected array $attributes = [];
    protected array $fillable = [];
    protected array $hidden = [];
    
    /**
     * Obtém todos os registros da tabela
     * 
     * @return array
     */
    public function all(): array {
        $sql = "SELECT * FROM {$this->table}";
        return Database::fetchAll($sql);
    }
    
    /**
     * Obtém um registro pelo ID
     * 
     * @param int $id
     * @return array|null
     */
    public function find(int $id): ?array {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        return Database::fetchOne($sql, [$id]);
    }
    
    /**
     * Obtém um registro por uma coluna específica
     * 
     * @param string $column
     * @param mixed $value
     * @return array|null
     */
    public function findBy(string $column, $value): ?array {
        $sql = "SELECT * FROM {$this->table} WHERE {$column} = ?";
        return Database::fetchOne($sql, [$value]);
    }
    
    /**
     * Obtém múltiplos registros por uma coluna específica
     * 
     * @param string $column
     * @param mixed $value
     * @return array
     */
    public function findAllBy(string $column, $value): array {
        $sql = "SELECT * FROM {$this->table} WHERE {$column} = ?";
        return Database::fetchAll($sql, [$value]);
    }
    
    /**
     * Salva um novo registro
     * 
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool {
        $data = $this->filterFillable($data);
        
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        
        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        
        try {
            Database::query($sql, array_values($data));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    
    /**
     * Atualiza um registro
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool {
        $data = $this->filterFillable($data);
        
        $set = implode(', ', array_map(fn($key) => "{$key} = ?", array_keys($data)));
        $values = array_values($data);
        $values[] = $id;
        
        $sql = "UPDATE {$this->table} SET {$set} WHERE id = ?";
        
        try {
            Database::query($sql, $values);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    
    /**
     * Deleta um registro
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        
        try {
            Database::query($sql, [$id]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    
    /**
     * Conta registros na tabela
     * 
     * @return int
     */
    public function count(): int {
        $sql = "SELECT COUNT(*) as total FROM {$this->table}";
        $result = Database::fetchOne($sql);
        return $result['total'] ?? 0;
    }
    
    /**
     * Filtra dados para apenas os campos fillable
     * 
     * @param array $data
     * @return array
     */
    protected function filterFillable(array $data): array {
        if (empty($this->fillable)) {
            return $data;
        }
        
        return array_filter($data, fn($key) => in_array($key, $this->fillable), ARRAY_FILTER_USE_KEY);
    }
    
    /**
     * Define atributos do modelo
     * 
     * @param array $attributes
     */
    public function setAttributes(array $attributes): void {
        $this->attributes = $attributes;
    }
    
    /**
     * Obtém um atributo
     * 
     * @param string $key
     * @return mixed
     */
    public function __get(string $key) {
        return $this->attributes[$key] ?? null;
    }
    
    /**
     * Define um atributo
     * 
     * @param string $key
     * @param mixed $value
     */
    public function __set(string $key, $value): void {
        $this->attributes[$key] = $value;
    }
}
