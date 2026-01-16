<?php

namespace App\Models;

use CodeIgniter\Model;

class ItineraryModel extends Model
{
    protected $table = 'itinerary';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['duration_day', 'day_number', 'title', 'description', 'time_start', 'time_end', 'location', 'icon', 'is_active'];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getByDuration($duration)
    {
        return $this->where('duration_day', $duration)
                    ->where('is_active', 1)
                    ->orderBy('day_number, time_start', 'ASC')
                    ->findAll();
    }

    public function getActive()
    {
        return $this->where('is_active', 1)
                    ->orderBy('duration_day, day_number, time_start', 'ASC')
                    ->findAll();
    }
}
