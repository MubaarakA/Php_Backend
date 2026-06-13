<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Users</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <i class="bi bi-plus-lg me-1"></i> Add User
    </button>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Password</th>
                        <th>Expiration</th>
                        <th>Speed</th>
                        <th>Download</th>
                        <th>Upload</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)): ?>
                        <tr><td colspan="8" class="text-center text-muted">No users found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td><?= htmlspecialchars($u['username']) ?></td>
                                <td><?= htmlspecialchars($u['password'] ?? '—') ?></td>
                                <td><?= htmlspecialchars($u['expiration'] ?? '—') ?></td>
                                <td><span class="badge bg-primary"><?= htmlspecialchars($u['speed'] ?? '—') ?></span></td>
                                <td><?= $u['download'] ?> MB</td>
                                <td><?= $u['upload'] ?> MB</td>
                                <td>
                                    <?php if ($u['status'] === 'online'): ?>
                                        <span class="badge bg-success">🟢 Online</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">🔴 Offline</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-sm"
                                       href="index.php?action=user.destroy&user=<?= urlencode($u['username']) ?>"
                                       onclick="return confirm('Delete this user?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="index.php?action=user.store">
                <div class="modal-header">
                    <h5 class="modal-title">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="Phone Number" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="text" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Expiration Date & Time</label>
                        <input type="datetime-local" name="expiration" class="form-control" placeholder="Expiration Date & Time" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Speed</label>
                        <select name="speed" class="form-select" required>
                            <option value="" disabled selected>Select Speed</option>
                            <?php foreach ($speeds as $s): ?>
                                <option value="<?= htmlspecialchars($s['value']) ?>">
                                    <?= htmlspecialchars($s['label']) ?> (<?= htmlspecialchars($s['value']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create User</button>
                </div>
            </form>
        </div>
    </div>
</div>
