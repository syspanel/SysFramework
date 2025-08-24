<?php  

/************************************************************************/
/* SysFramework - PHP Framework                                         */
/* ============================                                         */
/*                                                                      */
/* PHP Framework                                                        */
/* (c) 2025 by Marco Costa marcocosta@gmx.com                           */
/*                                                                      */
/* https://sysframework.com                                             */
/*                                                                      */
/* This project is licensed under the MIT License.                      */
/*                                                                      */
/* For more informations: marcocosta@gmx.com                            */
/************************************************************************/

namespace Core;

use App\Console\MakeUserTableCommand;
use App\Console\MakeClientTableCommand;

use PDO;

class SysCli
{
    protected $commands = [];
    private $pdo;

    public function __construct()
    {
        // Criação da conexão PDO usando as variáveis de ambiente
        $this->pdo = $this->createDatabaseConnection();
        
        $this->commands = [
            'generate:key' => 'generateAppKey',
            'clear:cache' => 'clearCache',
            'clear:logs' => 'clearLogs',
            'backup:storage' => 'backupStorage',
            'optimize' => 'optimize',
            'queue:process' => 'processQueue',
            'serve' => 'serve',
            'storage:link' => 'storageLink',
            'cache:warmup' => 'warmupCache',
            'db:backup' => 'backupDatabase',
            'db:restore' => 'restoreDatabase',
            'list' => 'listCommands',
            'help' => 'displayHelp',
            'version' => 'displayVersion',
            'clean:logs' => 'cleanOldLogs',
            'check:env' => 'checkEnv',
            'make:controller' => 'createController',
            'make:model' => 'createModel',
            'make:permissions' => 'setPermissions',
            'make:component' => 'makeComponent',
            'make:userstable' => 'makeUserTable',
            'make:clientstable' => 'makeClientTable',
        ];
    }

    public function handle()
    {
        // Obtém o comando e argumentos da linha de comando
        global $argv;
        $command = $argv[1] ?? 'list';
        $arguments = array_slice($argv, 2);

        // Verifica se o comando existe no array de comandos
        if (array_key_exists($command, $this->commands)) {
            // Chama o método correspondente com os argumentos passados
            call_user_func_array([$this, $this->commands[$command]], $arguments);
        } else {
            $this->displayHelp();
        }
    }
    
    
    protected function makeUserTable()
    {
        $command = new MakeUserTableCommand($this->pdo);
        $command->execute();
    }
    
    
    protected function makeClientTable()
    {
        $command = new MakeClientTableCommand($this->pdo);
        $command->execute();
    }

    private function createDatabaseConnection()
    {
        $host = "localhost";
        $dbname = "SysFramework";
        $user = "sysframework";
        $password = "mega88ax";

        return new \PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    }
    
    
    
    
    

