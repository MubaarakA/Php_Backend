<h4 class="mb-4">Payments<?= isset($_GET['filter']) && $_GET['filter'] === 'today' ? ' — Today' : '' ?></h4>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Phone</th>
                        <th>Amount</th>
                        <th>Router</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($payments)): ?>
                        <tr><td colspan="5" class="text-center text-muted">No payments yet.</td></tr>
                    <?php else: ?>
                        <?php foreach ($payments as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['transaction_id']) ?></td>
                                <td><?= htmlspecialchars($p['phone']) ?></td>
                                <td>$<?= number_format($p['amount'], 2) ?></td>
                                <td><?= htmlspecialchars($p['router']) ?></td>
                                <td><?= htmlspecialchars($p['created_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
