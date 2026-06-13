<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0">Routers</h4>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRouterModal">
        <i class="bi bi-plus-lg me-1"></i> Add Router
    </button>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Router</th>
                        <th>IP</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($routers)): ?>
                        <tr><td colspan="4" class="text-center text-muted">No routers configured.</td></tr>
                    <?php else: ?>
                        <?php foreach ($routers as $r): ?>
                            <tr>
                                <td><?= htmlspecialchars($r['router']) ?></td>
                                <td><?= htmlspecialchars($r['ip']) ?></td>
                                <td><?= htmlspecialchars($r['name']) ?></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editRouter<?= $r['id'] ?>">Edit</button>
                                    <a class="btn btn-sm btn-danger"
                                       href="index.php?action=router.destroy&id=<?= $r['id'] ?>"
                                       onclick="return confirm('Delete this router?')">Delete</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="editRouter<?= $r['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="index.php?action=router.update">
                                            <input type="hidden" name="id" value="<?= $r['id'] ?>">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Router</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Router ID</label>
                                                    <input type="text" name="router" class="form-control" value="<?= htmlspecialchars($r['router']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">IP</label>
                                                    <input type="text" name="ip" class="form-control" value="<?= htmlspecialchars($r['ip']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Name</label>
                                                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($r['name']) ?>" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="addRouterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="index.php?action=router.store">
                <div class="modal-header">
                    <h5 class="modal-title">Add Router</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Router ID</label>
                        <input type="text" name="router" class="form-control" placeholder="router_a" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">IP</label>
                        <input type="text" name="ip" class="form-control" placeholder="192.168.1.1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Supermarket" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Router</button>
                </div>
            </form>
        </div>
    </div>
</div>
