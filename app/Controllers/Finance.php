<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\PaymentModel;

class Finance extends BaseController
{
    public function dashboard()
    {
        $db = \Config\Database::connect();
        $bookingModel = new BookingModel();
        $paymentModel = new PaymentModel();

        // Summary Statistics
        $totalBookings = $db->table('bookings')->countAllResults();
        $totalRevenue = $db->table('bookings')->selectSum('total_price')->get()->getRow()->total_price ?? 0;
        $totalNetCost = $db->table('bookings')->selectSum('total_net_cost')->get()->getRow()->total_net_cost ?? 0;
        $totalMargin = $totalRevenue - $totalNetCost;

        // Payment Statistics
        $paidAmount = $db->table('payments')
            ->where('status', 'confirmed')
            ->selectSum('amount')
            ->get()
            ->getRow()
            ->amount ?? 0;

        $pendingAmount = $totalRevenue - $paidAmount;

        // Monthly Revenue (last 12 months)
        $monthlyRevenue = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = date('Y-m', strtotime("-$i months"));
            $revenue = $db->table('bookings')
                ->where("DATE_FORMAT(created_at, '%Y-%m')", $month)
                ->selectSum('total_price')
                ->get()
                ->getRow()
                ->total_price ?? 0;
            
            $monthlyRevenue[] = [
                'month' => date('M Y', strtotime($month)),
                'revenue' => $revenue
            ];
        }

        // Payment Status Distribution
        $paymentStats = [
            'paid' => $db->table('bookings')->where('payment_status', 'paid')->countAllResults(),
            'partial' => $db->table('bookings')->where('payment_status', 'partial')->countAllResults(),
            'unpaid' => $db->table('bookings')->where('payment_status', 'unpaid')->countAllResults()
        ];

        // Recent Payments
        $recentPayments = $db->table('payments')
            ->select('payments.*, bookings.booking_code, bookings.customer_name')
            ->join('bookings', 'bookings.id = payments.booking_id')
            ->orderBy('payments.created_at', 'DESC')
            ->limit(10)
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Dashboard Keuangan',
            'total_bookings' => $totalBookings,
            'total_revenue' => $totalRevenue,
            'total_net_cost' => $totalNetCost,
            'total_margin' => $totalMargin,
            'margin_percent' => ($totalRevenue > 0) ? round(($totalMargin / $totalRevenue) * 100, 2) : 0,
            'paid_amount' => $paidAmount,
            'pending_amount' => $pendingAmount,
            'monthly_revenue' => $monthlyRevenue,
            'payment_stats' => $paymentStats,
            'recent_payments' => $recentPayments
        ];

        return view('admin/finance_dashboard', $data);
    }

    public function report($type = 'monthly')
    {
        $db = \Config\Database::connect();

        if ($type === 'monthly') {
            $report = $this->getMonthlyReport();
        } elseif ($type === 'customer') {
            $report = $this->getCustomerReport();
        } elseif ($type === 'payment') {
            $report = $this->getPaymentReport();
        } else {
            $report = [];
        }

        header('Content-Type: application/json');
        echo json_encode($report);
    }

    private function getMonthlyReport()
    {
        $db = \Config\Database::connect();
        
        $report = $db->table('bookings')
            ->select("
                DATE_FORMAT(created_at, '%Y-%m') as month,
                COUNT(*) as total_bookings,
                SUM(total_price) as total_revenue,
                SUM(total_net_cost) as total_cost,
                SUM(estimated_margin) as total_margin,
                SUM(num_people) as total_pax
            ")
            ->groupBy("DATE_FORMAT(created_at, '%Y-%m')")
            ->orderBy("DATE_FORMAT(created_at, '%Y-%m')", 'DESC')
            ->limit(12)
            ->get()
            ->getResultArray();

        return $report;
    }

    private function getCustomerReport()
    {
        $db = \Config\Database::connect();
        
        $report = $db->table('bookings')
            ->select('customer_name, customer_email, COUNT(*) as total_bookings, SUM(total_price) as total_spent')
            ->groupBy('customer_email')
            ->orderBy('total_spent', 'DESC')
            ->limit(50)
            ->get()
            ->getResultArray();

        return $report;
    }

    private function getPaymentReport()
    {
        $db = \Config\Database::connect();
        
        $report = $db->table('payments')
            ->select('
                DATE_FORMAT(payment_date, "%Y-%m-%d") as payment_date,
                payment_method,
                status,
                COUNT(*) as count,
                SUM(amount) as total_amount
            ')
            ->groupBy(['DATE_FORMAT(payment_date, "%Y-%m-%d")', 'payment_method', 'status'])
            ->orderBy('payment_date', 'DESC')
            ->get()
            ->getResultArray();

        return $report;
    }
}
