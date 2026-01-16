<?php

namespace App\Models;

use CodeIgniter\Model;

class HeroSlideshowModel extends Model
{
    protected $table            = 'hero_slideshow';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'description', 'image_url', 'sort_order', 'is_active'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Get all active slides ordered by sort_order
    public function getActiveSlideshows()
    {
        return $this->where('is_active', 1)
                    ->orderBy('sort_order', 'ASC')
                    ->findAll();
    }

    // Get all slides (including inactive) for admin
    public function getAllSlideshows()
    {
        return $this->orderBy('sort_order', 'ASC')->findAll();
    }

    // Update sort order for multiple slides
    public function updateSortOrder($slideshows)
    {
        foreach ($slideshows as $index => $slideshow) {
            $this->update($slideshow['id'], ['sort_order' => $index]);
        }
    }

    // Toggle active status
    public function toggleActive($id)
    {
        $current = $this->find($id);
        if ($current) {
            return $this->update($id, ['is_active' => !$current['is_active']]);
        }
        return false;
    }
}
