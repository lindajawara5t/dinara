<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Debug Settings - Dinara Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 40px 0;
        }
        .debug-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            margin-bottom: 20px;
        }
        .image-preview {
            width: 150px;
            height: 150px;
            object-fit: contain;
            border: 2px solid #dee2e6;
            border-radius: 10px;
            background: #f8f9fa;
        }
        .status-ok { color: #28a745; }
        .status-error { color: #dc3545; }
        .code-block {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            font-family: 'Courier New', monospace;
            font-size: 13px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center mb-4">
            <h1 class="text-white fw-bold"><i class="bi bi-bug me-2"></i>Debug Settings Database</h1>
            <p class="text-white">Informasi lengkap tentang gambar yang tersimpan di database</p>
        </div>

        <div class="debug-card">
            <h3 class="mb-4"><i class="bi bi-database me-2"></i>Data Settings dari Database</h3>
            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 30%;">Setting Key</th>
                            <th style="width: 40%;">Value</th>
                            <th style="width: 30%;">Preview / Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $imageKeys = ['logo_image', 'hero_image', 'km_photo_1', 'km_photo_2', 'km_photo_3', 
                                      'promo_1_image', 'promo_2_image', 'promo_3_image',
                                      'flyer_1', 'flyer_2', 'flyer_3', 'flyer_4', 'flyer_5',
                                      'gallery_1', 'gallery_2', 'gallery_3', 'gallery_4', 
                                      'gallery_5', 'gallery_6', 'gallery_7', 'gallery_8'];
                        
                        $folderMapping = [
                            'logo_image' => 'uploads',
                            'hero_image' => 'uploads',
                            'km_photo_' => 'uploads/karimunjawa',
                            'promo_' => 'uploads/promo',
                            'flyer_' => 'uploads/flyer',
                            'gallery_' => 'uploads/gallery',
                        ];
                        
                        foreach($imageKeys as $key): 
                            $value = $settings[$key] ?? '';
                            
                            // Determine folder
                            $folder = 'uploads';
                            foreach ($folderMapping as $prefix => $f) {
                                if (strpos($key, $prefix) === 0) {
                                    $folder = $f;
                                    break;
                                }
                            }
                            
                            // Check if file exists
                            $filePath = FCPATH . $folder . '/' . $value;
                            $fileExists = !empty($value) && file_exists($filePath);
                            $imageUrl = !empty($value) ? base_url($folder . '/' . $value) : '';
                        ?>
                        <tr>
                            <td><strong><?= $key ?></strong></td>
                            <td>
                                <?php if(empty($value)): ?>
                                    <span class="badge bg-secondary">Belum diset</span>
                                <?php else: ?>
                                    <div class="code-block mb-2"><?= $value ?></div>
                                    <small class="text-muted">Full Path: <?= $folder ?>/<?= $value ?></small><br>
                                    <small class="text-muted">URL: <?= $imageUrl ?></small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if(empty($value)): ?>
                                    <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i>Kosong</span>
                                <?php elseif($fileExists): ?>
                                    <span class="badge bg-success mb-2"><i class="bi bi-check-circle me-1"></i>File Exists</span><br>
                                    <img src="<?= $imageUrl ?>" alt="<?= $key ?>" class="image-preview" onerror="this.style.display='none'; this.parentElement.innerHTML+='<div class=\'badge bg-danger\'>Error Load</div>';">
                                <?php else: ?>
                                    <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>File Tidak Ditemukan</span><br>
                                    <small class="text-danger">Expected: <?= $filePath ?></small>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="debug-card">
            <h3 class="mb-3"><i class="bi bi-folder2-open me-2"></i>Struktur Folder Upload</h3>
            <div class="row">
                <?php
                $folders = ['uploads', 'uploads/karimunjawa', 'uploads/promo', 'uploads/flyer', 'uploads/gallery'];
                foreach($folders as $folder):
                    $fullPath = FCPATH . $folder;
                    $exists = is_dir($fullPath);
                    $writable = $exists && is_writable($fullPath);
                    $files = $exists ? scandir($fullPath) : [];
                    $fileCount = count(array_filter($files, function($f) { return $f !== '.' && $f !== '..' && $f !== '.htaccess'; }));
                ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php if($exists): ?>
                                    <i class="bi bi-folder-check status-ok me-2"></i>
                                <?php else: ?>
                                    <i class="bi bi-folder-x status-error me-2"></i>
                                <?php endif; ?>
                                <?= $folder ?>
                            </h5>
                            <?php if($exists): ?>
                                <p class="mb-1">
                                    <span class="badge <?= $writable ? 'bg-success' : 'bg-warning' ?>">
                                        <?= $writable ? 'Writable' : 'Read Only' ?>
                                    </span>
                                    <span class="badge bg-info text-dark"><?= $fileCount ?> files</span>
                                </p>
                                <small class="text-muted"><?= $fullPath ?></small>
                            <?php else: ?>
                                <span class="badge bg-danger">Folder tidak ada!</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="text-center">
            <a href="<?= base_url('settings/unified') ?>" class="btn btn-light btn-lg">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Settings
            </a>
        </div>
    </div>
</body>
</html>