    // Método para criar um novo componente
    private function makeComponent($name)
    {
        // Nome da classe do componente
        $className = ucfirst($name);

        // Caminho para o diretório de componentes
        $componentDir = __DIR__ . '/../app/Components';

        // Caminho do arquivo da classe do componente
        $componentClassPath = "{$componentDir}/{$className}.php";

        // Caminho para o diretório das views
        $viewDir = __DIR__ . '/../resources/views/components';

        // Caminho do arquivo Blade do componente
        $viewPath = "{$viewDir}/{$name}.blade.php";

        // Cria o diretório de componentes se não existir
        if (!is_dir($componentDir)) {
            mkdir($componentDir, 0755, true);
        }

        // Cria o diretório de views se não existir
        if (!is_dir($viewDir)) {
            mkdir($viewDir, 0755, true);
        }

        // Conteúdo da classe do componente
        $componentClassContent = "<?php

namespace App\\Components;

use \App\\BladeOne;

class {$className}
{
    protected \$attributes;

    public function __construct(\$attributes = [])
    {
        \$this->attributes = \$attributes;
    }

    public function render()
    {
        ob_start();
        include __DIR__ . '/../../resources/views/components/{$name}.blade.php';
        return ob_get_clean();
    }
}
";

        // Conteúdo do arquivo Blade do componente
        $viewContent = "<div>
    <!-- Componente {$name} -->
    {{ \$slot }}
</div>";

        // Cria o arquivo da classe do componente
        if (!file_exists($componentClassPath)) {
            file_put_contents($componentClassPath, $componentClassContent);
            echo "Componente {$name} criado em {$componentClassPath}.\n";
        } else {
            echo "Componente {$name} já existe.\n";
        }

        // Cria o arquivo Blade do componente
        if (!file_exists($viewPath)) {
            file_put_contents($viewPath, $viewContent);
            echo "View do componente {$name} criada em {$viewPath}.\n";
        } else {
            echo "View do componente {$name} já existe.\n";
        }
    }



public function setPermissions()
{
    $directories = [
        'app',
        'core',
        'resources',
        'routes',
        'public',
        'config',
        'database',
        // Adicione outras pastas aqui
    ];

    $specialDirectories = [
        'storage',
        'cache',
        'logs',
        'vendor',
    ];

    $files = [
        '.env',
        '.htaccess',
        'public/.htaccess',
    ];

    // Definir permissão 0755 para as pastas normais
    foreach ($directories as $dir) {
        if (is_dir($dir)) {
            chmod($dir, 0755);
            echo "Permissão 0755 aplicada à pasta: $dir\n";
        }
    }

    // Definir permissão 0775 para as pastas especiais
    foreach ($specialDirectories as $dir) {
        if (is_dir($dir)) {
            chmod($dir, 0775);
            echo "Permissão 0775 aplicada à pasta: $dir\n";
        }
    }

    // Definir permissão 0644 para arquivos específicos
    foreach ($files as $file) {
        if (file_exists($file)) {
            chmod($file, 0644);
            echo "Permissão 0644 aplicada ao arquivo: $file\n";
        }
    }

    echo "Permissões ajustadas com sucesso.\n";
}



