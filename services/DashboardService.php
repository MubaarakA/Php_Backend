<?php

require_once __DIR__ . '/../repositories/RadiusUserRepository.php';
require_once __DIR__ . '/../repositories/ActiveUserRepository.php';
require_once __DIR__ . '/../repositories/PaymentRepository.php';
require_once __DIR__ . '/../repositories/FailedPaymentRepository.php';
require_once __DIR__ . '/../repositories/AuthLogRepository.php';

class DashboardService
{
    public function getStats(): array
    {
        $payments = new PaymentRepository();
        $users = new RadiusUserRepository();
        $active = new ActiveUserRepository();
        $failed = new FailedPaymentRepository();
        $logs = new AuthLogRepository();

        return [
            'total_revenue' => $payments->totalRevenue(),
            'today_revenue' => $payments->todayRevenue(),
            'total_users' => $users->count(),
            'active_users' => $active->count(),
            'failed_payments' => $failed->count(),
            'login_failures' => $logs->countRejections(),
        ];
    }
}
