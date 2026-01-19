<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'booking_code', 'customer_name', 'customer_email', 'customer_phone', 'customer_address',
        'city_origin', 'travel_date', 'duration_day', 'num_people', 'num_children',
        'tour_laut_selected', 'tour_darat_selected', 'hotel_selected', 'facilities_selected',
        'guide_type', 'transport_type', 'flight_type',
        'total_price', 'total_net_cost', 'estimated_margin',
        'status', 'payment_status', 'notes', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Get booking with payment details
    public function getBookingWithPayments($booking_id)
    {
        $booking = $this->find($booking_id);
        if ($booking) {
            $paymentModel = new PaymentModel();
            $booking['payments'] = $paymentModel->where('booking_id', $booking_id)->findAll();
            
            $itemModel = new BookingItemModel();
            $booking['items'] = $itemModel->where('booking_id', $booking_id)->findAll();
        }
        return $booking;
    }

    // Get all bookings with summary
    public function getAllWithSummary()
    {
        return $this->select('bookings.*, 
            SUM(CASE WHEN payments.status = "confirmed" THEN payments.amount ELSE 0 END) as paid_amount,
            COUNT(payments.id) as payment_count')
            ->join('payments', 'payments.booking_id = bookings.id', 'left')
            ->groupBy('bookings.id')
            ->orderBy('bookings.created_at', 'DESC')
            ->findAll();
    }
}
