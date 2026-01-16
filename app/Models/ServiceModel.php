<?php namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table      = 'service_categories';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    // INI BAGIAN PENTINGNYA!
    // Kita harus daftarkan 'price_net' dan 'type' di sini agar bisa disimpan
    protected $allowedFields = [
        'name', 
        'type', 
        'description', 
        'long_description',
        'price_publish', 
        'price_net',
        'image_url'
    ];
}