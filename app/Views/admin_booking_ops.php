<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Operasional Tamu - <?= $booking['booking_code'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { background: #f0f2f5; font-family: sans-serif; }
        .card-stat { border: none; border-radius: 12px; color: white; padding: 20px; }
        .bg-in { background: linear-gradient(135deg, #11998e, #38ef7d); }
        .bg-out { background: linear-gradient(135deg, #eb3349, #f45c43); }
        .bg-net { background: linear-gradient(135deg, #2980b9, #6dd5fa); }
    </style>
</head>
<body>
    <div class="container py-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="/admin" class="btn btn-outline-secondary btn-sm mb-2"><i class="bi bi-arrow-left"></i> Kembali ke Dashboard</a>
                <h4 class="fw-bold mb-0">Operasional Trip: <?= $booking['guest_name'] ?></h4>
                <small class="text-muted">Kode: <?= $booking['booking_code'] ?> | Tgl: <?= $booking['travel_date'] ?></small>
            </div>
            <div>
                <span class="badge bg-<?= $booking['status']=='confirmed'?'success':'warning' ?> fs-6"><?= strtoupper($booking['status']) ?></span>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card-stat bg-in shadow-sm">
                    <small>TOTAL PEMBAYARAN TAMU (OMSET)</small>
                    <h3 class="fw-bold">Rp <?= number_format($booking['total_revenue']) ?></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-stat bg-out shadow-sm">
                    <small>TOTAL PENGELUARAN (MODAL JALAN)</small>
                    <h3 class="fw-bold">Rp <?= number_format($total_expense) ?></h3>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-stat bg-net shadow-sm">
                    <small>SISA UANG (MASUK KAS BESAR)</small>
                    <h3 class="fw-bold">Rp <?= number_format($profit_trip) ?></h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white fw-bold py-3"><i class="bi bi-wallet2"></i> Catat Pengeluaran Trip Ini</div>
                    <div class="card-body">
                        <form action="/admin/simpan_pengeluaran" method="post">
                            <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                            <div class="row g-2 align-items-end">
                                <div class="col-md-4">
                                    <label class="small">Keperluan</label>
                                    <input type="text" name="expense_name" class="form-control" placeholder="Cth: Beli Bensin / Bayar Kapal" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="small">Kategori</label>
                                    <select name="category" class="form-select">
                                        <option value="transport">Transport</option>
                                        <option value="makan">Makan/Minum</option>
                                        <option value="tiket">Tiket Wisata</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="small">Nominal (Rp)</label>
                                    <input type="number" name="amount" class="form-control" required>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-danger w-100 fw-bold">CATAT</button>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive mt-3">
                            <table class="table table-striped table-hover small">
                                <thead class="table-light"><tr><th>Keperluan</th><th>Kategori</th><th class="text-end">Nominal</th></tr></thead>
                                <tbody>
                                    <?php if(!empty($expenses)): foreach($expenses as $e): ?>
                                    <tr>
                                        <td><?= esc($e['expense_name']) ?></td>
                                        <td><span class="badge bg-secondary"><?= $e['category'] ?></span></td>
                                        <td class="text-end text-danger fw-bold">- Rp <?= number_format($e['amount']) ?></td>
                                    </tr>
                                    <?php endforeach; else: ?>
                                    <tr><td colspan="3" class="text-center text-muted">Belum ada pengeluaran dicatat.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white fw-bold py-3"><i class="bi bi-gear"></i> Pengaturan Trip</div>
                    <div class="card-body">
                        <form action="/admin/update_guide_booking" method="post">
                            <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                            
                            <div class="mb-3">
                                <label class="small fw-bold">Pilih Guide</label>
                                <select name="guide_name" class="form-select">
                                    <option value="">-- Pilih Guide --</option>
                                    <?php foreach($guides as $g): ?>
                                        <option value="<?= $g['name'] ?>" <?= $booking['guide_name'] == $g['name'] ? 'selected' : '' ?>><?= $g['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="small fw-bold">Status Trip</label>
                                <select name="status" class="form-select">
                                    <option value="pending" <?= $booking['status'] == 'pending' ? 'selected' : '' ?>>Menunggu</option>
                                    <option value="confirmed" <?= $booking['status'] == 'confirmed' ? 'selected' : '' ?>>Sedang Jalan</option>
                                    <option value="completed" <?= $booking['status'] == 'completed' ? 'selected' : '' ?>>Selesai (Tutup Buku)</option>
                                    <option value="cancelled" <?= $booking['status'] == 'cancelled' ? 'selected' : '' ?>>Batal</option>
                                </select>
                            </div>

                            <button class="btn btn-primary w-100">Update Status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>