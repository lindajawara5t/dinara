<?php

namespace App\Models;

use CodeIgniter\Model;

class WisataLautModel extends Model
{
    protected $table = 'wisata_laut';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = false;
    protected $allowedFields = ['name', 'description', 'image_url', 'location', 'lat', 'lng', 'price_publish', 'price_net', 'is_active'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getActive()
    {
        return $this->where('is_active', 1)->findAll();
    }
}