    // Gera uma nova chave de aplicativo e a atualiza no arquivo .env
    protected function generateAppKey()
    {
        $key = bin2hex(random_bytes(16));
        echo "Generated APP_KEY: {$key}\n";
        
        $envFile = __DIR__ . '/../.env';

        if (!file_exists($envFile)) {
            echo "Error: .env file does not exist.\n";
            return;
        }

        $envContents = file_get_contents($envFile);
        $pattern = '/^APP_KEY=.*$/m';

        if (preg_match($pattern, $envContents)) {
            $envContents = preg_replace($pattern, "APP_KEY={$key}", $envContents);
        } else {
            $envContents .= "\nAPP_KEY={$key}\n";
        }

        if (file_put_contents($envFile, $envContents)) {
            echo "APP_KEY successfully updated in .env file.\n";
        } else {
            echo "Error: Unable to write to .env file.\n";
        }
    }
    
    
    protected function createModel($modelName)
{
    // Define o caminho para o diretório dos modelos
    $modelsPath = __DIR__ . '/../app/Models/';
    
    // Verifica se o diretório existe
    if (!is_dir($modelsPath)) {
        mkdir($modelsPath, 0755, true);
    }

    // Define o conteúdo básico do modelo
    $modelTemplate = <<<PHP
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class $modelName extends Model
{
    // Define o nome da tabela associada ao modelo
    protected \$table = strtolower('$modelName') . 's';

    // Define os atributos que podem ser preenchidos em massa
    protected \$fillable = [
        'name',
        'password',
        'company',
        'address',
        'phone',
        'email',
        'notes',
    ];

    // Define os atributos que devem ser ocultados em arrays e JSON
    protected \$hidden = [
        'password',
    ];
}
PHP;

    // Define o caminho completo do novo modelo
    $modelFilePath = $modelsPath . $modelName . '.php';

    // Verifica se o modelo já existe
    if (file_exists($modelFilePath)) {
        echo "Model '$modelName' já existe.\n";
        return;
    }

    // Cria o novo arquivo do modelo
    
if (file_put_contents($modelFilePath, $modelTemplate)) {
        if (chmod($modelFilePath, 0777)) {
            echo "Model '{$modelName}' criado com sucesso e permissões ajustadas para 0777.\n";
        } else {
            echo "Model '{$modelName}' criado, mas falha ao ajustar permissões.\n";
        }
    } else {
        echo "Erro ao criar o model '{$modelName}'.\n";
    }
}

    
    protected function createController($controllerName)
{
    // Define o caminho para o diretório dos controladores
    $controllersPath = __DIR__ . '/../app/Controllers/';
    
    // Verifica se o diretório existe
    if (!is_dir($controllersPath)) {
        mkdir($controllersPath, 0755, true);
    }

    // Define o conteúdo básico do controlador
    $controllerTemplate = <<<PHP
<?php

namespace App\Controllers;

use App\Models\Client;
use Core\BaseController;
use Core\SysRouter;
use Core\SysLogger;
use eftec\bladeone\BladeOne;

class $controllerName extends BaseController
{
    protected \$blade;
    protected \$logger;

    public function __construct()
    {
        // Instancia o BladeOne para renderizar views
        \$this->blade = new BladeOne(VIEWS_PATH, VIEWSCACHE_PATH, BladeOne::MODE_AUTO);

        // Instancia o SysLogger para registro de logs
        \$this->logger = new SysLogger();
    }

    public function index()
    {
        \$this->logger->info('($controllerName.index) - Esta é uma mensagem de informação.');

        \$data = [
            'user' => [
                'name' => 'João',
                'is_admin' => true
            ],
            'items' => ['Item 1', 'Item 2', 'Item 3']
        ];

        \$clients = Client::all();

        echo \$this->blade->run('clients.index', ['clients' => \$clients, 'data' => \$data]);
    }

    public function create()
    {
        echo \$this->blade->run('clients.create');
    }

    public function store()
    {
        \$data = \$_POST;
        \$data['password'] = password_hash(\$data['password'], PASSWORD_BCRYPT);
        Client::create(\$data);
        header('Location: /clients');
        exit;
    }

    public function edit(\$id)
    {
        \$client = Client::find(\$id);
        echo \$this->blade->run('clients.edit', ['client' => \$client]);
    }

    public function update(\$id)
    {
        \$data = \$_POST;
        \$data['password'] = password_hash(\$data['password'], PASSWORD_BCRYPT);
        \$client = Client::find(\$id);
        if (\$client) {
            \$client->update(\$data);
        }
        header('Location: /clients');
        exit;
    }

    public function show(\$id)
    {
        \$client = Client::find(\$id);
        echo \$this->blade->run('clients.show', ['client' => \$client]);
    }

    public function delete(\$id)
    {
        Client::destroy(\$id);
        header('Location: /clients');
        exit;
    }
}
PHP;

    // Define o caminho completo do novo controlador
    $controllerFilePath = $controllersPath . $controllerName . '.php';

    // Verifica se o controlador já existe
    if (file_exists($controllerFilePath)) {
        echo "Controller '$controllerName' já existe.\n";
        return;
    }

    // Cria o novo arquivo do controlador

    // Altera as permissões do arquivo para 0755
if (file_put_contents($controllerFilePath, $controllerTemplate)) {
        if (chmod($controllerFilePath, 0777)) {
            echo "Controller '{$controllerName}' criado com sucesso e permissões ajustadas para 0777.\n";
        } else {
            echo "Controller '{$controllerName}' criado, mas falha ao ajustar permissões.\n";
        }
    } else {
        echo "Erro ao criar o model '{$controllerName}'.\n";
    }
}


    

    
    
    

    // Limpa os arquivos de cache dos diretórios /cache e /cache/views
    protected function clearCache()
    {
        $cacheDirs = [__DIR__ . '/../cache', __DIR__ . '/../cache/views'];
        
        foreach ($cacheDirs as $dir) {
            if (is_dir($dir)) {
                $files = glob($dir . '/*');
                foreach ($files as $file) {
                    if (is_file($file)) {
                        unlink($file);
                    }
                }
                echo "Cleared cache in $dir.\n";
            } else {
                echo "Error: Cache directory does not exist: $dir.\n";
            }
        }
    }

