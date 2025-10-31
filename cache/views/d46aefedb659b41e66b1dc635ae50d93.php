<?php echo $this->extend('layouts.app'); ?>

<?php $this->startSection('title', 'Login'); ?>
<?php $this->stopSection(); ?><?php $this->startSection('content', ''); ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Login</h2>
        
        <?php if ($message != ''): ?>
        <div class="alert alert-info" role="alert">
            <?php echo htmlspecialchars($message, ENT_QUOTES, "UTF-8"); ?>
        </div>   
        <?php endif; ?><form action="<?php echo htmlspecialchars(route('auth.gologin'), ENT_QUOTES, "UTF-8"); ?>" method="POST">
            <?php echo '<input type="hidden" name="_token" value="' . htmlspecialchars($this->csrfToken(), ENT_QUOTES, "UTF-8") . '">'; ?><div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        
        <br><br>
        <a href="/register">Registrar</a>
        <br>
        <a href="/forgot_password">Esqueci minha senha</a>
        <br>
        <a href="/resend_confirmation">Reenviar confirmação de email</a>
        
        
    </div>
</div>
<?php $this->stopSection(); ?>