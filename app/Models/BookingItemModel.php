<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingItemModel extends Model
{
    protected $table = 'booking_items';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'booking_id', 'item_type', 'item_id', 'item_name', 'quantity', 'price_unit', 'price_total', 'notes', 'created_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
}
