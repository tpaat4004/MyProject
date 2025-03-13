<h1>Edit Sizes</h1>
<form method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Name sizes</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $sizes['name'] ?>" required>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
</form>