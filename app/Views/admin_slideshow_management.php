<?php
// Get slideshow model
$slideshowModel = new \App\Models\HeroSlideshowModel();
$slideshows = $slideshowModel->getAllSlideshows();
?>

<style>
.slideshow-management {
    margin-top: 2rem;
}

.slideshow-item {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1rem;
    display: flex;
    gap: 1rem;
    align-items: center;
}

.slideshow-item img {
    width: 120px;
    height: 80px;
    object-fit: cover;
    border-radius: 4px;
}

.slideshow-item-content {
    flex: 1;
}

.slideshow-item-title {
    font-weight: 600;
    color: #333;
    margin-bottom: 0.25rem;
}

.slideshow-item-desc {
    font-size: 0.875rem;
    color: #666;
    margin-bottom: 0.5rem;
}

.slideshow-item-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.slideshow-item-actions button {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
}

.slideshow-upload-form {
    background: #f0f7ff;
    border: 2px dashed #0066cc;
    border-radius: 8px;
    padding: 2rem;
    text-align: center;
    margin-bottom: 2rem;
    cursor: pointer;
    transition: all 0.3s;
}

.slideshow-upload-form:hover {
    border-color: #0052a3;
    background: #e6f2ff;
}

.slideshow-upload-form input[type="file"] {
    display: none;
}

.drag-handle {
    cursor: move;
    color: #999;
    font-size: 1.25rem;
    margin-right: 0.5rem;
}

.slideshow-list {
    margin-top: 1.5rem;
}

.slideshow-empty {
    text-align: center;
    padding: 2rem;
    color: #999;
    font-style: italic;
}
</style>

<div class="slideshow-management">
    <h5 class="mb-4"><i class="bi bi-images"></i> Hero Slideshow Management</h5>
    
    <!-- Upload Form -->
    <div class="slideshow-upload-form" onclick="document.getElementById('slideshow_image').click();">
        <i class="bi bi-cloud-arrow-up" style="font-size: 2rem; color: #0066cc;"></i>
        <p class="mt-2 mb-0"><strong>Klik untuk upload atau drag image ke sini</strong></p>
        <small class="text-muted">Format: JPG, PNG | Max: 5MB</small>
        <input type="file" id="slideshow_image" accept="image/*" onchange="handleSlideshowImageUpload(event)">
    </div>

    <!-- Upload Form (Text Fields) -->
    <div class="card mb-3">
        <div class="card-body">
            <div class="mb-3">
                <label for="slideshow_title" class="form-label">Judul Slide (Opsional)</label>
                <input type="text" class="form-control" id="slideshow_title" placeholder="Contoh: Pantai Indah Karimunjawa">
            </div>
            <div class="mb-3">
                <label for="slideshow_desc" class="form-label">Deskripsi (Opsional)</label>
                <textarea class="form-control" id="slideshow_desc" rows="2" placeholder="Deskripsi untuk slide ini..."></textarea>
            </div>
            <button type="button" class="btn btn-primary w-100" onclick="uploadSlideshow()" id="upload-btn" disabled>
                <i class="bi bi-upload"></i> Upload Slideshow
            </button>
        </div>
    </div>

    <!-- List of Slideshows -->
    <div class="slideshow-list">
        <h6 class="mb-3">Slide yang Ada (<?= count($slideshows) ?>)</h6>
        
        <?php if (empty($slideshows)): ?>
            <div class="slideshow-empty">
                Belum ada slideshow. Silakan upload gambar di atas.
            </div>
        <?php else: ?>
            <div id="slideshows-container">
                <?php foreach ($slideshows as $slide): ?>
                    <div class="slideshow-item" data-id="<?= $slide['id'] ?>">
                        <span class="drag-handle" title="Drag untuk ubah urutan">
                            <i class="bi bi-grip-vertical"></i>
                        </span>
                        <img src="<?= base_url($slide['image_url']) ?>" alt="<?= $slide['title'] ?>">
                        <div class="slideshow-item-content">
                            <div class="slideshow-item-title"><?= $slide['title'] ?: 'Untitled' ?></div>
                            <?php if ($slide['description']): ?>
                                <div class="slideshow-item-desc"><?= $slide['description'] ?></div>
                            <?php endif; ?>
                            <div class="slideshow-item-meta">
                                <small class="text-muted">Urutan: <?= $slide['sort_order'] ?> | 
                                Status: <span class="badge <?= $slide['is_active'] ? 'bg-success' : 'bg-secondary' ?>">
                                    <?= $slide['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                                </span></small>
                            </div>
                        </div>
                        <div class="slideshow-item-actions">
                            <button type="button" class="btn btn-sm btn-outline-warning" onclick="editSlideshow(<?= $slide['id'] ?>)" title="Edit">
                                <i class="bi bi-pencil"></i> Edit
                            </button>
                            <button type="button" class="btn btn-sm <?= $slide['is_active'] ? 'btn-outline-danger' : 'btn-outline-success' ?>" 
                                onclick="toggleSlideshowActive(<?= $slide['id'] ?>)" title="Toggle">
                                <i class="bi <?= $slide['is_active'] ? 'bi-eye-slash' : 'bi-eye' ?>"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteSlideshowItem(<?= $slide['id'] ?>)" title="Delete">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editSlideshowModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Slideshow</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="edit_slideshow_id">
                <div class="mb-3">
                    <label for="edit_slideshow_image" class="form-label">Gambar</label>
                    <div id="edit_slideshow_preview" style="margin-bottom: 1rem;">
                        <img id="current-image" src="" alt="" style="max-width: 100%; max-height: 200px; border-radius: 4px;">
                    </div>
                    <input type="file" class="form-control" id="edit_slideshow_image" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="edit_slideshow_title" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="edit_slideshow_title">
                </div>
                <div class="mb-3">
                    <label for="edit_slideshow_desc" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="edit_slideshow_desc" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveEditSlideshow()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
let selectedImage = null;

function handleSlideshowImageUpload(event) {
    const file = event.target.files[0];
    if (file) {
        selectedImage = file;
        document.getElementById('upload-btn').disabled = false;
        console.log('Image selected:', file.name);
    }
}

function uploadSlideshow() {
    if (!selectedImage) {
        alert('Silakan pilih gambar terlebih dahulu');
        return;
    }

    const formData = new FormData();
    formData.append('slideshow_image', selectedImage);
    formData.append('title', document.getElementById('slideshow_title').value);
    formData.append('description', document.getElementById('slideshow_desc').value);

    fetch('<?= base_url('admin/save_slideshow') ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Slideshow berhasil ditambahkan');
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan');
    });
}

