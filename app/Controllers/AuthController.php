<?php

namespace App\Controllers;

use App\Models\Auth;
use Core\BaseController;
use Core\SysLogger;
use Core\SysTE;
use Core\Request;
use Core\Response;
use App\Services\AnotherService;
use App\Services\SomeService;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

class AuthController extends BaseController
{
    protected $sysTE;
    protected $logger;
    protected $someService;
    protected $anotherService;
    protected $request;
    protected $response;
    protected $mailer;

    public function __construct($sysTE, $logger, $someService, $anotherService, $request, $response)
    {
        $this->sysTE = $sysTE;
        $this->logger = $logger;
        $this->someService = $someService;
        $this->anotherService = $anotherService;
        $this->request = $request;
        $this->response = $response;

        // Configuração do Mailer
        $transport = Transport::fromDsn(MAILER_DSN); // Use a variável de ambiente correta
        $this->mailer = new Mailer($transport); // Armazenar o Mailer para uso posterior

    }

    public function register()
    {
        $this->logger->info('(auth.register) - Formulário de Registro.');

        return $this->response->send(
            $this->sysTE->render('auth.register')
        );
    }

    public function newregister()
    {
        $data = $this->request->post();

        $validator = new \Core\Validations();

        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'length' => [6, 20]],
        ];

        $validator->validate($data, $rules);

        if ($validator->hasErrors()) {
            $this->logger->warning('(auth.newregister) - Erros de validação: ' . json_encode($validator->getErrors()));
            return $this->response->redirect('/register?error=validation');
        }

        if (!empty(Auth::where('email', $data['email']))) {
            $this->logger->warning('(auth.newregister) - Email já existe: ' . $data['email']);
            return $this->response->redirect('/register?error=email_exists');
        }

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $userId = Auth::create($data);

        // Enviar email de confirmação
        $this->sendConfirmationEmail($data['email'], $userId);

        $_SESSION['firstname'] = $data['firstname'];
        $_SESSION['lastname'] = $data['lastname'];
        $_SESSION['email'] = $data['email'];

        return $this->response->redirect('/registred');
    }

    private function sendConfirmationEmail($email, $userId)
    {
        $token = bin2hex(random_bytes(16));
        $user = new Auth();
        $user->saveConfirmationToken($userId, $token);

       $confirmationLink = "https://" . MAIL_URL . "/confirm_email?token={$token}&user_id={$userId}";

        $subject = "Confirmação de Registro";
        $message = "Por favor, clique no link para confirmar seu registro: <a href=\"{$confirmationLink}\">Confirmar</a>";

        // Criar e enviar e-mail
        $emailMessage = (new Email())
            ->from(MAIL_FROM_ADDRESS) // Substitua pelo seu e-mail
            ->to($email)
            ->subject($subject)
            ->html($message);

        $this->mailer->send($emailMessage);
    }

    public function confirm_email()
    {
        $token = $this->request->get('token');
        $userId = $this->request->get('user_id');
    


        $isValid = Auth::verifyToken($userId, $token);
    

        if ($isValid) {
            Auth::confirmUser($userId);

            return $this->response->send(
                $this->sysTE->render('auth.confirmation', [
                    'message' => 'Obrigado por confirmar seu e-mail! Clique aqui para fazer login: <a href="/login">Login</a>'
                ])
            );
        }

        return $this->response->send(
            $this->sysTE->render('auth.confirmation', [
                'message' => 'Token inválido ou expirado.'
            ])
        );
    }

    public function registred()
    {
        $firstname = $_SESSION['firstname'] ?? '';
        $lastname = $_SESSION['lastname'] ?? '';
        $email = $_SESSION['email'] ?? '';

        unset($_SESSION['firstname'], $_SESSION['lastname'], $_SESSION['email']);

        return $this->response->send(
            $this->sysTE->render('auth.registred', [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email
            ])
        );
    }
    
    
    public function login()
    {
        $this->logger->info('(auth.login) - Formulário de Login.');

        $data = ['message' => ''];

        return $this->response->send(
            $this->sysTE->render('auth.login', $data)
        );
    }

    public function gologin()
{
    $data = $this->request->post();

    $validator = new \Core\Validations();

    $rules = [
        'email' => ['required', 'email'],
        'password' => ['required', 'string'],
    ];

    $validator->validate($data, $rules);

    if ($validator->hasErrors()) {
        $this->logger->warning('(auth.gologin) - Erros de validação: ' . json_encode($validator->getErrors()));
        return $this->response->redirect('/login?error=validation');
    }

    // Buscar o usuário pelo email
    $user = Auth::where('email', $data['email']);

    if (empty($user)) {
        $this->logger->warning('(auth.gologin) - Tentativa de login falhou. Email não encontrado: ' . $data['email']);
              
        $data = ['message' => 'Tentativa de login falhou. Email não encontrado.'];

        return $this->response->send(
            $this->sysTE->render('auth.login', $data)
        );
        
    }

    // Verificar a senha
    if (!password_verify($data['password'], $user[0]['password'])) {
        $this->logger->warning('(auth.gologin) - Tentativa de login falhou. Senha incorreta para o email: ' . $data['email']);
                
        $data = ['message' => 'Tentativa de login falhou. Senha incorreta.'];

        return $this->response->send(
            $this->sysTE->render('auth.login', $data)
        );
        
        
    }

    // Verificar se o email foi confirmado
    if (is_null($user[0]['confirmed_at'])) {
        $this->logger->warning('(auth.gologin) - Tentativa de login falhou. Email não confirmado: ' . $data['email']);
        return $this->response->send(
            $this->sysTE->render('auth.confirmemail', [
                'message' => 'Por favor, confirme seu e-mail antes de fazer login.'
            ])
        );
    }

    // Iniciar a sessão
    $_SESSION['user_id'] = $user[0]['id'];
    $_SESSION['firstname'] = $user[0]['firstname'];
    $_SESSION['lastname'] = $user[0]['lastname'];
    $_SESSION['email'] = $user[0]['email'];

    $this->logger->info('(auth.gologin) - Login bem-sucedido para: ' . $data['email']);

    // Redirecionar após login bem-sucedido
    return $this->response->send(
        $this->sysTE->render('auth.dashboard')
    );
}


    public function logout()
    {
        $this->logger->info('(auth.logout) - Logout bem-sucedido para: ' . $data['email']);
        session_destroy();
        return $this->response->redirect('/');
    }
    
    





