<?php

namespace App;

use PDO;
use PDOException;

/**
 * Classe Database
 * Gerencia a conexão com o banco de dados usando PDO (Singleton)
 */
class Database {
    
    private static ?PDO $instance = null;
    
    /**
     * Obtém a instância única da conexão PDO
     * 
     * @return PDO
     */
    public static function getInstance(): PDO {
        if (self::$instance === null) {
            self::$instance = self::connect();
        }
        return self::$instance;
    }
    
    /**
     * Estabelece a conexão com o banco de dados
     * 
     * @return PDO
     */
    private static function connect(): PDO {
        try {
            $host = $_ENV['DB_HOST'] ?? 'localhost';
            $dbname = $_ENV['DB_NAME'] ?? 'teste2';
            $user = $_ENV['DB_USER'] ?? 'root';
            $pass = $_ENV['DB_PASS'] ?? 'root';
            
            $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
            
            $pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
            
            return $pdo;
        } catch (PDOException $e) {
            die("Erro de conexão com o banco de dados: " . $e->getMessage());
        }
    }
    
    /**
     * Executa uma query simples
     * 
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public static function query(string $sql, array $params = []) {
        $pdo = self::getInstance();
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
    /**
     * Obtém um registro
     * 
     * @param string $sql
     * @param array $params
     * @return array|null
     */
    public static function fetchOne(string $sql, array $params = []): ?array {
        $stmt = self::query($sql, $params);
        return $stmt->fetch() ?: null;
    }
    
    /**
     * Obtém todos os registros
     * 
     * @param string $sql
     * @param array $params
     * @return array
     */
    public static function fetchAll(string $sql, array $params = []): array {
        $stmt = self::query($sql, $params);
        return $stmt->fetchAll() ?: [];
    }
    
    /**
     * Obtém um valor único
     * 
     * @param string $sql
     * @param array $params
     * @return mixed
     */
    public static function fetchColumn(string $sql, array $params = []) {
        $stmt = self::query($sql, $params);
        return $stmt->fetchColumn();
    }
    
    /**
     * Inicia uma transação
     */
    public static function beginTransaction(): void {
        self::getInstance()->beginTransaction();
    }
    
    /**
     * Confirma uma transação
     */
    public static function commit(): void {
        self::getInstance()->commit();
    }
    
    /**
     * Reverte uma transação
     */
    public static function rollBack(): void {
        self::getInstance()->rollBack();
    }
}
