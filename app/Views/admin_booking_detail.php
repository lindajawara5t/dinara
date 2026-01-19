<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Booking - DINARA Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; margin-bottom: 30px; border-radius: 10px; }
        .section { background: white; border-radius: 10px; padding: 20px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .section-title { font-weight: 700; color: #333; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #f0f0f0; }
        .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-top: 15px; }
        .info-item { }
        .info-label { font-size: 0.85rem; color: #999; font-weight: 600; text-transform: uppercase; }
        .info-value { font-size: 1rem; color: #333; font-weight: 600; margin-top: 5px; }
        .status-badge { display: inline-block; padding: 8px 15px; border-radius: 20px; font-weight: 600; }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-confirmed { background: #d4edda; color: #155724; }
        .status-completed { background: #cfe2ff; color: #084298; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
        .table-items { width: 100%; margin-top: 15px; }
        .table-items th { background: #f8f9fa; font-weight: 600; border-bottom: 2px solid #dee2e6; }
        .action-buttons { margin-top: 20px; display: flex; gap: 10px; }
        .package-detail { }
        .package-header { font-weight: 700; color: #667eea; margin-bottom: 10px; font-size: 1rem; }
    </style>
</head>
<body>
    <div class="container-fluid p-4">
        <!-- Header -->
        <div class="header d-flex justify-content-between align-items: center">
            <div>
                <h2><i class="bi bi-journal-text"></i> Detail Booking</h2>
                <small><?= $booking['booking_code'] ?></small>
            </div>
            <a href="<?= base_url('admin/bookings') ?>" class="btn btn-light">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">
                <!-- Informasi Tamu -->
                <div class="section">
                    <h5 class="section-title">📋 Informasi Tamu</h5>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Nama</div>
                            <div class="info-value"><?= $booking['customer_name'] ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Email</div>
                            <div class="info-value"><?= $booking['customer_email'] ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Nomor HP</div>
                            <div class="info-value"><?= $booking['customer_phone'] ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Alamat</div>
                            <div class="info-value"><?= $booking['customer_address'] ?></div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Perjalanan -->
                <div class="section">
                    <h5 class="section-title">✈️ Informasi Perjalanan</h5>
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Kota Asal</div>
                            <div class="info-value"><?= ucfirst($booking['city_origin'] ?? '-') ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Tanggal Berangkat</div>
                            <div class="info-value"><?= date('d M Y', strtotime($booking['travel_date'])) ?></div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Durasi</div>
                            <div class="info-value"><?= $booking['duration_day'] ?> Hari</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Peserta</div>
                            <div class="info-value"><?= $booking['num_people'] ?> Orang <?php if($booking['num_children'] > 0): ?>(+<?= $booking['num_children'] ?> anak)<?php endif; ?></div>
                        </div>
                    </div>
                </div>

                <!-- Paket yang Dipilih -->
                <div class="section">
                    <h5 class="section-title">🎫 Rincian Paket yang Dipilih</h5>
                    
                    <!-- Hotel/Penginapan -->
                    <div class="package-detail mb-3">
                        <h6 class="package-header">🏨 Hotel/Penginapan</h6>
                        <div style="display: grid; grid-template-columns: 1fr auto; gap: 10px; align-items: center; padding: 10px; background: #f8f9fa; border-radius: 5px;">
                            <div>
                                <p class="mb-1" style="font-weight: 600; color: #333;"><?= $booking['hotel_selected'] ?></p>
                                <small class="text-muted">Jumlah Kamar: <?= ceil($booking['num_people'] / 2) ?> | Malam: <?= max(1, $booking['duration_day'] - 1) ?></small>
                            </div>
                            <div style="text-align: right;">
                                <div style="font-weight: 700; color: #667eea; font-size: 1.1rem;">Rp 0</div>
                                <small class="text-muted">*Dari booking_items</small>
                            </div>
                        </div>
                    </div>

                    <!-- Wisata Darat & Guide -->
                    <div class="package-detail mb-3">
                        <h6 class="package-header">🏞️ Wisata Darat & Guide</h6>
                        <?php 
                        if (!empty($booking['tour_darat_details'])): 
                        ?>
                            <?php foreach($booking['tour_darat_details'] as $idx => $tour): ?>
                                <div style="padding: 12px; background: #f8f9fa; border-radius: 5px; margin-bottom: 8px; border-left: 3px solid #667eea;">
                                    <div style="display: grid; grid-template-columns: 1fr auto; gap: 10px; align-items: start;">
                                        <div>
                                            <p class="mb-1" style="font-weight: 600; color: #333;"><?= $tour['name'] ?></p>
                                            <small class="text-muted"><?= substr($tour['description'] ?? '', 0, 100) ?>...</small>
                                        </div>
                                        <div style="text-align: right;">
                                            <div style="font-weight: 700; color: #667eea;">Rp <?= number_format($tour['price_publish'] ?? 0) ?></div>
                                            <small class="text-muted">per orang</small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div style="padding: 10px; background: #f8f9fa; border-radius: 5px; color: #999;">Tidak ada wisata darat dipilih</div>
                        <?php endif; ?>
                    </div>

                    <!-- Wisata Laut -->
                    <div class="package-detail mb-3">
                        <h6 class="package-header">🌊 Wisata Laut</h6>
                        <?php 
                        if (!empty($booking['tour_laut_details'])): 
                        ?>
                            <?php foreach($booking['tour_laut_details'] as $idx => $tour): ?>
                                <div style="padding: 12px; background: #f8f9fa; border-radius: 5px; margin-bottom: 8px; border-left: 3px solid #667eea;">
                                    <div style="display: grid; grid-template-columns: 1fr auto; gap: 10px; align-items: start;">
                                        <div>
                                            <p class="mb-1" style="font-weight: 600; color: #333;"><?= $tour['name'] ?></p>
                                            <small class="text-muted"><?= substr($tour['description'] ?? '', 0, 100) ?>...</small>
                                        </div>
                                        <div style="text-align: right;">
                                            <div style="font-weight: 700; color: #667eea;">Rp <?= number_format($tour['price_publish'] ?? 0) ?></div>
                                            <small class="text-muted">per orang</small>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div style="padding: 10px; background: #f8f9fa; border-radius: 5px; color: #999;">Tidak ada wisata laut dipilih</div>
                        <?php endif; ?>
                    </div>

                    <!-- Guide -->
                    <?php if(!empty($booking['guide_type'])): ?>
                        <div class="package-detail mb-3">
                            <h6 class="package-header">👨‍🏫 Guide</h6>
                            <div style="display: grid; grid-template-columns: 1fr auto; gap: 10px; align-items: center; padding: 10px; background: #f8f9fa; border-radius: 5px;">
                                <div>
                                    <p class="mb-1" style="font-weight: 600; color: #333;"><?= $booking['guide_type'] ?></p>
                                    <small class="text-muted">Jumlah Guide: <?= ceil($booking['num_people'] / 8) ?> | Durasi: <?= $booking['duration_day'] ?> hari</small>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-weight: 700; color: #667eea; font-size: 1.1rem;">Rp 0</div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Transportasi Lokal -->
                    <?php if(!empty($booking['transport_type'])): ?>
                        <div class="package-detail mb-3">
                            <h6 class="package-header">🚗 Transportasi Lokal</h6>
                            <div style="display: grid; grid-template-columns: 1fr auto; gap: 10px; align-items: center; padding: 10px; background: #f8f9fa; border-radius: 5px;">
                                <div>
                                    <p class="mb-1" style="font-weight: 600; color: #333;"><?= $booking['transport_type'] ?></p>
                                    <small class="text-muted">Rental Durasi: <?= $booking['duration_day'] ?> hari</small>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-weight: 700; color: #667eea; font-size: 1.1rem;">Rp 0</div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Tiket Pesawat -->
                    <?php if(!empty($booking['flight_type'])): ?>
                        <div class="package-detail mb-3">
                            <h6 class="package-header">✈️ Tiket Pesawat</h6>
                            <div style="display: grid; grid-template-columns: 1fr auto; gap: 10px; align-items: center; padding: 10px; background: #f8f9fa; border-radius: 5px;">
                                <div>
                                    <p class="mb-1" style="font-weight: 600; color: #333;"><?= $booking['flight_type'] ?></p>
                                    <small class="text-muted">Untuk <?= $booking['num_people'] ?> orang (PP)</small>
                                </div>
                                <div style="text-align: right;">
                                    <div style="font-weight: 700; color: #667eea; font-size: 1.1rem;">Rp 0</div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Fasilitas Tambahan -->
                    <?php 
                    if (!empty($booking['facilities_details'])): 
                    ?>
                        <div class="package-detail mb-3">
                            <h6 class="package-header">✨ Fasilitas Tambahan</h6>
                            <?php foreach($booking['facilities_details'] as $idx => $facility): ?>
                                <div style="padding: 12px; background: #f8f9fa; border-radius: 5px; margin-bottom: 8px; border-left: 3px solid #667eea;">
                                    <div style="display: grid; grid-template-columns: 1fr auto; gap: 10px; align-items: start;">
                                        <div>
                                            <p class="mb-1" style="font-weight: 600; color: #333;"><?= $facility['name'] ?? $facility['description'] ?></p>
                                            <small class="text-muted"><?= $facility['description'] ?? '' ?></small>
                                        </div>
                                        <div style="text-align: right;">
                                            <div style="font-weight: 700; color: #667eea;">Rp <?= number_format($facility['price_publish'] ?? 0) ?></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Catatan Khusus -->
                    <?php if(!empty($booking['notes'])): ?>
                        <div class="alert alert-info mt-3">
                            <strong>📝 Catatan Khusus:</strong><br>
                            <?= nl2br($booking['notes']) ?>
                        </div>
                    <?php endif; ?>

                    <!-- Price Breakdown Summary -->
                    <div style="background: #f0f4ff; padding: 15px; border-radius: 8px; margin-top: 15px;">
                        <h6 style="margin-bottom: 10px; color: #667eea;">💰 Ringkasan Harga</h6>
                        <table style="width: 100%; font-size: 0.9rem;">
                            <tr>
                                <td>Tiket Kapal PP</td>
                                <td style="text-align: right;">Rp 0</td>
                            </tr>
                            <tr>
                                <td>Transportasi Darat PP</td>
                                <td style="text-align: right;">Rp 0</td>
                            </tr>
                            <tr>
                                <td>Penginapan</td>
                                <td style="text-align: right;">Rp 0</td>
                            </tr>
                            <tr>
                                <td>Sewa Kendaraan Lokal</td>
                                <td style="text-align: right;">Rp 0</td>
                            </tr>
                            <tr>
                                <td>Wisata Darat & Guide</td>
                                <td style="text-align: right;">Rp 0</td>
                            </tr>
                            <tr>
                                <td>Wisata Laut</td>
                                <td style="text-align: right;">Rp 0</td>
                            </tr>
                            <tr>
                                <td>Makan</td>
                                <td style="text-align: right;">Rp 0</td>
                            </tr>
                            <tr>
                                <td>Fasilitas Tambahan</td>
                                <td style="text-align: right;">Rp 0</td>
                            </tr>
                            <tr style="border-top: 2px solid #667eea;">
                                <td style="font-weight: 700;">TOTAL</td>
                                <td style="text-align: right; font-weight: 700; color: #667eea; font-size: 1.1rem;">Rp <?= number_format($booking['total_price']) ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Booking Items -->
                <?php if(!empty($booking['items'])): ?>
                    <div class="section">
                        <h5 class="section-title">📦 Detail Item</h5>
                        <table class="table table-sm table-items">
                            <thead>
                                <tr>
                                    <th>Tipe</th>
                                    <th>Nama Item</th>
                                    <th style="text-align: right;">Qty</th>
                                    <th style="text-align: right;">Harga Unit</th>
                                    <th style="text-align: right;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($booking['items'] as $item): ?>
                                    <tr>
                                        <td><span class="badge bg-secondary"><?= ucfirst(str_replace('_', ' ', $item['item_type'])) ?></span></td>
                                        <td><?= $item['item_name'] ?></td>
                                        <td style="text-align: right;"><?= $item['quantity'] ?></td>
                                        <td style="text-align: right;">Rp <?= number_format($item['price_unit']) ?></td>
                                        <td style="text-align: right;">Rp <?= number_format($item['price_total']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <!-- Status & Ringkasan -->
                <div class="section">
                    <h5 class="section-title">📊 Status & Ringkasan</h5>
                    <div class="info-item mb-3">
                        <div class="info-label">Status Booking</div>
                        <div class="info-value">
                            <span class="status-badge status-<?= $booking['status'] ?>">
                                <?= ucfirst($booking['status']) ?>
                            </span>
                        </div>
                    </div>
                    <div class="info-item mb-3">
                        <div class="info-label">Status Pembayaran</div>
                        <div class="info-value">
                            <span class="status-badge status-<?= $booking['payment_status'] ?>">
                                <?= ucfirst(str_replace('_', ' ', $booking['payment_status'])) ?>
                            </span>
                        </div>
                    </div>
                    <hr>
                    <div class="info-item mb-2">
                        <div class="info-label">Total Harga</div>
                        <div class="info-value" style="font-size: 1.3rem; color: #667eea;">
                            Rp <?= number_format($booking['total_price']) ?>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Biaya Netto</div>
                        <div class="info-value">Rp <?= number_format($booking['total_net_cost'] ?? 0) ?></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Estimasi Profit</div>
                        <div class="info-value" style="color: #28a745;">
                            Rp <?= number_format(($booking['total_price'] - ($booking['total_net_cost'] ?? 0))) ?>
                        </div>
                    </div>
                </div>

                <!-- Payment Info -->
                <?php if(!empty($booking['payments'])): ?>
                    <div class="section">
                        <h5 class="section-title">💳 Riwayat Pembayaran</h5>
                        <?php foreach($booking['payments'] as $payment): ?>
                            <div class="card mb-2">
                                <div class="card-body p-2">
                                    <div class="d-flex justify-content-between">
                                        <strong><?= ucfirst($payment['payment_method']) ?></strong>
                                        <span class="badge bg-<?= ($payment['status'] === 'confirmed' ? 'success' : 'warning') ?>">
                                            <?= ucfirst($payment['status']) ?>
                                        </span>
                                    </div>
                                    <small class="text-muted">
                                        Rp <?= number_format($payment['amount']) ?><br>
                                        <?= $payment['payment_date'] ? date('d M Y', strtotime($payment['payment_date'])) : 'Belum dibayar' ?>
                                    </small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Actions -->
                <div class="section">
                    <h5 class="section-title">⚙️ Aksi</h5>
                    <div class="action-buttons">
                        <?php if($booking['status'] === 'pending'): ?>
                            <button class="btn btn-success w-100" onclick="updateStatus('confirmed')">
                                <i class="bi bi-check-circle"></i> Setujui
                            </button>
                            <button class="btn btn-danger w-100" onclick="updateStatus('cancelled')">
                                <i class="bi bi-x-circle"></i> Tolak
                            </button>
                        <?php endif; ?>
                        <?php if($booking['status'] === 'confirmed'): ?>
                            <button class="btn btn-info w-100" onclick="updateStatus('completed')">
                                <i class="bi bi-check2-all"></i> Selesaikan
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateStatus(newStatus) {
            if (confirm('Ubah status ke ' + newStatus + '?')) {
                fetch('<?= base_url('admin/booking/update-status') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        booking_id: <?= $booking['id'] ?>,
                        status: newStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Status berhasil diperbarui!');
                        location.reload();
                    } else {
                        alert('Error: ' + (data.message || 'Gagal update status'));
                    }
                })
                .catch(err => alert('Error: ' + err));
            }
        }
    </script>
</body>
</html>
