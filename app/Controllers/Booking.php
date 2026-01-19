<?php

namespace App\Controllers;

use App\Models\BookingModel;
use App\Models\PaymentModel;

class Booking extends BaseController
{
    public function confirmation($bookingId = null)
    {
        if (!$bookingId) {
            return redirect()->to(base_url('/'));
        }

        $bookingModel = new BookingModel();
        $booking = $bookingModel->getBookingWithPayments($bookingId);

        if (!$booking) {
            return redirect()->to(base_url('/'));
        }

        $data = [
            'title' => 'Konfirmasi Booking',
            'booking' => $booking
        ];

        return view('booking_confirmation', $data);
    }
}
