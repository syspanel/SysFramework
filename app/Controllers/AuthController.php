<?php

/***************************************************************************
 * SysFramework - PHP Framework                                            *
 * ======================================================================= *
 *                                                                          *
 * PHP Framework                                                            *
 * (c) 2025 Marco Costa  |  sysframework@syspanel.com.br                    *
 * Website: https://sysframework.syspanel.com.br                            *
 *                                                                          *
 * Licensed under the MIT License                                           *
 *                                                                          *
 * Permission is hereby granted, free of charge, to any person obtaining    *
 * a copy of this software and associated documentation files (the          *
 * "Software"), to deal in the Software without restriction, including      *
 * without limitation the rights to use, copy, modify, merge, publish,      *
 * distribute, sublicense, and/or sell copies of the Software, and to       *
 * permit persons to whom the Software is furnished to do so, subject to    *
 * the following conditions:                                                *
 *                                                                          *
 * The above copyright notice and this permission notice shall be included  *
 * in all copies or substantial portions of the Software.                   *
 *                                                                          *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS  *
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF               *
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.   *
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY     *
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,     *
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE        *
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.                   *
 ***************************************************************************/

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

        // Mailer configuration
        $transport = Transport::fromDsn(MAILER_DSN); // Use the correct environment variable
        $this->mailer = new Mailer($transport); // Store the Mailer for later use
    }

    public function register()
    {
        $this->logger->info('(auth.register) - Registration form.');

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
            $this->logger->warning('(auth.newregister) - Validation errors: ' . json_encode($validator->getErrors()));
            return $this->response->redirect('/register?error=validation');
        }

        if (!empty(Auth::where('email', $data['email']))) {
            $this->logger->warning('(auth.newregister) - Email already exists: ' . $data['email']);
            return $this->response->redirect('/register?error=email_exists');
        }

        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $userId = Auth::create($data);

        // Send confirmation email
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

        $subject = "Registration Confirmation";
        $message = "Please click the link to confirm your registration: <a href=\"{$confirmationLink}\">Confirm</a>";

        // Create and send email
        $emailMessage = (new Email())
            ->from(MAIL_FROM_ADDRESS) // Replace with your email
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
                    'message' => 'Thank you for confirming your email! Click here to login: <a href="/login">Login</a>'
                ])
            );
        }

        return $this->response->send(
            $this->sysTE->render('auth.confirmation', [
                'message' => 'Invalid or expired token.'
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
        $this->logger->info('(auth.login) - Login form.');

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
            $this->logger->warning('(auth.gologin) - Validation errors: ' . json_encode($validator->getErrors()));
            return $this->response->redirect('/login?error=validation');
        }

        // Fetch user by email
        $user = Auth::where('email', $data['email']);

        if (empty($user)) {
            $this->logger->warning('(auth.gologin) - Login attempt failed. Email not found: ' . $data['email']);

            $data = ['message' => 'Login attempt failed. Email not found.'];

            return $this->response->send(
                $this->sysTE->render('auth.login', $data)
            );
        }

        // Verify password
        if (!password_verify($data['password'], $user[0]['password'])) {
            $this->logger->warning('(auth.gologin) - Login attempt failed. Incorrect password for email: ' . $data['email']);

            $data = ['message' => 'Login attempt failed. Incorrect password.'];

            return $this->response->send(
                $this->sysTE->render('auth.login', $data)
            );
        }

        // Check if email confirmed
        if (is_null($user[0]['confirmed_at'])) {
            $this->logger->warning('(auth.gologin) - Login attempt failed. Email not confirmed: ' . $data['email']);
            return $this->response->send(
                $this->sysTE->render('auth.confirmemail', [
                    'message' => 'Please confirm your email before logging in.'
                ])
            );
        }

        // Start session
        $_SESSION['user_id'] = $user[0]['id'];
        $_SESSION['firstname'] = $user[0]['firstname'];
        $_SESSION['lastname'] = $user[0]['lastname'];
        $_SESSION['email'] = $user[0]['email'];

        $this->logger->info('(auth.gologin) - Successful login for: ' . $data['email']);

        // Redirect after successful login
        return $this->response->send(
            $this->sysTE->render('admin.dashboard')
        );
    }

    public function logout()
    {
        $email = $_SESSION['email'] ?? 'unknown';

        $this->logger->info('(auth.logout) - Successful logout for: ' . $email);

        session_destroy();

        return $this->response->redirect('/');
    }

    public function forgotPassword()
    {
        $this->logger->info('(auth.forgot_password) - Request password reset.');

        $data = ['message' => ''];

        return $this->response->send(
            $this->sysTE->render('auth.forgot_password', $data)
        );
    }

    public function sendResetLink()
    {
        $data = $this->request->post();

        // Check if email exists
        $user = Auth::where('email', $data['email']);
        if (empty($user)) {
            $this->logger->warning('(auth.sendResetLink) - Email not found: ' . $data['email']);
            $data = ['message' => 'Email not found.'];

            return $this->response->send(
                $this->sysTE->render('auth.forgot_password', $data)
            );
        }

        // Generate reset token
        $token = bin2hex(random_bytes(16));
        $userModel = new Auth();
        $userModel->saveResetToken($user[0]['id'], $token);

        // Send reset email
        $resetLink = "https://" . MAIL_URL . "/reset_password?token={$token}&user_id={$user[0]['id']}";

        $subject = "Password Reset";
        $message = "Click the link to reset your password: <a href=\"{$resetLink}\">Reset Password</a>";

        $emailMessage = (new Email())
            ->from(MAIL_FROM_ADDRESS)
            ->to($data['email'])
            ->subject($subject)
            ->html($message);

        $this->mailer->send($emailMessage);

        $this->logger->info('(auth.sendResetLink) - Reset link sent to: ' . $data['email']);

        return $this->response->send(
            $this->sysTE->render('auth.forgot_password', [
                'message' => 'Password reset link has been sent to your email.'
            ])
        );
    }

    public function resetPassword()
    {
        $this->logger->info('(auth.resetPassword) - Reset password page.');

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

        // Verify token validity
        $user = Auth::verifyResetToken($userId, $token);

        if (!$user) {
            return $this->response->redirect('/reset_password?error=invalid_token');
        }

        // Update password
        $newPassword = password_hash($data['password'], PASSWORD_BCRYPT);
        Auth::updatePassword($userId, $newPassword);

        $data = ['message' => 'Password successfully reset.'];

        return $this->response->send(
            $this->sysTE->render('auth.login', $data)
        );
    }

    public function resendConfirmation()
    {
        $this->logger->info('(auth.resend_confirmation) - Resend email confirmation.');

        $data = ['message' => ''];

        return $this->response->send(
            $this->sysTE->render('auth.resend_confirmation', $data)
        );
    }

    public function goresendConfirmation()
    {
        $data = $this->request->post();

        // Check if email exists and not confirmed
        $user = Auth::where('email', $data['email']);
        if (empty($user) || !is_null($user[0]['confirmed_at'])) {
            $data = ['message' => 'Email does not exist or has already been confirmed.'];
            return $this->response->send(
                $this->sysTE->render('auth.resend_confirmation', $data)
            );
        }

        // Resend confirmation email
        $this->sendConfirmationEmail($data['email'], $user[0]['id']);

        $data = ['message' => 'A new confirmation email has been sent.'];
        return $this->response->send(
            $this->sysTE->render('auth.resend_confirmation', $data)
        );
    }

    public function goforgotPassword()
    {
        $data = $this->request->post();

        // Validate email
        $validator = new \Core\Validations();
        $rules = ['email' => ['required', 'email']];
        $validator->validate($data, $rules);

        if ($validator->hasErrors()) {
            $this->logger->warning('(auth.forgotPassword) - Validation errors: ' . json_encode($validator->getErrors()));
            return $this->response->redirect('/forgot-password?error=validation');
        }

        // Fetch user by email
        $user = Auth::where('email', $data['email']);

        if (empty($user)) {
            $this->logger->warning('(auth.forgotPassword) - Email not found: ' . $data['email']);
            return $this->response->redirect('/forgot-password?error=user_not_found');
        }

        // Generate reset token
        $token = bin2hex(random_bytes(16));
        Auth::saveResetToken($user[0]['id'], $token);

        // Send reset email
        $resetLink = "https://" . MAIL_URL . "/reset-password?token={$token}&user_id={$user[0]['id']}";
        $subject = "Password Reset";
        $message = "Click the link to reset your password: <a href=\"{$resetLink}\">Reset Password</a>";

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

        // Validate email
        $validator = new \Core\Validations();
        $rules = ['email' => ['required', 'email']];
        $validator->validate($data, $rules);

        if ($validator->hasErrors()) {
            $this->logger->warning('(auth.resendConfirmationEmail) - Validation errors: ' . json_encode($validator->getErrors()));
            return $this->response->redirect('/resend-confirmation?error=validation');
        }

        // Fetch user by email
        $user = Auth::where('email', $data['email']);

        if (empty($user)) {
            $this->logger->warning('(auth.resendConfirmationEmail) - Email not found: ' . $data['email']);
            return $this->response->redirect('/resend-confirmation?error=user_not_found');
        }

        if (!is_null($user[0]['confirmed_at'])) {
            $this->logger->info('(auth.resendConfirmationEmail) - User already confirmed: ' . $data['email']);
            return $this->response->redirect('/login?message=email_already_confirmed');
        }

        // Resend confirmation email
        $this->sendConfirmationEmail($data['email'], $user[0]['id']);

        return $this->response->redirect('/resend-confirmation?success=true');
    }
}
