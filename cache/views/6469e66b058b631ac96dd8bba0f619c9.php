<?php echo $this->extend('layouts.app'); ?>

<?php $this->startSection('title', 'Clients List'); ?> 
<?php $this->stopSection(); ?><?php $this->startSection('content', ''); ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-4 text-primary">Clients List</h1>
        <a href="/clients/create" class="btn btn-success btn-lg">Add New Client</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($client->id, ENT_QUOTES, "UTF-8"); ?></td> <!-- Corrigido para sintaxe de objeto -->
                        <td><?php echo htmlspecialchars($client->name, ENT_QUOTES, "UTF-8"); ?></td> <!-- Corrigido para sintaxe de objeto -->
                        <td><?php echo htmlspecialchars($client->company, ENT_QUOTES, "UTF-8"); ?></td> <!-- Corrigido para sintaxe de objeto -->
                        <td>
                            <a href="/clients/show/<?php echo htmlspecialchars($client->id, ENT_QUOTES, "UTF-8"); ?>" class="btn btn-info btn-sm me-2">View</a> <!-- Sintaxe de objeto -->
                            <a href="/clients/edit/<?php echo htmlspecialchars($client->id, ENT_QUOTES, "UTF-8"); ?>" class="btn btn-warning btn-sm me-2">Edit</a> <!-- Sintaxe de objeto -->
                            <a href="/clients/delete/<?php echo htmlspecialchars($client->id, ENT_QUOTES, "UTF-8"); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a> <!-- Sintaxe de objeto -->
                        </td>
                    </tr>
                <?php endforeach; ?></tbody>
        </table>
    </div>
</div>
<?php $this->stopSection(); ?>