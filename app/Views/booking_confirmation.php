<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Smart Travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .confirmation-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
            overflow: hidden;
        }
        .confirmation-header {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .confirmation-header i {
            font-size: 48px;
            margin-bottom: 15px;
            display: block;
        }
        .confirmation-header h2 {
            margin: 0;
            font-weight: bold;
        }
        .booking-code {
            background: rgba(255,255,255,0.2);
            padding: 12px;
            border-radius: 8px;
            margin-top: 15px;
            font-family: monospace;
            font-size: 18px;
            font-weight: bold;
        }
        .confirmation-body {
            padding: 30px;
        }
        .booking-detail {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        .booking-detail:last-child {
            border-bottom: none;
        }
        .detail-label {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        .detail-value {
            color: #333;
            font-weight: 600;
            font-size: 1.1rem;
        }
        .payment-status {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: bold;
        }
        .payment-status.unpaid {
            background: #fef3c7;
            color: #92400e;
        }
        .payment-status.paid {
            background: #d1fae5;
            color: #065f46;
        }
        .payment-section {
            background: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .payment-section h4 {
            margin-bottom: 15px;
            color: #333;
        }
        .bank-details {
            background: white;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
        .bank-details p {
            margin: 8px 0;
            color: #555;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }
        .action-buttons button, .action-buttons a {
            flex: 1;
            padding: 12px;
            border-radius: 8px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102,126,234,0.4);
        }
        .btn-secondary {
            background: #e5e7eb;
            color: #333;
        }
        .btn-secondary:hover {
            background: #d1d5db;
        }
    </style>
</head>
<body>
    <div class="confirmation-card">
        <!-- Header -->
        <div class="confirmation-header">
            <i class="bi bi-check-circle"></i>
            <h2>Booking Berhasil!</h2>
            <p style="margin: 10px 0 0 0;">Terima kasih telah memesan liburan impian Anda</p>
            <div class="booking-code">
                <?= $booking['booking_code'] ?>
            </div>
        </div>

        <!-- Body -->
        <div class="confirmation-body">
            <!-- Customer Details -->
            <div class="booking-detail">
                <div class="detail-label">Nama Pemesan</div>
                <div class="detail-value"><?= esc($booking['customer_name']) ?></div>
            </div>

            <div class="booking-detail">
                <div class="detail-label">Email</div>
                <div class="detail-value"><?= esc($booking['customer_email']) ?></div>
            </div>

            <div class="booking-detail">
                <div class="detail-label">Nomor HP</div>
                <div class="detail-value"><?= esc($booking['customer_phone']) ?></div>
            </div>

            <div class="booking-detail">
                <div class="detail-label">Tanggal Berangkat</div>
                <div class="detail-value"><?= date('d F Y', strtotime($booking['travel_date'])) ?></div>
            </div>

            <div class="booking-detail">
                <div class="detail-label">Durasi</div>
                <div class="detail-value"><?= $booking['duration_day'] ?> Hari / <?= ($booking['duration_day'] - 1) ?> Malam</div>
            </div>

            <div class="booking-detail">
                <div class="detail-label">Jumlah Peserta</div>
                <div class="detail-value"><?= $booking['num_people'] ?> Orang</div>
            </div>

            <!-- Total Harga -->
            <div class="booking-detail">
                <div class="detail-label">Total Harga</div>
                <div class="detail-value" style="color: #10b981; font-size: 1.3rem;">
                    Rp <?= number_format($booking['total_price'], 0, ',', '.') ?>
                </div>
            </div>

            <!-- Payment Status -->
            <div class="booking-detail">
                <div class="detail-label">Status Pembayaran</div>
                <span class="payment-status <?= strtolower($booking['payment_status']) ?>">
                    <?php
                    $statusLabel = [
                        'unpaid' => 'Belum Dibayar',
                        'partial' => 'Sebagian Dibayar',
                        'paid' => 'Sudah Dibayar'
                    ];
                    echo $statusLabel[strtolower($booking['payment_status'])] ?? 'Pending';
                    ?>
                </span>
            </div>

            <!-- Payment Section -->
            <?php if (strtolower($booking['payment_status']) !== 'paid'): ?>
            <div class="payment-section">
                <h4>Data Pembayaran</h4>
                <div class="bank-details">
                    <p><strong>Bank:</strong> <?= $booking['payments'][0]['bank_name'] ?? 'BCA' ?></p>
                    <p><strong>No. Rekening:</strong> <?= $booking['payments'][0]['bank_account'] ?? '123456789' ?></p>
                    <p><strong>Atas Nama:</strong> <?= $booking['payments'][0]['account_holder'] ?? 'PT Smart Travel' ?></p>
                    <p><strong>Jumlah:</strong> Rp <?= number_format($booking['payments'][0]['amount'] ?? 0, 0, ',', '.') ?></p>
                    <p><strong>Batas Pembayaran:</strong> <?= date('d F Y', strtotime($booking['payments'][0]['due_date'] ?? 'now')) ?></p>
                </div>
            </div>
            <?php endif; ?>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="<?= base_url('/') ?>" class="btn-secondary">
                    <i class="bi bi-house"></i> Kembali ke Beranda
                </a>
                <button class="btn-primary" onclick="window.print()">
                    <i class="bi bi-printer"></i> Cetak Bukti
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
