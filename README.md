# DespachoSys PRO

Um sistema de gerenciamento de despacho profissional e completo para pequenas empresas, desenvolvido em **PHP puro** com **Composer** e **Bootstrap**.

## Características Principais

- ✅ **Arquitetura MVC Profissional** – Separação clara entre Model, View e Controller
- ✅ **Autoloading PSR-4** – Carregamento automático de classes via Composer
- ✅ **Autenticação Segura** – Sistema de login com hash bcrypt
- ✅ **Gerenciamento de Usuários** – Criação, edição e exclusão de usuários com roles
- ✅ **Gerenciamento de Mercadorias** – CRUD completo com SKU único
- ✅ **Gerenciamento de Despachos** – Rastreamento de pedidos e entregas
- ✅ **Gerenciamento de Clientes** – Cadastro de clientes com dados completos
- ✅ **Interface Responsiva** – Bootstrap 5 para design moderno
- ✅ **Dashboard** – Estatísticas e métricas do sistema
- ✅ **Controle de Permissões** – Sistema de roles e permissões

## Requisitos

- **PHP 7.4+** (Recomendado: PHP 8.0+)
- **MySQL 5.7+** ou **MariaDB 10.3+**
- **Composer**
- **Servidor Web** (Apache, Nginx, etc.)

## Instalação

### 1. Clonar o Repositório

```bash
git clone https://github.com/fabiano1981sf-design/Despacho_Manus_Pro.git
cd Despacho_Manus_Pro
```

### 2. Instalar Dependências

```bash
composer install
```

### 3. Configurar Variáveis de Ambiente

Copie o arquivo `.env.example` para `.env` e configure as credenciais do banco de dados:

```bash
cp .env.example .env
```

Edite o arquivo `.env`:

```env
DB_HOST=localhost
DB_NAME=teste2
DB_USER=root
DB_PASS=root

SITE_NAME="DespachoSys PRO"
SITE_URL="http://localhost:8000"
APP_ENV=development
APP_DEBUG=true
```

### 4. Criar o Banco de Dados

```bash
mysql -u root -p < teste2.sql
```

### 5. Iniciar o Servidor

```bash
php -S localhost:8000 -t public/
```

Acesse `http://localhost:8000` no seu navegador.

## Estrutura do Projeto

```
Despacho_Manus_Pro/
├── public/
│   └── index.php           # Ponto de entrada da aplicação
├── src/
│   ├── Database.php        # Gerenciador de conexão com BD
│   ├── Model.php           # Classe base para modelos
│   ├── Controller.php      # Classe base para controladores
│   ├── Auth.php            # Sistema de autenticação
│   ├── Router.php          # Sistema de roteamento
│   ├── View.php            # Sistema de renderização de views
│   ├── Models/             # Modelos de dados
│   │   ├── User.php
│   │   ├── Mercadoria.php
│   │   ├── Despacho.php
│   │   ├── Cliente.php
│   │   ├── Categoria.php
│   │   └── Transportadora.php
│   └── Controllers/        # Controladores
│       ├── DashboardController.php
│       ├── AuthController.php
│       └── MercadoriaController.php
├── views/                  # Templates HTML
│   ├── _login.php
│   ├── _dashboard.php
│   ├── _mercadorias.php
│   └── ... (outras views)
├── config/                 # Arquivos de configuração
├── .env                    # Variáveis de ambiente
├── composer.json           # Dependências do Composer
└── README.md               # Este arquivo
```

## Funcionalidades Implementadas

### Autenticação
- Login seguro com email e senha
- Logout
- Controle de sessão
- Roles de usuário (admin, vendedor, operador, etc.)

### Dashboard
- Estatísticas gerais do sistema
- Contagem de mercadorias, clientes, despachos
- Indicadores de desempenho

### Gerenciamento de Mercadorias
- Criar, ler, atualizar e deletar mercadorias
- SKU único para cada mercadoria
- Controle de estoque
- Categorização de produtos

### Gerenciamento de Clientes
- Cadastro completo de clientes
- Dados de contato e endereço
- Histórico de pedidos

### Gerenciamento de Despachos
- Criar e rastrear despachos
- Status de entrega
- Integração com transportadoras
- Data de saída e entrega

## Próximas Funcionalidades

- [ ] Gerenciamento completo de Pedidos de Venda
- [ ] Controle Financeiro (Contas a Pagar/Receber)
- [ ] Relatórios e Gráficos
- [ ] Integração com APIs de Transportadoras
- [ ] Sistema de Notificações
- [ ] Backup Automático
- [ ] API REST
- [ ] Testes Unitários

## Guia de Desenvolvimento

### Criar um Novo Modelo

```php
// src/Models/NovoModelo.php
namespace App\Models;

use App\Model;

class NovoModelo extends Model {
    protected string $table = 'novo_modelo';
    protected array $fillable = ['campo1', 'campo2'];
}
```

### Criar um Novo Controlador

```php
// src/Controllers/NovoController.php
namespace App\Controllers;

use App\Controller;

class NovoController extends Controller {
    public function index(): void {
        $this->render('_novo', ['data' => 'valor']);
    }
}
```

### Registrar uma Rota

No arquivo `public/index.php`:

```php
Router::get('novo', 'NovoController', 'index');
```

### Criar uma View

```php
// views/_novo.php
<div class="container">
    <h1>Página Nova</h1>
    <p><?php echo $data; ?></p>
</div>
```

## Segurança

- **Senhas:** Utilizamos bcrypt com cost 12 para hash de senhas
- **SQL Injection:** Utilizamos prepared statements com PDO
- **XSS:** Escapamos todas as saídas HTML
- **CSRF:** Implementar tokens CSRF nas próximas versões
- **Sessão:** Regeneração de ID de sessão após login

## Contribuindo

Contribuições são bem-vindas! Por favor:

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## Licença

Este projeto está licenciado sob a Licença MIT - veja o arquivo LICENSE para detalhes.

## Suporte

Para suporte, abra uma issue no repositório ou entre em contato através do email: fabiano1981.sf@gmail.com

## Autor

Desenvolvido por **Fabiano Silva** 

---

**Última atualização:** 01 de Dezembro de 2025
