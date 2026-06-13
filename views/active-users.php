<h4 class="mb-4">🟢 Active Users</h4>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>IP</th>
                        <th>Started</th>
                        <th>Download</th>
                        <th>Upload</th>
                        <th>Time Left</th>
                        <th>Expiration</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($activeUsers)): ?>
                        <tr><td colspan="7" class="text-center text-muted">No active users.</td></tr>
                    <?php else: ?>
                        <?php foreach ($activeUsers as $a): ?>
                            <tr>
                                <td><?= htmlspecialchars($a['username']) ?></td>
                                <td><?= htmlspecialchars($a['framedipaddress'] ?? '—') ?></td>
                                <td><?= htmlspecialchars($a['acctstarttime'] ?? '—') ?></td>
                                <td><?= $a['download'] ?> MB</td>
                                <td><?= $a['upload'] ?> MB</td>
                                <td><?= htmlspecialchars($a['time_left']) ?></td>
                                <td><?= htmlspecialchars($a['expiration'] ?? '—') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
