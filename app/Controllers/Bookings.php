<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\PaymentModel;
use App\Models\BookingItemModel;

class Bookings extends BaseController
{
    public function index()
    {
        $bookingModel = new BookingModel();
        $db = \Config\Database::connect();

        // Get all bookings
        $allBookings = $bookingModel->getAllWithSummary();
        
        // Count pending bookings
        $pendingCount = $db->table('bookings')->where('status', 'pending')->countAllResults();

        $data = [
            'title' => 'Manajemen Booking',
            'bookings' => $allBookings,
            'pending_count' => $pendingCount,
            'total_bookings' => count($allBookings)
        ];

        return view('admin_bookings', $data);
    }

    public function detail($bookingId)
    {
        $bookingModel = new BookingModel();
        $booking = $bookingModel->getBookingWithPayments($bookingId);

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan');
        }

        // Load related data
        $db = \Config\Database::connect();
        
        // Load wisata darat & laut details
        $wisataDaratModel = new \App\Models\WisataDaratModel();
        $wisataLautModel = new \App\Models\WisataLautModel();
        
        // Parse and load wisata darat
        $tourDarat = !empty($booking['tour_darat_selected']) ? json_decode($booking['tour_darat_selected'], true) : [];
        $booking['tour_darat_details'] = [];
        if (!empty($tourDarat)) {
            foreach ($tourDarat as $id) {
                $detail = $wisataDaratModel->find($id);
                if ($detail) {
                    $booking['tour_darat_details'][] = $detail;
                }
            }
        }

        // Parse and load wisata laut
        $tourLaut = !empty($booking['tour_laut_selected']) ? json_decode($booking['tour_laut_selected'], true) : [];
        $booking['tour_laut_details'] = [];
        if (!empty($tourLaut)) {
            foreach ($tourLaut as $id) {
                $detail = $wisataLautModel->find($id);
                if ($detail) {
                    $booking['tour_laut_details'][] = $detail;
                }
            }
        }

        // Parse and load facilities
        $facilities = !empty($booking['facilities_selected']) ? json_decode($booking['facilities_selected'], true) : [];
        $booking['facilities_details'] = [];
        if (!empty($facilities)) {
            $serviceModel = new \App\Models\ServiceModel();
            foreach ($facilities as $id) {
                $detail = $serviceModel->find($id);
                if ($detail) {
                    $booking['facilities_details'][] = $detail;
                }
            }
        }

        $data = [
            'title' => 'Detail Booking',
            'booking' => $booking
        ];

        return view('admin_booking_detail', $data);
    }

    public function updateStatus()
    {
        $json = $this->request->getJSON(true);
        $bookingId = $json['booking_id'] ?? null;
        $status = $json['status'] ?? null;

        if (!$bookingId || !$status) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Parameter tidak lengkap'
            ]);
        }

        $bookingModel = new BookingModel();
        $allowed = ['pending', 'confirmed', 'completed', 'cancelled'];

        if (!in_array($status, $allowed)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Status tidak valid'
            ]);
        }

        $updated = $bookingModel->update($bookingId, ['status' => $status]);

        return $this->response->setJSON([
            'success' => $updated ? true : false,
            'message' => $updated ? 'Status booking diperbarui' : 'Gagal update status'
        ]);
    }

    public function recordPayment($bookingId)
    {
        $json = $this->request->getJSON(true);
        $paymentModel = new PaymentModel();
        $bookingModel = new BookingModel();

        // Create new payment record
        $paymentCode = 'PAY-' . strtoupper(substr(md5(time()), 0, 8));
        $paymentModel->insert([
            'booking_id' => $bookingId,
            'payment_code' => $paymentCode,
            'amount' => $json['amount'],
            'payment_method' => $json['payment_method'] ?? 'transfer',
            'payment_date' => $json['payment_date'] ?? date('Y-m-d'),
            'status' => 'confirmed',
            'notes' => $json['notes'] ?? ''
        ]);

        // Update booking payment status
        $totalPaid = $paymentModel->getTotalPaidByBooking($bookingId);
        $booking = $bookingModel->find($bookingId);
        
        if ($totalPaid >= $booking['total_price']) {
            $bookingModel->update($bookingId, ['payment_status' => 'paid']);
        } elseif ($totalPaid > 0) {
            $bookingModel->update($bookingId, ['payment_status' => 'partial']);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Pembayaran tercatat',
            'payment_code' => $paymentCode
        ]);
    }
}