public function forgotPassword()
    {
        $this->logger->info('(auth.forgot_password) - Reenviar Senha.');
        
        $data = ['message' => ''];

        return $this->response->send(
            $this->sysTE->render('auth.forgot_password', $data)
        );
    }


    
    
    
    public function sendResetLink()
{
    $data = $this->request->post();

    // Verificar se o email existe no sistema
    $user = Auth::where('email', $data['email']);
    if (empty($user)) {
        $this->logger->warning('(auth.sendResetLink) - Email não encontrado: ' . $data['email']);
        $data = ['message' => 'Email não encontrado.'];

        return $this->response->send(
            $this->sysTE->render('auth.forgot_password', $data)
        );
    }

    // Gerar token de redefinição
    $token = bin2hex(random_bytes(16));
    $userModel = new Auth(); // Cria uma instância da classe User
    $userModel->saveResetToken($user[0]['id'], $token); // Chama o método a partir da instância

    // Enviar o e-mail com o link de redefinição
    $resetLink = "https://" . MAIL_URL . "/reset_password?token={$token}&user_id={$user[0]['id']}";
    
    
    $subject = "Redefinição de senha";
    $message = "Clique no link para redefinir sua senha: <a href=\"{$resetLink}\">Redefinir senha</a>";

    $emailMessage = (new Email())
        ->from(MAIL_FROM_ADDRESS)
        ->to($data['email'])
        ->subject($subject)
        ->html($message);

    $this->mailer->send($emailMessage);

    $this->logger->info('(auth.sendResetLink) - Link de redefinição enviado para: ' . $data['email']);

    return $this->response->send(
        $this->sysTE->render('auth.forgot_password', [
            'message' => 'Link de redefinição de senha enviado para seu e-mail.'
        ])
    );
}






public function resetPassword()
    {
        $this->logger->info('(auth.forgot_password) - Rededirnir Senha.');
        
        $data = ['message' => ''];

        return $this->response->send(
            $this->sysTE->render('auth.reset_password', $data)
        );
    }





