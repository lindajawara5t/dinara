<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    protected $table = 'blog_posts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'category',
        'status',
        'views',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $dateFormat = 'datetime';

    // Validasi
    protected $validationRules = [
        'title' => 'required|string|max_length[255]',
        'slug' => 'required|string|max_length[255]|is_unique[blog_posts.slug,id,{id}]',
        'excerpt' => 'string|max_length[500]',
        'content' => 'string',
        'category' => 'required|in_list[wisata,tips,berita]',
        'status' => 'in_list[published,draft]',
    ];

    protected $validationMessages = [
        'title' => [
            'required' => 'Judul blog harus diisi',
            'max_length' => 'Judul maksimal 255 karakter',
        ],
        'slug' => [
            'required' => 'Slug harus diisi',
            'is_unique' => 'Slug sudah digunakan',
        ],
        'category' => [
            'required' => 'Kategori harus dipilih',
        ],
    ];

    /**
     * Generate slug dari title
     */
    public function generateSlug($title)
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        return $slug;
    }

    /**
     * Get published posts
     */
    public function getPublished($limit = null)
    {
        $query = $this->where('status', 'published')->orderBy('created_at', 'DESC');
        if ($limit) {
            $query->limit($limit);
        }
        return $query->findAll();
    }

    /**
     * Get posts by category
     */
    public function getByCategory($category, $limit = null)
    {
        $query = $this->where('category', $category)->where('status', 'published')->orderBy('created_at', 'DESC');
        if ($limit) {
            $query->limit($limit);
        }
        return $query->findAll();
    }

    /**
     * Get post by slug
     */
    public function getBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    /**
     * Increment views
     */
    public function incrementViews($id)
    {
        return $this->update($id, ['views' => $this->selectCount('id')->where('id', $id)->get()->getRow()->id + 1]);
    }

    /**
     * Search posts
     */
    public function search($keyword)
    {
        return $this->where('status', 'published')
            ->groupStart()
                ->like('title', $keyword)
                ->orLike('excerpt', $keyword)
                ->orLike('content', $keyword)
            ->groupEnd()
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }
}