    // Limpa os arquivos de log do diretório /logs
    protected function clearLogs()
    {
        $logDir = __DIR__ . '/../logs';

        if (is_dir($logDir)) {
            $files = glob($logDir . '/*');
            foreach ($files as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
            echo "Cleared log files in $logDir.\n";
        } else {
            echo "Error: Logs directory does not exist.\n";
        }
    }

    // Cria o banco de dados conforme as variáveis de ambiente
    protected function createDatabase()
    {
        $env = $this->loadEnv();

        $dbHost = $env['DB_HOST'] ?? '127.0.0.1';
        $dbUser = $env['DB_USERNAME'] ?? 'root';
        $dbPass = $env['DB_PASSWORD'] ?? '';
        $dbPort = $env['DB_PORT'] ?? '3306';
        $dbName = $env['DB_DATABASE'] ?? 'my_database';
        $charset = $env['DB_CHARSET'] ?? 'utf8mb4';
        $collation = $env['DB_COLLATION'] ?? 'utf8mb4_general_ci';

        $conn = new \mysqli($dbHost, $dbUser, $dbPass, null, $dbPort);

        if ($conn->connect_error) {
            echo "Connection failed: " . $conn->connect_error . "\n";
            return;
        }

        $sql = "CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET $charset COLLATE $collation";
        if ($conn->query($sql) === TRUE) {
            echo "Database '{$dbName}' created successfully.\n";
        } else {
            echo "Error creating database: " . $conn->error . "\n";
        }

        $conn->close();
    }

    // Verifica a conectividade com o banco de dados
    protected function checkDatabase()
    {
        $env = $this->loadEnv();

        $dbHost = $env['DB_HOST'] ?? '127.0.0.1';
        $dbUser = $env['DB_USERNAME'] ?? 'root';
        $dbPass = $env['DB_PASSWORD'] ?? '';
        $dbName = $env['DB_DATABASE'] ?? 'my_database';
        $dbPort = $env['DB_PORT'] ?? '3306';

        $conn = new \mysqli($dbHost, $dbUser, $dbPass, $dbName, $dbPort);

        if ($conn->connect_error) {
            echo "Connection failed: " . $conn->connect_error . "\n";
        } else {
            echo "Database connection successful.\n";
        }

        $conn->close();
    }

    // Faz um backup do banco de dados
    protected function backupDatabase()
    {
        $env = $this->loadEnv();

        $dbHost = $env['DB_HOST'] ?? '127.0.0.1';
        $dbUser = $env['DB_USERNAME'] ?? 'root';
        $dbPass = $env['DB_PASSWORD'] ?? '';
        $dbName = $env['DB_DATABASE'] ?? 'my_database';
        $backupFile = __DIR__ . '/../backups/' . $dbName . '_' . date('Ymd_His') . '.sql';

        $command = "mysqldump -h $dbHost -u $dbUser -p$dbPass $dbName > $backupFile";
        system($command, $returnVar);

        if ($returnVar === 0) {
            echo "Database backup created successfully: $backupFile\n";
        } else {
            echo "Error creating database backup.\n";
        }
    }

    // Restaura o banco de dados a partir de um arquivo de backup
    protected function restoreDatabase()
    {
        $env = $this->loadEnv();

        $dbHost = $env['DB_HOST'] ?? '127.0.0.1';
        $dbUser = $env['DB_USERNAME'] ?? 'root';
        $dbPass = $env['DB_PASSWORD'] ?? '';
        $dbName = $env['DB_DATABASE'] ?? 'my_database';
        $backupFile = readline("Enter the path to the backup file: ");

        if (!file_exists($backupFile)) {
            echo "Error: Backup file does not exist.\n";
            return;
        }

        $command = "mysql -h $dbHost -u $dbUser -p$dbPass $dbName < $backupFile";
        system($command, $returnVar);

        if ($returnVar === 0) {
            echo "Database restored successfully from $backupFile\n";
        } else {
            echo "Error restoring database.\n";
        }
    }

    // Executa migrações
    protected function migrate()
    {
        $env = $this->loadEnv();
        $dbHost = $env['DB_HOST'] ?? '127.0.0.1';
        $dbUser = $env['DB_USERNAME'] ?? 'root';
        $dbPass = $env['DB_PASSWORD'] ?? '';
        $dbName = $env['DB_DATABASE'] ?? 'my_database';
        $dbPort = $env['DB_PORT'] ?? '3306';

        $conn = new \mysqli($dbHost, $dbUser, $dbPass, $dbName, $dbPort);

        if ($conn->connect_error) {
            echo "Connection failed: " . $conn->connect_error . "\n";
            return;
        }

        $migrationDir = __DIR__ . '/../database/migrations/';
        $files = glob($migrationDir . '*.php');

        foreach ($files as $file) {
            include $file;
            $className = 'Database\Migrations\\' . pathinfo($file, PATHINFO_FILENAME);

            if (class_exists($className)) {
                $migration = new $className;
                $migration->up($conn);
                echo "Migration '{$className}' executed successfully.\n";
            } else {
                echo "Migration class '{$className}' not found.\n";
            }
        }

        $conn->close();
    }

    // Executa seeders do banco de dados
    protected function seed()
    {
        $env = $this->loadEnv();
        $dbHost = $env['DB_HOST'] ?? '127.0.0.1';
        $dbUser = $env['DB_USERNAME'] ?? 'root';
        $dbPass = $env['DB_PASSWORD'] ?? '';
        $dbName = $env['DB_DATABASE'] ?? 'my_database';
        $dbPort = $env['DB_PORT'] ?? '3306';

        $conn = new \mysqli($dbHost, $dbUser, $dbPass, $dbName, $dbPort);

        if ($conn->connect_error) {
            echo "Connection failed: " . $conn->connect_error . "\n";
            return;
        }

        $seederDir = __DIR__ . '/../database/seeders/';
        $files = glob($seederDir . '*.php');

        foreach ($files as $file) {
            include $file;
            $className = 'Database\Seeders\\' . pathinfo($file, PATHINFO_FILENAME);

            if (class_exists($className)) {
                $seeder = new $className;
                $seeder->run($conn);
                echo "Seeder '{$className}' executed successfully.\n";
            } else {
                echo "Seeder class '{$className}' not found.\n";
            }
        }

        $conn->close();
    }

    // Lista diretórios importantes como logs, cache, views e database
    protected function listPaths()
    {
        $paths = [
            'Logs' => __DIR__ . '/../logs',
            'Cache' => __DIR__ . '/../cache',
            'Views' => __DIR__ . '/../cache/views',
            'Database Migrations' => __DIR__ . '/../database/migrations',
            'Database Seeders' => __DIR__ . '/../database/seeders'
        ];

        foreach ($paths as $key => $path) {
            if (is_dir($path)) {
                $files = scandir($path);
                echo "$key:\n";
                foreach ($files as $file) {
                    if ($file !== '.' && $file !== '..') {
                        echo "  $file\n";
                    }
                }
            } else {
                echo "Error: Directory does not exist: $path.\n";
            }
        }
    }

    // Lista rotas definidas (exemplo fictício)
    protected function listRoutes()
    {
        $routesFile = __DIR__ . '/../routes/web.php';

        if (!file_exists($routesFile)) {
            echo "Error: routes/web.php file does not exist.\n";
            return;
        }

        $routes = file_get_contents($routesFile);

        // Regex to find routes
        preg_match_all('/Router::(get|post|put|delete|patch)\s*\'([^\']+)\'/', $routes, $matches);

        echo "Routes:\n";
        foreach ($matches[2] as $route) {
            echo "$route\n";
        }
    }

    // Exibe dicas e comandos úteis para MySQL
    protected function showMysqlHelp()
    {
        echo "Comandos MySQL para criação e gerenciamento de bancos de dados:\n";
        echo "1. Criar um banco de dados:\n";
        echo "   CREATE DATABASE nome_do_banco_de_dados;\n";
        echo "   Exemplo: CREATE DATABASE my_database;\n";
        echo "   - Cria um banco de dados chamado 'my_database'.\n";
        echo "\n";
        echo "2. Excluir um banco de dados:\n";
        echo "   DROP DATABASE nome_do_banco_de_dados;\n";
        echo "   Exemplo: DROP DATABASE my_database;\n";
        echo "   - Exclui o banco de dados chamado 'my_database'.\n";
        echo "\n";
        echo "3. Criar uma tabela:\n";
        echo "   CREATE TABLE nome_da_tabela (\n";
        echo "       coluna1 tipo_de_dado,\n";
        echo "       coluna2 tipo_de_dado,\n";
        echo "       ...\n";
        echo "   );\n";
        echo "   Exemplo: CREATE TABLE users (\n";
        echo "       id INT AUTO_INCREMENT PRIMARY KEY,\n";
        echo "       name VARCHAR(255) NOT NULL\n";
        echo "   );\n";
        echo "   - Cria uma tabela chamada 'users' com colunas 'id' e 'name'.\n";
        echo "\n";
        echo "4. Excluir uma tabela:\n";
        echo "   DROP TABLE nome_da_tabela;\n";
        echo "   Exemplo: DROP TABLE users;\n";
        echo "   - Exclui a tabela chamada 'users'.\n";
        echo "\n";
        echo "5. Mostrar tabelas:\n";
        echo "   SHOW TABLES;\n";
        echo "   - Lista todas as tabelas no banco de dados atual.\n";
        echo "\n";
        echo "6. Mostrar estrutura da tabela:\n";
        echo "   DESCRIBE nome_da_tabela;\n";
        echo "   Exemplo: DESCRIBE users;\n";
        echo "   - Mostra a estrutura da tabela 'users'.\n";
    }

    // Exibe informações sobre a ferramenta SysCli
    protected function displayAbout()
    {
        echo "SysFramework - PHP Framework\n";
        echo "Version 1.0\n";
        echo "Developed by Marco Costa\n";
        echo "marcocosta@gmx.com\n";
    }

    // Exibe o conteúdo do arquivo .env
    protected function displayEnv()
    {
        $envFile = __DIR__ . '/../.env';

        if (!file_exists($envFile)) {
            echo "Error: .env file does not exist.\n";
            return;
        }

        $envContents = file_get_contents($envFile);
        echo ".env file contents:\n" . $envContents;
    }

    // Define uma variável no arquivo .env
    protected function setEnvVar()
    {
        $key = readline("Enter the environment variable key: ");
        $value = readline("Enter the environment variable value: ");
        $envFile = __DIR__ . '/../.env';

        if (!file_exists($envFile)) {
            echo "Error: .env file does not exist.\n";
            return;
        }

        $envContents = file_get_contents($envFile);
        $pattern = "/^{$key}=.*/m";

        if (preg_match($pattern, $envContents)) {
            $envContents = preg_replace($pattern, "{$key}={$value}", $envContents);
        } else {
            $envContents .= "\n{$key}={$value}\n";
        }

        if (file_put_contents($envFile, $envContents)) {
            echo "Environment variable '{$key}' set successfully.\n";
        } else {
            echo "Error: Unable to write to .env file.\n";
        }
    }

    // Executa tarefas de otimização do sistema
    protected function optimize()
    {
        // Exemplo de otimizações comuns
        echo "Starting system optimization...\n";
        
        // Otimiza o autoload do Composer
        echo "Optimizing Composer autoload...\n";
        system('composer dump-autoload -o');

        // Executa tarefas de otimização de cache, se aplicável
        echo "Optimizing application cache...\n";
        $this->warmupCache(); // Pré-aquece o cache

        // Outras otimizações específicas podem ser adicionadas aqui

        echo "System optimization completed.\n";
    }

    // Processa a fila de jobs
    protected function processQueue()
    {
        echo "Processing job queue...\n";
        
        // Exemplo de como processar uma fila de jobs (ajuste conforme necessário)
        $queueDir = __DIR__ . '/../queue';
        $files = glob($queueDir . '/*.php');

        foreach ($files as $file) {
            include $file;
            $jobClass = pathinfo($file, PATHINFO_FILENAME);
            
            // Verifica se a classe de job existe e executa
            if (class_exists($jobClass)) {
                $job = new $jobClass;
                if (method_exists($job, 'handle')) {
                    $job->handle();
                    echo "Job '{$jobClass}' processed successfully.\n";
                } else {
                    echo "Method 'handle' not found in job '{$jobClass}'.\n";
                }
            } else {
                echo "Job class '{$jobClass}' not found.\n";
            }
        }
        
        echo "Job queue processing completed.\n";
    }

    // Inicia o servidor de desenvolvimento
    protected function serve()
    {
        echo "Starting development server...\n";
        
        // Executa o servidor embutido do PHP
        $host = '127.0.0.1';
        $port = '8000';
        echo "Server is running at http://$host:$port\n";
        system("php -S $host:$port -t public");

        // Nota: Esse comando pode ser executado em background se necessário
    }

    // Cria um link simbólico para o diretório de armazenamento
    protected function storageLink()
    {
        echo "Creating storage link...\n";
        
        // Exemplo de como criar um link simbólico para o diretório de armazenamento
        $target = __DIR__ . '/../storage';
        $link = __DIR__ . '/../public/storage';

        if (is_link($link)) {
            echo "Storage link already exists.\n";
            return;
        }

        if (symlink($target, $link)) {
            echo "Storage link created successfully.\n";
        } else {
            echo "Error creating storage link.\n";
        }
    }

    // Preaquece o cache
    protected function warmupCache()
    {
        echo "Warming up cache...\n";
        
        // Exemplo de como pré-aquecer o cache (ajuste conforme necessário)
        $cacheDir = __DIR__ . '/../cache';
        
        // Cria diretório de cache se não existir
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0777, true);
        }

