<?php

namespace App\Controllers;

use App\Models\BlogModel;
use CodeIgniter\RESTful\ResourceController;

class Blog extends ResourceController
{
    protected $modelName = 'App\Models\BlogModel';
    protected $format = 'json';
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * Get latest published blog posts
     */
    public function index()
    {
        $limit = $this->request->getVar('limit') ?? 6;
        $posts = $this->model->getPublished($limit);
        return $this->respond($posts);
    }

    /**
     * Get single blog post by slug
     */
    public function detail($slug = null)
    {
        $post = $this->model->getBySlug($slug);
        
        if (!$post) {
            return $this->failNotFound('Post tidak ditemukan');
        }

        return $this->respond($post);
    }

    /**
     * Get posts by category
     */
    public function category($category = null)
    {
        $limit = $this->request->getVar('limit') ?? 6;
        $posts = $this->model->getByCategory($category, $limit);
        return $this->respond($posts);
    }

    /**
     * Search posts
     */
    public function search()
    {
        $keyword = $this->request->getVar('q');
        
        if (!$keyword) {
            return $this->fail('Keyword pencarian diperlukan', 400);
        }

        $posts = $this->model->search($keyword);
        return $this->respond($posts);
    }

    // ==================== ADMIN METHODS ====================

    /**
     * Get all posts (admin)
     */
    public function all()
    {
        $posts = $this->model->orderBy('created_at', 'DESC')->findAll();
        return $this->respond($posts);
    }

    /**
     * Create new blog post (admin)
     */
    public function create()
    {
        $data = $this->request->getPost();

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = $this->model->generateSlug($data['title']);
        }

        // Handle file upload
        $image = $this->request->getFile('featured_image');
        if ($image && $image->isValid()) {
            $newName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/blog', $newName);
            $data['featured_image'] = $newName;
        }

        if ($this->model->save($data)) {
            return $this->respondCreated(['id' => $this->model->getInsertID()]);
        } else {
            return $this->fail($this->model->errors(), 400);
        }
    }

    /**
     * Update blog post (admin)
     */
    public function update($id = null)
    {
        $data = $this->request->getPost();

        // Generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = $this->model->generateSlug($data['title']);
        }

        // Handle file upload
        $image = $this->request->getFile('featured_image');
        if ($image && $image->isValid()) {
            // Delete old image
            $post = $this->model->find($id);
            if ($post && !empty($post['featured_image'])) {
                $oldPath = FCPATH . 'uploads/blog/' . $post['featured_image'];
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Upload new image
            $newName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/blog', $newName);
            $data['featured_image'] = $newName;
        }

        $data['id'] = $id;

        if ($this->model->save($data)) {
            return $this->respond(['message' => 'Post updated successfully']);
        } else {
            return $this->fail($this->model->errors(), 400);
        }
    }

    /**
     * Delete blog post (admin)
     */
    public function delete($id = null)
    {
        $post = $this->model->find($id);
        
        if (!$post) {
            return $this->failNotFound('Post tidak ditemukan');
        }

        // Delete image
        if (!empty($post['featured_image'])) {
            $imagePath = FCPATH . 'uploads/blog/' . $post['featured_image'];
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($this->model->delete($id)) {
            return $this->respondDeleted(['message' => 'Post deleted successfully']);
        } else {
            return $this->fail('Gagal menghapus post', 400);
        }
    }
}
