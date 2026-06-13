<h4 class="mb-4">Failed Payments</h4>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Phone</th>
                        <th>Amount</th>
                        <th>Router</th>
                        <th>Reason</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($failedPayments)): ?>
                        <tr><td colspan="6" class="text-center text-muted">No failed payments.</td></tr>
                    <?php else: ?>
                        <?php foreach ($failedPayments as $f): ?>
                            <tr>
                                <td><?= $f['id'] ?></td>
                                <td><?= htmlspecialchars($f['phone']) ?></td>
                                <td>$<?= number_format($f['amount'], 2) ?></td>
                                <td><?= htmlspecialchars($f['router'] ?? '—') ?></td>
                                <td><span class="badge bg-warning text-dark"><?= htmlspecialchars($f['reason']) ?></span></td>
                                <td><?= htmlspecialchars($f['created_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
