<!DOCTYPE html>
<html>
<head>
    <title>Back Office Smart Travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">

    <div class="card shadow" style="max-width: 600px; margin: auto;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Input Master Data</h4>
        </div>
        <div class="card-body">
            <form action="/admin/simpan" method="post">
                
                <div class="mb-3">
                    <label>Nama Layanan</label>
                    <input type="text" name="nama" class="form-control" placeholder="Contoh: Tiket Kapal Ferry" required>
                </div>

                <div class="mb-3">
                    <label>Jenis Kategori</label>
                    <select name="jenis" class="form-select">
                        <option value="transport_sea">Transport Laut (Kapal)</option>
                        <option value="transport_land">Transport Darat</option>
                        <option value="stay">Penginapan</option>
                        <option value="meal">Makanan</option>
                        <option value="activity">Wisata</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Harga Jual (Rp)</label>
                    <input type="number" name="harga" class="form-control" placeholder="100000" required>
                </div>

                <button type="submit" class="btn btn-success w-100 fw-bold">SIMPAN DATA</button>
            </form>
        </div>
    </div>
<div class="card shadow mt-5" style="max-width: 800px; margin: auto;">
        <div class="card-header bg-dark text-white">
            <h4>Database Layanan Anda</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama Layanan</th>
                        <th>Jenis</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($layanan as $item): ?>
                    <tr>
                        <td><?= $item['name'] ?></td>
                        <td>
                            <span class="badge bg-info text-dark"><?= $item['type'] ?></span>
                        </td>
                        <td>Rp <?= number_format($item['price_publish'], 0, ',', '.') ?></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <br><br>
</body>
</html>