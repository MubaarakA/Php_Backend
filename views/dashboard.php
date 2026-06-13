<h4 class="mb-4">Dashboard</h4>

<div class="row g-4">
    <div class="col-md-4">
        <a href="index.php?page=payments" class="text-decoration-none">
            <div class="card stat-card shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Total Revenue</div>
                    <div class="stat-value">$<?= number_format($stats['total_revenue'], 2) ?></div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="index.php?page=payments&filter=today" class="text-decoration-none">
            <div class="card stat-card shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Today Revenue</div>
                    <div class="stat-value">$<?= number_format($stats['today_revenue'], 2) ?></div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="index.php?page=users" class="text-decoration-none">
            <div class="card stat-card shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Total Users</div>
                    <div class="stat-value"><?= $stats['total_users'] ?></div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="index.php?page=active-users" class="text-decoration-none">
            <div class="card stat-card shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Active Users</div>
                    <div class="stat-value"><?= $stats['active_users'] ?></div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="index.php?page=failed-payments" class="text-decoration-none">
            <div class="card stat-card shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Failed Payments</div>
                    <div class="stat-value"><?= $stats['failed_payments'] ?></div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="index.php?page=logs&filter=reject" class="text-decoration-none">
            <div class="card stat-card shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small">Login Failures</div>
                    <div class="stat-value"><?= $stats['login_failures'] ?></div>
                </div>
            </div>
        </a>
    </div>
</div>
