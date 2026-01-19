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
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="slideshow_duration" class="form-label">Durasi Tampil (ms)</label>
                    <input type="number" class="form-control" id="slideshow_duration" value="5000" placeholder="5000">
                    <small class="text-muted">Berapa lama slide ditampilkan (ms). Default: 5000ms = 5 detik</small>
                </div>
                <div class="col-md-6">
                    <label for="slideshow_button_class" class="form-label">Style Tombol</label>
                    <select class="form-select" id="slideshow_button_class">
                        <option value="btn-warning">Kuning (Warning)</option>
                        <option value="btn-primary">Biru (Primary)</option>
                        <option value="btn-success">Hijau (Success)</option>
                        <option value="btn-danger">Merah (Danger)</option>
                        <option value="btn-info">Info (Cyan)</option>
                        <option value="btn-dark">Hitam (Dark)</option>
                    </select>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="slideshow_button_label" class="form-label">Label Tombol (Opsional)</label>
                <input type="text" class="form-control" id="slideshow_button_label" placeholder="Contoh: Lihat Paket, Booking Sekarang">
                <small class="text-muted">Kosongkan jika tidak ingin menampilkan tombol</small>
            </div>
            
            <div class="mb-3">
                <label for="slideshow_button_url" class="form-label">Link Tombol (Opsional)</label>
                <div style="display: flex; gap: 10px; margin-bottom: 10px;">
                    <select class="form-select" id="slideshow_button_url" style="flex: 1;">
                        <option value="">-- Pilih Link Terusan --</option>
                        <option value="/">🏠 Home (Beranda)</option>
                        <option value="/promo">🎉 Promo</option>
                        <option value="/kalkulator">🧮 Hitung Kalkulasi</option>
                        <option value="/destinasi">🗺️ Destinasi</option>
                        <option value="/hotel">🏨 Hotel</option>
                        <option value="/travel">✈️ Travel & Wisata</option>
                        <option value="/travel/karimunjawa">🏝️ Karimunjawa</option>
                        <option value="/blog">📰 Blog & Terbaru</option>
                        <option value="https://www.susiair.com/">✈️ Tiket Pesawat</option>
                        <option value="/estimasi">🚤 Estimasi Harga</option>
                        <option value="/contact">📞 Hubungi Kami</option>
                    </select>
                    <input type="text" class="form-control" id="slideshow_button_url_custom" placeholder="Atau masukkan custom URL..." style="flex: 0.8;">
                </div>
                <small class="text-muted">Pilih dari dropdown atau masukkan custom URL (https://... atau /path). Custom URL akan menimpa pilihan dropdown.</small>
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
                                <small class="text-muted">
                                    Urutan: <?= $slide['sort_order'] ?> | 
                                    Durasi: <?= $slide['duration'] ?? 5000 ?>ms | 
                                    Status: <span class="badge <?= $slide['is_active'] ? 'bg-success' : 'bg-secondary' ?>">
                                        <?= $slide['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                                    </span>
                                    <?php if (!empty($slide['button_label'])): ?>
                                        | <span class="badge bg-info"><i class="bi bi-link-45deg"></i> Ada Tombol</span>
                                    <?php endif; ?>
                                </small>
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
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="edit_slideshow_duration" class="form-label">Durasi (ms)</label>
                        <input type="number" class="form-control" id="edit_slideshow_duration" value="5000">
                    </div>
                    <div class="col-md-6">
                        <label for="edit_slideshow_button_class" class="form-label">Style Tombol</label>
                        <select class="form-select" id="edit_slideshow_button_class">
                            <option value="btn-warning">Kuning</option>
                            <option value="btn-primary">Biru</option>
                            <option value="btn-success">Hijau</option>
                            <option value="btn-danger">Merah</option>
                            <option value="btn-info">Info</option>
                            <option value="btn-dark">Hitam</option>
                        </select>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="edit_slideshow_button_label" class="form-label">Label Tombol</label>
                    <input type="text" class="form-control" id="edit_slideshow_button_label" placeholder="Kosongkan jika tidak ada tombol">
                </div>
                
                <div class="mb-3">
                    <label for="edit_slideshow_button_url" class="form-label">Link Tombol</label>
                    <div style="display: flex; gap: 10px; margin-bottom: 10px;">
                        <select class="form-select" id="edit_slideshow_button_url" style="flex: 1;">
                            <option value="">-- Pilih Link Terusan --</option>
                            <option value="/">🏠 Home (Beranda)</option>
                            <option value="/promo">🎉 Promo</option>
                            <option value="/kalkulator">🧮 Hitung Kalkulasi</option>
                            <option value="/destinasi">🗺️ Destinasi</option>
                            <option value="/hotel">🏨 Hotel</option>
                            <option value="/travel">✈️ Travel & Wisata</option>
                            <option value="/travel/karimunjawa">🏝️ Karimunjawa</option>
                            <option value="/blog">📰 Blog & Terbaru</option>
                            <option value="https://www.susiair.com/">✈️ Tiket Pesawat</option>
                            <option value="/estimasi">🚤 Estimasi Harga</option>
                            <option value="/contact">📞 Hubungi Kami</option>
                        </select>
                        <input type="text" class="form-control" id="edit_slideshow_button_url_custom" placeholder="Atau custom URL..." style="flex: 0.8;">
                    </div>
                    <small class="text-muted">Pilih dari dropdown atau masukkan custom URL. Custom URL akan menimpa pilihan dropdown.</small>
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

// Helper function untuk mengambil URL tombol (prioritas custom > dropdown)
function getButtonUrl(dropdownSelector, customSelector) {
    const customUrl = document.getElementById(customSelector).value.trim();
    if (customUrl) {
        return customUrl; // Custom URL memiliki prioritas
    }
    return document.getElementById(dropdownSelector).value;
}

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
    formData.append('duration', document.getElementById('slideshow_duration').value);
    formData.append('button_label', document.getElementById('slideshow_button_label').value);
    formData.append('button_url', getButtonUrl('slideshow_button_url', 'slideshow_button_url_custom'));
    formData.append('button_class', document.getElementById('slideshow_button_class').value);

    console.log('📤 Uploading slideshow with button_url:', getButtonUrl('slideshow_button_url', 'slideshow_button_url_custom'));

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
                document.getElementById('edit_slideshow_duration').value = slideshow.duration || 5000;
                document.getElementById('edit_slideshow_button_label').value = slideshow.button_label || '';
                
                // Set button_url dari database ke dropdown jika cocok, jika tidak ke custom field
                const buttonUrl = slideshow.button_url || '';
                const dropdownOptions = document.getElementById('edit_slideshow_button_url').options;
                let found = false;
                for (let i = 0; i < dropdownOptions.length; i++) {
                    if (dropdownOptions[i].value === buttonUrl) {
                        document.getElementById('edit_slideshow_button_url').value = buttonUrl;
                        document.getElementById('edit_slideshow_button_url_custom').value = '';
                        found = true;
                        break;
                    }
                }
                // Jika tidak ditemukan di dropdown, masukkan ke custom field
                if (!found) {
                    document.getElementById('edit_slideshow_button_url').value = '';
                    document.getElementById('edit_slideshow_button_url_custom').value = buttonUrl;
                }
                
                document.getElementById('edit_slideshow_button_class').value = slideshow.button_class || 'btn-warning';
                document.getElementById('current-image').src = '<?= base_url('/') ?>' + slideshow.image_url;
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
    formData.append('duration', document.getElementById('edit_slideshow_duration').value);
    formData.append('button_label', document.getElementById('edit_slideshow_button_label').value);
    formData.append('button_url', getButtonUrl('edit_slideshow_button_url', 'edit_slideshow_button_url_custom'));
    formData.append('button_class', document.getElementById('edit_slideshow_button_class').value);
    
    console.log('🔄 Updating slideshow with button_url:', getButtonUrl('edit_slideshow_button_url', 'edit_slideshow_button_url_custom'));
    
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

// Event listeners untuk auto-clear custom field saat dropdown dipilih
document.addEventListener('DOMContentLoaded', function() {
    const slideshowDropdown = document.getElementById('slideshow_button_url');
    const slideshowCustom = document.getElementById('slideshow_button_url_custom');
    const editDropdown = document.getElementById('edit_slideshow_button_url');
    const editCustom = document.getElementById('edit_slideshow_button_url_custom');
    
    if (slideshowDropdown && slideshowCustom) {
        slideshowDropdown.addEventListener('change', function() {
            if (this.value) {
                slideshowCustom.value = ''; // Clear custom jika dropdown dipilih
            }
        });
        slideshowCustom.addEventListener('input', function() {
            if (this.value) {
                slideshowDropdown.value = ''; // Clear dropdown jika custom diisi
            }
        });
    }
    
    if (editDropdown && editCustom) {
        editDropdown.addEventListener('change', function() {
            if (this.value) {
                editCustom.value = ''; // Clear custom jika dropdown dipilih
            }
        });
        editCustom.addEventListener('input', function() {
            if (this.value) {
                editDropdown.value = ''; // Clear dropdown jika custom diisi
            }
        });
    }
});
</script>
