<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Admins</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminModal">
        <i class="bi bi-plus-lg me-1"></i> Add Admin
    </button>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admins as $a): ?>
                        <tr>
                            <td><?= $a['id'] ?></td>
                            <td><?= htmlspecialchars($a['username']) ?></td>
                            <td>
                                <?php if ((int) $a['id'] !== (int) (auth_user()['id'] ?? 0)): ?>
                                    <a class="btn btn-sm btn-danger"
                                       href="index.php?action=admin.destroy&id=<?= $a['id'] ?>"
                                       onclick="return confirm('Delete this admin?')">Delete</a>
                                <?php else: ?>
                                    <span class="text-muted small">Current user</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addAdminModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="index.php?action=admin.store">
                <div class="modal-header">
                    <h5 class="modal-title">Add Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Admin</button>
                </div>
            </form>
        </div>
    </div>
</div>
