<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', sans-serif;
        }
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-left: 4px solid #667eea;
            margin-bottom: 20px;
        }
        .stat-value {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
            margin: 10px 0;
        }
        .stat-label {
            color: #7f8c8d;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .stat-icon {
            font-size: 32px;
            color: #667eea;
            opacity: 0.2;
            float: right;
        }
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border-radius: 12px;
            margin-bottom: 20px;
        }
        .card-header {
            background: white;
            border-bottom: 1px solid #e9ecef;
            padding: 20px;
            font-weight: 600;
            color: #2c3e50;
        }
        .chart-container {
            position: relative;
            height: 300px;
            margin-bottom: 20px;
        }
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Dashboard Keuangan</h2>
            <a href="<?= base_url('admin') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Summary Statistics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <span class="stat-icon"><i class="bi bi-cash-coin"></i></span>
                    <div class="stat-label">Total Revenue</div>
                    <div class="stat-value">Rp <?= number_format($total_revenue, 0, ',', '.') ?></div>
                    <small class="text-muted"><?= $total_bookings ?> bookings</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card" style="border-left-color: #10b981;">
                    <span class="stat-icon" style="color: #10b981;"><i class="bi bi-graph-up"></i></span>
                    <div class="stat-label">Total Margin</div>
                    <div class="stat-value">Rp <?= number_format($total_margin, 0, ',', '.') ?></div>
                    <small class="text-success"><?= $margin_percent ?>% dari revenue</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card" style="border-left-color: #f59e0b;">
                    <span class="stat-icon" style="color: #f59e0b;"><i class="bi bi-check-circle"></i></span>
                    <div class="stat-label">Sudah Dibayar</div>
                    <div class="stat-value">Rp <?= number_format($paid_amount, 0, ',', '.') ?></div>
                    <small class="text-muted"><?= round(($paid_amount / $total_revenue * 100), 1) ?>% collected</small>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card" style="border-left-color: #ef4444;">
                    <span class="stat-icon" style="color: #ef4444;"><i class="bi bi-hourglass"></i></span>
                    <div class="stat-label">Belum Dibayar</div>
                    <div class="stat-value">Rp <?= number_format($pending_amount, 0, ',', '.') ?></div>
                    <small class="text-danger"><?= round(($pending_amount / $total_revenue * 100), 1) ?>% pending</small>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Revenue Trend (12 Bulan Terakhir)</div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Status Pembayaran</div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="paymentStatusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Payments Table -->
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <span>Pembayaran Terbaru</span>
                    <a href="<?= base_url('admin/bookings') ?>" class="btn btn-sm btn-outline-primary">
                        Lihat Semua
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Payment Code</th>
                            <th>Booking Code</th>
                            <th>Nama Tamu</th>
                            <th>Jumlah</th>
                            <th>Metode</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_payments as $payment): ?>
                        <tr>
                            <td><code style="background: #f0f0f0; padding: 4px 8px; border-radius: 4px;"><?= esc($payment['payment_code']) ?></code></td>
                            <td><?= esc($payment['booking_code']) ?></td>
                            <td><strong><?= esc($payment['customer_name']) ?></strong></td>
                            <td class="fw-bold text-success">Rp <?= number_format($payment['amount'], 0, ',', '.') ?></td>
                            <td>
                                <span class="badge bg-info"><?= ucfirst($payment['payment_method']) ?></span>
                            </td>
                            <td><small><?= date('d M Y', strtotime($payment['payment_date'])) ?></small></td>
                            <td>
                                <?php if($payment['status'] === 'confirmed'): ?>
                                    <span class="badge bg-success">Confirmed</span>
                                <?php elseif($payment['status'] === 'pending'): ?>
                                    <span class="badge bg-warning">Pending</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Failed</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: <?= json_encode(array_column($monthly_revenue, 'month')) ?>,
                datasets: [{
                    label: 'Revenue',
                    data: <?= json_encode(array_column($monthly_revenue, 'revenue')) ?>,
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } }
            }
        });

        // Payment Status Chart
        const statusCtx = document.getElementById('paymentStatusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Sudah Bayar', 'Sebagian', 'Belum Bayar'],
                datasets: [{
                    data: [<?= $payment_stats['paid'] ?>, <?= $payment_stats['partial'] ?>, <?= $payment_stats['unpaid'] ?>],
                    backgroundColor: ['#10b981', '#60a5fa', '#fbbf24']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    </script>
</body>
</html>
