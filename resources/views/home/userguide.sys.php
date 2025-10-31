<?php ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>SysFramework — Documentação</title>
  <style>
    body { font-family: Arial, Helvetica, sans-serif; margin: 0; display: flex; }
    nav {
      width: 280px;
      background: #0b3a66;
      color: #fff;
      height: 100vh;
      overflow-y: auto;
      padding: 20px;
      box-sizing: border-box;
    }
    nav h2 {
      font-size: 20px;
      margin-top: 0;
      text-align: center;
    }
    nav input {
      width: 100%;
      padding: 8px;
      margin-bottom: 12px;
      border-radius: 4px;
      border: none;
      font-size: 14px;
    }
    nav ul { list-style: none; padding: 0; margin: 0; }
    nav li { margin-bottom: 6px; }
    nav a {
      color: #fff;
      text-decoration: none;
      display: block;
      padding: 4px 8px;
      border-radius: 4px;
    }
    nav a:hover { background: #155d9b; }
    main { flex: 1; padding: 24px; background: #f7f9fc; overflow-y: auto; }
    header { border-bottom: 2px solid #ccc; margin-bottom: 20px; }
    .class-section { background: #fff; padding: 20px; margin-bottom: 32px; border-radius: 8px; box-shadow: 0 0 6px rgba(0,0,0,0.1); }
    pre { background: #f4f4f4; padding: 12px; border-radius: 6px; overflow: auto; font-size: 14px; }
    code { background: #eef; padding: 2px 4px; border-radius: 4px; }
    h3, h4 { color: #0b3a66; }
  </style>
</head>
<body>
  <nav>

    
	<h2><a href="/">SysFramework Home</a></h2>
	  
	  
    <h2>Core</h2>
    <a href="#SysRouter">SysRouter</a>
    <a href="#BaseController">BaseController</a>
    <a href="#Cache">Cache</a>
    <a href="#Component">Component</a>
    <a href="#Component">ComponentManager</a>
    <a href="#Request">Request</a>
    <a href="#Response">Response</a>
    <a href="#Security">Security</a>
    <a href="#SysCli">SysCli</a>
    <a href="#SysController">SysController</a>
    <a href="#SysEnv">SysEnv</a>
    <a href="#SysImages">SysImages</a>
    <a href="#SysLogger">SysLogger</a>
    <a href="#SysMailer">SysMailer</a>
    <a href="#SysORM">SysORM</a>
    <a href="#SysORMAuth">SysORMAuth</a>
    <a href="#SysORMHash">SysORMHash</a>
    <a href="#SysORMRequest">SysORMRequest</a>
    <a href="#SysSanitize">SysSanitize</a>
    <a href="#SysTables">SysTables</a>
    <a href="#SysTE">SysTE</a>
    <a href="#Translator">Translator</a>
    <a href="#Validations">Validations</a>
    
    <hr>
    
    <h2>Config</h2>
	<a href="#bootstrap">/config/bootstrap.php</a>
	<a href="#databese">/config/database.php</a>
	<a href="#functions">/config/functions.php</a>
	<a href="#helpers">/config/helpers.php</a>
	<a href="#loadenv">/config/loadenv.php</a>
	<a href="#paths">/config/paths.php</a>
	<a href="#settings">/config/settings.php</a>
	
	
	<hr>
    
    <h2>Public</h2>
	<a href="#public-index">/public/index.php</a>
	<a href="#public-robots">/public/robots.txt</a>
	<a href="#public-htaccess">/public/.htaccess</a>
	
	<hr>
    
    <h2>Raiz</h2>
	<a href="#env">.env</a>
	<a href="#htaccess">.htaccess</a>
	<a href="#composer-json">composer.json</a>
	<a href="#license">license</a>
	<a href="#readme">readme</a>
	<a href="#syscli">syscli</a>
	
	
	<hr>
    
    <h2>App</h2>
	<a href="#components-Alert">/app/Components/Alert</a>
	<a href="#console-makeclienttablecommand">/app/Console/Commands/MakeUserTableCommand</a>
	<a href="#console-makeusertablecommand">/app/Console/Commands/MakeUserTableCommand</a>
	<a href="#controllers-apiusercontroller">/app/Controllers/Api/UserController</a>
	<a href="#controllers-authcontroller">/app/Controllers/AuthController</a>
	<a href="#controllers-clientcontroller">/app/Controllers/ClientController</a>
	<a href="#controllers-homecontroller">/app/Controllers/HomeController</a>
	<a href="#middlewares-apiauthmiddlewar">/app/Middlewares/ApiAuthMiddleware</a>
	<a href="#middlewares-authmiddleware">/app/Middlewares/AuthMiddleware</a>
	<a href="#models-auth">/app/Models/Auth</a>
	<a href="#models-Client">/app/Models/Client</a>
	<a href="#services-authservice">/app/Services/AuthService</a>
	<a href="#services-syscacheservice">/app/Services/SysCacheService</a>
	<a href="#services-sysqueueservice">/app/Services/SysQueueService</a>
	<a href="#sevicces-userrequest">/app/Services/UserRequest</a>

	
	<hr>
    
    <h2>Routes</h2>
	<a href="#routes-web">/routes/web.php</a>



  </nav>
  </nav>

  <main>
    <header>
      <h1>Documentação do Core — SysFramework</h1>
      <p>Manual técnico e didático das classes fundamentais do núcleo do SysFramework.</p>
    </header>
    
    
    
    <section id="SysRouter" class="classe-doc">
    <h2>
        <i class="bi bi-router-fill text-primary"></i>
        Classe: <code>SysRouter</code>
    </h2>
    <p>
        <i class="bi bi-info-circle text-secondary"></i>
        A classe <strong>SysRouter</strong> é responsável por gerenciar todas as rotas do aplicativo, permitindo registrar rotas, 
        grupos de rotas, middlewares, limites de requisição (rate limiting), flash messages, respostas JSON e páginas de erro personalizadas.
    </p>

    <h3><i class="bi bi-diagram-2 text-success"></i> Namespace</h3>
    <pre><code>namespace Core;</code></pre>

    <h3><i class="bi bi-list-check text-warning"></i> Principais Funcionalidades</h3>
    <ul>
        <li>Registrar rotas: <code>get()</code>, <code>post()</code>, <code>put()</code>, <code>delete()</code>.</li>
        <li>Grupos de rotas com prefixos e middlewares: <code>group()</code>.</li>
        <li>Rate limiting para proteger contra abuso de requisições.</li>
        <li>Rotas nomeadas para fácil geração de URLs: <code>route()</code>.</li>
        <li>Resolução de requisições e chamada automática de controllers: <code>resolve()</code>.</li>
        <li>Middlewares globais e específicos.</li>
        <li>Logs de acesso e erros.</li>
        <li>Respostas JSON e flash messages.</li>
        <li>Redirecionamento via <code>redirect()</code>.</li>
        <li>Validação de CSRF token: <code>validateCsrf()</code>.</li>
        <li>Páginas de erro customizadas: <code>setCustomErrorPage()</code>.</li>
    </ul>

    <h3><i class="bi bi-box-arrow-in-right text-success"></i> Registro de Rotas</h3>
    <p>Exemplos de registro de rotas:</p>
    <pre><code>
SysRouter::get('/home', 'HomeController@index')->name('home');
SysRouter::post('/login', 'AuthController@login')->name('login');
SysRouter::group(['prefix' => '/admin', 'middleware' => ['AuthMiddleware']], function() {
    SysRouter::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
});
    </code></pre>

    <h3><i class="bi bi-shield-fill-exclamation text-danger"></i> Rate Limiting</h3>
    <p>
        Protege contra excesso de requisições. Se um IP exceder o limite definido (<code>requestLimit</code>) 
        em um determinado intervalo (<code>timeFrame</code>), ele será temporariamente bloqueado.
    </p>

    <h3><i class="bi bi-code-slash text-secondary"></i> Resolução de Requisições</h3>
    <p>
        <code>resolve($requestMethod, $requestUri, $dependencies)</code> compara a URL solicitada com as rotas registradas, 
        aplica middlewares, valida parâmetros e chama o controller correspondente.
    </p>

    <h3><i class="bi bi-patch-check text-success"></i> Rotas Nomeadas</h3>
    <pre><code>
$url = SysRouter::route('home'); // Retorna /home
$urlAdmin = SysRouter::route('admin.dashboard'); // Retorna /admin/dashboard
</code></pre>

    <h3><i class="bi bi-arrow-right-circle text-info"></i> Redirecionamento</h3>
    <pre><code>
SysRouter::redirect('home'); // Redireciona para rota nomeada 'home'
SysRouter::redirect('admin.dashboard', ['id' => 10]); // Redireciona com parâmetros
</code></pre>

    <h3><i class="bi bi-file-text-fill text-warning"></i> Respostas JSON</h3>
    <pre><code>
SysRouter::jsonResponse(['status' => 'success', 'data' => $data], 200);
</code></pre>

    <h3><i class="bi bi-bug-fill text-danger"></i> Logs e Monitoramento</h3>
    <ul>
        <li>Access logs: <code>logs/access.log</code></li>
        <li>Error logs: <code>logs/router.log</code></li>
        <li>Blocked IP logs: <code>logs/block.log</code></li>
    </ul>

    <h3><i class="bi bi-exclamation-triangle-fill text-warning"></i> Páginas de Erro Customizadas</h3>
    <pre><code>
SysRouter::setCustomErrorPage(404, function() {
    echo "Página não encontrada!";
});
</code></pre>

    <h3><i class="bi bi-lightbulb text-warning"></i> Dicas de Uso</h3>
    <ul>
        <li>Use grupos para organizar rotas com prefixos comuns e aplicar middlewares.</li>
        <li>Defina rotas nomeadas para facilitar a geração de URLs e redirecionamentos.</li>
        <li>Ative rate limiting para proteger APIs públicas de abuso de requisições.</li>
        <li>Use <code>resolve()</code> no ponto de entrada principal do aplicativo (ex.: index.php).</li>
        <li>Combine <code>flash()</code> e <code>getFlash()</code> para mensagens temporárias entre redirecionamentos.</li>
        <li>Valide tokens CSRF em formulários POST com <code>validateCsrf()</code>.</li>
    </ul>

    <h3><i class="bi bi-star-fill text-warning"></i> Conclusão</h3>
    <p>
        A classe <strong>SysRouter</strong> fornece um sistema completo de roteamento para aplicações PHP, 
        integrando segurança, middlewares, logs, rotas nomeadas, rate limiting e suporte a respostas JSON e flash messages.
    </p>
</section>


    <!-- ============================= -->
    <!-- BaseController -->
    <!-- ============================= -->
    <section id="BaseController" class="class-section">
      <h2>BaseController</h2>
      <p><strong>Namespace:</strong> <code>Core</code><br>
      <strong>Caminho:</strong> <code>core/BaseController.php</code></p>

      <h3>Descrição</h3>
      <p>
        A classe <strong>BaseController</strong> é a classe base concreta de todos os controladores do SysFramework.
        Ela fornece métodos utilitários essenciais para enviar respostas padronizadas em formato JSON,
        garantindo consistência entre as respostas da aplicação e facilitando o uso de APIs RESTful.
      </p>

      <h3>Responsabilidades principais</h3>
      <ul>
        <li>Definir o comportamento padrão de saída HTTP dos controladores.</li>
        <li>Facilitar o envio de respostas <code>JSON</code> e mensagens de erro uniformes.</li>
        <li>Servir como superclasse para todos os controladores da aplicação.</li>
      </ul>

      <h3>Métodos</h3>

      <h4>jsonResponse($data, $status = 200)</h4>
      <p>Retorna uma resposta JSON genérica para o cliente.</p>

      <h4>jsonError($message, $status = 400)</h4>
      <p>Retorna uma resposta JSON formatada para erros, padronizando o formato.</p>

      <h3>Exemplo</h3>
      <pre>
class UserController extends BaseController {
    public function get() {
        $this->jsonResponse(['status' => 'ok']);
    }
}
      </pre>
    </section>

    <!-- ============================= -->
    <!-- Cache -->
    <!-- ============================= -->
    <section id="Cache" class="class-section">
      <h2>Cache</h2>
      <p><strong>Namespace:</strong> <code>Core</code><br>
      <strong>Caminho:</strong> <code>core/Cache.php</code></p>

      <h3>Descrição</h3>
      <p>
        A classe <strong>Cache</strong> implementa um sistema simples de cache baseado em arquivos JSON,
        com suporte opcional a verificação de integridade via HMAC (hash autenticado).
        É ideal para armazenar dados temporários, resultados de consultas ou respostas de APIs,
        evitando reprocessamentos e melhorando a performance da aplicação.
      </p>

      <h3>Propriedades</h3>
      <ul>
        <li><code>protected string $path</code> — Caminho base onde os arquivos de cache serão salvos.</li>
        <li><code>protected ?string $hmacKey</code> — Chave opcional para gerar assinaturas HMAC e garantir integridade.</li>
      </ul>

      <h3>Métodos</h3>

      <h4>__construct(string $path, ?string $hmacKey = null)</h4>
      <p>Inicializa o sistema de cache, criando o diretório especificado se necessário.</p>

      <h4>fileForKey(string $key): string</h4>
      <p>Gera o caminho completo do arquivo de cache a partir de uma chave fornecida.</p>

      <h4>set(string $key, $value, int $ttl = 3600): bool</h4>
      <p>
        Armazena um valor no cache.  
        O valor é codificado em JSON e salvo junto com a data de expiração (<code>$ttl</code> em segundos).
        Se uma <code>hmacKey</code> foi definida, o conteúdo é assinado com HMAC-SHA256.
      </p>
      <ul>
        <li><strong>$key:</strong> Identificador único do item de cache.</li>
        <li><strong>$value:</strong> Valor a ser armazenado (qualquer tipo serializável em JSON).</li>
        <li><strong>$ttl:</strong> Tempo de vida em segundos (padrão 3600 = 1 hora).</li>
      </ul>

      <h4>get(string $key)</h4>
      <p>
        Recupera um valor do cache, se ainda válido.  
        Caso o arquivo não exista, esteja expirado ou tenha sido adulterado (HMAC inválido), retorna <code>null</code>.
      </p>

      <h4>delete(string $key): bool</h4>
      <p>Remove um item de cache específico, caso exista.</p>

      <h3>Exemplo de uso</h3>
      <pre>
use Core\Cache;

$cache = new Cache(__DIR__ . '/cache', 'minha_chave_hmac');

// Gravar valor no cache
$cache->set('config', ['modo' => 'produção'], 600);

// Ler valor
$config = $cache->get('config');

// Excluir valor
$cache->delete('config');
      </pre>

      <h3>Notas técnicas</h3>
      <ul>
        <li>Armazena os dados como arquivos <code>.cache</code> no diretório especificado.</li>
        <li>Utiliza <code>md5($key)</code> para nomear os arquivos de forma uniforme.</li>
        <li>Garante atomicidade na escrita com <code>tempnam()</code> e <code>rename()</code>.</li>
        <li>O uso de HMAC previne adulteração manual dos arquivos de cache.</li>
        <li>Indicado para ambientes sem Redis/Memcached.</li>
      </ul>

      <h3>Boas práticas</h3>
      <ul>
        <li>Utilize chaves descritivas, ex: <code>user_123_profile</code>.</li>
        <li>Evite armazenar dados muito grandes (limite recomendado: até 2 MB por item).</li>
        <li>Limpe periodicamente o diretório de cache se o sistema gerar muitos arquivos expirados.</li>
      </ul>

      <h3>Histórico</h3>
      <ul>
        <li>🟩 <strong>v1.0</strong> — Implementação inicial com suporte a JSON + HMAC opcional.</li>
      </ul>
    </section>
    
    
    <section id="Component">
<h2>Core\Component</h2>
<p>Classe abstrata para criação de componentes reutilizáveis no SysFramework. Cada componente pode receber atributos dinâmicos e deve implementar seu próprio método <code>render()</code>.</p>

<h3>Propriedades</h3>
<table>
<tr><th>Propriedade</th><th>Tipo</th><th>Descrição</th></tr>
<tr><td><code>$attributes</code></td><td>array</td><td>Lista de atributos personalizados passados ao componente.</td></tr>
</table>

<h3>Métodos</h3>
<table>
<tr><th>Método</th><th>Descrição</th></tr>
<tr><td><code>__construct($attributes = [])</code></td><td>Inicializa o componente com atributos dinâmicos.</td></tr>
<tr><td><code>render()</code></td><td>Método abstrato que deve ser implementado para renderizar o componente.</td></tr>
<tr><td><code>__get($name)</code></td><td>Permite acessar atributos dinâmicos como propriedades do objeto.</td></tr>
</table>

<h3>Exemplo</h3>
<pre><code>class Botao extends Component {
    public function render() {
        return "&lt;button class='btn btn-primary'&gt;" .
               htmlspecialchars($this->label ?? 'OK') .
               "&lt;/button&gt;";
    }
}

// Uso:
$botao = new Botao(['label' => 'Salvar']);
echo $botao->render();</code></pre>
</section>


<section id="ComponentManager">
<h2>Core\ComponentManager</h2>
<p>
A classe <code>ComponentManager</code> é responsável por localizar, instanciar e renderizar
componentes definidos na aplicação.  
Ela funciona como o “controlador de componentes” do SysFramework, garantindo
que cada componente seja carregado de forma dinâmica e independente.
</p>

<h3>Propriedades</h3>
<p><em>Esta classe não possui propriedades declaradas.</em></p>

<h3>Métodos</h3>
<table>
<tr><th>Método</th><th>Descrição</th></tr>
<tr>
<td><code>render($name, $attributes = [])</code></td>
<td>
Localiza e renderiza um componente da aplicação.
O nome informado deve corresponder à classe dentro do namespace <code>App\Components</code>.
Caso a classe não exista, uma exceção é lançada.
</td>
</tr>
</table>

<h3>Funcionamento</h3>
<p>
O método <code>render()</code> monta automaticamente o nome completo da classe do componente,
verifica sua existência com <code>class_exists()</code>, instancia o componente passando seus atributos,
e então chama o método <code>render()</code> do próprio componente.
</p>

<h3>Exemplo de uso</h3>
<pre><code>// Estrutura esperada:
// App/Components/Botao.php

namespace App\Components;
use Core\Component;

class Botao extends Component {
    public function render() {
        return "&lt;button class='btn'&gt;" .
               htmlspecialchars($this->label ?? 'OK') .
               "&lt;/button&gt;";
    }
}

// Exemplo de uso do ComponentManager:
use Core\ComponentManager;

$manager = new ComponentManager();

// Renderiza o componente "Botao"
echo $manager->render('botao', ['label' => 'Enviar']);
</code></pre>

<h3>Tratamento de erros</h3>
<p>
Se o componente especificado não for encontrado, é lançada uma exceção:
</p>
<pre><code>throw new \Exception("Componente {$name} não encontrado.");</code></pre>

<p>Isso ajuda a detectar rapidamente problemas de nomenclatura ou caminhos incorretos.</p>
</section>





<section id="Request">
<h2>Core\Request</h2>
<p>
A classe <code>Request</code> encapsula todas as informações relacionadas à requisição HTTP atual.
Ela fornece métodos convenientes para acessar o método HTTP, URI, parâmetros <code>GET</code> e <code>POST</code>,
cabeçalhos (headers) e detectar o tipo da requisição (como AJAX, GET, POST, PUT, DELETE).
</p>

<h3>Propriedades</h3>
<table>
<tr><th>Propriedade</th><th>Tipo</th><th>Descrição</th></tr>
<tr><td><code>$method</code></td><td>string</td><td>Armazena o método HTTP da requisição (GET, POST, etc.).</td></tr>
<tr><td><code>$uri</code></td><td>string</td><td>URI requisitada pelo cliente.</td></tr>
<tr><td><code>$get</code></td><td>array</td><td>Contém os parâmetros enviados via <code>$_GET</code>.</td></tr>
<tr><td><code>$post</code></td><td>array</td><td>Contém os parâmetros enviados via <code>$_POST</code>.</td></tr>
<tr><td><code>$headers</code></td><td>array</td><td>Lista de cabeçalhos HTTP obtidos através de <code>getallheaders()</code>.</td></tr>
</table>

<h3>Métodos</h3>
<table>
<tr><th>Método</th><th>Descrição</th></tr>
<tr><td><code>__construct()</code></td><td>Inicializa as propriedades com base nas variáveis globais da requisição atual.</td></tr>
<tr><td><code>method()</code></td><td>Retorna o método HTTP (ex.: GET, POST, PUT, DELETE).</td></tr>
<tr><td><code>uri()</code></td><td>Retorna a URI requisitada.</td></tr>
<tr><td><code>get($key = null, $default = null)</code></td><td>Obtém um parâmetro específico de <code>$_GET</code> ou o array completo.</td></tr>
<tr><td><code>post($key = null, $default = null)</code></td><td>Obtém um parâmetro específico de <code>$_POST</code> ou o array completo.</td></tr>
<tr><td><code>headers()</code></td><td>Retorna o array completo de cabeçalhos da requisição.</td></tr>
<tr><td><code>header($key, $default = null)</code></td><td>Retorna o valor de um cabeçalho específico, se existir.</td></tr>
<tr><td><code>isAjax()</code></td><td>Verifica se a requisição foi feita via AJAX.</td></tr>
<tr><td><code>isPost()</code></td><td>Retorna <code>true</code> se o método for POST.</td></tr>
<tr><td><code>isGet()</code></td><td>Retorna <code>true</code> se o método for GET.</td></tr>
<tr><td><code>isPut()</code></td><td>Retorna <code>true</code> se o método for PUT.</td></tr>
<tr><td><code>isDelete()</code></td><td>Retorna <code>true</code> se o método for DELETE.</td></tr>
</table>

<h3>Descrição detalhada</h3>
<p>
A classe <code>Request</code> abstrai o acesso às variáveis superglobais do PHP, oferecendo uma interface
orientada a objetos para ler parâmetros de requisição de forma segura e limpa.
</p>
<p>
Ela é normalmente utilizada dentro dos controladores para manipular os dados enviados pelo cliente
sem precisar acessar diretamente <code>$_GET</code> ou <code>$_POST</code>.
</p>

<h3>Exemplo de uso</h3>
<pre><code>use Core\Request;

$request = new Request();

// Verificar o método HTTP
if ($request->isPost()) {
    $nome = $request->post('nome');
    echo "Dados recebidos via POST: " . htmlspecialchars($nome);
}

// Detectar requisição AJAX
if ($request->isAjax()) {
    echo "Requisição AJAX detectada.";
}

// Acessar cabeçalhos
$userAgent = $request->header('User-Agent');
echo "Navegador: " . $userAgent;
</code></pre>

<h3>Observações</h3>
<ul>
<li>Os métodos <code>isPost()</code>, <code>isGet()</code>, <code>isPut()</code> e <code>isDelete()</code> facilitam a identificação do tipo de requisição.</li>
<li>O método <code>isAjax()</code> detecta requisições feitas via JavaScript (com header <code>X-Requested-With: XMLHttpRequest</code>).</li>
<li>Ideal para uso em controladores e middlewares do SysFramework.</li>
</ul>
</section>




<section id="Response" class="doc-section">
    <h2>Classe <code>Core\Response</code></h2>
    <p>
        A classe <strong>Response</strong> é responsável por gerenciar as respostas HTTP enviadas pelo servidor.
        Ela define o <em>status code</em>, adiciona cabeçalhos personalizados, envia o conteúdo da resposta
        (como HTML ou JSON) e realiza redirecionamentos quando necessário.
    </p>

    <h3>📁 Namespace</h3>
    <pre><code>namespace Core;</code></pre>

    <h3>🧩 Atributos</h3>
    <ul>
        <li><code>protected int $statusCode = 200;</code> — Código de status HTTP padrão (200 OK).</li>
        <li><code>protected array $headers = [];</code> — Armazena os cabeçalhos (headers) da resposta.</li>
    </ul>

    <h3>⚙️ Métodos</h3>

    <h4><code>setStatusCode(int $code)</code></h4>
    <p>Define o código de status HTTP da resposta. Exemplo: 200 (OK), 404 (Not Found), 500 (Internal Server Error).</p>
    <pre><code>$response->setStatusCode(404);</code></pre>

    <h4><code>addHeader(string $name, string $value)</code></h4>
    <p>Adiciona um cabeçalho (header) personalizado à resposta.</p>
    <pre><code>$response->addHeader('Content-Type', 'application/json');</code></pre>

    <h4><code>send($content)</code></h4>
    <p>
        Envia todos os cabeçalhos definidos e exibe o conteúdo fornecido (geralmente HTML, texto ou JSON).
    </p>
    <pre><code>
$response->setContentType('text/html')
         ->setStatusCode(200)
         ->send('&lt;h1&gt;Página carregada com sucesso!&lt;/h1&gt;');
    </code></pre>

    <h4><code>redirect($url)</code></h4>
    <p>
        Redireciona o cliente para outra URL com o código de status <code>302</code> (Found).
    </p>
    <pre><code>$response->redirect('/login');</code></pre>

    <h4><code>setContentType($type = 'text/html')</code></h4>
    <p>
        Define o tipo de conteúdo da resposta. Exemplo: <code>text/html</code>, <code>application/json</code>, etc.
    </p>
    <pre><code>$response->setContentType('application/json');</code></pre>

    <h3>💡 Exemplo Prático</h3>
    <pre><code>
use Core\Response;

$response = new Response();

// Envia resposta HTML simples
$response->setStatusCode(200)
         ->setContentType('text/html')
         ->send('&lt;h1&gt;Bem-vindo ao SysFramework!&lt;/h1&gt;');

// Redireciona para outra rota
//$response->redirect('/home');
    </code></pre>

    <h3>🧠 Observações</h3>
    <ul>
        <li>Os métodos <code>setStatusCode()</code> e <code>addHeader()</code> retornam a própria instância da classe (padrão Fluent Interface).</li>
        <li>O método <code>redirect()</code> encerra imediatamente a execução do script.</li>
        <li>É possível combinar o <code>Response</code> com o <code>Request</code> para criar controladores RESTful.</li>
    </ul>
</section>




<section id="Security" class="doc-section">
    <h2>Classe <code>Core\Security</code></h2>
    <p>
        A classe <strong>Security</strong> fornece um conjunto de métodos estáticos para aumentar a segurança das aplicações
        desenvolvidas com o <strong>SysFramework</strong>.  
        Ela protege contra ataques comuns como <em>Cross-Site Scripting (XSS)</em>, <em>injeção SQL</em> e 
        <em>requisições forjadas (CSRF)</em>.
    </p>

    <h3>📁 Namespace</h3>
    <pre><code>namespace Core;</code></pre>

    <h3>🧰 Métodos</h3>

    <h4><code>sanitize(string $value)</code></h4>
    <p>
        Remove todas as tags HTML e converte caracteres especiais para entidades seguras.
        Ideal para limpar entradas de formulários antes de armazenar ou exibir.
    </p>
    <pre><code>
$nome = "&lt;script&gt;alert('XSS')&lt;/script&gt;";
$seguro = Security::sanitize($nome); 
// Resultado: alert('XSS') — sem tags HTML
    </code></pre>

    <h4><code>escapeSql(string $value)</code></h4>
    <p>
        Sanitiza uma string contra injeções SQL.  
        No entanto, o uso recomendado é de <strong>prepared statements</strong> em vez de escaping manual.
    </p>
    <pre><code>
// Evite concatenar valores diretamente em queries SQL.
// Use sempre prepared statements com PDO.
$query = $pdo->prepare("SELECT * FROM usuarios WHERE nome = ?");
$query->execute([$nome]);
    </code></pre>

    <h4><code>generateCsrfToken()</code></h4>
    <p>
        Gera e armazena um token <strong>CSRF</strong> na sessão, usado para proteger formulários contra envios maliciosos
        externos.
    </p>
    <pre><code>
$token = Security::generateCsrfToken();
echo '&lt;input type="hidden" name="csrf_token" value="' . $token . '"&gt;';
    </code></pre>

    <h4><code>validateCsrfToken(string $token)</code></h4>
    <p>
        Valida o token CSRF enviado em um formulário comparando-o com o valor armazenado na sessão.
    </p>
    <pre><code>
if (!Security::validateCsrfToken($_POST['csrf_token'])) {
    die('Token CSRF inválido!');
}
    </code></pre>

    <h4><code>escapeHtml(string $value)</code></h4>
    <p>
        Escapa caracteres HTML perigosos, prevenindo ataques de XSS.  
        Deve ser utilizado sempre que dados do usuário forem exibidos na interface.
    </p>
    <pre><code>
echo Security::escapeHtml($comentario);
// Exemplo: converte &lt;script&gt; em &amp;lt;script&amp;gt;
    </code></pre>

    <h4><code>validateUrl(string $url)</code></h4>
    <p>
        Verifica se uma string é uma URL válida usando <code>filter_var()</code>.
    </p>
    <pre><code>
if (!Security::validateUrl($url)) {
    echo "URL inválida!";
}
    </code></pre>

    <h3>💡 Exemplo Prático</h3>
    <pre><code>
use Core\Security;

session_start();

// Gera o token CSRF para o formulário
$csrfToken = Security::generateCsrfToken();

// Exibe o formulário protegido
echo '&lt;form method="post"&gt;';
echo '&lt;input type="hidden" name="csrf_token" value="' . $csrfToken . '"&gt;';
echo '&lt;input type="text" name="nome"&gt;';
echo '&lt;button type="submit"&gt;Enviar&lt;/button&gt;';
echo '&lt;/form&gt;';

// Valida a submissão
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Security::validateCsrfToken($_POST['csrf_token'])) {
        die('Falha de segurança: token CSRF inválido!');
    }
    echo 'Token válido e dados processados com segurança.';
}
    </code></pre>

    <h3>🧠 Boas Práticas</h3>
    <ul>
        <li>Sempre sanitize e escape dados vindos do usuário antes de exibir na página.</li>
        <li>Use <code>generateCsrfToken()</code> e <code>validateCsrfToken()</code> em todos os formulários POST.</li>
        <li>Evite usar <code>escapeSql()</code>; prefira <strong>prepared statements</strong> do PDO ou MySQLi.</li>
        <li>Combine o uso desta classe com <code>Request</code> e <code>Response</code> para segurança completa.</li>
    </ul>
</section>


<section id="syscli" class="doc-section">
    <h2>Classe <code>Core\SysCli</code></h2>
    <p>
        A classe <strong>SysCli</strong> oferece uma forma segura e estruturada de executar comandos de terminal
        (<em>Command Line Interface</em>) a partir do SysFramework.  
        Ela foi projetada para prevenir falhas de segurança, evitando injeções de comando e exposição de credenciais sensíveis.
    </p>

    <h3>📁 Namespace</h3>
    <pre><code>namespace Core;</code></pre>

    <h3>🧩 Visão Geral</h3>
    <ul>
        <li>Executa comandos de terminal de forma segura com <code>escapeshellarg()</code>.</li>
        <li>Permite o controle de saída e erros através de <code>proc_open()</code>.</li>
        <li>Inclui funções utilitárias para operações CLI específicas como <strong>mysqldump</strong> e servidor PHP embutido.</li>
    </ul>

    <h3>🧠 Propriedades</h3>
    <ul>
        <li><code>protected array $commands</code> — lista interna de comandos registrados (reservada para expansões futuras).</li>
    </ul>

    <h3>⚙️ Métodos</h3>

    <h4><code>protected runShellCommand(string $cmd, array $args = []): array</code></h4>
    <p>
        Executa um comando de forma segura, escapando todos os argumentos e capturando o código de status, a saída e o erro.  
        Este é o método interno usado por todos os outros métodos públicos.
    </p>
    <pre><code>
use Core\SysCli;

$cli = new SysCli();
$result = $cli->execCommand('ls', ['-la']);

echo "Comando: " . $result['cmd'] . PHP_EOL;
echo "Saída: " . $result['output'] . PHP_EOL;
echo "Erro: " . $result['error'] . PHP_EOL;
echo "Status: " . $result['status'];
    </code></pre>

    <h4><code>mysqldump(array $dbConfig, string $dumpFile): array</code></h4>
    <p>
        Realiza um <code>mysqldump</code> de forma segura, sem expor senhas na linha de comando.  
        Cria temporariamente um arquivo de configuração protegido com as credenciais, executa o comando e o remove ao final.
    </p>
    <pre><code>
$dbConfig = [
    'host' => 'localhost',
    'user' => 'root',
    'password' => 'senhaSegura123',
    'database' => 'meu_banco'
];

$cli = new SysCli();
$result = $cli->mysqldump($dbConfig, '/backups/meu_banco.sql');

if ($result['status'] === 0) {
    echo "Backup realizado com sucesso!";
} else {
    echo "Erro no backup: " . $result['error'];
}
    </code></pre>

    <h4><code>serve(string $host = '127.0.0.1', int $port = 8000, string $docroot = 'public'): array</code></h4>
    <p>
        Inicia o servidor embutido do PHP apontando para o diretório especificado.  
        Útil em ambiente de desenvolvimento para testes rápidos de aplicações.
    </p>
    <pre><code>
$cli = new SysCli();
$cli->serve('0.0.0.0', 8080, 'public');
    </code></pre>

    <h4><code>execCommand(string $command, array $args = []): array</code></h4>
    <p>
        Executa um comando genérico no terminal, utilizando internamente <code>runShellCommand()</code>.  
        Todos os argumentos são automaticamente escapados para segurança.
    </p>
    <pre><code>
$cli = new SysCli();
$result = $cli->execCommand('ping', ['-c', '4', 'google.com']);
echo $result['output'];
    </code></pre>

    <h3>💡 Exemplo Prático</h3>
    <pre><code>
use Core\SysCli;

$cli = new SysCli();

// Rodar comando simples
echo "&lt;pre&gt;";
print_r($cli->execCommand('whoami'));
echo "&lt;/pre&gt;";

// Iniciar servidor PHP local
$cli->serve('127.0.0.1', 9000, 'public');

// Realizar dump de banco de dados de forma segura
$config = [
    'host' => 'localhost',
    'user' => 'root',
    'password' => '123456',
    'database' => 'sysdb'
];
print_r($cli->mysqldump($config, '/tmp/sysdb.sql'));
    </code></pre>

    <h3>🧱 Estrutura de Retorno</h3>
    <p>
        Todos os métodos de execução retornam um <code>array</code> com as seguintes chaves:
    </p>
    <ul>
        <li><code>status</code> → Código de retorno do processo (0 = sucesso).</li>
        <li><code>output</code> → Saída padrão do comando.</li>
        <li><code>error</code> → Saída de erro, caso ocorra.</li>
        <li><code>cmd</code> → Comando completo executado.</li>
    </ul>

    <h3>⚠️ Cuidados e Boas Práticas</h3>
    <ul>
        <li>Nunca insira valores dinâmicos sem antes escapar — use sempre os argumentos no array.</li>
        <li>Evite expor senhas ou credenciais diretamente na linha de comando.</li>
        <li>Use o método <code>mysqldump()</code> para exportar bancos de forma segura.</li>
        <li>Prefira executar comandos dentro de usuários limitados e não como <code>root</code>.</li>
    </ul>
</section>



<section id="SysController" class="classe-doc">
    <h2>
        <i class="bi bi-diagram-3-fill text-primary"></i>
        Classe: <code>SysController</code>
    </h2>
    
    <p>
        <i class="bi bi-info-circle text-secondary"></i>
        A classe <strong>SysController</strong> fornece funcionalidades de apoio aos controladores 
        do <strong>SysFramework</strong>, permitindo enviar respostas no formato JSON de forma simples e padronizada.  
        É uma classe utilitária leve, usada principalmente por controladores que necessitam retornar 
        dados para chamadas AJAX ou APIs REST.
    </p>

    <h3>
        <i class="bi bi-diagram-2 text-success"></i>
        Namespace
    </h3>
    <pre><code>namespace Core;</code></pre>

    <h3>
        <i class="bi bi-list-check text-warning"></i>
        Métodos
    </h3>

    <h4>
        <i class="bi bi-braces text-info"></i>
        <code>jsonResponse($data, $statusCode = 200)</code>
    </h4>
    <p>
        <i class="bi bi-arrow-return-right text-muted"></i>
        Envia uma resposta HTTP no formato <strong>JSON</strong>.  
        Este método define o cabeçalho <code>Content-Type: application/json</code>, 
        ajusta o código de status HTTP com <code>http_response_code()</code>, 
        e converte automaticamente os dados passados para JSON utilizando <code>json_encode()</code>.  
        Após o envio da resposta, o script é encerrado com <code>exit()</code>.
    </p>

    <h5>
        <i class="bi bi-input-cursor text-primary"></i>
        Parâmetros:
    </h5>
    <ul>
        <li><code>$data</code> — Array ou objeto contendo os dados que serão convertidos em JSON.</li>
        <li><code>$statusCode</code> — (opcional) Código de status HTTP da resposta (padrão: <code>200</code>).</li>
    </ul>

    <h5>
        <i class="bi bi-code-slash text-secondary"></i>
        Exemplo de uso:
    </h5>
    <pre><code>
use Core\SysController;

class ApiController extends SysController
{
    public function getUserList()
    {
        $users = [
            ['id' => 1, 'nome' => 'Marco'],
            ['id' => 2, 'nome' => 'Ana']
        ];

        // Retorna os dados em formato JSON
        $this->jsonResponse($users);
    }
}
    </code></pre>

    <h3>
        <i class="bi bi-cpu text-danger"></i>
        Resumo de Funcionamento
    </h3>
    <p>
        Ao chamar <code>jsonResponse()</code>, a saída do PHP é imediatamente encerrada, 
        garantindo que nenhum conteúdo adicional seja adicionado à resposta JSON.  
        Ideal para endpoints de API e controladores AJAX.
    </p>

    <h3>
        <i class="bi bi-star-fill text-warning"></i>
        Conclusão
    </h3>
    <p>
        A <strong>SysController</strong> simplifica o envio de respostas JSON dentro do SysFramework, 
        tornando o código dos controladores mais limpo e consistente.  
        É ideal para aplicações modernas que utilizam <em>frontends dinâmicos</em> com 
        <strong>jQuery</strong>, <strong>AJAX</strong> ou <strong>APIs REST</strong>.
    </p>
</section>




<section id="SysEnv" class="classe-doc">
    <h2>
        <i class="bi bi-gear-wide-connected text-primary"></i>
        Classe: <code>SysEnv</code>
    </h2>

    <p>
        <i class="bi bi-info-circle text-secondary"></i>
        A classe <strong>SysEnv</strong> é responsável por carregar e gerenciar as variáveis de ambiente 
        do <strong>SysFramework</strong>.  
        Ela lê automaticamente o arquivo <code>.env</code> e disponibiliza as variáveis definidas 
        em <code>$_ENV</code> e <code>$_SERVER</code>, facilitando a configuração do sistema 
        sem expor informações sensíveis diretamente no código.
    </p>

    <h3>
        <i class="bi bi-diagram-2 text-success"></i>
        Namespace
    </h3>
    <pre><code>namespace Core;</code></pre>

    <h3>
        <i class="bi bi-list-check text-warning"></i>
        Métodos
    </h3>

    <h4>
        <i class="bi bi-file-earmark-code text-info"></i>
        <code>public static function load($filePath = __DIR__ . '/../.env')</code>
    </h4>
    <p>
        <i class="bi bi-arrow-return-right text-muted"></i>
        Carrega as variáveis de ambiente definidas no arquivo <code>.env</code> especificado.  
        Cada linha do arquivo deve seguir o formato <code>CHAVE=VALOR</code>.  
        Comentários iniciados com <code>#</code> são ignorados.
    </p>

    <h5>
        <i class="bi bi-input-cursor text-primary"></i>
        Parâmetros:
    </h5>
    <ul>
        <li><code>$filePath</code> — Caminho completo para o arquivo <code>.env</code>. O padrão é <code>/core/../.env</code>.</li>
    </ul>

    <h5>
        <i class="bi bi-exclamation-triangle text-danger"></i>
        Exceções:
    </h5>
    <p>
        Lança uma exceção <code>\Exception</code> se o arquivo <code>.env</code> não for encontrado.
    </p>

    <h4>
        <i class="bi bi-search text-info"></i>
        <code>public static function get($key, $default = null)</code>
    </h4>
    <p>
        <i class="bi bi-arrow-return-right text-muted"></i>
        Obtém o valor de uma variável de ambiente carregada anteriormente.  
        Caso a variável não exista, retorna o valor padrão informado.
    </p>

    <h5>
        <i class="bi bi-input-cursor text-primary"></i>
        Parâmetros:
    </h5>
    <ul>
        <li><code>$key</code> — Nome da variável de ambiente a ser obtida.</li>
        <li><code>$default</code> — Valor de retorno caso a variável não exista (padrão: <code>null</code>).</li>
    </ul>

    <h5>
        <i class="bi bi-check-circle text-success"></i>
        Retorno:
    </h5>
    <p>
        Retorna o valor da variável de ambiente solicitada ou o valor padrão.
    </p>

    <h3>
        <i class="bi bi-code-slash text-secondary"></i>
        Exemplo de uso
    </h3>
    <pre><code>
use Core\SysEnv;

// Carrega o arquivo .env
SysEnv::load(__DIR__ . '/../.env');

// Obtém variáveis do ambiente
$dbHost = SysEnv::get('DB_HOST', 'localhost');
$dbUser = SysEnv::get('DB_USER', 'root');
$dbPass = SysEnv::get('DB_PASS', '');
    </code></pre>

    <h3>
        <i class="bi bi-lightbulb text-warning"></i>
        Dicas de Uso
    </h3>
    <ul>
        <li>Armazene informações sensíveis como senhas, chaves de API e credenciais no <code>.env</code>.</li>
        <li>Não envie o arquivo <code>.env</code> para o repositório público (adicione ao <code>.gitignore</code>).</li>
        <li>Utilize o <code>SysEnv</code> sempre antes de inicializar conexões com banco de dados ou serviços externos.</li>
    </ul>

    <h3>
        <i class="bi bi-shield-lock-fill text-danger"></i>
        Segurança
    </h3>
    <p>
        O <strong>SysEnv</strong> protege o sistema de exposição acidental de credenciais sensíveis, 
        mantendo-as isoladas em um arquivo de ambiente fora do diretório público.
    </p>

    <h3>
        <i class="bi bi-star-fill text-warning"></i>
        Conclusão
    </h3>
    <p>
        A <strong>SysEnv</strong> é essencial para o gerenciamento de configurações seguras e dinâmicas 
        no <strong>SysFramework</strong>.  
        Simples, segura e eficiente, ela garante que cada ambiente (produção, teste, desenvolvimento) 
        tenha suas próprias configurações sem alterar o código-fonte.
    </p>
</section>



<section id="SysImages" class="classe-doc">
    <h2>
        <i class="bi bi-image text-primary"></i>
        Classe: <code>SysImages</code>
    </h2>

    <p>
        <i class="bi bi-info-circle text-secondary"></i>
        A classe <strong>SysImages</strong> é responsável pelo carregamento, redimensionamento e 
        salvamento seguro de imagens utilizando a biblioteca <strong>GD</strong> do PHP.  
        Ela valida o tipo MIME, preserva o formato original e impede vulnerabilidades de 
        <em>path traversal</em> e manipulação indevida de arquivos.
    </p>

    <h3>
        <i class="bi bi-diagram-2 text-success"></i>
        Namespace
    </h3>
    <pre><code>namespace Core;</code></pre>

    <h3>
        <i class="bi bi-list-check text-warning"></i>
        Métodos Principais
    </h3>

    <h4>
        <i class="bi bi-file-earmark-code text-info"></i>
        <code>__construct(string $filePath)</code>
    </h4>
    <p>
        <i class="bi bi-arrow-return-right text-muted"></i>
        Construtor da classe que carrega uma imagem existente no servidor, valida seu tipo e 
        prepara o recurso GD para manipulação.
    </p>
    <ul>
        <li><strong>$filePath</strong> — Caminho completo do arquivo de imagem a ser carregado.</li>
    </ul>

    <h5><i class="bi bi-exclamation-triangle text-danger"></i> Exceções:</h5>
    <ul>
        <li><code>\InvalidArgumentException</code> — Caso o arquivo não exista ou o formato seja inválido.</li>
    </ul>

    <h4>
        <i class="bi bi-arrows-expand text-success"></i>
        <code>public function resizeToWidth(int $newWidth): void</code>
    </h4>
    <p>
        Redimensiona a imagem proporcionalmente, ajustando sua largura para <code>$newWidth</code>.
    </p>

    <h4>
        <i class="bi bi-arrows-vertical text-success"></i>
        <code>public function resizeToHeight(int $newHeight): void</code>
    </h4>
    <p>
        Redimensiona a imagem proporcionalmente, ajustando sua altura para <code>$newHeight</code>.
    </p>

    <h4>
        <i class="bi bi-bounding-box text-success"></i>
        <code>public function resize(int $newWidth, int $newHeight): void</code>
    </h4>
    <p>
        Redimensiona a imagem para o tamanho exato informado, mantendo a transparência 
        em imagens PNG.
    </p>

    <h4>
        <i class="bi bi-save2 text-primary"></i>
        <code>public function save(string $filename, ?int $quality = 90): void</code>
    </h4>
    <p>
        Salva a imagem no disco, validando o nome do arquivo e preservando o tipo original 
        se nenhuma extensão for fornecida.
    </p>
    <ul>
        <li><strong>$filename</strong> — Nome ou caminho de destino da imagem (somente <code>basename</code> permitido).</li>
        <li><strong>$quality</strong> — Qualidade da imagem (0–100). Padrão: <code>90</code>.</li>
    </ul>

    <h5><i class="bi bi-shield-lock text-danger"></i> Segurança:</h5>
    <ul>
        <li>Evita injeção de caminho (<code>path traversal</code>) com <code>basename()</code>.</li>
        <li>Usa arquivos temporários (<code>tempnam()</code>) com permissões seguras.</li>
    </ul>

    <h4>
        <i class="bi bi-trash text-secondary"></i>
        <code>__destruct()</code>
    </h4>
    <p>
        Destroi o recurso GD em memória ao final da execução, evitando vazamentos de memória.
    </p>

    <h3>
        <i class="bi bi-code-slash text-secondary"></i>
        Exemplo de uso
    </h3>
    <pre><code>
use Core\SysImages;

try {
    // Carrega a imagem
    $img = new SysImages('uploads/foto.jpg');

    // Redimensiona para largura máxima de 800px
    $img->resizeToWidth(800);

    // Salva com qualidade 90
    $img->save('foto_redimensionada.jpg', 90);
    
    echo "Imagem processada com sucesso!";
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
    </code></pre>

    <h3>
        <i class="bi bi-lightbulb text-warning"></i>
        Dicas de Uso
    </h3>
    <ul>
        <li>Ideal para redimensionamento de imagens enviadas por usuários (upload seguro).</li>
        <li>Utilize a função <code>resizeToWidth()</code> ou <code>resizeToHeight()</code> para manter proporções corretas.</li>
        <li>O método <code>save()</code> cria um arquivo temporário antes de salvar, garantindo integridade.</li>
    </ul>

    <h3>
        <i class="bi bi-shield-lock-fill text-danger"></i>
        Segurança
    </h3>
    <p>
        <strong>SysImages</strong> valida o tipo MIME da imagem e impede a execução de 
        arquivos falsos (por exemplo, scripts renomeados com extensão de imagem).  
        Além disso, protege contra escrita fora do diretório permitido.
    </p>

    <h3>
        <i class="bi bi-star-fill text-warning"></i>
        Conclusão
    </h3>
    <p>
        A classe <strong>SysImages</strong> oferece uma interface simples e segura para 
        manipulação de imagens com o PHP GD, sendo uma ferramenta essencial no ecossistema 
        do <strong>SysFramework</strong> para tratamento de uploads e otimização visual.
    </p>
</section>





<section id="SysLogger" class="classe-doc">
    <h2>
        <i class="bi bi-journal-text text-primary"></i>
        Classe: <code>SysLogger</code>
    </h2>
    <p>
        <i class="bi bi-info-circle text-secondary"></i>
        A classe <strong>SysLogger</strong> é responsável pelo registro de logs do sistema, permitindo
        acompanhar eventos, avisos e erros de execução do <strong>SysFramework</strong>.  
        Ela grava mensagens formatadas em arquivos locais, incluindo informações de data, nível e IP do cliente.
    </p>
    <h3>
        <i class="bi bi-diagram-2 text-success"></i>
        Namespace
    </h3>
    <pre><code>namespace Core;</code></pre>
    <h3>
        <i class="bi bi-gear text-warning"></i>
        Descrição Geral
    </h3>
    <p>
        O <strong>SysLogger</strong> simplifica o processo de registro de logs, com suporte a diferentes níveis
        de severidade (<code>INFO</code>, <code>WARNING</code> e <code>ERROR</code>), além de incluir o endereço IP
        de origem.  
        O log padrão é salvo no diretório <code>/logs/app.log</code>, podendo ser configurado via construtor.
    </p>
    <h3>
        <i class="bi bi-list-check text-warning"></i>
        Métodos Principais
    </h3>
    <h4><i class="bi bi-file-earmark-code text-info"></i> <code>__construct($logFile = null, $logLevel = self::LOG_LEVEL_INFO, $clientIP = null)</code></h4>
    <p>
        Inicializa o logger com arquivo de destino, nível de log e IP do cliente.  
        Caso nenhum arquivo seja especificado, utiliza <code>logs/app.log</code> por padrão.
    </p>
    <ul>
        <li><strong>$logFile</strong> — Caminho completo do arquivo de log.</li>
        <li><strong>$logLevel</strong> — Define o nível mínimo de log a ser gravado.</li>
        <li><strong>$clientIP</strong> — IP do cliente. Se omitido, é detectado automaticamente.</li>
    </ul>
    <h4><i class="bi bi-pencil-square text-primary"></i> <code>public function log($message, $level = self::LOG_LEVEL_INFO)</code></h4>
    <p>
        Registra uma mensagem no log, de acordo com o nível informado.
    </p>
    <h4><i class="bi bi-info-circle text-success"></i> <code>public function info($message)</code></h4>
    <p>
        Registra uma mensagem informativa (<code>INFO</code>).
    </p>
    <h4><i class="bi bi-exclamation-triangle text-warning"></i> <code>public function warning($message)</code></h4>
    <p>
        Registra um aviso (<code>WARNING</code>).
    </p>
    <h4><i class="bi bi-bug text-danger"></i> <code>public function error($message)</code></h4>
    <p>
        Registra um erro (<code>ERROR</code>).
    </p>
    <h4><i class="bi bi-check2-all text-secondary"></i> <code>protected function shouldLog($level)</code></h4>
    <p>
        Determina se o log deve ser registrado com base no nível configurado.
    </p>
    <h4><i class="bi bi-clock-history text-muted"></i> <code>protected function formatMessage($message, $level)</code></h4>
    <p>
        Formata a mensagem antes de gravá-la, incluindo timestamp, nível e IP.
    </p>
    <h3><i class="bi bi-code-slash text-secondary"></i> Exemplo de uso</h3>
    <pre><code>
use Core\SysLogger;

$logger = new SysLogger();

// Registra mensagens de diferentes níveis
$logger->info('Inicialização do sistema concluída.');
$logger->warning('Uso de memória acima do esperado.');
$logger->error('Falha ao conectar ao banco de dados.');
    </code></pre>
    <h3><i class="bi bi-lightbulb text-warning"></i> Dicas de Uso</h3>
    <ul>
        <li>Configure o caminho do log fora do diretório público (<code>public/</code>) por segurança.</li>
        <li>Utilize níveis adequados de log para evitar arquivos muito grandes.</li>
        <li>Combine com o <code>SysEnv</code> para definir níveis de log via variáveis de ambiente.</li>
    </ul>
    <h3><i class="bi bi-shield-lock-fill text-danger"></i> Segurança</h3>
    <p>
        O <strong>SysLogger</strong> impede a exposição de dados sensíveis e usa o IP do cliente apenas para rastreamento.
        Recomenda-se proteger o diretório de logs com permissões restritas (ex: <code>chmod 600</code>).
    </p>
    <h3><i class="bi bi-star-fill text-warning"></i> Conclusão</h3>
    <p>
        A classe <strong>SysLogger</strong> fornece uma forma prática e confiável de registrar eventos no sistema,
        sendo essencial para depuração e monitoramento do <strong>SysFramework</strong>.
    </p>
</section>





<section id="SysMailer" class="classe-doc">
    <h2>
        <i class="bi bi-envelope-paper text-primary"></i>
        Classe: <code>SysMailer</code>
    </h2>
    <p>
        <i class="bi bi-info-circle text-secondary"></i>
        A classe <strong>SysMailer</strong> é responsável pelo envio de e-mails via SMTP, com suporte a HTML, 
        anexos e criptografia TLS/SSL. Ela inclui registro de logs de sucesso e falha, garantindo rastreabilidade.
    </p>
    <h3>
        <i class="bi bi-diagram-2 text-success"></i>
        Namespace
    </h3>
    <pre><code>namespace Core;</code></pre>
    <h3>
        <i class="bi bi-gear text-warning"></i>
        Descrição Geral
    </h3>
    <p>
        O <strong>SysMailer</strong> permite configurar host, porta, autenticação, remetente e criptografia.
        Suporta envio de mensagens em HTML ou texto simples, anexos e charset customizado.  
        Mensagens são logadas em arquivo local para auditoria.
    </p>
    <h3>
        <i class="bi bi-list-check text-warning"></i>
        Métodos Principais
    </h3>
    <h4><i class="bi bi-file-earmark-code text-info"></i> <code>__construct(array $config = [])</code></h4>
    <p>
        Inicializa o mailer com parâmetros de configuração como host, porta, usuário, senha, criptografia, 
        remetente e arquivo de log.
    </p>
    <ul>
        <li><strong>$config['host']</strong> — Servidor SMTP.</li>
        <li><strong>$config['port']</strong> — Porta do SMTP (padrão 587).</li>
        <li><strong>$config['username']</strong> — Usuário do SMTP.</li>
        <li><strong>$config['password']</strong> — Senha do SMTP.</li>
        <li><strong>$config['encryption']</strong> — Método de criptografia (tls ou ssl).</li>
        <li><strong>$config['from_email']</strong> — E-mail remetente.</li>
        <li><strong>$config['from_name']</strong> — Nome do remetente.</li>
        <li><strong>$config['log_file']</strong> — Caminho do arquivo de log.</li>
    </ul>
    <h4><i class="bi bi-send-fill text-primary"></i> <code>send($to, $subject, $body, $isHtml = true, $attachments = [], $charset = 'UTF-8')</code></h4>
    <p>
        Envia um e-mail para o destinatário especificado, com assunto, corpo da mensagem e anexos opcionais.
        Permite mensagens HTML ou texto simples e define o charset do e-mail.
    </p>
    <ul>
        <li><strong>$to</strong> — Endereço de destino.</li>
        <li><strong>$subject</strong> — Assunto da mensagem.</li>
        <li><strong>$body</strong> — Conteúdo do e-mail.</li>
        <li><strong>$isHtml</strong> — Se true, envia como HTML.</li>
        <li><strong>$attachments</strong> — Array de arquivos a anexar.</li>
        <li><strong>$charset</strong> — Charset da mensagem (padrão UTF-8).</li>
    </ul>
    <h4><i class="bi bi-shield-lock text-danger"></i> Segurança e Logs</h4>
    <p>
        O <strong>SysMailer</strong> cria logs de sucesso e erro no arquivo definido, incluindo timestamp e nível de registro.
        Conexões SSL/TLS são usadas para proteger o envio, evitando exposição de credenciais.
    </p>
    <h3><i class="bi bi-code-slash text-secondary"></i> Exemplo de uso</h3>
    <pre><code>
use Core\SysMailer;

$config = [
    'host' => 'smtp.example.com',
    'port' => 587,
    'username' => 'usuario',
    'password' => 'senha',
    'encryption' => 'tls',
    'from_email' => 'no-reply@example.com',
    'from_name' => 'SysFramework',
    'log_file' => 'mail.log'
];

$mailer = new SysMailer($config);

$mailer->send('destinatario@example.com', 'Teste de envio', '&lt;h1&gt;Olá!&lt;/h1&gt;', true);
    </code></pre>
    <h3><i class="bi bi-lightbulb text-warning"></i> Dicas de Uso</h3>
    <ul>
        <li>Proteja o arquivo de log (<code>chmod 600</code>) para não expor informações sensíveis.</li>
        <li>Prefira TLS ou SSL para conexões SMTP, evitando transmissão de senhas em texto plano.</li>
        <li>Valide destinatários e conteúdos de e-mail para evitar abusos e injeção de cabeçalhos.</li>
    </ul>
    <h3><i class="bi bi-star-fill text-warning"></i> Conclusão</h3>
    <p>
        A classe <strong>SysMailer</strong> fornece um mecanismo seguro e completo para envio de e-mails
        dentro do <strong>SysFramework</strong>, com suporte a anexos, logs e criptografia.
    </p>
</section>



<section id="SysORM" class="classe-doc">
    <h2>
        <i class="bi bi-table text-primary"></i>
        Classe: <code>SysORM</code>
    </h2>
    <p>
        <i class="bi bi-info-circle text-secondary"></i>
        A classe <strong>SysORM</strong> é um ORM simples para PHP, permitindo interação segura 
        com o banco de dados MySQL através de PDO. Suporta operações CRUD, filtragem de campos 
        <code>fillable</code> e ocultação de campos <code>hidden</code>.
    </p>

    <h3>
        <i class="bi bi-diagram-2 text-success"></i>
        Namespace
    </h3>
    <pre><code>namespace Core;</code></pre>

    <h3>
        <i class="bi bi-list-check text-warning"></i>
        Propriedades Principais
    </h3>
    <ul>
        <li><strong>$table</strong> — Nome da tabela associada ao modelo.</li>
        <li><strong>$fillable</strong> — Campos permitidos para inserção/atualização.</li>
        <li><strong>$hidden</strong> — Campos que serão ocultados ao converter para array.</li>
        <li><strong>$attributes</strong> — Armazena os valores do registro.</li>
        <li><strong>static $pdo</strong> — Instância PDO compartilhada.</li>
    </ul>

    <h3>
        <i class="bi bi-list-check text-warning"></i>
        Métodos Principais
    </h3>

    <h4><i class="bi bi-database text-success"></i> <code>static connect()</code></h4>
    <p>
        Conecta ao banco de dados usando PDO e retorna a instância compartilhada.
    </p>

    <h4><i class="bi bi-collection text-success"></i> <code>static all()</code></h4>
    <p>
        Retorna todos os registros da tabela como objetos da classe do modelo.
    </p>

    <h4><i class="bi bi-search text-success"></i> <code>static find($id)</code></h4>
    <p>
        Localiza um registro pelo ID e retorna uma instância do modelo ou <code>null</code> se não encontrado.
    </p>

    <h4><i class="bi bi-plus-circle text-success"></i> <code>static create(array $data)</code></h4>
    <p>
        Cria um novo registro usando os campos <code>fillable</code> e retorna a instância do registro criado.
    </p>

    <h4><i class="bi bi-pencil-square text-success"></i> <code>update(array $data)</code></h4>
    <p>
        Atualiza o registro atual com os campos permitidos em <code>fillable</code>.
    </p>

    <h4><i class="bi bi-trash text-danger"></i> <code>static destroy($id)</code></h4>
    <p>
        Remove o registro do banco de dados com base no ID fornecido.
    </p>

    <h4><i class="bi bi-card-list text-secondary"></i> <code>toArray()</code></h4>
    <p>
        Converte os atributos do modelo em array, aplicando <code>htmlspecialchars</code> 
        e ocultando campos definidos em <code>hidden</code>.
    </p>

    <h4><i class="bi bi-arrows-move text-info"></i> <code>__get($name) / __set($name, $value)</code></h4>
    <p>
        Métodos mágicos para acessar ou definir atributos dinamicamente.
    </p>

    <h3><i class="bi bi-code-slash text-secondary"></i> Exemplo de uso</h3>
    <pre><code>
use Core\SysORM;

class User extends SysORM {
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden = ['password'];
}

// Criar usuário
$newUser = User::create([
    'name' => 'Marco',
    'email' => 'marco@example.com',
    'password' => password_hash('123456', PASSWORD_DEFAULT)
]);

// Atualizar usuário
$newUser->update(['name' => 'Marco Costa']);

// Obter todos os usuários
$users = User::all();

// Buscar usuário por ID
$user = User::find($newUser->id);

// Remover usuário
User::destroy($newUser->id);
    </code></pre>

    <h3><i class="bi bi-lightbulb text-warning"></i> Dicas de Uso</h3>
    <ul>
        <li>Defina corretamente <code>fillable</code> para evitar alterações indevidas de campos sensíveis.</li>
        <li>Utilize <code>hidden</code> para impedir que campos como senhas sejam expostos em arrays ou JSON.</li>
        <li>Use <code>toArray()</code> antes de exibir dados para evitar XSS.</li>
    </ul>

    <h3><i class="bi bi-star-fill text-warning"></i> Conclusão</h3>
    <p>
        O <strong>SysORM</strong> simplifica o gerenciamento de dados no MySQL, fornecendo métodos 
        CRUD seguros e flexíveis, integrando-se perfeitamente ao ecossistema do <strong>SysFramework</strong>.
    </p>
</section>



<section id="SysORMAuth" class="classe-doc">
    <h2>
        <i class="bi bi-shield-lock text-primary"></i>
        Classe: <code>SysORMAuth</code>
    </h2>
    <p>
        <i class="bi bi-info-circle text-secondary"></i>
        A classe <strong>SysORMAuth</strong> fornece funcionalidades de autenticação de usuários usando sessões PHP, integração com o modelo <code>Auth</code> e verificação de senhas com <code>SysORMHash</code>.
    </p>

    <h3>
        <i class="bi bi-diagram-2 text-success"></i>
        Namespace
    </h3>
    <pre><code>namespace Core;</code></pre>

    <h3>
        <i class="bi bi-list-check text-warning"></i>
        Métodos Principais
    </h3>

    <h4><i class="bi bi-box-arrow-in-right text-success"></i> <code>static attempt(array $credentials): bool</code></h4>
    <p>
        Tenta autenticar um usuário com base nas credenciais fornecidas.
    </p>
    <ul>
        <li><strong>$credentials</strong> — Array contendo <code>email</code> e <code>password</code>.</li>
        <li>Se a autenticação for bem-sucedida, registra o <code>user_id</code> na sessão e retorna <code>true</code>.</li>
        <li>Retorna <code>false</code> em caso de falha.</li>
    </ul>

    <h4><i class="bi bi-box-arrow-right text-danger"></i> <code>static logout(): void</code></h4>
    <p>
        Encerra a sessão do usuário atual de forma segura, removendo todas as variáveis de sessão e cookies relacionados.
    </p>

    <h4><i class="bi bi-person-lines-fill text-info"></i> <code>static user()</code></h4>
    <p>
        Retorna os dados do usuário autenticado com base no <code>user_id</code> da sessão.
    </p>
    <ul>
        <li>Retorna <code>null</code> se não houver usuário autenticado.</li>
        <li>Integração direta com o modelo <code>Auth</code> para recuperar os dados.</li>
    </ul>

    <h4><i class="bi bi-key-fill text-secondary"></i> <code>protected static ensureSessionStarted(): void</code></h4>
    <p>
        Garante que a sessão PHP esteja ativa antes de acessar ou manipular dados de sessão.
    </p>

    <h3><i class="bi bi-code-slash text-secondary"></i> Exemplo de uso</h3>
    <pre><code>
use Core\SysORMAuth;

// Tentativa de login
$credentials = [
    'email' => 'marco@example.com',
    'password' => '123456'
];

if (SysORMAuth::attempt($credentials)) {
    echo "Usuário autenticado com sucesso!";
} else {
    echo "Credenciais inválidas!";
}

// Obter usuário logado
$user = SysORMAuth::user();
if ($user) {
    echo "Usuário atual: " . $user['email'];
}

// Logout
SysORMAuth::logout();
echo "Sessão encerrada.";
    </code></pre>

    <h3><i class="bi bi-lightbulb text-warning"></i> Dicas de Uso</h3>
    <ul>
        <li>Use <code>attempt()</code> para login e sempre valide os campos antes de chamar o método.</li>
        <li>Chame <code>logout()</code> para encerrar sessões de forma segura.</li>
        <li>O método <code>user()</code> retorna os dados do usuário atual, útil para controle de acesso.</li>
        <li>Integra com <code>SysORMHash</code> para verificação segura de senhas.</li>
    </ul>

    <h3><i class="bi bi-shield-lock-fill text-danger"></i> Segurança</h3>
    <p>
        - Regenera o ID da sessão ao autenticar para evitar <em>session fixation</em>.<br>
        - Limpa todas as variáveis de sessão e cookies ao fazer logout.<br>
        - Evita autenticação sem credenciais completas.
    </p>

    <h3><i class="bi bi-star-fill text-warning"></i> Conclusão</h3>
    <p>
        <strong>SysORMAuth</strong> oferece uma forma simples, segura e integrada de autenticar usuários 
        utilizando o modelo <code>Auth</code> e sessões PHP, sendo ideal para aplicações construídas 
        com o <strong>SysFramework</strong>.
    </p>
</section>




<section id="SysORMHash" class="classe-doc">
    <h2>
        <i class="bi bi-shield-lock text-primary"></i>
        Classe: <code>SysORMHash</code>
    </h2>
    <p>
        <i class="bi bi-info-circle text-secondary"></i>
        A classe <strong>SysORMHash</strong> fornece métodos simples e seguros para criar 
        e verificar hashes de senhas utilizando os recursos nativos do PHP.
    </p>

    <h3>
        <i class="bi bi-diagram-2 text-success"></i>
        Namespace
    </h3>
    <pre><code>namespace Core;</code></pre>

    <h3>
        <i class="bi bi-list-check text-warning"></i>
        Métodos Principais
    </h3>

    <h4><i class="bi bi-key-fill text-success"></i> <code>static make($value)</code></h4>
    <p>
        Cria um hash seguro para uma senha ou qualquer valor fornecido.
    </p>
    <ul>
        <li><strong>$value</strong> — Valor (normalmente senha) a ser hash.</li>
        <li>Retorna uma string hash usando <code>password_hash</code> com algoritmo padrão.</li>
    </ul>

    <h4><i class="bi bi-check-circle-fill text-success"></i> <code>static check($value, $hashedValue)</code></h4>
    <p>
        Verifica se o valor fornecido corresponde ao hash armazenado.
    </p>
    <ul>
        <li><strong>$value</strong> — Valor a ser verificado.</li>
        <li><strong>$hashedValue</strong> — Hash armazenado.</li>
        <li>Retorna <code>true</code> se corresponder, <code>false</code> caso contrário.</li>
    </ul>

    <h3><i class="bi bi-code-slash text-secondary"></i> Exemplo de uso</h3>
    <pre><code>
use Core\SysORMHash;

// Criar hash de uma senha
$hash = SysORMHash::make('minhaSenha123');

// Verificar senha
if (SysORMHash::check('minhaSenha123', $hash)) {
    echo "Senha correta!";
} else {
    echo "Senha incorreta!";
}
    </code></pre>

    <h3><i class="bi bi-lightbulb text-warning"></i> Dicas de Uso</h3>
    <ul>
        <li>Use <code>make()</code> sempre que precisar armazenar senhas ou dados sensíveis.</li>
        <li>Use <code>check()</code> para validação segura de senhas em login ou autenticação.</li>
        <li>Não armazene senhas em texto puro; sempre use hashing.</li>
    </ul>

    <h3><i class="bi bi-shield-lock-fill text-danger"></i> Segurança</h3>
    <p>
        - Baseado em funções nativas do PHP (<code>password_hash</code> e <code>password_verify</code>) garantindo segurança.<br>
        - Não é reversível; hashes não podem ser descriptografados.<br>
        - Adequado para autenticação segura no <strong>SysFramework</strong>.
    </p>

    <h3><i class="bi bi-star-fill text-warning"></i> Conclusão</h3>
    <p>
        A classe <strong>SysORMHash</strong> simplifica a criação e verificação de hashes, 
        garantindo segurança de senhas e dados sensíveis dentro do <strong>SysFramework</strong>.
    </p>
</section>




<section id="SysORMRequest" class="classe-doc">
    <h2>
        <i class="bi bi-journal-text text-primary"></i>
        Classe: <code>SysORMRequest</code>
    </h2>
    <p>
        <i class="bi bi-info-circle text-secondary"></i>
        A classe <strong>SysORMRequest</strong> é responsável por encapsular e validar 
        os dados enviados em requisições HTTP (normalmente via <code>POST</code> ou <code>GET</code>), 
        fornecendo métodos para validação e acesso seguro aos valores.
    </p>

    <h3>
        <i class="bi bi-diagram-2 text-success"></i>
        Namespace
    </h3>
    <pre><code>namespace Core;</code></pre>

    <h3>
        <i class="bi bi-list-check text-warning"></i>
        Métodos Principais
    </h3>

    <h4><i class="bi bi-box-arrow-in-right text-success"></i> <code>__construct()</code></h4>
    <p>
        Inicializa a instância da classe e carrega os dados da requisição, normalmente 
        usando <code>$_POST</code>. Pode ser ajustado para <code>$_GET</code> se necessário.
    </p>

    <h4><i class="bi bi-check2-square text-success"></i> <code>rules()</code></h4>
    <p>
        Define as regras de validação para os campos da requisição. Por padrão, retorna um array vazio.
    </p>
    <ul>
        <li>Retorno esperado: array associativo no formato <code>['campo' => 'regra']</code>.</li>
    </ul>

    <h4><i class="bi bi-shield-check text-success"></i> <code>validate()</code></h4>
    <p>
        Executa a validação dos dados de acordo com as regras definidas em <code>rules()</code>. 
        Se algum campo obrigatório estiver vazio, lança uma <code>\Exception</code>.
    </p>

    <h4><i class="bi bi-patch-check text-success"></i> <code>validated()</code></h4>
    <p>
        Retorna os dados validados após execução de <code>validate()</code>.
    </p>

    <h4><i class="bi bi-search text-info"></i> <code>__get($name)</code></h4>
    <p>
        Permite acessar os campos da requisição como propriedades da instância.
    </p>
    <ul>
        <li>Exemplo: <code>$request->email</code> retorna o valor do campo <code>email</code>.</li>
    </ul>

    <h3><i class="bi bi-code-slash text-secondary"></i> Exemplo de uso</h3>
    <pre><code>
use Core\SysORMRequest;

class UserRequest extends SysORMRequest {
    public function rules() {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }
}

try {
    $request = new UserRequest();
    $data = $request->validated();
    echo "Dados validados: ";
    print_r($data);
} catch (Exception $e) {
    echo "Erro na validação: " . $e->getMessage();
}
    </code></pre>

    <h3><i class="bi bi-lightbulb text-warning"></i> Dicas de Uso</h3>
    <ul>
        <li>Use classes que estendam <code>SysORMRequest</code> para cada formulário ou endpoint, definindo regras próprias.</li>
        <li>Combine com <code>SysORM</code> para armazenar os dados validados no banco.</li>
        <li>Evite acessar <code>$_POST</code> diretamente; utilize <code>validated()</code> para garantir segurança.</li>
    </ul>

    <h3><i class="bi bi-shield-lock-fill text-danger"></i> Segurança</h3>
    <p>
        - Valida dados obrigatórios antes de utilizá-los.<br>
        - Ajuda a prevenir envio de dados incompletos ou maliciosos.<br>
        - Recomenda-se combinar com filtros adicionais (como <code>Core\Security</code>) para sanitização de entradas.
    </p>

    <h3><i class="bi bi-star-fill text-warning"></i> Conclusão</h3>
    <p>
        A classe <strong>SysORMRequest</strong> fornece uma base sólida para tratamento e 
        validação de dados de requisições no <strong>SysFramework</strong>, facilitando 
        a criação de sistemas seguros e organizados.
    </p>
</section>





<section id="SysSanitize" class="classe-doc">
    <h2>
        <i class="bi bi-shield-fill text-primary"></i>
        Classe: <code>SysSanitize</code>
    </h2>
    <p>
        <i class="bi bi-info-circle text-secondary"></i>
        A classe <strong>SysSanitize</strong> fornece métodos para limpar e sanitizar dados de entrada, garantindo que valores recebidos de formulários, APIs ou qualquer fonte externa não contenham scripts ou tags HTML maliciosas.
    </p>

    <h3><i class="bi bi-diagram-2 text-success"></i> Namespace</h3>
    <pre><code>namespace Core;</code></pre>

    <h3><i class="bi bi-list-check text-warning"></i> Principais Métodos</h3>
    <ul>
        <li><code>sanitizeString(string $string)</code>: Remove tags HTML e codifica caracteres especiais em uma string.</li>
        <li><code>sanitizeArray(array $array)</code>: Sanitiza recursivamente cada valor de um array (útil para formulários ou dados JSON).</li>
        <li><code>sanitize(mixed $input)</code>: Sanitiza qualquer entrada (string ou array), chamando automaticamente os métodos apropriados.</li>
    </ul>

    <h3><i class="bi bi-code-slash text-secondary"></i> Exemplos de Uso</h3>
    <pre><code>
// Sanitizando uma string
$input = '&lt;script&gt;alert("hack")&lt;/script&gt;Hello World!';
$clean = SysSanitize::sanitizeString($input);
// Resultado: Hello World!

// Sanitizando um array
$data = [
    'name'  => '&lt;b&gt;João&lt;/b&gt;',
    'email' => 'joao@example.com',
    'bio'   => '&lt;script&gt;alert("xss")&lt;/script&gt;Developer'
];
$cleanData = SysSanitize::sanitizeArray($data);
/* Resultado:
[
    'name'  => 'João',
    'email' => 'joao@example.com',
    'bio'   => 'Developer'
]
*/ 


// Sanitizando qualquer input
$cleanInput = SysSanitize::sanitize($_POST);
</code></pre>

    <h3><i class="bi bi-lightbulb text-warning"></i> Dicas de Uso</h3>
    <ul>
        <li>Sempre sanitizar dados antes de exibi-los em HTML para prevenir XSS (Cross-Site Scripting).</li>
        <li>Para dados vindos de APIs ou JSON, use <code>sanitizeArray()</code> ou <code>sanitize()</code> para limpeza automática.</li>
        <li>Combine <strong>SysSanitize</strong> com validação de entrada (ex.: <code>SysORMRequest</code>) para garantir integridade dos dados.</li>
    </ul>

    <h3><i class="bi bi-star-fill text-warning"></i> Conclusão</h3>
    <p>
        A classe <strong>SysSanitize</strong> é uma ferramenta simples e eficiente para proteção de entradas de usuário, garantindo que seu sistema não seja vulnerável a ataques baseados em injeção de scripts ou HTML.
    </p>
</section>





<section id="SysTables" class="classe-doc">
    <h2>
        <i class="bi bi-table text-primary"></i>
        Classe: <code>SysTables</code>
    </h2>
    <p>
        <i class="bi bi-info-circle text-secondary"></i>
        A classe <strong>SysTables</strong> facilita a exibição de tabelas dinâmicas no front-end, oferecendo recursos como paginação, busca, ordenação por colunas e controle do número de linhas exibidas.
    </p>

    <h3><i class="bi bi-diagram-2 text-success"></i> Namespace</h3>
    <pre><code>namespace Core;</code></pre>

    <h3><i class="bi bi-list-check text-warning"></i> Principais Métodos</h3>
    <ul>
        <li><code>__construct(array $data = [], array $columns = [], int $defaultRowsPerPage = 10)</code>: Inicializa a tabela com dados, colunas e linhas por página. Aplica pesquisa e ordenação se parâmetros $_GET estiverem presentes.</li>
        <li><code>initialize(array $data, array $columns)</code>: Reinicializa os dados e colunas da tabela.</li>
        <li><code>setPage(int $page)</code>: Define a página atual da tabela.</li>
        <li><code>getTotalPages()</code>: Retorna o número total de páginas da tabela.</li>
        <li><code>search(string $query)</code>: Filtra os dados com base em uma string de pesquisa.</li>
        <li><code>sort(string $column, string $order)</code>: Ordena os dados pela coluna especificada em ordem ascendente ou descendente.</li>
        <li><code>renderSearchAndRowsPerPage()</code>: Gera HTML para input de busca e seleção de número de linhas por página.</li>
        <li><code>renderTable()</code>: Gera o HTML da tabela com os dados paginados e ordenados.</li>
        <li><code>renderPagination()</code>: Gera os links de paginação.</li>
    </ul>

    <h3><i class="bi bi-code-slash text-secondary"></i> Exemplos de Uso</h3>
    <pre><code>
$data = [
    ['name' => 'João', 'email' => 'joao@example.com'],
    ['name' => 'Maria', 'email' => 'maria@example.com'],
    ['name' => 'Carlos', 'email' => 'carlos@example.com'],
];

$columns = ['name', 'email'];

$table = new SysTables($data, $columns);

// Renderizar busca e seleção de linhas
echo $table->renderSearchAndRowsPerPage();

// Renderizar tabela
echo $table->renderTable();

// Renderizar paginação
echo $table->renderPagination();
</code></pre>

    <h3><i class="bi bi-lightbulb text-warning"></i> Dicas de Uso</h3>
    <ul>
        <li>Combine a classe com inputs de busca e ordenação para criar tabelas interativas.</li>
        <li>Use $_GET para capturar paginação, ordenação e busca de forma automática.</li>
        <li>Personalize o HTML e classes CSS no método <code>renderTable()</code> para se adequar ao estilo do seu front-end.</li>
    </ul>

    <h3><i class="bi bi-star-fill text-warning"></i> Conclusão</h3>
    <p>
        A classe <strong>SysTables</strong> simplifica a criação de tabelas dinâmicas no PHP, permitindo que desenvolvedores adicionem facilmente recursos avançados como paginação, busca e ordenação sem depender de bibliotecas externas.
    </p>
</section>




<section id="SysTE" class="classe-doc">
    <h2>
        <i class="bi bi-file-code text-primary"></i>
        Classe: <code>SysTE</code>
    </h2>
    <p>
        <i class="bi bi-info-circle text-secondary"></i>
        A classe <strong>SysTE</strong> é o mecanismo de templates do SysFramework, permitindo renderizar views com suporte a diretivas inspiradas no Blade (como @if, @foreach, @extends, @section, @yield, @include, @csrf etc.).
    </p>

    <h3><i class="bi bi-diagram-2 text-success"></i> Namespace</h3>
    <pre><code>namespace Core;</code></pre>

    <h3><i class="bi bi-list-check text-warning"></i> Principais Funcionalidades</h3>
    <ul>
        <li>Renderização de templates com suporte a <strong>.blade.php</strong> e <strong>.sys.php</strong>.</li>
        <li>Compilação automática para cache de templates, recompilando apenas se houver alterações.</li>
        <li>Diretivas de controle de fluxo: <code>@if, @elseif, @else, @endif</code>, <code>@foreach, @endforeach</code>, <code>@for, @endfor</code>.</li>
        <li>Seções e layouts: <code>@extends, @section, @endsection, @yield</code>.</li>
        <li>Inclusão de templates: <code>@include, @includeIf, @includeWhen, @includeUnless</code>.</li>
        <li>Stacks para push de conteúdo: <code>@push, @endpush, @stack</code>.</li>
        <li>Segurança: diretivas <code>@csrf</code> e <code>@method</code> para formulários.</li>
        <li>Sanitização automática de variáveis exibidas via <code>{{ variavel }}</code>.</li>
    </ul>

    <h3><i class="bi bi-code-slash text-secondary"></i> Exemplos de Uso</h3>
    <pre><code>
$viewsPath = __DIR__ . '/views';
$cachePath = __DIR__ . '/cache';

$te = new SysTE($viewsPath, $cachePath);

echo $te->render('home.index', [
    'title' => 'Página Inicial',
    'users' => $userList
]);
</code></pre>

    <h3><i class="bi bi-lightbulb text-warning"></i> Diretivas Suportadas</h3>
    <ul>
        <li><code>@if, @elseif, @else, @endif</code>: Controle de fluxo condicional.</li>
        <li><code>@foreach, @endforeach</code>: Loop sobre arrays ou objetos.</li>
        <li><code>@for, @endfor</code>: Loop numérico.</li>
        <li><code>{{ variavel }}</code>: Exibe variável com escape de HTML.</li>
        <li><code>@extends('layout')</code>: Estende um layout.</li>
        <li><code>@section('nome')</code> / <code>@endsection</code>: Define seções de conteúdo.</li>
        <li><code>@yield('nome')</code>: Exibe conteúdo de uma seção.</li>
        <li><code>@include('template')</code>: Inclui outro template.</li>
        <li><code>@csrf</code>: Insere token CSRF em formulários.</li>
        <li><code>@method('PUT')</code>: Insere método HTTP em formulários.</li>
        <li><code>@push('nome')</code> / <code>@endpush</code>: Empilha conteúdo para renderização posterior.</li>
        <li><code>@stack('nome')</code>: Renderiza conteúdo empilhado.</li>
    </ul>

    <h3><i class="bi bi-star-fill text-warning"></i> Dicas de Uso</h3>
    <ul>
        <li>Organize seus templates em pastas e use notação ponto, ex: <code>home.index</code> para <code>views/home/index.blade.php</code>.</li>
        <li>Utilize cache para otimizar a performance, evitando recompilação em cada request.</li>
        <li>Combine seções e layouts para criar páginas complexas de forma modular.</li>
        <li>Use as diretivas de inclusão condicional (<code>@includeIf</code>, <code>@includeWhen</code>) para flexibilizar templates.</li>
        <li>As variáveis exibidas com <code>{{ }}</code> são automaticamente sanitizadas.</li>
    </ul>

    <h3><i class="bi bi-star text-primary"></i> Observações</h3>
    <ul>
        <li>O método <code>csrfToken()</code> deve ser adaptado para gerar ou recuperar tokens CSRF conforme a implementação de sessão do projeto.</li>
        <li>Permite o uso de diretivas personalizadas adicionando novos métodos de compilação.</li>
    </ul>
</section>





<section id="Translator" class="classe-doc">
    <h2>
        <i class="bi bi-translate text-primary"></i>
        Classe: <code>Translator</code>
    </h2>
    <p>
        <i class="bi bi-info-circle text-secondary"></i>
        A classe <strong>Translator</strong> gerencia traduções de strings no SysFramework, permitindo suportar múltiplos idiomas via arquivos de locale.
    </p>

    <h3><i class="bi bi-diagram-2 text-success"></i> Namespace</h3>
    <pre><code>namespace Core;</code></pre>

    <h3><i class="bi bi-list-check text-warning"></i> Funcionalidades Principais</h3>
    <ul>
        <li>Carrega arquivos de idioma por locale (ex: <code>pt_br</code>).</li>
        <li>Permite traduzir chaves de mensagem para o idioma atual.</li>
        <li>Substitui placeholders nas mensagens, como <code>{name}</code> ou <code>{count}</code>.</li>
        <li>Muda dinamicamente o locale em tempo de execução.</li>
    </ul>

    <h3><i class="bi bi-code-slash text-secondary"></i> Exemplo de Uso</h3>
    <pre><code>
$translator = new \Core\Translator('pt_br');

// Traduz uma chave simples
echo $translator->translate('welcome'); 

// Traduz com placeholders
echo $translator->translate('greeting', ['name' => 'Marco']); 

// Troca o idioma para inglês
$translator->setLocale('en');
echo $translator->translate('welcome');
</code></pre>

    <h3><i class="bi bi-lightbulb text-warning"></i> Observações</h3>
    <ul>
        <li>Os arquivos de locale devem estar no diretório <code>locales/{locale}/messages.php</code> e retornar um array associativo de chaves/valores.</li>
        <li>Se a chave não for encontrada, o próprio nome da chave será retornado.</li>
        <li>Os placeholders devem ser passados como array associativo <code>['placeholder' => 'valor']</code>.</li>
        <li>Exemplo de arquivo <code>locales/pt_br/messages.php</code>:
            <pre><code>&lt;?php
return [
    'welcome' => 'Bem-vindo',
    'greeting' => 'Olá, {name}!',
];</code></pre>
        </li>
    </ul>
</section>





<section id="Validations" class="classe-doc">
    <h2>
        <i class="bi bi-check2-square text-primary"></i>
        Classe: <code>Validations</code>
    </h2>
    <p>
        <i class="bi bi-info-circle text-secondary"></i>
        A classe <strong>Validations</strong> é responsável por validar dados de entrada de forma flexível, permitindo regras simples e complexas.
    </p>

    <h3><i class="bi bi-diagram-2 text-success"></i> Namespace</h3>
    <pre><code>namespace Core;</code></pre>

    <h3><i class="bi bi-list-check text-warning"></i> Funcionalidades Principais</h3>
    <ul>
        <li>Valida campos com regras simples como <code>required</code> e <code>email</code>.</li>
        <li>Valida campos com regras complexas, como comprimento mínimo e máximo (<code>length</code>).</li>
        <li>Armazena mensagens de erro por campo.</li>
        <li>Permite verificar se existem erros e retornar todas as mensagens de erro.</li>
    </ul>

    <h3><i class="bi bi-code-slash text-secondary"></i> Exemplo de Uso</h3>
    <pre><code>
$validator = new \Core\Validations();

$data = [
    'name' => 'Marco',
    'email' => 'invalid-email'
];

$rules = [
    'name' => ['required', ['length' => [3, 50]]],
    'email' => ['required', 'email']
];

$validator->validate($data, $rules);

if ($validator->hasErrors()) {
    print_r($validator->getErrors());
}
</code></pre>

    <h3><i class="bi bi-lightbulb text-warning"></i> Observações</h3>
    <ul>
        <li>As regras podem ser simples (strings) ou complexas (arrays associativos).</li>
        <li>O método <code>getErrors()</code> retorna um array estruturado com mensagens de erro por campo.</li>
        <li>Novas regras podem ser adicionadas nos métodos <code>applySimpleRule</code> e <code>applyRule</code> conforme necessidade.</li>
    </ul>
</section>










<section id="bootstrap" class="doc-section">
    <h2>Arquivo <code>/config/bootsrap.php</code></h2>
    <p>
        O arquivo <strong>/config/bootsrap.php</strong> é o ponto de entrada principal do SysFramework. 
        Ele inicializa o ambiente do framework, carrega configurações, rotas, middlewares, 
        instâncias de Request e Response, e resolve as requisições HTTP recebidas.
    </p>

    <h3>📁 Namespace</h3>
    <pre><code>Sem namespace (arquivo global de configuração)</code></pre>

    <h3>🧩 Funcionalidades Principais</h3>
    <ul>
        <li>Inicializa a sessão PHP (<code>session_start()</code>).</li>
        <li>Carrega arquivos auxiliares e de configuração: <code>helpers.php</code>, <code>paths.php</code>, <code>loadenv.php</code>, <code>settings.php</code>.</li>
        <li>Aplica middleware de sanitização para proteger dados de entrada.</li>
        <li>Carrega rotas do arquivo <code>routes/web.php</code>.</li>
        <li>Instancia objetos essenciais: <code>Request</code>, <code>Response</code>, <code>SysTE</code>, <code>SysLogger</code>, serviços do aplicativo.</li>
        <li>Resolve a requisição atual via <code>SysRouter::resolve()</code>.</li>
    </ul>

    <h3>⚙️ Passo a Passo Interno</h3>

    <h4><code>Inicialização da sessão</code></h4>
    <pre><code>if (!isset($_SESSION)) {
    session_start();
}</code></pre>
    <p>Garante que a sessão esteja ativa, necessária para autenticação, CSRF e flash messages.</p>

    <h4><code>Carregamento de arquivos de configuração</code></h4>
    <pre><code>
require_once dirname(__DIR__) . '/config/helpers.php';
$paths = require dirname(__DIR__) . '/config/paths.php';
require_once dirname(__DIR__) . '/config/loadenv.php';
require_once dirname(__DIR__) . '/config/settings.php';
    </code></pre>

    <h4><code>Middleware de sanitização</code></h4>
    <pre><code>sanitizeMiddleware();</code></pre>
    <p>Sanitiza globalmente os dados recebidos via <code>$_POST</code> e <code>$_GET</code> para prevenir XSS e injeções.</p>

    <h4><code>Instância de Request e Response</code></h4>
    <pre><code>
$request = new \Core\Request();
$response = new \Core\Response();
    </code></pre>
    <p>Cria objetos que abstraem a requisição HTTP e permitem o envio de respostas.</p>

    <h4><code>Injeção de dependências</code></h4>
    <pre><code>
$dependencies = [
    new SysTE(VIEWS_PATH, VIEWSCACHE_PATH),
    new SysLogger(),
    new SomeService(),
    new AnotherService(),
    $request,
    $response
];
    </code></pre>
    <p>Lista de dependências que serão injetadas automaticamente nos controladores ao resolver a rota.</p>

    <h4><code>Resolução da rota</code></h4>
    <pre><code>SysRouter::resolve($requestMethod, $requestUri, $dependencies);</code></pre>
    <p>O roteador encontra o controlador correspondente à URI e método HTTP, e executa o fluxo da requisição.</p>

    <h3>💡 Exemplo Prático</h3>
    <pre><code>
use Core\Request;
use Core\Response;
use Core\SysTE;
use Core\SysRouter;
use Core\SysLogger;

// Instancia objetos essenciais
$request = new Request();
$response = new Response();
$view = new SysTE(VIEWS_PATH, VIEWSCACHE_PATH);
$logger = new SysLogger();

// Define dependências do controlador
$dependencies = [$view, $logger, $request, $response];

// Resolva a rota atual
SysRouter::resolve($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'], $dependencies);
    </code></pre>

    <h3>🧠 Observações</h3>
    <ul>
        <li>O arquivo é o ponto de entrada principal do framework e deve ser incluído antes de qualquer lógica de aplicação.</li>
        <li>Middlewares, rotas e serviços são carregados neste arquivo, garantindo consistência em toda a aplicação.</li>
        <li>O framework suporta injeção automática de dependências para simplificar controladores e serviços.</li>
        <li>Algumas funcionalidades, como cache de rotas e banco de dados (Eloquent), estão preparadas, mas podem ser ativadas apenas quando necessário.</li>
    </ul>
</section>





<section id="database" class="doc-section">
    <h2>Arquivo <code>/config/database.php</code></h2>
    <p>
        O arquivo <strong>/config/database.php</strong> configura a conexão com o banco de dados utilizando o <strong>Eloquent ORM</strong>
        do Laravel, através da classe <code>Illuminate\Database\Capsule\Manager</code>. Ele lê as variáveis de ambiente definidas no projeto
        para estabelecer a conexão e inicializar o Eloquent.
    </p>

    <h3>📁 Namespace</h3>
    <pre><code>Sem namespace (arquivo global de configuração)</code></pre>

    <h3>🧩 Funcionalidades Principais</h3>
    <ul>
        <li>Configura a conexão com o banco de dados utilizando variáveis de ambiente (<code>$_ENV</code>).</li>
        <li>Suporta diferentes drivers de banco de dados: MySQL, PostgreSQL, SQLite, SQL Server, etc.</li>
        <li>Inicializa o Eloquent ORM para ser usado em toda a aplicação.</li>
        <li>Permite consultas e manipulação de dados usando ActiveRecord e Query Builder.</li>
    </ul>

    <h3>⚙️ Passo a Passo Interno</h3>

    <h4><code>Instanciação do Capsule Manager</code></h4>
    <pre><code>use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;</code></pre>
    <p>Cria a instância do gerenciador do Eloquent.</p>

    <h4><code>Adição da conexão</code></h4>
    <pre><code>
$capsule->addConnection([
    "driver" => $_ENV['DB_CONNECTION'],
    "host" => $_ENV['DB_HOST'],
    "database" => $_ENV['DB_DATABASE'],
    "username" => $_ENV['DB_USERNAME'],
    "password" => $_ENV['DB_PASSWORD'],
    "charset" => $_ENV['DB_CHARSET'],
    "port" => $_ENV['DB_PORT'],
    "collation" => 'utf8mb4_general_ci',
    "prefix"    => '',
]);
    </code></pre>
    <p>Lê os parâmetros do banco de dados do arquivo <code>.env</code> e adiciona a conexão ao Capsule.</p>

    <h4><code>Inicialização do Eloquent</code></h4>
    <pre><code>
$capsule->setAsGlobal();
$capsule->bootEloquent();
    </code></pre>
    <p>Define o Eloquent como global e inicializa seus recursos, permitindo o uso do ORM em qualquer parte do projeto.</p>

    <h3>💡 Exemplo Prático</h3>
    <pre><code>
use Illuminate\Database\Capsule\Manager as Capsule;

// Obtenção da instância
$capsule = require __DIR__ . '/config/database.php';

// Consultas usando Eloquent
$users = $capsule->table('users')->get();
foreach ($users as $user) {
    echo $user->name;
}

// Ou usando Models
use App\Models\User;
$users = User::all();
    </code></pre>

    <h3>🧠 Observações</h3>
    <ul>
        <li>É necessário definir corretamente as variáveis de ambiente no <code>.env</code> para que a conexão funcione.</li>
        <li>O Capsule permite o uso do Eloquent fora do Laravel, mantendo a familiaridade com ORM.</li>
        <li>O retorno do arquivo é a instância do Capsule, que pode ser usada diretamente para consultas ou injeção de dependências.</li>
    </ul>
</section>



<section id="functions" class="doc-section">
    <h2>Arquivo <code>/config/functions.php</code></h2>
    <p>
        O arquivo <strong>/config/functions.php</strong> contém funções globais utilitárias utilizadas em todo o SysFramework. 
        Ele inclui funções para sanitização, manipulação de sessões, redirecionamentos, logging, formatação de dados, criptografia, carregamento de views, autoload de classes e cálculos de datas/tempos.
    </p>

    <h3>📁 Namespace</h3>
    <pre><code>Sem namespace (arquivo global de funções)</code></pre>

    <h3>🧩 Funcionalidades Principais</h3>
    <ul>
        <li><code>sanitizeMiddleware()</code> — Sanitiza globalmente <code>$_POST</code>, <code>$_GET</code> e <code>$_REQUEST</code>.</li>
        <li><code>loadConfig($filePath)</code> — Carrega arquivos de configuração em <code>.php</code> ou <code>.ini</code> e retorna um array associativo.</li>
        <li><code>sanitize($data)</code> — Limpa e escapa dados de entrada para evitar XSS.</li>
        <li><code>redirect($url, $statusCode = 302)</code> — Redireciona para outra URL com status HTTP configurável.</li>
        <li><code>logError($message, $file = 'error.log')</code> — Registra erros em arquivo de log.</li>
        <li><code>baseUrl($path = '')</code> — Gera URLs absolutas a partir do host atual.</li>
        <li><code>startSecureSession()</code> — Inicializa sessões PHP seguras com cookies apenas.</li>
        <li><code>formatDate($date, $format = 'd/m/Y H:i')</code> — Formata datas de acordo com o padrão desejado.</li>
        <li><code>loadView($viewName, $data = [])</code> — Renderiza uma view PHP com dados passados.</li>
        <li><code>renderView($templateName, $data = [])</code> — Renderiza templates Twig.</li>
        <li><code>encrypt($data, $key)</code> / <code>decrypt($data, $key)</code> — Criptografia simétrica usando AES-256-CBC.</li>
        <li><code>autoload($className)</code> — AutoCarregamento de classes do diretório <code>/core</code>.</li>
        <li><code>formatCurrency($amount, ...)</code> — Formata valores monetários com separadores e símbolo.</li>
        <li><code>formatToTwoDecimals($number)</code> — Formata números para duas casas decimais.</li>
        <li><code>daysBetweenDates($date1, $date2)</code> — Calcula a diferença em dias entre duas datas.</li>
        <li><code>minutesBetweenEvents($event1, $event2)</code> — Calcula a diferença em minutos entre dois eventos/data-hora.</li>
    </ul>

    <h3>💡 Exemplos Práticos</h3>
    <pre><code>
// Sanitizar dados
sanitizeMiddleware();

// Redirecionamento
redirect('/home');

// Log de erros
logError('Falha na conexão com o banco de dados.');

// Geração de URL base
echo baseUrl('assets/css/style.css');  // http://localhost/assets/css/style.css

// Formatar datas
echo formatDate('2025-08-30 14:30:00'); // 30/08/2025 14:30

// Formatar moeda
echo formatCurrency(2500); // R$ 2.500,00

// Formatar número
echo formatToTwoDecimals(45.6789); // 45.68

// Calcular diferença entre datas
echo daysBetweenDates('2025-08-01', '2025-08-30'); // 29

// Calcular minutos entre eventos
$event1 = '2025-08-30 14:00:00';
$event2 = '2025-08-30 16:30:00';
echo minutesBetweenEvents($event1, $event2); // 150
    </code></pre>

    <h3>🧠 Observações</h3>
    <ul>
        <li>As funções de sanitização são fundamentais para evitar ataques XSS e injeções.</li>
        <li>O arquivo é global, permitindo o uso de qualquer função sem precisar de instâncias.</li>
        <li>Funções de criptografia utilizam chave e vetor fixo (pode ser aprimorado para maior segurança).</li>
        <li>O autoload permite carregar classes do diretório <code>/core</code> automaticamente.</li>
        <li>Funções de datas e tempo retornam valores absolutos, garantindo consistência independente da ordem das datas.</li>
    </ul>
</section>





<section id="helpers" class="doc-section">
    <h2>Arquivo <code>/config/helpers.php</code></h2>
    <p>
        O arquivo <strong>/config/helpers.php</strong> contém funções auxiliares globais para o SysFramework. 
        Ele provê recursos como geração de URLs, sanitização de dados, manipulação de sessões, criptografia, helpers para views, utilitários de strings, arrays, datas, números aleatórios e segurança (CSRF).
    </p>

    <h3>📁 Namespace</h3>
    <pre><code>Sem namespace (arquivo global de helpers)</code></pre>

    <h3>🧩 Funcionalidades Principais</h3>
    <ul>
        <li><code>unblockIp($ip)</code> — Desbloqueia IPs previamente bloqueados por excesso de requisições.</li>
        <li><code>asset($path)</code> — Gera URL completa para arquivos estáticos (CSS, JS, imagens).</li>
        <li><code>url($name, $params = [])</code> — Gera URL completa baseada em nomes de rotas do SysRouter.</li>
        <li><code>sanitizeMiddleware()</code> — Sanitiza globalmente dados recebidos via <code>$_POST</code>, <code>$_GET</code> e <code>$_REQUEST</code>.</li>
        <li><code>loadConfig($filePath)</code> — Carrega arquivos de configuração PHP ou INI.</li>
        <li><code>sanitize($data)</code> — Limpa e escapa dados de entrada.</li>
        <li><code>logError($message, $file = 'error.log')</code> — Registra erros em arquivo de log.</li>
        <li><code>baseUrl($path = '')</code> — Retorna URL base do site.</li>
        <li><code>startSecureSession()</code> — Inicia sessão PHP segura com cookies apenas.</li>
        <li><code>formatDate($date, $format = 'd/m/Y H:i')</code> — Formata datas.</li>
        <li><code>loadView($viewName, $data = [])</code> — Renderiza views PHP.</li>
        <li><code>encrypt($data, $key)</code> / <code>decrypt($data, $key)</code> — Criptografia AES-256-CBC.</li>
        <li><code>autoload($className)</code> — AutoCarregamento de classes do diretório <code>/core</code>.</li>
        <li><code>formatCurrency($amount, ...)</code> — Formata valores monetários.</li>
        <li><code>formatToTwoDecimals($number)</code> — Formata números com duas casas decimais.</li>
        <li><code>daysBetweenDates($date1, $date2)</code> — Calcula diferença em dias entre datas.</li>
        <li><code>minutesBetweenEvents($event1, $event2)</code> — Calcula diferença em minutos entre datas/hora.</li>
        <li><code>generateCsrfToken()</code> / <code>checkCsrfToken($token)</code> — Proteção CSRF.</li>
        <li><code>getFullUrl()</code> — Retorna URL completa da página atual.</li>
        <li><code>redirect($url, $statusCode = 302)</code> — Redireciona usuário.</li>
        <li><code>old($key, $default)</code> — Recupera valores antigos de formulários.</li>
        <li><code>abort($statusCode, $message)</code> — Lança erro HTTP e encerra.</li>
        <li><code>bcrypt($value)</code> — Gera hash bcrypt de senha.</li>
        <li><code>str_limit($value, $limit, $end)</code> — Limita comprimento de string.</li>
        <li><code>array_first($array, $callback)</code> / <code>array_last($array, $callback)</code> — Obtém primeiro/último item de array.</li>
        <li><code>config($key, $default)</code> — Recupera valor de configuração.</li>
        <li><code>storage_path($path)</code> / <code>public_path($path)</code> / <code>views_path($path)</code> — Caminhos de diretórios importantes.</li>
        <li><code>dd(...$vars)</code> — Dump and Die (depuração).</li>
        <li><code>back()</code> — Redireciona para página anterior.</li>
        <li><code>view($view, $data)</code> — Renderiza view PHP.</li>
        <li><code>str_slug($string, $separator)</code> — Cria slug amigável para URLs.</li>
        <li><code>e($value)</code> — Escapa string para HTML (XSS).</li>
        <li><code>str_random($length)</code> — Gera string aleatória.</li>
        <li><code>optional($value)</code> — Acessa propriedades de objetos nulos sem erro.</li>
        <li><code>blank($value)</code> / <code>filled($value)</code> — Verifica se valor está vazio ou preenchido.</li>
        <li><code>route($name, $params)</code> — Retorna URL de rota nomeada.</li>
        <li><code>now()</code> — Retorna data/hora atual.</li>
        <li><code>generateRandomNumber($min, $max)</code> — Gera número inteiro aleatório.</li>
    </ul>

    <h3>💡 Exemplos Práticos</h3>
    <pre><code>
// Gerar URL de asset
echo asset('css/style.css');

// Sanitizar dados de formulário
sanitizeMiddleware();

// Gerar token CSRF
$token = generateCsrfToken();

// Checar token CSRF
if (!checkCsrfToken($token)) abort(403, 'Token inválido');

// Redirecionar usuário
redirect('/home');

// Gerar slug
echo str_slug('Título de Exemplo'); // titulo-de-exemplo

// Gerar número aleatório entre 10 e 100
$rand = generateRandomNumber(10, 100);

// Recuperar valor antigo de formulário
$oldEmail = old('email', 'default@example.com');

// Dump and die
dd($oldEmail, $rand);
    </code></pre>

    <h3>🧠 Observações</h3>
    <ul>
        <li>Funções são globais e podem ser usadas em qualquer lugar da aplicação.</li>
        <li>Sanitização de inputs e tokens CSRF são essenciais para segurança.</li>
        <li>Funções de paths, assets e views centralizam caminhos e URLs, evitando erros de caminho absoluto.</li>
        <li>Helpers como <code>optional</code>, <code>blank</code> e <code>filled</code> ajudam a evitar erros com valores nulos.</li>
        <li>Funções de debug (<code>dd</code>) e hashing (<code>bcrypt</code>) facilitam desenvolvimento seguro e rápido.</li>
    </ul>
</section>



<section id="loadenv" class="doc-section">
    <h2>Arquivo <code>/config/loadenv.php</code></h2>
    <p>
        Este arquivo é responsável por carregar as variáveis de ambiente da aplicação a partir do arquivo <code>.env</code> e definir constantes globais no SysFramework.
        Ele utiliza a classe <code>Core\SysEnv</code> para leitura e acesso seguro das variáveis.
    </p>

    <h3>📁 Namespace</h3>
    <pre><code>Sem namespace (arquivo global de configuração)</code></pre>

    <h3>🧩 Funcionalidades Principais</h3>
    <ul>
        <li><code>SysEnv::load()</code> — Carrega as variáveis do arquivo <code>.env</code> para uso na aplicação.</li>
        <li>Define constantes globais de configuração do aplicativo:
            <ul>
                <li><code>APP_NAME</code> — Nome do aplicativo (ex: SysFramework).</li>
                <li><code>APP_ENV</code> — Ambiente da aplicação (ex: local, production).</li>
                <li><code>APP_KEY</code> — Chave de aplicação usada para criptografia.</li>
                <li><code>APP_DEBUG</code> — Modo de depuração (true/false).</li>
                <li><code>APP_TIMEZONE</code> — Fuso horário da aplicação (ex: UTC).</li>
                <li><code>APP_URL</code> — URL base da aplicação.</li>
                <li><code>APP_LOCALE</code> — Local padrão (ex: utf-8).</li>
                <li><code>BCRYPT_ROUNDS</code> — Número de rounds para hashing Bcrypt.</li>
            </ul>
        </li>
        <li>Define constantes de configuração do banco de dados:
            <ul>
                <li><code>DB_CONNECTION</code> — Tipo de conexão (ex: mysql).</li>
                <li><code>DB_CHARSET</code> — Charset do banco de dados (ex: utf-8).</li>
                <li><code>DB_COLLATION</code> — Collation padrão (ex: utf8mb4_general_ci).</li>
                <li><code>DB_PREFIX</code> — Prefixo para tabelas.</li>
                <li><code>DB_HOST</code> — Host do banco (ex: 127.0.0.1).</li>
                <li><code>DB_PORT</code> — Porta do banco (ex: 3306).</li>
                <li><code>DB_DATABASE</code> — Nome do banco de dados.</li>
                <li><code>DB_USERNAME</code> — Usuário do banco.</li>
                <li><code>DB_PASSWORD</code> — Senha do banco.</li>
            </ul>
        </li>
        <li>Define constantes de configuração de e-mail:
            <ul>
                <li><code>MAIL_TRANSPORT</code> — Tipo de transporte (ex: smtp).</li>
                <li><code>MAIL_HOST</code> — Host do servidor SMTP.</li>
                <li><code>MAIL_PORT</code> — Porta SMTP.</li>
                <li><code>MAIL_USERNAME</code> — Usuário SMTP.</li>
                <li><code>MAIL_PASSWORD</code> — Senha SMTP.</li>
                <li><code>MAIL_ENCRYPTION</code> — Tipo de criptografia (ex: tls, ssl).</li>
                <li><code>MAIL_FROM_ADDRESS</code> — Endereço de envio padrão.</li>
                <li><code>MAIL_FROM_NAME</code> — Nome do remetente padrão.</li>
                <li><code>MAILER_DSN</code> — DSN completo para configuração do Mailer.</li>
                <li><code>MAIL_URL</code> — URL do serviço de e-mail, se aplicável.</li>
            </ul>
        </li>
    </ul>

    <h3>💡 Observações</h3>
    <ul>
        <li>As constantes definidas aqui podem ser usadas em qualquer parte da aplicação sem precisar instanciar objetos.</li>
        <li>Valores padrão são fornecidos caso a variável de ambiente não esteja definida no arquivo <code>.env</code>.</li>
        <li>O carregamento do <code>.env</code> permite que a aplicação seja facilmente configurável sem alterar o código.</li>
        <li>Segurança: não inclua arquivos <code>.env</code> no repositório público, pois contêm credenciais sensíveis.</li>
    </ul>

    <h3>📌 Exemplo de Uso</h3>
    <pre><code>
echo APP_NAME;       // SysFramework
echo APP_ENV;        // local
echo DB_DATABASE;    // sysframework
echo MAIL_HOST;      // sandbox.smtp.mailtrap.io
    </code></pre>
</section>





<section id="paths" class="doc-section">
    <h2>Arquivo <code>/config/paths.php</code></h2>
    <p>
        Este arquivo retorna um array associativo contendo todos os caminhos principais e subdiretórios utilizados pelo SysFramework. 
        Ele serve como referência central para localizar arquivos e pastas da aplicação.
    </p>

    <h3>🧩 Funcionalidades Principais</h3>
    <ul>
        <li><code>base_path</code> — Caminho raiz do projeto.</li>
        <li>Diretórios principais:
            <ul>
                <li><code>app_path</code> — Pasta principal da aplicação (<code>/app</code>).</li>
                <li><code>core_path</code> — Pasta do core do framework (<code>/core</code>).</li>
                <li><code>public_path</code> — Pasta pública (<code>/public</code>).</li>
                <li><code>routes_path</code> — Pasta de rotas (<code>/routes</code>).</li>
                <li><code>storage_path</code> — Pasta de armazenamento de dados (<code>/storage</code>).</li>
                <li><code>config_path</code> — Pasta de arquivos de configuração (<code>/config</code>).</li>
            </ul>
        </li>
        <li>Subdiretórios específicos dentro da pasta <code>app</code>:
            <ul>
                <li><code>controllers_path</code> — Controladores (<code>/app/Controllers</code>).</li>
                <li><code>models_path</code> — Modelos (<code>/app/Models</code>).</li>
                <li><code>views_path</code> — Views (<code>/resources/views</code>).</li>
                <li><code>helpers_path</code> — Helpers (<code>/app/Helpers</code>).</li>
                <li><code>events_path</code> — Eventos (<code>/app/Events</code>).</li>
                <li><code>listeners_path</code> — Listeners (<code>/app/Listeners</code>).</li>
                <li><code>middlewares_path</code> — Middlewares (<code>/app/Middlewares</code>).</li>
                <li><code>services_path</code> — Serviços (<code>/app/Services</code>).</li>
                <li><code>usecases_path</code> — Casos de uso (<code>/app/UseCases</code>).</li>
                <li><code>console_path</code> — Scripts de console (<code>/app/Console</code>).</li>
            </ul>
        </li>
        <li>Pastas auxiliares:
            <ul>
                <li><code>cache_path</code> — Cache geral (<code>/cache</code>).</li>
                <li><code>viewscache_path</code> — Cache de views (<code>/cache/views</code>).</li>
                <li><code>logs_path</code> — Logs de erros e atividades (<code>/logs</code>).</li>
                <li><code>uploads_path</code> — Uploads de arquivos (<code>/storage/uploads</code>).</li>
            </ul>
        </li>
        <li>Arquivos específicos:
            <ul>
                <li><code>webroutes_file</code> — Arquivo principal de rotas web (<code>/routes/web.php</code>).</li>
                <li><code>env_file</code> — Arquivo de variáveis de ambiente (<code>/.env</code>).</li>
            </ul>
        </li>
    </ul>

    <h3>💡 Observações</h3>
    <ul>
        <li>Ter todos os caminhos centralizados facilita a manutenção da aplicação e evita "hardcodes" de diretórios em múltiplos lugares.</li>
        <li>Os caminhos são calculados dinamicamente usando <code>dirname(__DIR__)</code>, garantindo que funcionem independentemente da estrutura do servidor.</li>
        <li>Para acessar qualquer caminho dentro do framework, basta usar: <code>$paths = require 'config/paths.php'; $paths['views_path'];</code></li>
    </ul>

    <h3>📌 Exemplo de Uso</h3>
    <pre><code>
$paths = require __DIR__ . '/paths.php';
echo $paths['base_path'];        // /var/www/html/seu-projeto
echo $paths['controllers_path']; // /var/www/html/seu-projeto/app/Controllers
echo $paths['uploads_path'];     // /var/www/html/seu-projeto/storage/uploads
    </code></pre>
</section>






<section id="settings" class="doc-section">
    <h2>Arquivo <code>/config/settings.php</code></h2>
    <p>
        Este arquivo é responsável por configurar variáveis globais, inicializar serviços essenciais do SysFramework 
        e definir constantes com os caminhos do projeto, facilitando o acesso a diretórios e recursos em toda a aplicação.
    </p>

    <h3>🧩 Funcionalidades Principais</h3>
    <ul>
        <li>
            <strong>Token CSRF</strong>: Gera automaticamente um token CSRF se ainda não existir na sessão, garantindo proteção contra ataques CSRF.
            <pre><code>if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}</code></pre>
        </li>

        <li>
            <strong>Gerenciamento de Imagens</strong>: Inicializa o <code>Intervention Image</code> para manipulação de imagens.
            <pre><code>use Intervention\Image\ImageManager;
$manager = ImageManager::gd(autoOrientation: false);</code></pre>
        </li>

        <li>
            <strong>EasyCSRF</strong>: Gera um token adicional <code>systoken</code> usando a biblioteca <code>EasyCSRF</code> para proteção adicional em formulários.
            <pre><code>use EasyCSRF\EasyCSRF;
$sessionProvider = new EasyCSRF\NativeSessionProvider();
$easyCSRF = new EasyCSRF\EasyCSRF($sessionProvider);
$systoken = $easyCSRF->generate('systoken');
$_SESSION['systoken'] = $systoken;</code></pre>
        </li>

        <li>
            <strong>Translator</strong>: Inicializa o serviço de tradução de mensagens do framework.
            <pre><code>use Core\Translator;
$translator = new Translator('pt_br');</code></pre>
        </li>

        <li>
            <strong>Definição de Constantes de Caminhos</strong>: Todas as pastas e arquivos importantes do projeto são definidos como constantes globais, facilitando o acesso em qualquer ponto da aplicação.
            <pre><code>define("BASE_PATH",$paths['base_path']);
define("APP_PATH",$paths['app_path']);
define("CORE_PATH",$paths['core_path']);
define("PUBLIC_PATH",$paths['public_path']);
define("ROUTES_PATH",$paths['routes_path']);
define("STORAGE_PATH",$paths['storage_path']);
define("CONFIG_PATH",$paths['config_path']);
define("CONTROLLERS_PATH",$paths['controllers_path']);
define("MODELS_PATH",$paths['models_path']);
define("VIEWS_PATH",$paths['views_path']);
define("HELPERS_PATH",$paths['helpers_path']);
define("EVENTS_PATH",$paths['events_path']);
define("LISTENERS_PATH",$paths['listeners_path']);
define("MIDDLEWARES_PATH",$paths['middlewares_path']);
define("SERVICES_PATH",$paths['services_path']);
define("USECASES_PATH",$paths['usecases_path']);
define("CONSOLE_PATH",$paths['console_path']);
define("CACHE_PATH",$paths['cache_path']);
define("VIEWSCACHE_PATH",$paths['viewscache_path']);
define("LOGS_PATH",$paths['logs_path']);
define("UPLOADS_PATH",$paths['uploads_path']);
define("WEBROUTES_FILE",$paths['webroutes_file']);
define("ENV_FILE",$paths['env_file']);</code></pre>
        </li>
    </ul>

    <h3>💡 Observações</h3>
    <ul>
        <li>O arquivo garante que sessões estejam ativas antes de inicializar tokens ou outros recursos.</li>
        <li>As constantes definidas podem ser usadas em qualquer lugar da aplicação, evitando duplicação de caminhos.</li>
        <li>O Translator facilita a internacionalização da aplicação, permitindo múltiplos idiomas.</li>
        <li>O EasyCSRF junto com o token padrão de sessão adiciona uma camada extra de segurança contra ataques de CSRF.</li>
    </ul>

    <h3>📌 Exemplo de Uso</h3>
    <pre><code>
// Usando o token CSRF
$csrf = $_SESSION['csrf_token'];

// Acessando o caminho de uploads
$uploadDir = UPLOADS_PATH;

// Traduzindo uma mensagem
echo $translator->translate('welcome');</code></pre>
</section>





<section id="public-index" class="doc-section">
    <h2>Arquivo <code>/public/index.php</code></h2>
    <p>
        Este é o ponto de entrada principal da aplicação (front controller) do SysFramework. 
        Todo request HTTP passa por este arquivo, que inicializa o framework e carrega todas as dependências necessárias.
    </p>

    <h3>🧩 Funcionalidades Principais</h3>
    <ul>
        <li>
            <strong>Inicialização de Sessão</strong>: Garante que a sessão do PHP esteja ativa antes de qualquer operação.
            <pre><code>if (!isset($_SESSION)) {
    session_start();
}</code></pre>
        </li>

        <li>
            <strong>Exibição de Erros</strong>: Configura o PHP para exibir todos os erros e warnings, útil para desenvolvimento.
            <pre><code>ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);</code></pre>
        </li>

        <li>
            <strong>Autoloading</strong>: Carrega automaticamente todas as dependências do Composer.
            <pre><code>require_once dirname(__DIR__) . '/vendor/autoload.php';</code></pre>
        </li>

        <li>
            <strong>Bootstrap do Framework</strong>: Inicializa o SysFramework carregando configurações, helpers, rotas e middlewares.
            <pre><code>require_once dirname(__DIR__) . '/config/bootstrap.php';</code></pre>
        </li>
    </ul>

    <h3>💡 Observações</h3>
    <ul>
        <li>O <code>index.php</code> deve estar dentro do diretório público (<code>/public</code>) para garantir segurança e separar arquivos acessíveis publicamente de arquivos internos do framework.</li>
        <li>Este arquivo nunca deve ser modificado diretamente para lógica de negócio; toda funcionalidade deve ser implementada via controllers, serviços e rotas.</li>
        <li>O carregamento do Composer e do bootstrap garante que autoloading e configuração do ambiente estejam sempre ativos antes de processar qualquer request.</li>
    </ul>

    <h3>📌 Fluxo de Execução</h3>
    <ol>
        <li>Inicia a sessão do usuário.</li>
        <li>Ativa exibição de erros (modo desenvolvimento).</li>
        <li>Carrega o autoload do Composer para dependências externas.</li>
        <li>Chama o <code>bootstrap.php</code> para inicializar o SysFramework (helpers, rotas, env, middlewares, etc.).</li>
        <li>O framework passa o request para o roteador, que dispara o controller correspondente.</li>
    </ol>
</section>




<section id="public-robots" class="doc-section">
    <h2>Arquivo <code>/public/robots.txt</code></h2>
    <p>
        O <code>robots.txt</code> é um arquivo usado para fornecer instruções aos motores de busca (como Google, Bing, etc.) sobre quais páginas ou diretórios podem ser rastreados ou indexados.
    </p>

    <h3>🧩 Conteúdo Atual</h3>
    <pre><code>User-agent: *
Disallow:</code></pre>

    <h3>💡 Explicação</h3>
    <ul>
        <li><code>User-agent: *</code> → Aplica a regra para todos os robôs de busca.</li>
        <li><code>Disallow:</code> → Sem diretórios listados, o que significa que os robôs podem rastrear todas as páginas do site.</li>
    </ul>

    <h3>📌 Observações</h3>
    <ul>
        <li>Este arquivo deve estar no diretório <code>/public</code> para que os motores de busca o encontrem.</li>
        <li>Se você quiser bloquear alguma área do site, basta adicionar o caminho após <code>Disallow:</code>, por exemplo <code>Disallow: /admin/</code>.</li>
        <li>O <code>robots.txt</code> não impede o acesso direto a páginas; ele apenas orienta os motores de busca.</li>
    </ul>
</section>




<section id="public-htaccess" class="doc-section">
    <h2>Arquivo <code>/public/.htaccess</code></h2>
    <p>
        O <code>.htaccess</code> é um arquivo de configuração do Apache que permite ajustar configurações específicas do servidor para o diretório onde está localizado.
    </p>

    <h3>🧩 Conteúdo Atual</h3>
    <pre><code>Options All -Indexes

php_value memory_limit 768M
php_flag register_long_arrays on
#php_value post_max_size 100M
#php_value upload_max_size 64M
#php_value max_execution_time 300
#php_value max_input_time 300
#php_value upload_max_filesize 64M
#php_flag short_open_tag on
php_value date.timezone 'America/Sao_Paulo'
php_value default_charset 'UTF-8'

php_value max_file_uploads 2000

#php_value extension fileinfo.so

php_flag display_errors on
php_value error_reporting -1

#php_value session.gc_maxlifetime 1400

RewriteEngine on
RewriteCond %{SCRIPT_FILENAME} !-f
RewriteCond %{SCRIPT_FILENAME} !-d
RewriteCond %{SCRIPT_FILENAME} !-l
RewriteRule ^(.*)$ index.php/$1</code></pre>

    <h3>💡 Explicação das Configurações</h3>
    <ul>
        <li><code>Options All -Indexes</code> → Desabilita a listagem de diretórios.</li>
        <li><code>php_value memory_limit 768M</code> → Define o limite de memória do PHP para 768MB.</li>
        <li><code>php_flag register_long_arrays on</code> → Habilita arrays antigos do PHP (ex.: <code>$HTTP_POST_VARS</code>).</li>
        <li>Configurações comentadas (#) como <code>post_max_size</code>, <code>upload_max_size</code>, <code>max_execution_time</code> → estão desativadas mas podem ser ajustadas conforme necessidade.</li>
        <li><code>php_value date.timezone 'America/Sao_Paulo'</code> → Define o fuso horário padrão do PHP.</li>
        <li><code>php_value default_charset 'UTF-8'</code> → Define a codificação padrão para UTF-8.</li>
        <li><code>php_value max_file_uploads 2000</code> → Permite até 2000 arquivos em um upload múltiplo.</li>
        <li><code>php_flag display_errors on</code> e <code>php_value error_reporting -1</code> → Ativa a exibição de erros e define a exibição para todos os tipos de erro.</li>
        <li>Bloco de <code>RewriteEngine</code> → Redireciona todas as requisições para o <code>index.php</code>, permitindo URLs amigáveis (roteamento do framework).</li>
    </ul>

    <h3>📌 Observações</h3>
    <ul>
        <li>O <code>.htaccess</code> funciona apenas em servidores Apache com o módulo <code>mod_rewrite</code> habilitado.</li>
        <li>As configurações de PHP via <code>php_value</code> só funcionam se o PHP estiver rodando como módulo do Apache (mod_php).</li>
        <li>É possível descomentar e ajustar valores como <code>post_max_size</code> e <code>upload_max_filesize</code> conforme necessidade do projeto.</li>
    </ul>
</section>






<section id="env-file" class="doc-section">
    <h2>Arquivo <code>/.env</code></h2>
    <p>
        O arquivo <code>.env</code> contém todas as variáveis de ambiente necessárias para configurar o <strong>SysFramework</strong> em seu servidor ou ambiente local.
        Ele não deve ser versionado em repositórios públicos quando contiver dados sensíveis.
    </p>

    <h3>🧩 Conteúdo Atual (Exemplo Seguro)</h3>
    <pre><code># ========================================
# Configurações do aplicativo
# ========================================
APP_NAME=SysFramework
APP_ENV=local
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_TIMEZONE=America/Sao_Paulo
APP_URL=http://localhost:8000
APP_LOCALE=utf-8

BCRYPT_ROUNDS=12

# ========================================
# Configurações do banco de dados
# ========================================
DB_CONNECTION=mysql
DB_CHARSET=utf8mb4
DB_COLLATION=utf8mb4_general_ci
DB_PREFIX=
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sysframework
DB_USERNAME=root
DB_PASSWORD=secret

# ========================================
# Configurações de e-mail
# ========================================
MAIL_TRANSPORT=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME=SysFramework
MAILER_DSN=smtp://your_username:your_password@smtp.example.com:587
MAIL_URL=http://example.com

# ========================================
# Configuração de teste
# ========================================
APP_TEST=teste</code></pre>

    <h3>💡 Explicação das Configurações</h3>
    <ul>
        <li><code>APP_NAME</code> → Nome do aplicativo.</li>
        <li><code>APP_ENV</code> → Ambiente da aplicação (local, production, staging, etc.).</li>
        <li><code>APP_KEY</code> → Chave secreta da aplicação, usada para criptografia e tokens.</li>
        <li><code>APP_DEBUG</code> → Habilita ou desabilita o modo debug.</li>
        <li><code>APP_TIMEZONE</code> → Define o fuso horário padrão da aplicação.</li>
        <li><code>APP_URL</code> → URL base do aplicativo.</li>
        <li><code>APP_LOCALE</code> → Define a codificação padrão e idioma da aplicação.</li>
        <li><code>BCRYPT_ROUNDS</code> → Número de rounds para gerar hashes bcrypt.</li>
        <li>Bloco <code>DB_*</code> → Configurações do banco de dados (host, porta, nome do DB, usuário e senha).</li>
        <li>Bloco <code>MAIL_*</code> → Configurações do serviço de envio de e-mail (SMTP ou outro transport).</li>
        <li><code>APP_TEST</code> → Variável de teste ou ambiente temporário.</li>
    </ul>

    <h3>📌 Observações</h3>
    <ul>
        <li>Substitua todos os valores sensíveis (senhas, APP_KEY, tokens) antes de usar em produção.</li>
        <li>O arquivo <code>.env</code> é lido pelo framework via <code>SysEnv::load()</code> e define constantes e variáveis importantes.</li>
        <li>É recomendável manter o arquivo <code>.env</code> fora de repositórios públicos e backups compartilhados.</li>
    </ul>
</section>





<section id="composer-json" class="doc-section">
    <h2>Arquivo <code>composer.json</code></h2>
    <p>
        O <code>composer.json</code> é o arquivo de configuração do Composer, usado para gerenciar dependências do <strong>SysFramework</strong>
        e configurar autoload, scripts e requisitos do projeto.
    </p>

    <h3>🧩 Conteúdo Atual</h3>
    <pre><code>{
    "name": "syspanel/sysframework",
    "description": "PHP Framework - Version 2.0",
    "type": "project",
    "license": "MIT",
    "authors": [
        {
            "name": "Marco Costa",
            "email": "sysframework@syspanel.com.br"
        }
    ],
    "config": {
        "optimize-autoloader": true,
        "prepend-autoloader": false,
        "platform": {
            "php": "8.3.0"
        }
    },
    "require": {
        "php-di/php-di": "^7.0",
        "intervention/image": "^3.8",
        "gilbitron/easycsrf": "^1.5",
        "twbs/bootstrap": "5.3.3",
        "twitter/bootstrap": "*",
        "sceditor/sceditor": "^2.1",
        "symfony/mailer": "^7.1",
        "guzzlehttp/psr7": "^2.7",
        "middlewares/utils": "^4.0"
    },
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "App\\Controllers\\": "app/Controllers/",
            "App\\Models\\": "app/Models/",
            "App\\Services\\": "app/Services/",
            "App\\Middlewares\\": "app/Middlewares/",
            "App\\Handlers\\": "app/Handlers/",
            "Core\\": "core/",
            "Core\\Library": "core/library",
            "Database\\Migrations\\": "database/migrations",
            "Database\\Seeders\\": "database/seeders"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "App\\Console\\Commands\\": "app/Console/Commands/"
        }
    },
    "scripts": {
        "post-install-cmd": [
            "Composer\\ScriptHandler::clearCache"
        ],
        "post-update-cmd": [
            "Composer\\ScriptHandler::clearCache"
        ]
    }
}</code></pre>

    <h3>💡 Explicação das Configurações</h3>
    <ul>
        <li><code>name</code> → Nome do pacote ou projeto.</li>
        <li><code>description</code> → Descrição do projeto.</li>
        <li><code>type</code> → Tipo de pacote (aqui, <code>project</code>).</li>
        <li><code>license</code> → Licença do projeto (MIT).</li>
        <li><code>authors</code> → Informações do(s) autor(es).</li>
        <li><code>config</code> → Configurações do Composer, como otimização do autoloader e plataforma PHP.</li>
        <li><code>require</code> → Dependências obrigatórias do projeto.</li>
        <li><code>autoload</code> → Mapeamento de namespaces para autoload (PSR-4) para produção.</li>
        <li><code>autoload-dev</code> → Mapeamento de namespaces para autoload de desenvolvimento.</li>
        <li><code>scripts</code> → Comandos executados automaticamente após instalar ou atualizar dependências.</li>
    </ul>

    <h3>📌 Observações</h3>
    <ul>
        <li>As dependências podem ser atualizadas conforme necessidade do framework ou do projeto.</li>
        <li>O autoload PSR-4 permite que o Composer carregue automaticamente classes de acordo com namespaces e caminhos definidos.</li>
        <li>Os scripts <code>post-install-cmd</code> e <code>post-update-cmd</code> ajudam a limpar caches ou executar tarefas pós-instalação.</li>
    </ul>
</section>




<section id="license" class="doc-section">
    <h2>Arquivo <code>LICENSE</code></h2>
    <p>
        O arquivo <code>LICENSE</code> define os termos da licença do SysFramework, garantindo direitos e responsabilidades aos usuários do software.
    </p>

    <h3>🧩 Conteúdo Atual</h3>
    <pre><code>MIT License

Copyright (c) 2025 SysFramework (sysframework@syspanel.com.br)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is provided to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE, AND NON-INFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES, OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT, OR OTHERWISE, ARISING FROM, OUT OF, OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.</code></pre>

    <h3>💡 Explicação da Licença MIT</h3>
    <ul>
        <li>Permite usar, copiar, modificar, mesclar, publicar, distribuir, sublicenciar e/ou vender cópias do software.</li>
        <li>É necessário manter o aviso de copyright e a licença em todas as cópias ou partes substanciais do software.</li>
        <li>O software é fornecido "no estado em que se encontra", sem garantias de qualquer tipo.</li>
        <li>Os autores não são responsáveis por quaisquer danos ou responsabilidades decorrentes do uso do software.</li>
    </ul>

    <h3>📌 Observações</h3>
    <ul>
        <li>A Licença MIT é altamente permissiva, permitindo uso comercial e privado sem restrições significativas.</li>
        <li>É recomendada para projetos de código aberto que desejam máxima liberdade de uso e distribuição.</li>
        <li>Inclua sempre o arquivo <code>LICENSE</code> ao distribuir o software.</li>
    </ul>
</section>





<section id="readme" class="doc-section">
    <h2>Arquivo <code>README.md</code></h2>
    <p>
        O arquivo <code>README.md</code> fornece uma visão geral do SysFramework, incluindo informações de instalação, requisitos, recursos, componentes externos e suporte.
    </p>

    <h3>🧩 Conteúdo Atual</h3>
    <pre><code>SysFramework

sysframework.syspanel.com.br

MVC PHP Framework desenvolvido com uma estrutura robusta e modular para fornecer uma base sólida para a criação de aplicações web escaláveis e produtivas.

Versão 2.0

28/10/2025

Marco Costa (sysframework@syspanel.com.br)

## Requirements

* PHP 8.3

## Ferramentas

1 - SysCli
2 - SysORM
3 - SysTE
4 - SysRouter e Injeção de Dependências
5 - Bloqueio de IP por excesso de requisições
6 - Disponível uso de Request e Response
7 - SysTables

## Installation

1 - Extract SysFramework.zip no diretório html
2 - Ative permissão 0755 em todas as pastas e arquivos
3 - Ative permissão 0775 nos diretórios: cache, logs, storage, vendor
4 - Ative permissão 0644 nos arquivos .htaccess e public/.htaccess
5 - Configuração no Virtual Host Apache2:
    &lt;Directory "/var/www/html/sysframework.syspanel.com.br/public"&gt;
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    &lt;/Directory&gt;
6 - Criar DB
7 - Configure .ENV

## Features

Core:

* Class SysLogger
* Class SysORM
* Class SysTE
* Class SysCli
* Class SysEnv
* Class SysImages
* Class SysSanitize
* Class Translator
* Class Validations
* Class SysMail
* Class Security
* Class SysRouter
* Class SysTables

Helpers:

* assets
* dd()
* sanitizeMiddleware()
* sanitize()
* generateCsrfToken()
* checkCsrfToken()
* old()
* bcrypt()
* back()
* e()
* blank()
* filled()

## Componentes externos

* twbs/bootstrap https://github.com/twbs/bootstrap MIT license
* php-di/php-di https://github.com/PHP-DI/PHP-DI MIT License
* sceditor/sceditor https://github.com/samclarke/SCEditor MIT License
* gilbitron/easycsrf https://github.com/gilbitron/EasyCSRF MIT License
* Symfony's Mailer https://symfony.com/doc/current/mailer.html MIT License
* guzzle/psr7 https://github.com/guzzle/psr7 MIT License

## PSR-7

https://www.php-fig.org/psr/psr-7/

## SysCli

php syscli Help 

## Suporte

Email: sysframework@syspanel.com.br

📜 Terms of Use

This project is licensed under the MIT License.

You can use, copy, modify, merge, publish, distribute, sublicense, or sell copies of the Software, as long as the license and copyright notice are included in all copies or substantial portions of the Software.

The Software is provided "as is", without warranties of any kind. For more details, see the MIT License.

For more information, contact: sysframework@syspanel.com.br

### Support the Project
If you find this project useful, consider supporting its development with a donation via PayPal:

[![Donate via PayPal](https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif)](https://www.paypal.com/donate/?business=marcocosta@gmx.com&currency_code=USD)

© 2025 SysFramework - Under the MIT License.</code></pre>

    <h3>💡 Explicação do README</h3>
    <ul>
        <li>Fornece informações gerais do projeto, incluindo versão, autor e contato.</li>
        <li>Lista os requisitos mínimos de PHP.</li>
        <li>Descreve ferramentas e componentes principais do framework.</li>
        <li>Fornece instruções de instalação e configuração do ambiente.</li>
        <li>Documenta classes Core e helpers disponíveis.</li>
        <li>Lista os componentes externos utilizados com links e licenças.</li>
        <li>Indica suporte a PSR-7 e uso do SysCli.</li>
        <li>Inclui informações de suporte, termos de uso e forma de contribuir via doação.</li>
    </ul>

    <h3>📌 Observações</h3>
    <ul>
        <li>Manter o README atualizado ajuda novos usuários e contribuintes a entenderem rapidamente o projeto.</li>
        <li>Incluir instruções claras de instalação e configuração evita problemas comuns.</li>
        <li>Fornecer links para documentação de componentes externos facilita o aprendizado e integração.</li>
    </ul>
</section>




<section id="syscli" class="doc-section">
    <h2>Arquivo <code>syscli</code></h2>
    <p>
        O arquivo <code>syscli</code> é o ponto de entrada para a interface de linha de comando (CLI) do SysFramework. Ele permite executar comandos administrativos e utilitários diretamente pelo terminal.
    </p>

    <h3>🧩 Conteúdo Atual</h3>
    <pre><code>&lt;?php  

/************************************************************************/
/* SysFramework - PHP Framework                                         */
/* ============================                                         */
/*                                                                      */
/* PHP Framework                                                        */
/* (c) 2025 by Marco Costa sysframework@syspanel.com.br                 */
/*                                                                      */
/* https://sysframework.syspanel.com.br                                 */
/*                                                                      */
/* This project is licensed under the MIT License.                      */
/*                                                                      */
/* For more informations: sysframework@syspanel.com.br                  */
/************************************************************************/

require_once __DIR__ . '/vendor/autoload.php';

use Core\SysCli;

$cli = new SysCli();
$cli->handle($argv);

?&gt;</code></pre>

    <h3>💡 Explicação do Arquivo</h3>
    <ul>
        <li><code>require_once __DIR__ . '/vendor/autoload.php';</code> → Carrega o autoloader do Composer, garantindo que todas as classes e dependências sejam carregadas automaticamente.</li>
        <li><code>use Core\SysCli;</code> → Importa a classe responsável pela execução dos comandos CLI do framework.</li>
        <li><code>$cli = new SysCli();</code> → Cria uma instância da classe <code>SysCli</code>.</li>
        <li><code>$cli->handle($argv);</code> → Passa os argumentos da linha de comando (<code>$argv</code>) para o manipulador de comandos do SysCli.</li>
        <li>Este arquivo permite executar comandos como <code>php syscli Help</code> para ver a lista de comandos disponíveis.</li>
    </ul>

    <h3>📌 Observações</h3>
    <ul>
        <li>O arquivo <code>syscli</code> deve ser executado pelo terminal, dentro do diretório raiz do projeto.</li>
        <li>Todos os comandos do framework estão centralizados na classe <code>SysCli</code>, facilitando a manutenção e expansão.</li>
        <li>Os argumentos passados via CLI são capturados automaticamente em <code>$argv</code> e processados pela classe.</li>
    </ul>
</section>






<section id="components-alert" class="doc-section">
    <h2>Classe <code>Alert</code> em <code>/app/Components/Alert/Alert.php</code></h2>
    <p>
        A classe <code>Alert</code> é responsável por renderizar componentes de alerta reutilizáveis na interface do SysFramework.
        Ela utiliza o template <code>Blade</code> localizado em <code>resources/views/components/Alert.blade.php</code>.
    </p>

    <h3>🧩 Propriedades</h3>
    <ul>
        <li><code>protected $attributes</code> → Armazena os atributos passados para o componente, como tipo do alerta, mensagem, classes CSS, etc.</li>
    </ul>

    <h3>🛠️ Métodos</h3>
    <ul>
        <li><code>__construct(array $attributes = [])</code> → Inicializa a instância do alerta com os atributos fornecidos.</li>
        <li><code>render()</code> → Renderiza o componente incluindo o template Blade correspondente e retorna o HTML gerado.</li>
    </ul>

    <h3>💡 Exemplo de Uso</h3>
    <pre><code>use App\Components\Alert;

// Criar um alerta de sucesso
$alert = new Alert(['type' => 'success', 'message' => 'Operação realizada com sucesso!']);
echo $alert->render();

// Criar um alerta de erro
$alert = new Alert(['type' => 'error', 'message' => 'Ocorreu um erro!']);
echo $alert->render();</code></pre>

    <h3>📌 Observações</h3>
    <ul>
        <li>O componente utiliza templates Blade para separar a lógica da apresentação.</li>
        <li>Os atributos fornecidos no construtor podem ser customizados de acordo com o template.</li>
        <li>Pode ser integrado diretamente em views ou usado dentro de outras classes do SysFramework.</li>
    </ul>
</section>





<section id="console-makeclienttablecommand" class="doc-section">
    <h2>Classe <code>MakeClientTableCommand</code> em <code>/app/Console/Commands/MakeClientTableCommand.php</code></h2>
    <p>
        Esta classe é responsável por criar a tabela <code>clients</code> no banco de dados e inserir clientes aleatórios para testes.
        É uma implementação de comando que pode ser executada pelo SysCli.
    </p>

    <h3>🧩 Propriedades</h3>
    <ul>
        <li><code>private $pdo</code> → Instância de <code>PDO</code> utilizada para executar comandos SQL no banco de dados.</li>
    </ul>

    <h3>🛠️ Métodos</h3>
    <ul>
        <li><code>__construct(PDO $pdo)</code> → Inicializa a classe recebendo a conexão PDO do banco de dados.</li>
        <li><code>execute()</code> → Executa o comando, criando a tabela e inserindo clientes aleatórios.</li>
        <li><code>private createTable()</code> → Cria a tabela <code>clients</code> se não existir.</li>
        <li><code>private insertRandomClients(int $count)</code> → Insere <code>$count</code> clientes aleatórios na tabela <code>clients</code>.</li>
    </ul>

    <h3>💡 Exemplo de Uso</h3>
    <pre><code>use App\Console\MakeClientTableCommand;

// Supondo que $pdo seja uma instância válida de PDO
$command = new MakeClientTableCommand($pdo);
$command->execute();</code></pre>

    <h3>📌 Observações</h3>
    <ul>
        <li>Os clientes inseridos são gerados aleatoriamente para testes e podem ser ajustados conforme necessário.</li>
        <li>O campo <code>password</code> é armazenado utilizando hash BCRYPT.</li>
        <li>O comando pode ser integrado ao SysCli para execução via terminal.</li>
    </ul>
</section>




<section id="console-makeusertablecommand" class="doc-section">
    <h2>Classe <code>MakeUserTableCommand</code> em <code>/app/Console/Commands/MakeUserTableCommand.php</code></h2>
    <p>
        Esta classe é responsável por criar a tabela <code>users</code> no banco de dados e inserir usuários aleatórios para testes.
        É uma implementação de comando que pode ser executada via SysCli.
    </p>

    <h3>🧩 Propriedades</h3>
    <ul>
        <li><code>private $pdo</code> → Instância de <code>PDO</code> utilizada para executar comandos SQL no banco de dados.</li>
    </ul>

    <h3>🛠️ Métodos</h3>
    <ul>
        <li><code>__construct(PDO $pdo)</code> → Inicializa a classe recebendo a conexão PDO do banco de dados.</li>
        <li><code>execute()</code> → Executa o comando, criando a tabela e inserindo usuários aleatórios. Trata exceções para evitar falhas na execução.</li>
        <li><code>private createTable()</code> → Cria a tabela <code>users</code> se não existir, incluindo colunas como <code>firstname</code>, <code>lastname</code>, <code>password</code>, <code>email</code>, <code>date_of_birth</code>, <code>notes</code>, <code>is_active</code>, <code>role</code>, <code>verification_token</code>, <code>reset_token</code>, <code>reset_expires</code>, <code>confirmed_at</code>, <code>created_at</code> e <code>updated_at</code>.</li>
        <li><code>private insertRandomUsers(int $count)</code> → Insere <code>$count</code> usuários aleatórios na tabela <code>users</code>. Gera tokens de verificação aleatórios e define <code>confirmed_at</code> como <code>null</code> inicialmente.</li>
    </ul>

    <h3>💡 Exemplo de Uso</h3>
    <pre><code>use App\Console\MakeUserTableCommand;

// Supondo que $pdo seja uma instância válida de PDO
$command = new MakeUserTableCommand($pdo);
$command->execute();</code></pre>

    <h3>📌 Observações</h3>
    <ul>
        <li>Os usuários inseridos são gerados aleatoriamente para testes e podem ser ajustados conforme necessário.</li>
        <li>O campo <code>password</code> é armazenado utilizando hash BCRYPT.</li>
        <li>O comando trata exceções para evitar falhas na inserção de registros duplicados ou inválidos.</li>
        <li>O comando pode ser integrado ao SysCli para execução via terminal.</li>
    </ul>
</section>





<section id="controllers-apiusercontroller" class="doc-section">
    <h2>Controller <code>ApiUserController</code> em <code>/app/Controllers/Api/ApiUserController.php</code></h2>
    <p>
        Este controller fornece endpoints API RESTful para manipulação de usuários. Ele herda de <code>SysController</code> e utiliza o model <code>User</code>.
    </p>

    <h3>🛠️ Métodos</h3>
    <ul>
        <li><code>index()</code> → Retorna todos os usuários cadastrados em formato JSON.</li>
        <li><code>show($id)</code> → Retorna os dados do usuário identificado por <code>$id</code>. Retorna erro 404 caso o usuário não exista.</li>
        <li><code>store()</code> → Cria um novo usuário com os dados recebidos via <code>$_POST</code> e retorna o usuário criado em JSON com status 201.</li>
        <li><code>update($id)</code> → Atualiza o usuário identificado por <code>$id</code> com os dados recebidos via <code>$_POST</code>. Retorna erro 404 caso o usuário não exista.</li>
        <li><code>delete($id)</code> → Remove o usuário identificado por <code>$id</code> e retorna uma mensagem de confirmação. Retorna erro 404 caso o usuário não exista.</li>
    </ul>

    <h3>💡 Exemplo de Uso via API</h3>
    <pre><code>// Listar todos os usuários
GET /api/users

// Visualizar um usuário específico
GET /api/users/{id}

// Criar um novo usuário
POST /api/users
Body: { "firstname": "John", "lastname": "Doe", "email": "john@example.com", ... }

// Atualizar usuário existente
PUT /api/users/{id}
Body: { "firstname": "Jane" }

// Deletar usuário
DELETE /api/users/{id}</code></pre>

    <h3>📌 Observações</h3>
    <ul>
        <li>As respostas são sempre em JSON, seguindo boas práticas de APIs REST.</li>
        <li>O controller utiliza o model <code>User</code> para todas as operações de banco de dados.</li>
        <li>Os métodos <code>store</code> e <code>update</code> usam <code>fill()</code> do model para popular os atributos de forma segura.</li>
        <li>É necessário tratar autenticação/autorização separadamente se a API for exposta externamente.</li>
    </ul>
</section>






<section id="controllers-authcontroller" class="doc-section">
    <h2>Controller <code>AuthController</code> em <code>/app/Controllers/AuthController.php</code></h2>
    <p>
        Este controller gerencia todo o fluxo de autenticação do sistema, incluindo registro, login, logout, redefinição de senha e confirmação de email. Ele herda de <code>BaseController</code> e utiliza diversos serviços, logger e templates do <code>SysTE</code>.
    </p>

    <h3>🛠️ Métodos</h3>
    <ul>
        <li><code>register()</code> → Exibe o formulário de registro.</li>
        <li><code>newregister()</code> → Processa o registro de um novo usuário, valida dados, cria registro no banco e envia email de confirmação.</li>
        <li><code>sendConfirmationEmail($email, $userId)</code> → Envia email de confirmação para um usuário com token único.</li>
        <li><code>confirm_email()</code> → Confirma o email de um usuário usando token e ID enviados via URL.</li>
        <li><code>registred()</code> → Exibe a página de confirmação de registro, usando dados armazenados na sessão.</li>
        <li><code>login()</code> → Exibe o formulário de login.</li>
        <li><code>gologin()</code> → Processa o login, verifica email, senha e confirmação, e inicia a sessão.</li>
        <li><code>logout()</code> → Encerra a sessão do usuário e redireciona para a página inicial.</li>
        <li><code>forgotPassword()</code> → Exibe o formulário de solicitação de redefinição de senha.</li>
        <li><code>sendResetLink()</code> → Gera token de redefinição e envia link por email.</li>
        <li><code>resetPassword()</code> → Exibe formulário para redefinir senha.</li>
        <li><code>goresetPassword()</code> → Valida token e atualiza a senha do usuário.</li>
        <li><code>resendConfirmation()</code> → Exibe formulário para reenviar email de confirmação.</li>
        <li><code>goresendConfirmation()</code> → Valida email e reenvia email de confirmação.</li>
        <li><code>goforgotPassword()</code> → Processa envio de email de redefinição, com validação de email.</li>
        <li><code>resendConfirmationEmail()</code> → Processa reenvio de email de confirmação para usuários não confirmados.</li>
    </ul>

    <h3>💡 Fluxo de Trabalho</h3>
    <ol>
        <li>Usuário acessa <code>/register</code> → formulário de registro.</li>
        <li>Submete dados → <code>newregister()</code> valida, cria registro e envia email de confirmação.</li>
        <li>Email contém token → usuário acessa link → <code>confirm_email()</code> confirma registro.</li>
        <li>Login → <code>gologin()</code> valida email e senha, inicia sessão.</li>
        <li>Redefinição de senha → <code>forgotPassword()</code> + <code>sendResetLink()</code> + <code>goresetPassword()</code>.</li>
        <li>Reenvio de confirmação → <code>resendConfirmation()</code> + <code>goresendConfirmation()</code> + <code>resendConfirmationEmail()</code>.</li>
    </ol>

    <h3>📌 Observações</h3>
    <ul>
        <li>O controller utiliza <code>SysTE</code> para renderizar views.</li>
        <li>O <code>Mailer</code> é configurado via <code>MAILER_DSN</code> e usado para envio de emails de confirmação e redefinição de senha.</li>
        <li>Todos os métodos de formulário possuem validação usando <code>\Core\Validations</code>.</li>
        <li>Logs são gravados usando <code>SysLogger</code> para auditoria de registros, logins, erros de validação e ações de email.</li>
        <li>É importante que as rotas estejam corretamente configuradas no <code>SysRouter</code> para apontar para cada método do controller.</li>
    </ul>
</section>





<section id="controllers-clientcontroller" class="doc-section">
    <h2>Controller <code>ClientController</code> em <code>/app/Controllers/ClientController.php</code></h2>
    <p>
        Este controller gerencia todas as operações relacionadas aos clientes do sistema, incluindo CRUD (Create, Read, Update, Delete). Ele herda de <code>BaseController</code> e utiliza <code>SysTE</code> para renderizar templates, <code>SysLogger</code> para registro de logs, e os objetos <code>Request</code> e <code>Response</code> para manipulação de requisições e respostas.
    </p>

    <h3>🛠️ Métodos</h3>

    <h4>🔹 index()</h4>
    <p>Lista todos os clientes e renderiza a view <code>clients.index</code>.</p>
    <pre><code>public function index() {
    $this->logger->info('(clients.index) - Carregando lista de clientes.');
    $clients = Client::all();
    return $this->response->send($this->sysTE->render('clients.index', ['clients' => $clients]));
}</code></pre>
    <ul>
        <li><code>$this->logger->info(...)</code> → grava log da ação.</li>
        <li><code>Client::all()</code> → retorna todos os clientes do banco.</li>
        <li><code>$this->sysTE->render(...)</code> → renderiza template HTML.</li>
        <li><code>$this->response->send(...)</code> → envia o HTML para o navegador.</li>
    </ul>

    <h4>🔹 create()</h4>
    <p>Exibe o formulário para criação de um novo cliente (<code>clients.create</code>).</p>
    <pre><code>public function create() {
    return $this->response->send($this->sysTE->render('clients.create'));
}</code></pre>

    <h4>🔹 store()</h4>
    <p>Recebe dados do formulário via POST, cria um cliente no banco e redireciona para a lista.</p>
    <pre><code>public function store() {
    $data = $this->request->post();
    $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
    Client::create($data);
    return $this->response->redirect('/clients');
}</code></pre>
    <ul>
        <li><code>$this->request->post()</code> → obtém dados enviados via POST.</li>
        <li><code>password_hash(...)</code> → criptografa senha do cliente.</li>
        <li><code>Client::create($data)</code> → insere cliente no banco.</li>
        <li><code>$this->response->redirect(...)</code> → redireciona para lista de clientes.</li>
    </ul>

    <h4>🔹 edit($id)</h4>
    <p>Exibe formulário de edição do cliente identificado pelo <code>$id</code> (<code>clients.edit</code>).</p>
    <pre><code>public function edit($id) {
    $client = Client::find($id);
    return $this->response->send($this->sysTE->render('clients.edit', ['client' => $client]));
}</code></pre>

    <h4>🔹 update($id)</h4>
    <p>Atualiza os dados do cliente identificado pelo <code>$id</code> com os dados do POST e redireciona para a lista.</p>
    <pre><code>public function update($id) {
    $data = $this->request->post();
    $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
    $client = Client::find($id);
    if ($client) {
        $client->update($data);
    }
    return $this->response->redirect('/clients');
}</code></pre>

    <h4>🔹 show($id)</h4>
    <p>Exibe detalhes de um cliente específico (<code>clients.show</code>).</p>
    <pre><code>public function show($id) {
    $client = Client::find($id);
    return $this->response->send($this->sysTE->render('clients.show', ['client' => $client]));
}</code></pre>

    <h4>🔹 delete($id)</h4>
    <p>Remove o cliente do banco de dados e redireciona para a lista de clientes.</p>
    <pre><code>public function delete($id) {
    Client::destroy($id);
    return $this->response->redirect('/clients');
}</code></pre>

    <h3>💡 Fluxo de Trabalho</h3>
    <ol>
        <li>Acessar <code>/clients</code> → lista de clientes.</li>
        <li>Criar novo cliente → <code>/clients/create</code> → enviar formulário → <code>store()</code>.</li>
        <li>Editar cliente → <code>/clients/edit/{id}</code> → atualizar dados → <code>update()</code>.</li>
        <li>Visualizar cliente → <code>/clients/show/{id}</code> → detalhes do cliente.</li>
        <li>Deletar cliente → <code>/clients/delete/{id}</code> → remove do banco.</li>
    </ol>

    <h3>📌 Observações</h3>
    <ul>
        <li>Senhas criptografadas com <code>password_hash</code> + BCRYPT.</li>
        <li>Logs das ações gravados com <code>SysLogger</code>.</li>
        <li>Rotas devem estar configuradas corretamente no <code>SysRouter</code>.</li>
        <li>O controller usa métodos estáticos do modelo <code>Client</code> para operações no banco.</li>
        <li>O controller segue o padrão MVC, separando claramente responsabilidades de Model, View e Controller.</li>
    </ul>
</section>





<section id="controllers-homecontroller" class="doc-section">
    <h2>Controller <code>HomeController</code> em <code>/app/Controllers/HomeController.php</code></h2>
    <p>
        O <strong>HomeController</strong> gerencia a página inicial e exemplos do sistema. Ele herda de <code>BaseController</code> e utiliza <code>SysTE</code> para renderizar templates, além de <code>SysLogger</code> para registro de logs.
    </p>

    <h3>🛠️ Propriedades</h3>
    <ul>
        <li><code>$sysTE</code> → instância da template engine para renderização de views.</li>
        <li><code>$logger</code> → instância de <code>SysLogger</code> para gravar logs de informações, avisos e erros.</li>
    </ul>

    <h3>🔹 __construct()</h3>
    <p>Construtor do controller, responsável por inicializar o <code>SysTE</code> e o <code>SysLogger</code>.</p>
    <pre><code>public function __construct() {
    $this->sysTE = new SysTE(VIEWS_PATH, VIEWSCACHE_PATH);
    $this->logger = new SysLogger();
}</code></pre>

    <h3>🔹 index()</h3>
    <p>Método principal que exibe a página inicial do sistema.</p>
    <pre><code>public function index() {
    $logger = new SysLogger();
    $logger->info('(home.index) - Esta é uma mensagem de informação.');
    echo $this->sysTE->render('home.index');
}</code></pre>
    <ul>
        <li>Cria uma instância de <code>SysLogger</code> e registra mensagens de log.</li>
        <li>Renderiza a view <code>home.index</code> usando <code>SysTE</code>.</li>
    </ul>

    <h3>🔹 example()</h3>
    <p>Método de exemplo para demonstração de envio de dados para a view.</p>
    <pre><code>public function example() {
    $logger = new SysLogger();
    $logger->info('(home.example) - Esta é uma mensagem de informação.');

    $data = [
        'user' => ['name' => 'João', 'is_admin' => true],
        'items' => ['Item 1', 'Item 2', 'Item 3']
    ];

    echo $this->sysTE->render('home.example', $data);
}</code></pre>
    <ul>
        <li>Exemplo de passagem de dados para o template (<code>$data</code>).</li>
        <li>Mostra como renderizar listas e informações do usuário na view.</li>
    </ul>

    <h3>🔹 syste()</h3>
    <p>Método de exemplo mostrando envio de dados simples para a view <code>home.syste</code>.</p>
    <pre><code>public function syste() {
    $logger = new SysLogger();
    $logger->info('(home.syste) - Esta é uma mensagem de informação.');

    $data = ['name' => 'Marco Costa'];

    echo $this->sysTE->render('home.syste', $data);
}</code></pre>
    <ul>
        <li>Registra informações no log.</li>
        <li>Renderiza a view <code>home.syste</code> com dados simples.</li>
    </ul>

    <h3>🔹 systables()</h3>
    <p>Método que renderiza a view <code>syscss.systables</code>, utilizada para demonstração de tabelas ou componentes CSS do sistema.</p>
    <pre><code>public function systables() {
    $logger = new SysLogger();
    $logger->info('(home.systables) - Esta é uma mensagem de informação.');

    echo $this->sysTE->render('syscss.systables');
}</code></pre>

    <h3>💡 Observações</h3>
    <ul>
        <li>Todos os métodos criam uma instância de <code>SysLogger</code> para registrar logs de informações.</li>
        <li>As views são renderizadas com <code>SysTE</code>, usando dados passados através de arrays associativos.</li>
        <li>O controller segue o padrão MVC, mantendo a lógica separada da apresentação.</li>
        <li>Exemplos como <code>example()</code> e <code>syste()</code> servem para testes ou demonstrações de templates.</li>
    </ul>

    <h3>💡 Fluxo de Trabalho</h3>
    <ol>
        <li>Acessar <code>/home/index</code> → página inicial.</li>
        <li>Acessar <code>/home/example</code> → demonstra dados de usuário e lista de itens.</li>
        <li>Acessar <code>/home/syste</code> → demonstra envio de dados simples para template.</li>
        <li>Acessar <code>/home/systables</code> → exibe tabela ou componentes CSS do sistema.</li>
    </ol>
</section>





<section id="middlewares-apiauthmiddleware" class="doc-section">
    <h2>Middleware <code>ApiAuthMiddleware</code> em <code>/app/Middlewares/ApiAuthMiddleware.php</code></h2>
    <p>
        O <strong>ApiAuthMiddleware</strong> é responsável por interceptar requisições para rotas de API e verificar se o usuário está autorizado a acessar os recursos, utilizando tokens de autenticação (JWT, OAuth ou outro método). 
        Ele atua como um <em>filtro</em> antes que a requisição chegue ao controller.
    </p>

    <h3>🛠️ Métodos</h3>
    <ul>
        <li><code>handle($request, $next)</code> → Intercepta a requisição, verifica o token de autorização e permite ou bloqueia o acesso.</li>
        <li><code>validateToken($token)</code> → Valida o token enviado pelo cliente. Retorna <code>true</code> se o token for válido, <code>false</code> caso contrário.</li>
    </ul>

    <h3>🔹 handle($request, $next)</h3>
    <pre><code>public function handle($request, $next) {
    $token = $request->getHeader('Authorization');

    if ($this->validateToken($token)) {
        return $next($request); // Passa a requisição adiante para o próximo middleware ou controller
    }

    return json_encode(['error' => 'Unauthorized'], 401); // Retorna erro 401 se não autorizado
}</code></pre>
    <ul>
        <li>Recupera o token de autorização do cabeçalho HTTP (<code>Authorization</code>).</li>
        <li>Chama <code>validateToken()</code> para verificar se o token é válido.</li>
        <li>Se válido, a requisição continua com <code>$next($request)</code>.</li>
        <li>Se inválido, retorna uma resposta JSON com erro 401 (Unauthorized).</li>
    </ul>

    <h3>🔹 validateToken($token)</h3>
    <pre><code>private function validateToken($token) {
    // Exemplo simples de validação
    return $token === 'valid_token';
}</code></pre>
    <ul>
        <li>Este método é privado, usado internamente pelo middleware.</li>
        <li>No exemplo atual, compara o token com uma string fixa <code>'valid_token'</code>.</li>
        <li>Em sistemas reais, aqui você implementaria validação JWT, OAuth ou consulta a banco de dados.</li>
    </ul>

    <h3>💡 Observações</h3>
    <ul>
        <li>Middlewares atuam como filtros antes do controller, permitindo implementar autenticação, autorização, logging, caching, etc.</li>
        <li>O <code>ApiAuthMiddleware</code> deve ser registrado na rota ou grupo de rotas que precisam de autenticação.</li>
        <li>O retorno JSON com status 401 garante que APIs respondam corretamente quando o acesso não é autorizado.</li>
    </ul>

    <h3>💡 Fluxo de Trabalho</h3>
    <ol>
        <li>Requisição chega a uma rota protegida.</li>
        <li>Middleware <code>ApiAuthMiddleware</code> executa <code>handle()</code>.</li>
        <li>Recupera o token do cabeçalho <code>Authorization</code>.</li>
        <li>Chama <code>validateToken()</code> para validar o token.</li>
        <li>Se válido → requisição continua para o próximo middleware ou controller.</li>
        <li>Se inválido → retorna JSON com erro 401.</li>
    </ol>
</section>






<section id="middlewares-authmiddleware" class="doc-section">
    <h2>Middleware <code>AuthMiddleware</code> em <code>/app/Middlewares/AuthMiddleware.php</code></h2>
    <p>
        O <strong>AuthMiddleware</strong> protege rotas que requerem autenticação de usuário. Ele verifica se há um usuário logado na sessão antes de permitir o acesso ao controller.
        Atua como um <em>filtro de autenticação</em> antes que a requisição chegue ao controller.
    </p>

    <h3>🛠️ Método</h3>
    <ul>
        <li><code>handle($request, $next)</code> → Intercepta a requisição, verifica se o usuário está autenticado e permite ou bloqueia o acesso.</li>
    </ul>

    <h3>🔹 handle($request, $next)</h3>
    <pre><code>public function handle($request, $next) {
    if (!isset($_SESSION['user_id'])) {
        // Redirecionar ou retornar erro se não autenticado
        return ['error' => 'Você não está autenticado.'];
    }
    return $next($request); // Permite continuar para o próximo middleware ou controller
}</code></pre>
    <ul>
        <li>Verifica se existe a variável <code>$_SESSION['user_id']</code>, indicando que o usuário está logado.</li>
        <li>Se não estiver logado, retorna um array com mensagem de erro.</li>
        <li>Se estiver logado, chama <code>$next($request)</code> para continuar o fluxo.</li>
    </ul>

    <h3>💡 Observações</h3>
    <ul>
        <li>Este middleware é útil para proteger páginas internas do sistema que requerem login.</li>
        <li>O retorno de erro pode ser substituído por um redirecionamento para a página de login, se desejado.</li>
        <li>Middlewares de autenticação devem ser registrados nas rotas que exigem login.</li>
        <li>Este exemplo usa sessão PHP, mas poderia ser adaptado para tokens de API ou outras formas de autenticação.</li>
    </ul>

    <h3>💡 Fluxo de Trabalho</h3>
    <ol>
        <li>Requisição chega a uma rota protegida.</li>
        <li>Middleware <code>AuthMiddleware</code> executa <code>handle()</code>.</li>
        <li>Verifica se <code>$_SESSION['user_id']</code> está definido.</li>
        <li>Se definido → requisição continua para o próximo middleware ou controller.</li>
        <li>Se não definido → retorna erro ou redireciona para login.</li>
    </ol>
</section>





<section id="models-auth" class="doc-section">
    <h2>Model <code>Auth</code> em <code>/app/Models/Auth.php</code></h2>
    <p>
        O <strong>Auth</strong> é o modelo responsável por gerenciar usuários no sistema. Ele estende <code>SysORM</code>, que oferece métodos básicos de acesso ao banco de dados. Este modelo lida com criação, atualização, confirmação de usuários, tokens de verificação e redefinição de senha.
    </p>

    <h3>🛠️ Propriedades</h3>
    <ul>
        <li><code>$table</code> → define a tabela no banco de dados (<code>users</code>).</li>
        <li><code>$fillable</code> → campos que podem ser preenchidos via mass assignment.</li>
        <li><code>$hidden</code> → campos que não devem ser expostos (como senha e tokens).</li>
    </ul>

    <h3>🔹 Métodos Principais</h3>

    <h4>create($data)</h4>
    <p>Cria um novo usuário no banco de dados.</p>
    <pre><code>public static function create($data) {
    // Insere dados do usuário na tabela
    // Retorna o ID do registro criado
}</code></pre>

    <h4>saveConfirmationToken($userId, $token)</h4>
    <p>Salva o token de verificação para confirmação de email do usuário.</p>
    <pre><code>public function saveConfirmationToken($userId, $token) {
    // Atualiza o campo verification_token do usuário
    // Retorna verdadeiro se atualização foi bem-sucedida
}</code></pre>

    <h4>verifyToken($userId, $token)</h4>
    <p>Verifica se o token de confirmação é válido para o usuário informado.</p>
    <pre><code>public static function verifyToken($userId, $token) {
    // Retorna verdadeiro se o token corresponder ao registro no banco
}</code></pre>

    <h4>confirmUser($userId)</h4>
    <p>Confirma o usuário, marcando <code>confirmed_at</code> e removendo o token.</p>
    <pre><code>public static function confirmUser($userId) {
    // Atualiza o usuário como confirmado
    // Retorna verdadeiro se a confirmação for bem-sucedida
}</code></pre>

    <h4>where($column, $value)</h4>
    <p>Busca todos os usuários que correspondem a um determinado valor em uma coluna.</p>
    <pre><code>public static function where($column, $value) {
    // Retorna array com todos os registros encontrados
}</code></pre>

    <h4>saveResetToken($userId, $token)</h4>
    <p>Salva um token de redefinição de senha e define validade de 1 hora.</p>
    <pre><code>public static function saveResetToken($userId, $token) {
    // Atualiza reset_token e reset_expires
    // Retorna verdadeiro se a atualização for bem-sucedida
}</code></pre>

    <h4>verifyResetToken($userId, $token)</h4>
    <p>Verifica se o token de redefinição de senha ainda é válido.</p>
    <pre><code>public static function verifyResetToken($userId, $token) {
    // Retorna verdadeiro se o token existir e não estiver expirado
}</code></pre>

    <h4>updatePassword($userId, $newPassword)</h4>
    <p>Atualiza a senha do usuário e remove o token de redefinição.</p>
    <pre><code>public static function updatePassword($userId, $newPassword) {
    // Atualiza o campo password e limpa reset_token e reset_expires
}</code></pre>

    <h3>💡 Observações</h3>
    <ul>
        <li>Campos sensíveis como <code>password</code>, <code>verification_token</code> e <code>reset_token</code> são protegidos via <code>$hidden</code>.</li>
        <li>O modelo usa métodos estáticos e instâncias internas para manipulação de dados.</li>
        <li>O sistema suporta confirmação de usuário via token e recuperação de senha com token temporário.</li>
        <li>Todos os métodos que alteram o banco retornam verdadeiro ou falso para indicar sucesso da operação.</li>
    </ul>
</section>




<section id="models-auth" class="doc-section">
    <h2>Model <code>Auth</code> em <code>/app/Models/Auth.php</code></h2>
    <p>
        O <strong>Auth</strong> é o modelo responsável por gerenciar usuários no sistema. Ele estende <code>SysORM</code>, que oferece métodos básicos de acesso ao banco de dados. Este modelo lida com criação, atualização, confirmação de usuários, tokens de verificação e redefinição de senha.
    </p>

    <h3>🛠️ Propriedades</h3>
    <ul>
        <li><code>$table</code> → define a tabela no banco de dados (<code>users</code>).</li>
        <li><code>$fillable</code> → campos que podem ser preenchidos via mass assignment.</li>
        <li><code>$hidden</code> → campos que não devem ser expostos (como senha e tokens).</li>
    </ul>

    <h3>🔹 Métodos Principais</h3>

    <h4>create($data)</h4>
    <p>Cria um novo usuário no banco de dados.</p>
    <pre><code>public static function create($data) {
    // Insere dados do usuário na tabela
    // Retorna o ID do registro criado
}</code></pre>

    <h4>saveConfirmationToken($userId, $token)</h4>
    <p>Salva o token de verificação para confirmação de email do usuário.</p>
    <pre><code>public function saveConfirmationToken($userId, $token) {
    // Atualiza o campo verification_token do usuário
    // Retorna verdadeiro se atualização foi bem-sucedida
}</code></pre>

    <h4>verifyToken($userId, $token)</h4>
    <p>Verifica se o token de confirmação é válido para o usuário informado.</p>
    <pre><code>public static function verifyToken($userId, $token) {
    // Retorna verdadeiro se o token corresponder ao registro no banco
}</code></pre>

    <h4>confirmUser($userId)</h4>
    <p>Confirma o usuário, marcando <code>confirmed_at</code> e removendo o token.</p>
    <pre><code>public static function confirmUser($userId) {
    // Atualiza o usuário como confirmado
    // Retorna verdadeiro se a confirmação for bem-sucedida
}</code></pre>

    <h4>where($column, $value)</h4>
    <p>Busca todos os usuários que correspondem a um determinado valor em uma coluna.</p>
    <pre><code>public static function where($column, $value) {
    // Retorna array com todos os registros encontrados
}</code></pre>

    <h4>saveResetToken($userId, $token)</h4>
    <p>Salva um token de redefinição de senha e define validade de 1 hora.</p>
    <pre><code>public static function saveResetToken($userId, $token) {
    // Atualiza reset_token e reset_expires
    // Retorna verdadeiro se a atualização for bem-sucedida
}</code></pre>

    <h4>verifyResetToken($userId, $token)</h4>
    <p>Verifica se o token de redefinição de senha ainda é válido.</p>
    <pre><code>public static function verifyResetToken($userId, $token) {
    // Retorna verdadeiro se o token existir e não estiver expirado
}</code></pre>

    <h4>updatePassword($userId, $newPassword)</h4>
    <p>Atualiza a senha do usuário e remove o token de redefinição.</p>
    <pre><code>public static function updatePassword($userId, $newPassword) {
    // Atualiza o campo password e limpa reset_token e reset_expires
}</code></pre>

    <h3>💡 Observações</h3>
    <ul>
        <li>Campos sensíveis como <code>password</code>, <code>verification_token</code> e <code>reset_token</code> são protegidos via <code>$hidden</code>.</li>
        <li>O modelo usa métodos estáticos e instâncias internas para manipulação de dados.</li>
        <li>O sistema suporta confirmação de usuário via token e recuperação de senha com token temporário.</li>
        <li>Todos os métodos que alteram o banco retornam verdadeiro ou falso para indicar sucesso da operação.</li>
    </ul>
</section>






<section id="services-authservice" class="doc-section">
    <h2>Service <code>AuthService</code> em <code>/app/Services/AuthService.php</code></h2>
    <p>
        O <strong>AuthService</strong> é responsável por gerenciar toda a lógica de autenticação e registro de usuários. Ele atua como intermediário entre os <em>models</em> (<code>User</code>, <code>Auth</code>) e os controladores, abstraindo funcionalidades de login, logout, registro e recuperação de senha.
    </p>

    <h3>🛠️ Métodos Principais</h3>

    <h4>attempt(array $credentials)</h4>
    <p>Tenta autenticar um usuário com as credenciais fornecidas.</p>
    <pre><code>public function attempt(array $credentials) {
    return Auth::attempt($credentials); // Retorna verdadeiro se autenticação for bem-sucedida
}</code></pre>

    <h4>logout()</h4>
    <p>Encerra a sessão do usuário logado.</p>
    <pre><code>public function logout() {
    Auth::logout(); // Limpa a sessão e cookies relacionados
}</code></pre>

    <h4>user()</h4>
    <p>Retorna os dados do usuário atualmente autenticado.</p>
    <pre><code>public function user() {
    return Auth::user(); // Retorna objeto do usuário logado ou null se não houver
}</code></pre>

    <h4>register(array $data)</h4>
    <p>Cria um novo usuário, aplicando hash na senha antes de salvar.</p>
    <pre><code>public function register(array $data) {
    $data['password'] = Hash::make($data['password']); // Criptografa a senha
    return User::create($data); // Salva o usuário no banco
}</code></pre>

    <h4>recoverPassword($email)</h4>
    <p>Inicia o processo de recuperação de senha para o usuário informado.</p>
    <pre><code>public function recoverPassword($email) {
    // Implementa lógica de envio de e-mail com token de redefinição
}</code></pre>

    <h4>confirmRegistration($token)</h4>
    <p>Confirma o registro de um usuário usando o token de verificação enviado por e-mail.</p>
    <pre><code>public function confirmRegistration($token) {
    // Implementa lógica para validar token e confirmar usuário
}</code></pre>

    <h3>💡 Observações</h3>
    <ul>
        <li>Abstrai a complexidade de autenticação e registro para os controladores.</li>
        <li>Garante que senhas sejam sempre armazenadas de forma segura usando hash.</li>
        <li>Centraliza a lógica de recuperação de senha e confirmação de registro.</li>
        <li>Facilita testes e manutenção, pois o controlador não precisa lidar diretamente com o model <code>User</code>.</li>
    </ul>
</section>





<section id="services-syscacheservice" class="doc-section">
    <h2>Service <code>SysCacheService</code> em <code>/app/Services/SysCacheService.php</code></h2>
    <p>
        O <strong>SysCacheService</strong> é responsável por gerenciar cache de dados no sistema utilizando arquivos no servidor. Ele permite armazenar, recuperar e limpar dados temporários, melhorando a performance ao evitar consultas ou cálculos repetitivos.
    </p>

    <h3>🛠️ Propriedades</h3>
    <ul>
        <li><code>private $cacheDir</code> → Diretório onde os arquivos de cache são armazenados.</li>
    </ul>

    <h3>🛠️ Métodos Principais</h3>

    <h4>__construct($cacheDir)</h4>
    <p>Construtor que define o diretório de cache e cria a pasta caso não exista.</p>
    <pre><code>public function __construct($cacheDir = __DIR__ . '/../cache') {
    $this->cacheDir = $cacheDir;
    if (!is_dir($this->cacheDir)) {
        mkdir($this->cacheDir, 0777, true); // Cria a pasta de cache
    }
}</code></pre>

    <h4>set($key, $data, $ttl)</h4>
    <p>Armazena dados no cache com uma chave única e tempo de expiração (TTL).</p>
    <pre><code>public function set($key, $data, $ttl = 3600) {
    $file = $this->getCacheFile($key);
    $cacheData = [
        'expires' => time() + $ttl,
        'data' => $data
    ];
    file_put_contents($file, serialize($cacheData)); // Salva no arquivo
}</code></pre>

    <h4>get($key)</h4>
    <p>Recupera dados do cache usando a chave. Retorna <code>null</code> se o cache expirou ou não existe.</p>
    <pre><code>public function get($key) {
    $file = $this->getCacheFile($key);
    if (!file_exists($file)) return null;

    $cacheData = unserialize(file_get_contents($file));
    if ($cacheData['expires'] < time()) {
        unlink($file); // Remove cache expirado
        return null;
    }

    return $cacheData['data'];
}</code></pre>

    <h4>clear($key)</h4>
    <p>Remove o cache correspondente a uma chave específica.</p>
    <pre><code>public function clear($key) {
    $file = $this->getCacheFile($key);
    if (file_exists($file)) unlink($file);
}</code></pre>

    <h4>clearAll()</h4>
    <p>Limpa todos os arquivos de cache no diretório.</p>
    <pre><code>public function clearAll() {
    foreach (glob($this->cacheDir . '/*') as $file) {
        unlink($file); // Remove todos os arquivos
    }
}</code></pre>

    <h4>getCacheFile($key)</h4>
    <p>Gera o caminho do arquivo de cache baseado na chave, usando <code>md5</code> para criar nomes únicos.</p>
    <pre><code>private function getCacheFile($key) {
    return $this->cacheDir . '/' . md5($key) . '.cache';
}</code></pre>

    <h3>💡 Observações</h3>
    <ul>
        <li>O cache é baseado em arquivos no servidor e cada chave gera um arquivo distinto.</li>
        <li>O TTL define por quanto tempo o cache é válido, evitando dados desatualizados.</li>
        <li>O serviço permite limpar cache individual (<code>clear</code>) ou total (<code>clearAll</code>).</li>
        <li>O uso do <code>serialize</code> e <code>unserialize</code> permite armazenar qualquer tipo de dado PHP (arrays, objetos, etc).</li>
        <li>Ideal para acelerar consultas pesadas ou armazenar resultados de cálculos frequentes.</li>
    </ul>
</section>




<section id="services-sysqueueservice" class="doc-section">
    <h2>Service <code>SysQueueService</code> em <code>/app/Services/SysQueueService.php</code></h2>
    <p>
        O <strong>SysQueueService</strong> gerencia uma fila de tarefas simples utilizando um arquivo JSON no servidor. Ele permite adicionar tarefas à fila e processá-las posteriormente, garantindo que execuções longas ou assíncronas possam ser controladas.
    </p>

    <h3>🛠️ Propriedades</h3>
    <ul>
        <li><code>private $queueFile</code> → Caminho do arquivo JSON onde as tarefas da fila são armazenadas.</li>
    </ul>

    <h3>🛠️ Métodos Principais</h3>

    <h4>__construct($queueFile)</h4>
    <p>Construtor que define o arquivo da fila e cria o arquivo caso não exista.</p>
    <pre><code>public function __construct($queueFile = __DIR__ . '/../cache/queue.json') {
    $this->queueFile = $queueFile;
    if (!file_exists($this->queueFile)) {
        file_put_contents($this->queueFile, json_encode([])); // Cria arquivo vazio
    }
}</code></pre>

    <h4>push($task)</h4>
    <p>Adiciona uma nova tarefa à fila.</p>
    <pre><code>public function push($task) {
    $queue = json_decode(file_get_contents($this->queueFile), true);
    $queue[] = $task; // Adiciona a tarefa ao array
    file_put_contents($this->queueFile, json_encode($queue)); // Salva novamente no arquivo
}</code></pre>

    <h4>process()</h4>
    <p>Processa todas as tarefas da fila. Após o processamento, a fila é esvaziada.</p>
    <pre><code>public function process() {
    $queue = json_decode(file_get_contents($this->queueFile), true);
    foreach ($queue as $task) {
        // Implementar processamento da tarefa aqui
        // Ex: chamar função, executar comando, enviar e-mail etc.
    }
    file_put_contents($this->queueFile, json_encode([])); // Limpa a fila
}</code></pre>

    <h3>💡 Observações</h3>
    <ul>
        <li>O serviço utiliza um arquivo JSON simples como armazenamento da fila.</li>
        <li>Cada chamada a <code>push()</code> adiciona uma tarefa ao final da fila.</li>
        <li>O método <code>process()</code> deve ser implementado conforme a lógica específica das tarefas do sistema.</li>
        <li>Após o processamento, a fila é esvaziada, garantindo que nenhuma tarefa seja executada duas vezes.</li>
        <li>Ideal para executar tarefas assíncronas simples sem depender de bancos de dados ou sistemas de fila externos.</li>
    </ul>
</section>




<section id="requests-userrequest" class="doc-section">
    <h2>Request <code>UserRequest</code> em <code>/app/Requests/UserRequest.php</code></h2>
    <p>
        O <strong>UserRequest</strong> é responsável por centralizar a validação e autorização de dados enviados em formulários relacionados ao usuário. Ele herda da classe <code>Request</code> do SysORM, que fornece métodos para validação de dados e autorização.
    </p>

    <h3>🛠️ Métodos Principais</h3>

    <h4>rules()</h4>
    <p>Define as regras de validação para os dados do usuário.</p>
    <pre><code>public function rules() {
    return [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . ($this->user() ? $this->user()->id : ''),
        'password' => 'required|string|min:8|confirmed',
        // Adicione outras regras conforme necessário
    ];
}</code></pre>
    <p><strong>Explicação:</strong></p>
    <ul>
        <li><code>required</code> → o campo é obrigatório.</li>
        <li><code>string</code> → deve ser do tipo string.</li>
        <li><code>max:255</code> → tamanho máximo de 255 caracteres.</li>
        <li><code>email</code> → deve ser um e-mail válido.</li>
        <li><code>unique:users,email,ID</code> → garante que o e-mail seja único na tabela <code>users</code>, exceto para o ID do usuário atual.</li>
        <li><code>min:8</code> → senha mínima de 8 caracteres.</li>
        <li><code>confirmed</code> → senha deve ter confirmação (campo <code>password_confirmation</code>).</li>
    </ul>

    <h4>authorize()</h4>
    <p>Define se o usuário tem permissão para realizar a requisição.</p>
    <pre><code>public function authorize() {
    return true; // Permite acesso para todos
}</code></pre>

    <h4>validated()</h4>
    <p>Retorna os dados validados após a execução das regras.</p>
    <pre><code>public function validated() {
    return parent::validated();
}</code></pre>

    <h3>💡 Observações</h3>
    <ul>
        <li>O <code>UserRequest</code> centraliza a lógica de validação, evitando duplicação de regras nos controllers.</li>
        <li>Você pode estender as regras para campos adicionais conforme a necessidade do sistema.</li>
        <li>O método <code>authorize()</code> pode ser personalizado para verificar permissões específicas do usuário.</li>
        <li>O uso de <code>validated()</code> garante que apenas os dados que passaram nas regras de validação sejam utilizados no sistema.</li>
    </ul>
</section>




<section id="routes-web" class="doc-section">
    <h2>Rotas do Sistema <code>routes/web.php</code></h2>
    <p>
        Este arquivo define todas as rotas do SysFramework, incluindo rotas públicas, rotas protegidas por middleware, autenticação, CRUD de clientes e páginas administrativas. Ele utiliza a classe <code>SysRouter</code> para registrar rotas e grupos de rotas, permitindo prefixos e middlewares.
    </p>

    <h3>🛠️ Rotas Públicas</h3>
    <ul>
        <li><code>/</code> → <code>HomeController@index</code> → Página inicial.</li>
        <li><code>/example</code> → <code>HomeController@example</code> → Exemplo de renderização com dados.</li>
        <li><code>/syste</code> → <code>HomeController@syste</code> → Exemplo de renderização de dados customizados.</li>
        <li><code>/systables</code> → <code>HomeController@systables</code> → Exibe tabelas do sistema.</li>
    </ul>

    <h3>📋 Rotas de Clientes</h3>
    <p>Grupo de rotas com prefixo <code>/clients</code>, correspondendo ao CRUD do <code>ClientController</code>.</p>
    <ul>
        <li><code>/clients</code> → Lista todos os clientes (<code>index()</code>).</li>
        <li><code>/clients/create</code> → Formulário de criação (<code>create()</code>).</li>
        <li><code>/clients</code> [POST] → Armazena novo cliente (<code>store()</code>).</li>
        <li><code>/clients/edit/{id}</code> → Formulário de edição (<code>edit($id)</code>).</li>
        <li><code>/clients/update/{id}</code> [PUT] → Atualiza cliente (<code>update($id)</code>).</li>
        <li><code>/clients/show/{id}</code> → Visualiza detalhes (<code>show($id)</code>).</li>
        <li><code>/clients/delete/{id}</code> → Remove cliente (<code>delete($id)</code>).</li>
    </ul>

    <h3>🛡️ Rotas Administrativas</h3>
    <p>Grupo protegido pelo <code>AuthMiddleware</code>, prefixo <code>/admin</code>:</p>
    <ul>
        <li><code>/admin</code> e <code>/admin/dashboard</code> → <code>AdminController@dashboard</code>.</li>
        <li><code>/admin/users</code> → <code>AdminController@users</code>.</li>
        <li><code>/admin/settings</code> → <code>AdminController@settings</code>.</li>
        <li>Outras rotas incluem: <code>buttons</code>, <code>cards</code>, <code>utilities_color</code>, <code>utilities_border</code>, <code>utilities_animation</code>, <code>utilities_other</code>, <code>blank</code>, <code>charts</code>, <code>tables</code>.</li>
    </ul>

    <h3>🔐 Autenticação</h3>
    <ul>
        <li><code>/register</code> → Formulário de registro (<code>AuthController@register</code>).</li>
        <li><code>/newregister</code> [POST] → Cria novo usuário (<code>newregister()</code>).</li>
        <li><code>/registred</code> → Confirmação de registro (<code>registred()</code>).</li>
        <li><code>/confirm_email</code> e <code>/confirmemail</code> → Confirmação de e-mail.</li>
        <li><code>/login</code> → Formulário de login (<code>login()</code>).</li>
        <li><code>/gologin</code> [POST] → Autentica usuário (<code>gologin()</code>).</li>
        <li><code>/logout</code> → Logout do usuário (<code>logout()</code>).</li>
    </ul>

    <h3>🔄 Recuperação de Senha</h3>
    <ul>
        <li><code>/forgot_password</code> → Formulário de recuperação (<code>forgotPassword()</code>).</li>
        <li><code>/send_resetlink</code> [POST] → Envia link de recuperação (<code>sendResetLink()</code>).</li>
        <li><code>/reset_password</code> → Formulário de redefinição (<code>resetPassword()</code>).</li>
        <li><code>/goreset_password</code> [POST] → Atualiza a senha (<code>goresetPassword()</code>).</li>
    </ul>

    <h3>📦 Outras Funcionalidades</h3>
    <ul>
        <li>Rota para arquivos estáticos: <code>/assets/{path}</code>.</li>
        <li>Rota de erro 404 personalizada, registrando a URL e exibindo uma página amigável.</li>
        <li>Suporte a cache de rotas (comentado: <code>SysRouter::cacheRoutes()</code>).</li>
    </ul>

    <h3>💡 Observações</h3>
    <ul>
        <li>O arquivo inicia a sessão caso ainda não esteja iniciada (<code>session_start()</code>).</li>
        <li>Middlewares podem ser aplicados em grupos de rotas para proteção de acesso.</li>
        <li>O uso de <code>SysRouter::group</code> facilita a organização de prefixos e middlewares.</li>
        <li>O logger <code>SysLogger</code> é utilizado para registrar acessos e erros, como na página 404.</li>
    </ul>
</section>





  </main>


</body>
</html>

