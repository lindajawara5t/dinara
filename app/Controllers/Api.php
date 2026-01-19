<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\BookingItemModel;
use App\Models\PaymentModel;
use App\Models\WisataLautModel;
use App\Models\WisataDaratModel;

class Api extends BaseController
{
    public function submitBooking()
    {
        try {
            // Get JSON data
            $json = $this->request->getJSON(true);

            // Validasi data - hanya nama dan email yang wajib
            if (empty($json['customer_name']) || empty($json['customer_email'])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Nama dan email harus diisi!'
                ]);
            }

            // Jika total_price 0 atau tidak ada, gunakan nilai default
            $totalPrice = !empty($json['total_price']) ? $json['total_price'] : 0;

        // Generate booking code
        $bookingCode = 'BK-' . strtoupper(substr(md5(time()), 0, 8));

        // Prepare booking data
        $bookingData = [
            'booking_code' => $bookingCode,
            'customer_name' => $json['customer_name'],
            'customer_email' => $json['customer_email'],
            'customer_phone' => $json['customer_phone'] ?? '',
            'customer_address' => $json['customer_address'] ?? '',
            'city_origin' => $json['city_origin'] ?? '',
            'travel_date' => $json['travel_date'] ?? null,
            'duration_day' => $json['duration_day'] ?? 3,
            'num_people' => $json['num_people'] ?? 1,
            'num_children' => $json['num_children'] ?? 0,
            'tour_laut_selected' => $json['tour_laut_selected'] ?? '[]',
            'tour_darat_selected' => $json['tour_darat_selected'] ?? '[]',
            'hotel_selected' => $json['hotel_selected'] ?? '',
            'facilities_selected' => $json['facilities_selected'] ?? '[]',
            'guide_type' => $json['guide_type'] ?? '',
            'transport_type' => $json['transport_type'] ?? '',
            'flight_type' => $json['flight_type'] ?? '',
            'total_price' => $totalPrice,
            'total_net_cost' => $json['total_net_cost'] ?? 0,
            'estimated_margin' => $json['estimated_margin'] ?? 0,
            'notes' => $json['notes'] ?? '',
            'status' => 'pending',
            'payment_status' => 'unpaid'
        ];

        // Save booking
        $bookingModel = new BookingModel();
        $bookingId = $bookingModel->insert($bookingData);

        if (!$bookingId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menyimpan booking'
            ]);
        }

        // Save booking items - tour laut
        $this->saveBookingItems($bookingId, 'tour_laut', $json['tour_laut_selected'] ?? '[]');

        // Save booking items - tour darat
        $this->saveBookingItems($bookingId, 'tour_darat', $json['tour_darat_selected'] ?? '[]');

        // Save booking items - hotel
        if (!empty($json['hotel_selected'])) {
            $bookingItemModel = new BookingItemModel();
            $bookingItemModel->insert([
                'booking_id' => $bookingId,
                'item_type' => 'hotel',
                'item_name' => $json['hotel_selected'],
                'quantity' => $json['num_people'] ?? 1,
                'price_total' => 0
            ]);
        }

        // Create initial payment record (invoice)
        $paymentModel = new PaymentModel();
        $paymentCode = 'PAY-' . strtoupper(substr(md5(time()), 0, 8));
        $paymentModel->insert([
            'booking_id' => $bookingId,
            'payment_code' => $paymentCode,
            'amount' => $json['total_price'] ?? 0,
            'payment_method' => 'transfer',
            'due_date' => date('Y-m-d', strtotime('+7 days')),
            'status' => 'pending',
            'bank_name' => 'BCA',
            'bank_account' => '123456789',
            'account_holder' => 'PT Smart Travel'
        ]);

            // Send email notification (optional)
            $this->sendBookingEmail($json['customer_email'], $bookingCode, $bookingData);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Booking berhasil dibuat',
                'booking_id' => $bookingId,
                'booking_code' => $bookingCode
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    private function saveBookingItems($bookingId, $itemType, $selectedJson)
    {
        $selected = json_decode($selectedJson, true);
        if (!is_array($selected) || empty($selected)) {
            return;
        }

        $model = ($itemType === 'tour_laut') ? new WisataLautModel() : new WisataDaratModel();
        $bookingItemModel = new BookingItemModel();

        foreach ($selected as $index) {
            $item = $model->find($index);
            if ($item) {
                $bookingItemModel->insert([
                    'booking_id' => $bookingId,
                    'item_type' => $itemType,
                    'item_id' => $item['id'],
                    'item_name' => $item['name'],
                    'quantity' => 1,
                    'price_unit' => $item['price_publish'] ?? 0,
                    'price_total' => $item['price_publish'] ?? 0
                ]);
            }
        }
    }

    private function sendBookingEmail($email, $bookingCode, $bookingData)
    {
        // TODO: Implement email sending
        // For now, just return silently
        return true;
    }
}