public function goresetPassword()
{
    $data = $this->request->post();
    $token = $data['token'];
    $userId = $data['user_id'];

    // Verificar se o token é válido e não expirou
    $user = Auth::verifyResetToken($userId, $token);

    if (!$user) {
        return $this->response->redirect('/reset_password?error=invalid_token');
    }

    // Atualizar a senha
    $newPassword = password_hash($data['password'], PASSWORD_BCRYPT);
    Auth::updatePassword($userId, $newPassword);
    
    $data = ['message' => 'Senha redefinida com sucesso.'];

        return $this->response->send(
            $this->sysTE->render('auth.login', $data)
        );
}










public function resendConfirmation()
    {
        $this->logger->info('(auth.resend_confirmation) - Reenviar confirmação de email.');
        
        $data = ['message' => ''];

        return $this->response->send(
            $this->sysTE->render('auth.resend_confirmation', $data)
        );
    }





public function goresendConfirmation()
{
    $data = $this->request->post();

    // Verificar se o e-mail existe e não foi confirmado
    $user = Auth::where('email', $data['email']);
    if (empty($user) || !is_null($user[0]['confirmed_at'])) {        
        $data = ['message' => 'Email não existe ou já foi confirmado.'];
        return $this->response->send(
            $this->sysTE->render('auth.resend_confirmation', $data)
        );
    }

    // Reenviar o e-mail de confirmação
    $this->sendConfirmationEmail($data['email'], $user[0]['id']); 

        $data = ['message' => 'Um novo e-mail de confirmação foi enviado.'];
        return $this->response->send(
            $this->sysTE->render('auth.resend_confirmation', $data)
        );
    
}





public function goforgotPassword()
{
    $data = $this->request->post();

    // Validação do email
    $validator = new \Core\Validations();
    $rules = ['email' => ['required', 'email']];
    $validator->validate($data, $rules);

    if ($validator->hasErrors()) {
        $this->logger->warning('(auth.forgotPassword) - Erros de validação: ' . json_encode($validator->getErrors()));
        return $this->response->redirect('/forgot-password?error=validation');
    }

    // Buscar o usuário pelo email
    $user = Auth::where('email', $data['email']);

    if (empty($user)) {
        $this->logger->warning('(auth.forgotPassword) - Email não encontrado: ' . $data['email']);
        return $this->response->redirect('/forgot-password?error=user_not_found');
    }

    // Gerar token de redefinição de senha
    $token = bin2hex(random_bytes(16));
    Auth::saveResetToken($user[0]['id'], $token);

    // Enviar email de redefinição
    $resetLink = "https://" . MAIL_URL . "/reset-password?token={$token}&user_id={$user[0]['id']}";
    $subject = "Redefinição de Senha";
    $message = "Clique no link para redefinir sua senha: <a href=\"{$resetLink}\">Redefinir Senha</a>";

    $emailMessage = (new Email())
        ->from(MAIL_FROM_ADDRESS)
        ->to($data['email'])
        ->subject($subject)
        ->html($message);

    $this->mailer->send($emailMessage);

    return $this->response->redirect('/forgot-password?success=true');
}

public function resendConfirmationEmail()
{
    $data = $this->request->post();

    // Validação do email
    $validator = new \Core\Validations();
    $rules = ['email' => ['required', 'email']];
    $validator->validate($data, $rules);

    if ($validator->hasErrors()) {
        $this->logger->warning('(auth.resendConfirmationEmail) - Erros de validação: ' . json_encode($validator->getErrors()));
        return $this->response->redirect('/resend-confirmation?error=validation');
    }

    // Buscar o usuário pelo email
    $user = Auth::where('email', $data['email']);

    if (empty($user)) {
        $this->logger->warning('(auth.resendConfirmationEmail) - Email não encontrado: ' . $data['email']);
        return $this->response->redirect('/resend-confirmation?error=user_not_found');
    }

    if (!is_null($user[0]['confirmed_at'])) {
        $this->logger->info('(auth.resendConfirmationEmail) - Usuário já confirmado: ' . $data['email']);
        return $this->response->redirect('/login?message=email_already_confirmed');
    }

    // Reenviar email de confirmação
    $this->sendConfirmationEmail($data['email'], $user[0]['id']);

    return $this->response->redirect('/resend-confirmation?success=true');
}

    
    
}
