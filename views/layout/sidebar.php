<?php $currentPage = $page ?? ''; ?>

<nav class="sidebar bg-dark text-white p-3 d-flex flex-column">
    <h5 class="mb-4 px-2"><?= APP_NAME ?></h5>

    <ul class="nav flex-column flex-grow-1">
        <li class="nav-item">
            <a class="nav-link text-white <?= $currentPage === 'dashboard' ? 'active' : '' ?>" href="index.php?page=dashboard">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $currentPage === 'users' ? 'active' : '' ?>" href="index.php?page=users">
                <i class="bi bi-people me-2"></i> Users
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $currentPage === 'active-users' ? 'active' : '' ?>" href="index.php?page=active-users">
                <i class="bi bi-wifi me-2"></i> Active Users
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $currentPage === 'payments' ? 'active' : '' ?>" href="index.php?page=payments">
                <i class="bi bi-credit-card me-2"></i> Payments
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $currentPage === 'failed-payments' ? 'active' : '' ?>" href="index.php?page=failed-payments">
                <i class="bi bi-x-circle me-2"></i> Failed Payments
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $currentPage === 'logs' ? 'active' : '' ?>" href="index.php?page=logs">
                <i class="bi bi-journal-text me-2"></i> Logs
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $currentPage === 'routers' ? 'active' : '' ?>" href="index.php?page=routers">
                <i class="bi bi-router me-2"></i> Routers
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= $currentPage === 'admins' ? 'active' : '' ?>" href="index.php?page=admins">
                <i class="bi bi-shield-lock me-2"></i> Admins
            </a>
        </li>
    </ul>

    <div class="mt-auto pt-3 border-top border-secondary">
        <span class="text-secondary small d-block mb-2 px-2"><?= htmlspecialchars(auth_user()['username'] ?? '') ?></span>
        <a class="nav-link text-white" href="index.php?action=logout">
            <i class="bi bi-box-arrow-left me-2"></i> Logout
        </a>
    </div>
</nav>

<main class="main-content flex-grow-1 p-4">

<?php $flash = flash_get(); ?>
<?php if ($flash): ?>
    <div class="alert alert-<?= $flash['type'] ?> alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($flash['message']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
