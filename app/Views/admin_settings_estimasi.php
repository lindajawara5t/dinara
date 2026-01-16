<?php
// Temporary: Skip auth check para debug
// TODO: Uncomment after testing
// if (empty(session()->get('user_id'))) {
//     redirect()->to('/admin');
// }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings Estimasi - Dinara Admin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', sans-serif; }
        
        /* SIDEBAR */
        .sidebar { min-height: 100vh; background: #2c3e50; color: white; padding-top: 20px; position: fixed; width: 250px; z-index: 1000; }
        .sidebar-brand { font-size: 1.3rem; font-weight: 800; text-align: center; margin-bottom: 40px; display: block; color: #ecf0f1; text-decoration: none; letter-spacing: 1px; }
        .nav-sidebar .nav-link { color: #bdc3c7; padding: 15px 25px; border-radius: 0; display: flex; align-items: center; transition: 0.3s; font-weight: 500; cursor: pointer; }
        .nav-sidebar .nav-link:hover, .nav-sidebar .nav-link.active { background: #34495e; color: #fff; border-left: 5px solid #3498db; padding-left: 20px; }
        .nav-sidebar .nav-link i { margin-right: 12px; font-size: 1.1rem; width: 25px; text-align: center; }
        
        /* MAIN CONTENT */
        .main-content { margin-left: 250px; padding: 30px; }
    </style>
</head>
<body>

    <div class="sidebar">
        <a href="#" class="sidebar-brand"><i class="bi bi-airplane-engines-fill text-warning"></i> DINARA ADMIN</a>
        
        <ul class="nav flex-column nav-sidebar">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/dashboard') ?>">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin') ?>">
                    <i class="bi bi-database-fill-gear"></i> Database Wisata
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?= base_url('settings/estimasi-info') ?>">
                    <i class="bi bi-sliders"></i> Settings Estimasi
                </a>
            </li>

            <li class="nav-item mt-5 pt-5 border-top border-secondary">
                <a href="<?= base_url('/') ?>" target="_blank" class="nav-link text-warning">
                    <i class="bi bi-globe"></i> Lihat Website
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="fw-bold text-dark"><i class="bi bi-gear-fill text-primary"></i> Settings Estimasi Biaya</h2>
                <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary btn-sm rounded-pill">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
            <p class="text-muted small">Kelola deskripsi dan informasi untuk setiap detail estimasi biaya yang ditampilkan di landing page</p>
        </div>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="row">
        <?php if(!empty($serviceInfo)): ?>
            <?php foreach($serviceInfo as $info): ?>
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-light border-0 rounded-4 rounded-bottom-0 d-flex align-items-center gap-2 py-3 px-4">
                        <i class="bi bi-info-circle text-primary" style="font-size:1.3rem;"></i>
                        <div>
                            <h6 class="fw-bold m-0 text-dark"><?= esc($info['title']) ?></h6>
                            <small class="text-muted"><?= esc($info['key_name']) ?></small>
                        </div>
                    </div>
                    <div class="card-body">
                        <form class="estimasi-info-form" data-section="<?= esc($info['key_name']) ?>">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Deskripsi</label>
                                <textarea class="form-control form-control-sm rounded-3" name="description" rows="3" placeholder="Deskripsi lengkap untuk tooltip"><?= esc($info['description']) ?></textarea>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-primary btn-sm rounded-pill flex-grow-1 save-estimasi-info" style="font-size:0.85rem;">
                                    <i class="bi bi-check-lg"></i> Simpan
                                </button>
                            </div>
                            <small class="text-success d-none mt-2 status-message"></small>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
        <div class="col-12">
            <div class="alert alert-info text-center py-4">
                <i class="bi bi-info-circle"></i> Tidak ada data estimasi info. Silakan refresh halaman ini.
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 bg-light p-4">
                <h6 class="fw-bold text-dark mb-3"><i class="bi bi-exclamation-triangle-fill text-warning"></i> Opsi Lanjutan</h6>
                <button type="button" class="btn btn-warning btn-sm rounded-pill" id="reset-all-defaults">
                    <i class="bi bi-arrow-clockwise"></i> Reset Semua ke Default
                </button>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Save individual estimasi info
        document.querySelectorAll('.save-estimasi-info').forEach(btn => {
            btn.addEventListener('click', function() {
                const form = this.closest('.estimasi-info-form');
                const sectionName = form.dataset.section;
                const description = form.querySelector('textarea[name="description"]').value;
                const statusMsg = form.querySelector('.status-message');

                if (!description) {
                    statusMsg.textContent = 'Deskripsi tidak boleh kosong!';
                    statusMsg.classList.remove('d-none', 'text-success');
                    statusMsg.classList.add('text-danger');
                    return;
                }

                fetch(`<?= base_url('settings/update-estimasi-info') ?>/${sectionName}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `description=${encodeURIComponent(description)}`
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        statusMsg.textContent = '✓ Berhasil disimpan';
                        statusMsg.classList.remove('d-none', 'text-danger');
                        statusMsg.classList.add('text-success');
                        setTimeout(() => statusMsg.classList.add('d-none'), 3000);
                    } else {
                        statusMsg.textContent = data.message || 'Gagal menyimpan';
                        statusMsg.classList.add('text-danger');
                        statusMsg.classList.remove('d-none');
                    }
                })
                .catch(err => {
                    console.error(err);
                    statusMsg.textContent = 'Error: ' + err.message;
                    statusMsg.classList.add('text-danger');
                    statusMsg.classList.remove('d-none');
                });
            });
        });

        // Reset all defaults
        document.getElementById('reset-all-defaults').addEventListener('click', function() {
            if (confirm('⚠️ Ini akan menghapus semua perubahan dan mengembalikan ke default. Lanjutkan?')) {
                fetch('<?= base_url('settings/reset-estimasi-info-defaults') ?>', {
                    method: 'POST'
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(err => console.error(err));
            }
        });
    });
    </script>

</body>
</html>
