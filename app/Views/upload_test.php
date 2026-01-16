<!DOCTYPE html>
<html>
<head>
    <title>Upload Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Upload Test</h1>
    
    <?php if (session()->has('success')): ?>
        <div class="alert alert-success"><?= session('success') ?></div>
    <?php endif; ?>
    
    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger"><?= session('error') ?></div>
    <?php endif; ?>
    
    <form action="<?= base_url('settings/save-unified') ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="section" value="test">
        
        <div class="mb-3">
            <label class="form-label">Logo (File Upload)</label>
            <input type="file" class="form-control" name="logo_image" accept="image/*" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
    
    <hr>
    <h3>Settings in Database</h3>
    <table class="table">
        <thead>
            <tr><th>Key</th><th>Value</th></tr>
        </thead>
        <tbody>
            <?php 
            $db = \Config\Database::connect();
            $settings = $db->table('site_settings')->get()->getResultArray();
            foreach ($settings as $setting): 
            ?>
                <tr>
                    <td><?= $setting['setting_key'] ?></td>
                    <td><?= $setting['setting_value'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <h3>Files in uploads folder</h3>
    <ul>
        <?php 
        $uploadDir = FCPATH . 'uploads';
        if (is_dir($uploadDir)) {
            $files = scandir($uploadDir);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    echo "<li>$file</li>";
                }
            }
        }
        ?>
    </ul>
</div>
</body>
</html>
