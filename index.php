<?php

require_once __DIR__ . '/bootstrap.php';

$action = $_GET['action'] ?? null;
$page = $_GET['page'] ?? 'dashboard';

if ($action) {
    switch ($action) {
        case 'login':
            require_once __DIR__ . '/controllers/AuthController.php';
            (new AuthController())->login();
            break;
        case 'logout':
            auth_require();
            require_once __DIR__ . '/controllers/AuthController.php';
            (new AuthController())->logout();
            break;
        case 'user.store':
            auth_require();
            require_once __DIR__ . '/controllers/UserController.php';
            (new UserController())->store();
            break;
        case 'user.destroy':
            auth_require();
            require_once __DIR__ . '/controllers/UserController.php';
            (new UserController())->destroy();
            break;
        case 'router.store':
            auth_require();
            require_once __DIR__ . '/controllers/RouterController.php';
            (new RouterController())->store();
            break;
        case 'router.update':
            auth_require();
            require_once __DIR__ . '/controllers/RouterController.php';
            (new RouterController())->update();
            break;
        case 'router.destroy':
            auth_require();
            require_once __DIR__ . '/controllers/RouterController.php';
            (new RouterController())->destroy();
            break;
        case 'admin.store':
            auth_require();
            require_once __DIR__ . '/controllers/AdminController.php';
            (new AdminController())->store();
            break;
        case 'admin.destroy':
            auth_require();
            require_once __DIR__ . '/controllers/AdminController.php';
            (new AdminController())->destroy();
            break;
        default:
            header('Location: index.php?page=dashboard');
            exit;
    }
    exit;
}

if ($page === 'login') {
    require_once __DIR__ . '/controllers/AuthController.php';
    (new AuthController())->showLogin();
    exit;
}

auth_require();

switch ($page) {
    case 'dashboard':
        require_once __DIR__ . '/controllers/DashboardController.php';
        (new DashboardController())->index();
        break;
    case 'users':
        require_once __DIR__ . '/controllers/UserController.php';
        (new UserController())->index();
        break;
    case 'active-users':
        require_once __DIR__ . '/controllers/ActiveUserController.php';
        (new ActiveUserController())->index();
        break;
    case 'payments':
        require_once __DIR__ . '/controllers/PaymentController.php';
        (new PaymentController())->index();
        break;
    case 'failed-payments':
        require_once __DIR__ . '/controllers/FailedPaymentController.php';
        (new FailedPaymentController())->index();
        break;
    case 'logs':
        require_once __DIR__ . '/controllers/LogController.php';
        (new LogController())->index();
        break;
    case 'routers':
        require_once __DIR__ . '/controllers/RouterController.php';
        (new RouterController())->index();
        break;
    case 'admins':
        require_once __DIR__ . '/controllers/AdminController.php';
        (new AdminController())->index();
        break;
    default:
        header('Location: index.php?page=dashboard');
        exit;
}