function editSlideshow(id) {
    fetch('<?= base_url('admin/get_slideshows') ?>')
        .then(response => response.json())
        .then(slideshows => {
            const slideshow = slideshows.find(s => s.id == id);
            if (slideshow) {
                document.getElementById('edit_slideshow_id').value = id;
                document.getElementById('edit_slideshow_title').value = slideshow.title || '';
                document.getElementById('edit_slideshow_desc').value = slideshow.description || '';
                document.getElementById('current-image').src = '<?= base_url('') ?>' + slideshow.image_url;
                new bootstrap.Modal(document.getElementById('editSlideshowModal')).show();
            }
        });
}

function saveEditSlideshow() {
    const id = document.getElementById('edit_slideshow_id').value;
    const formData = new FormData();
    
    formData.append('id', id);
    formData.append('title', document.getElementById('edit_slideshow_title').value);
    formData.append('description', document.getElementById('edit_slideshow_desc').value);
    
    const newImage = document.getElementById('edit_slideshow_image').files[0];
    if (newImage) {
        formData.append('slideshow_image', newImage);
    }

    fetch('<?= base_url('admin/update_slideshow') ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Slideshow berhasil diperbarui');
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan');
    });
}

function deleteSlideshowItem(id) {
    if (!confirm('Yakin ingin menghapus slideshow ini?')) return;

    fetch('<?= base_url('admin/delete_slideshow') ?>/' + id, {
        method: 'GET'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Slideshow berhasil dihapus');
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    });
}

function toggleSlideshowActive(id) {
    fetch('<?= base_url('admin/toggle_slideshow_active') ?>/' + id, {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}

// Sortable list (if using sortable library)
// Initialize if Sortable.js is available
if (typeof Sortable !== 'undefined') {
    const container = document.getElementById('slideshows-container');
    if (container) {
        new Sortable(container, {
            animation: 150,
            ghostClass: 'bg-light',
            handle: '.drag-handle',
            onEnd: function(evt) {
                const order = [];
                document.querySelectorAll('.slideshow-item').forEach((item, index) => {
                    order.push({id: item.dataset.id, order: index});
                });
                
                fetch('<?= base_url('admin/update_slideshow_order') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(order)
                });
            }
        });
    }
}
</script>
