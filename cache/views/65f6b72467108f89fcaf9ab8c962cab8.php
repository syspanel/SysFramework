<?php echo $this->extend('layouts.app'); ?>

<?php $this->startSection('title', 'Registrar'); ?>
<?php $this->stopSection(); ?><?php $this->startSection('content', ''); ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Registrar</h2>
        <form action="<?php echo htmlspecialchars(route('auth.newregister'), ENT_QUOTES, "UTF-8"); ?>" method="POST">
            <?php echo '<input type="hidden" name="_token" value="' . htmlspecialchars($this->csrfToken(), ENT_QUOTES, "UTF-8") . '">'; ?><div class="mb-3">
                <label for="firstname" class="form-label">Primeiro Nome</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Sobrenome</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</div>
<?php $this->stopSection(); ?>