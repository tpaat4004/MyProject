<h1>Users List</h1>
<a href="/users/create" class="btn btn-primary mb-3">Create Users</a>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td>
                <?php if (!empty($user['image'])): ?>
                    <img src="<?= $user['image'] ?>" alt="User Image" width="100" height="100">
                <?php endif; ?>
            </td>
            <td>
                <a href="/users/<?= $user['id'] ?>" class="btn btn-info btn-sm">View</a>
                <a href="/users/edit/<?= $user['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="/users/delete/<?= $user['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>