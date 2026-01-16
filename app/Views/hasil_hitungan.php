<!DOCTYPE html>
<html>
<head>
    <title>Hasil Analisa Smart Travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body class="bg-light p-2">

<div class="container" style="max-width: 800px;">
    
    <div class="card shadow mb-4 border-primary">
        <div class="card-body text-center">
            <h5 class="text-muted" style="font-size: 0.75rem;">Budget Awal: Rp <?= number_format($budget_awal ?? 0) ?> (<?= $orang ?? 1 ?> Orang)</h5>
            <h2 class="fw-bold text-primary" style="font-size: 1.3rem;">Sisa: Rp <?= number_format($sisa_uang ?? 0) ?></h2>
            
            <div class="alert alert-info d-inline-block mt-2" style="font-size: 0.85rem;">
                <small>✅ Sudah dipotong Tiket Kapal: <b><?= $nama_tiket ?? '-' ?></b> (Rp <?= number_format($biaya_wajib ?? 0) ?>)</small>
            </div>
        </div>
    </div>

    <h4 class="mb-3 fw-bold" style="font-size: 0.95rem;">🏨 Penginapan yang Masuk Budget Anda:</h4>
    
    <?php if(empty($rek_hotel)): ?>
        <div class="alert alert-danger p-4 text-center">
            <h4>Waduh, Hasil Kosong! 😔</h4>
            <p>Kemungkinan penyebabnya:</p>
            <ul class="text-start d-inline-block">
                <li>Budget Anda terlalu rendah untuk harga hotel yang ada.</li>
                <li>Atau Anda belum input data Hotel di halaman Admin.</li>
            </ul>
            <br>
            <a href="/kalkulator" class="btn btn-warning mt-2">Coba Tambah Budget</a>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach($rek_hotel as $hotel): ?>
            <div class="col-md-6 mb-3">
                <div class="card h-100 shadow-sm hover-effect">
                    <div style="height: 150px; background: #eee; display: flex; align-items: center; justify-content: center; color: #777;">
                        <i class="bi bi-building fs-1"></i>
                    </div>
                    <div class="card-body" style="padding: 0.8rem;">
                        <h5 class="card-title fw-bold" style="font-size: 0.95rem;"><?= $hotel['name'] ?></h5>
                        <p class="card-text text-muted" style="font-size: 0.75rem; margin-bottom: 0.5rem;"><?= $hotel['description'] ?? 'Fasilitas standar nyaman.' ?></p>
                        <h5 class="text-success fw-bold" style="font-size: 1rem;">Rp <?= number_format($hotel['price_publish']) ?></h5>
                        
                        <?php 
                            $nomor_admin = "6281234567890"; // Ganti No HP Admin disini
                            
                            $pesan  = "Halo Admin! 👋%0a";
                            $pesan .= "Saya mau booking paket ini:%0a";
                            $pesan .= "--------------------------%0a";
                            $pesan .= "💰 Budget: Rp " . number_format($budget_awal ?? 0) . "%0a";
                            $pesan .= "👥 Tamu: " . ($orang ?? 1) . " Orang%0a";
                            $pesan .= "🚢 Tiket: " . ($nama_tiket ?? '-') . "%0a";
                            $pesan .= "🏨 Hotel: *" . $hotel['name'] . "*%0a";
                            $pesan .= "💵 Harga Hotel: Rp " . number_format($hotel['price_publish']) . "%0a";
                            $pesan .= "--------------------------%0a";
                            $pesan .= "Apakah available?";
                        ?>

                        <a href="https://wa.me/<?= $nomor_admin ?>?text=<?= $pesan ?>" target="_blank" class="btn btn-success w-100 mt-2 fw-bold">
                            <i class="bi bi-whatsapp"></i> Booking via WA
                        </a>

                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="text-center mt-5 mb-5">
        <a href="/kalkulator" class="btn btn-secondary btn-lg me-2">🔄 Hitung Ulang</a>
    </div>

</div>

</body>
</html>