        // Adiciona lógica de pré-aquecimento de cache aqui
        // Por exemplo, você pode fazer uma requisição HTTP para aquecer cache

        echo "Cache warmed up successfully.\n";
    }

    // Executa testes (lógica específica deve ser implementada)
    protected function runTests()
    {
        echo "Running tests.\n";
    }

    // Lista todos os comandos disponíveis
    protected function listCommands()
    {
        echo "Available commands:\n";
        foreach ($this->commands as $command => $method) {
            echo "  $command\n";
        }
    }

    // Exibe informações sobre todos os comandos disponíveis
    protected function displayHelp()
    {
    echo "Available commands and their descriptions:\n";
    echo "  generate:key          Generate a new application key and update it in .env file.\n";
    echo "  clear:cache           Clear the application cache.\n";
    echo "  clear:logs            Clear the application log files.\n";
    echo "  backup:storage        Backup the storage directory.\n";
    echo "  optimize              Run system optimization tasks.\n";
    echo "  queue:process         Process the job queue.\n";
    echo "  serve                 Start the development server.\n";
    echo "  storage:link          Create a symbolic link for the storage directory.\n";
    echo "  cache:warmup          Warm up the application cache.\n";
    echo "  db:backup             Backup the database.\n";
    echo "  db:restore            Restore the database from a backup file.\n";
    echo "  migrate               Run database migrations.\n";
    echo "  seed                  Run database seeders.\n";
    echo "  list                  List all available commands.\n";
    echo "  help                  Display this help message.\n";
    echo "  version               Display the version of the SysCli tool.\n";
    echo "  check:env             Check the environment configuration.\n";
    echo "  clean:logs            Clean old log files.\n";
    echo "  list:paths            List important directories like logs, cache, views, and database migrations.\n";
    echo "  list:routes           List all routes defined in routes/web.php.\n";
    echo "  show:mysql            Show MySQL help and commands.\n";
    echo "  about                 Display information about the SysCli tool.\n";
    echo "  env                   Display the content of the .env file.\n";
    echo "  set:env               Set a variable in the .env file.\n";
    echo "  make:controller name  Controller create.\n";
    echo "  make:model name       Model create.\n";
    echo "  make:permissions      Framework ajust permissions.\n";
    echo "  make:component name   Cria Component.\n";
    echo "  make:userstable       Cria Tabela de Usuários.\n";
    echo "  make:clientstable     Cria Tabela de Clients.\n";
    }

    // Exibe a versão da ferramenta SysCli
    protected function displayVersion()
    {
        echo "SysFramework Version 1.0\n";
    }

    // Carrega variáveis de ambiente do arquivo .env
    protected function loadEnv()
    {
        $envFile = __DIR__ . '/../.env';
        $env = [];

        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                list($key, $value) = explode('=', $line, 2) + [NULL, NULL];
                $env[$key] = $value;
            }
        }

        return $env;
    }
    
    // Faz backup da pasta /storage para /backups
    protected function backupStorage()
    {
        echo "Starting storage backup...\n";

        $sourceDir = __DIR__ . '/../storage';
        $backupDir = __DIR__ . '/../backups/storage_backup_' . date('Ymd_His');

        // Cria o diretório de backup, se não existir
        if (!is_dir($backupDir)) {
            if (!mkdir($backupDir, 0777, true)) {
                echo "Error: Unable to create backup directory.\n";
                return;
            }
        }

        // Faz a cópia dos arquivos
        $this->copyDir($sourceDir, $backupDir);

        echo "Backup completed successfully: {$backupDir}\n";
    }

    // Copia o diretório e seu conteúdo
    protected function copyDir($sourceDir, $backupDir)
    {
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($sourceDir, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($files as $file) {
            $dest = $backupDir . DIRECTORY_SEPARATOR . $files->getSubPathName();

            if ($file->isDir()) {
                if (!mkdir($dest, 0777, true) && !is_dir($dest)) {
                    echo "Error: Failed to create directory {$dest}\n";
                }
            } else {
                if (!copy($file, $dest)) {
                    echo "Error: Failed to copy file {$file} to {$dest}\n";
                }
            }
        }
    }
}

