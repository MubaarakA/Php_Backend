<h4 class="mb-4">Logs<?= isset($_GET['filter']) && $_GET['filter'] === 'reject' ? ' — Login Failures' : '' ?></h4>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Result</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($logs)): ?>
                        <tr><td colspan="3" class="text-center text-muted">No logs found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($logs as $log): ?>
                            <tr>
                                <td><?= htmlspecialchars($log['username']) ?></td>
                                <td>
                                    <?php if ($log['reply'] === 'Access-Accept'): ?>
                                        <span class="badge bg-success">Access-Accept</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger"><?= htmlspecialchars($log['reply']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($log['authdate']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
