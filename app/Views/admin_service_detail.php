<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Detail - <?= $service['name'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f7f6; }
        .gallery-item { position: relative; overflow: hidden; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .gallery-item img { width: 100%; height: 120px; object-fit: cover; transition: 0.3s; }
        .gallery-item:hover img { transform: scale(1.05); }
        .btn-delete-img { position: absolute; top: 5px; right: 5px; background: rgba(220, 53, 69, 0.9); color: white; border: none; border-radius: 50%; width: 25px; height: 25px; font-size: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; }
    </style>
</head>
<body>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="/admin" class="btn btn-outline-secondary fw-bold"><i class="bi bi-arrow-left"></i> Kembali ke Dashboard</a>
            <h4 class="m-0 fw-bold text-primary">Kelola: <?= esc($service['name']) ?></h4>
        </div>

        <?php if(session()->getFlashdata('sukses')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> <?= session()->getFlashdata('sukses'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    alert(<?= json_encode(session()->getFlashdata('sukses')) ?>);
                });
            </script>
        <?php endif; ?>
        
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle"></i> <?= session()->getFlashdata('error'); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    alert(<?= json_encode(session()->getFlashdata('error')) ?>);
                });
            </script>
        <?php endif; ?>
        
        <div class="row">
            
            <div class="col-lg-7 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white fw-bold py-3"><i class="bi bi-file-text"></i> Detail Itinerary / Deskripsi Lengkap</div>
                    <div class="card-body">
                        <form action="/admin/update_long_desc" method="post">
                            <input type="hidden" name="id" value="<?= $service['id'] ?>">
                            <div class="mb-3">
                                <label class="small text-muted mb-1">Tulis detail lengkap perjalanan, fasilitas, atau jadwal kegiatan di sini:</label>
                                <textarea name="long_description" class="form-control" rows="15" placeholder="Contoh:&#10;07.00 - Berkumpul di Dermaga&#10;08.00 - Menuju Pulau Menjangan..."><?= esc($service['long_description'] ?? '') ?></textarea>
                            </div>
                            <button class="btn btn-primary w-100 fw-bold"><i class="bi bi-save"></i> SIMPAN DESKRIPSI</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white fw-bold py-3"><i class="bi bi-images"></i> Galeri Foto Tambahan</div>
                    <div class="card-body">
                        
                        <div class="alert alert-info small py-2">
                            <i class="bi bi-info-circle"></i> Anda bisa memilih <b>banyak foto</b> sekaligus. Foto akan otomatis dikompres agar ringan.
                        </div>

                        <form id="upload-form" enctype="multipart/form-data" class="mb-4">
                            <input type="hidden" name="service_id" value="<?= $service['id'] ?>">
                            <div class="input-group">
                                <input type="file" name="photos[]" id="upload-input" class="form-control" multiple accept="image/*" required>
                                <button type="button" id="upload-btn" class="btn btn-success fw-bold"><i class="bi bi-cloud-upload"></i> Upload</button>
                            </div>
                        </form>

                        <hr>

                        <div class="row g-3">
                            <?php if(!empty($photos)): ?>
                                <?php foreach($photos as $p): ?>
                                <div class="col-6 col-sm-4">
                                    <div class="gallery-item">
                                        <?php 
                                        // Cek field image_url atau file_name
                                        $imgPath = !empty($p['image_url']) ? '/uploads/' . $p['image_url'] : '/uploads/services/' . $p['file_name'];
                                        ?>
                                        <img src="<?= $imgPath ?>" alt="Foto">
                                        <a href="/admin/delete_service_photo/<?= $p['id'] ?>/<?= $service['id'] ?>" class="btn-delete-img" onclick="return confirm('Hapus foto ini?')">
                                            <i class="bi bi-x-lg"></i>
                                        </a>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center text-muted py-4 small">Belum ada foto tambahan.</div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('upload-btn').addEventListener('click', function() {
            const form = document.getElementById('upload-form');
            const fileInput = document.getElementById('upload-input');
            
            if (!fileInput.files.length) {
                alert('Pilih file gambar terlebih dahulu!');
                return;
            }
            
            const formData = new FormData(form);
            const btn = this;
            const originalText = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Uploading...';
            
            fetch('/admin/upload_service_photo', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Reload page to show new photos
                location.reload();
            })
            .catch(error => {
                alert('Error: ' + error);
                btn.disabled = false;
                btn.innerHTML = originalText;
            });
        });
    </script>
</body>
</html>