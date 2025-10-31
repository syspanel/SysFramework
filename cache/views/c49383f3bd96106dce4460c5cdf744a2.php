<?php echo $this->extend('layouts.app'); ?>


<?php $this->startSection('title', 'Client Details'); ?> 
<?php $this->stopSection(); ?><?php $this->startSection('content', ''); ?>
<div class="container mt-5">
    <h1 class="text-info">Client Details</h1>
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <td><?php echo htmlspecialchars($client->id, ENT_QUOTES, "UTF-8"); ?></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><?php echo htmlspecialchars($client->name, ENT_QUOTES, "UTF-8"); ?></td>
        </tr>
        <tr>
            <th>Company</th>
            <td><?php echo htmlspecialchars($client->company, ENT_QUOTES, "UTF-8"); ?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><?php echo htmlspecialchars($client->address, ENT_QUOTES, "UTF-8"); ?></td>
        </tr>
        <tr>
            <th>Phone</th>
            <td><?php echo htmlspecialchars($client->phone, ENT_QUOTES, "UTF-8"); ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo htmlspecialchars($client->email, ENT_QUOTES, "UTF-8"); ?></td>
        </tr>
        <tr>
            <th>Notes</th>
            <td><?php echo htmlspecialchars($client->notes, ENT_QUOTES, "UTF-8"); ?></td>
        </tr>
    </table>
    <a href="/clients/edit/<?php echo htmlspecialchars($client->id, ENT_QUOTES, "UTF-8"); ?>" class="btn btn-warning me-2">Edit</a>
    <a href="/clients/delete/<?php echo htmlspecialchars($client->id, ENT_QUOTES, "UTF-8"); ?>" class="btn btn-danger me-2" onclick="return confirm('Are you sure?')">Delete</a>
    <a href="/clients" class="btn btn-secondary">Back to List</a>
</div>
<?php $this->stopSection(); ?>