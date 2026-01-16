<?php

namespace App\Models;

use CodeIgniter\Model;

class KonsumsiModel extends Model
{
    protected $table = 'konsumsi';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['name', 'description', 'price_per_person', 'meal_type', 'is_active'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getActive()
    {
        return $this->where('is_active', 1)->findAll();
    }
}
