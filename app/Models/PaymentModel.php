<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $table = 'payments';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'booking_id', 'payment_code', 'amount', 'payment_method', 'payment_date', 'due_date',
        'status', 'bank_name', 'bank_account', 'account_holder', 'notes', 'evidence_url', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Get pending payments
    public function getPendingPayments()
    {
        return $this->where('status', 'pending')
            ->where('due_date <=', date('Y-m-d'))
            ->findAll();
    }

    // Get total paid for booking
    public function getTotalPaidByBooking($booking_id)
    {
        $result = $this->selectSum('amount')
            ->where('booking_id', $booking_id)
            ->where('status', 'confirmed')
            ->first();
        
        return $result['amount'] ?? 0;
    }
}
