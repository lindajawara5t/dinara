<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Booking - DINARA Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background: #f5f7fa; font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }
        .admin-header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 16px 20px; margin-bottom: 20px; border-radius: 12px; box-shadow: 0 2px 12px rgba(102, 126, 234, 0.2); }
        .admin-header h4 { margin: 0; font-weight: 600; font-size: 1.25rem; }
        .admin-header small { opacity: 0.9; font-size: 0.85rem; }
        .notification-badge { background: #ff6b6b; border-radius: 50%; min-width: 22px; height: 22px; display: inline-flex; align-items: center; justify-content: center; font-weight: 600; font-size: 0.75rem; margin-left: 8px; }
        .filter-tabs { display: flex; gap: 8px; margin-bottom: 16px; flex-wrap: wrap; }
        .filter-tab { padding: 6px 14px; border-radius: 20px; background: white; border: 1px solid #e1e8ed; cursor: pointer; font-weight: 500; font-size: 0.85rem; transition: all 0.2s; color: #555; }
        .filter-tab:hover { border-color: #667eea; color: #667eea; }
        .filter-tab.active { background: #667eea; color: white; border-color: #667eea; }
        .filter-tab .badge { background: #ff6b6b; color: white; padding: 2px 6px; border-radius: 10px; font-size: 0.7rem; margin-left: 4px; }
        
        /* Compact Table Style */
        .bookings-table { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
        .bookings-table table { width: 100%; margin: 0; font-size: 0.85rem; }
        .bookings-table thead { background: #f8f9fb; }
        .bookings-table th { padding: 10px 12px; font-weight: 600; color: #64748b; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px; border-bottom: 1px solid #e1e8ed; white-space: nowrap; }
        .bookings-table td { padding: 10px 12px; border-bottom: 1px solid #f1f3f5; vertical-align: middle; }
        .bookings-table tbody tr { transition: background 0.15s; }
        .bookings-table tbody tr:hover { background: #f8f9fb; }
        .bookings-table tbody tr:last-child td { border-bottom: none; }
        
        .booking-code { font-weight: 700; color: #667eea; font-size: 0.8rem; font-family: 'Courier New', monospace; display: inline-block; padding: 2px 6px; background: #f0f4ff; border-radius: 4px; }
        .customer-name { font-weight: 600; color: #1e293b; font-size: 0.9rem; }
        .customer-email { color: #64748b; font-size: 0.75rem; margin-top: 2px; }
        
        .status-badge { display: inline-block; padding: 3px 10px; border-radius: 12px; font-weight: 600; font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.3px; }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-confirmed { background: #d1fae5; color: #065f46; }
        .status-completed { background: #dbeafe; color: #1e40af; }
        .status-cancelled { background: #fee2e2; color: #991b1b; }
        .status-Cancelled { background: #fee2e2; color: #991b1b; }
        
        .payment-badge { display: inline-block; padding: 3px 8px; border-radius: 10px; font-size: 0.7rem; font-weight: 600; }
        .payment-unpaid { background: #fef3c7; color: #92400e; }
        .payment-partial { background: #dbeafe; color: #1e40af; }
        .payment-paid { background: #d1fae5; color: #065f46; }
        
        .btn-action-group { display: flex; gap: 4px; }
        .btn-xs { padding: 4px 8px; font-size: 0.75rem; border-radius: 6px; font-weight: 500; }
        .btn-view { background: #667eea; color: white; border: none; }
        .btn-view:hover { background: #5568d3; }
        .btn-approve { background: #10b981; color: white; border: none; }
        .btn-approve:hover { background: #059669; }
        .btn-reject { background: #f59e0b; color: white; border: none; }
        .btn-reject:hover { background: #d97706; }
        .btn-delete { background: #ef4444; color: white; border: none; }
        .btn-delete:hover { background: #dc2626; }
        
        .empty-state { text-align: center; padding: 40px; color: #94a3b8; background: white; border-radius: 12px; }
        .empty-state i { font-size: 2.5rem; margin-bottom: 8px; color: #cbd5e1; }
        
        .info-compact { font-size: 0.8rem; color: #64748b; }
        .info-compact strong { color: #1e293b; }
    </style>
</head>
<body>
    <div class="container-fluid p-4">
        <!-- Header -->
        <div class="admin-header">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h4><i class="bi bi-journal-text"></i> Catatan Tamu & Booking</h4>
                    <small>Menampilkan <?= $total_bookings ?> booking terbaru</small>
                </div>
                <?php if($pending_count > 0): ?>
                    <span class="notification-badge"><?= $pending_count ?></span>
                <?php endif; ?>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <button class="filter-tab active" onclick="filterBookings('all')">
                Semua <span class="badge"><?= $total_bookings ?></span>
            </button>
            <button class="filter-tab" onclick="filterBookings('pending')">
                Belum Bayar <?php if($pending_count > 0): ?><span class="badge"><?= $pending_count ?></span><?php endif; ?>
            </button>
            <button class="filter-tab" onclick="filterBookings('confirmed')">Confirmed</button>
            <button class="filter-tab" onclick="filterBookings('completed')">Completed</button>
            <button class="filter-tab" onclick="filterBookings('cancelled')">Cancelled</button>
        </div>

        <!-- Booking Table -->
        <div class="bookings-table">
            <?php if(!empty($bookings)): ?>
                <table>
                    <thead>
                        <tr>
                            <th style="width: 120px;">Booking Code</th>
                            <th>Nama Tamu</th>
                            <th style="width: 100px;">Tgl Booking</th>
                            <th style="text-align: center; width: 80px;">Jumlah</th>
                            <th style="text-align: right; width: 130px;">Total Harga</th>
                            <th style="text-align: center; width: 120px;">Status Booking</th>
                            <th style="text-align: center; width: 120px;">Pembayaran</th>
                            <th style="text-align: center; width: 140px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($bookings as $booking): ?>
                            <tr data-status="<?= strtolower($booking['status']) ?>">
                                <td>
                                    <span class="booking-code"><?= $booking['booking_code'] ?></span>
                                </td>
                                <td>
                                    <div class="customer-name"><?= $booking['customer_name'] ?></div>
                                    <div class="customer-email"><?= $booking['customer_email'] ?></div>
                                </td>
                                <td>
                                    <small><?= date('d M Y', strtotime($booking['travel_date'])) ?></small>
                                </td>
                                <td style="text-align: center;">
                                    <strong><?= $booking['num_people'] ?> org</strong>
                                </td>
                                <td style="text-align: right;">
                                    <strong style="color: #10b981;">Rp <?= number_format($booking['total_price'], 0, ',', '.') ?></strong>
                                </td>
                                <td style="text-align: center;">
                                    <span class="status-badge status-<?= strtolower($booking['status']) ?>">
                                        <?= ucfirst($booking['status']) ?>
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <?php
                                    $paymentStatus = $booking['payment_status'] ?? 'unpaid';
                                    $paymentLabels = [
                                        'unpaid' => 'Belum Bayar',
                                        'partial' => 'Sebagian',
                                        'paid' => 'Lunas'
                                    ];
                                    ?>
                                    <span class="payment-badge payment-<?= $paymentStatus ?>">
                                        <?= $paymentLabels[$paymentStatus] ?? 'Unknown' ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-action-group">
                                        <a href="<?= base_url('admin/booking/' . $booking['id']) ?>" class="btn btn-xs btn-view" title="Lihat Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <?php if(strtolower($booking['status']) === 'pending'): ?>
                                            <button class="btn btn-xs btn-approve" onclick="approveBooking(<?= $booking['id'] ?>)" title="Setujui">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                            <button class="btn btn-xs btn-reject" onclick="rejectBooking(<?= $booking['id'] ?>)" title="Tolak">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        <?php endif; ?>
                                        <?php if(strtolower($booking['status']) === 'cancelled'): ?>
                                            <button class="btn btn-xs btn-delete" onclick="deleteBooking(<?= $booking['id'] ?>)" title="Hapus Permanen">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-state">
                    <i class="bi bi-inbox"></i>
                    <p>Tidak ada booking saat ini</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function filterBookings(status) {
            // Update active tab
            document.querySelectorAll('.filter-tab').forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');

            // Filter rows
            const rows = document.querySelectorAll('tbody tr[data-status]');
            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                if (status === 'all' || rowStatus === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function approveBooking(bookingId) {
            if (confirm('Setujui booking ini? Booking akan masuk ke dalam perhitungan omset.')) {
                // Use POST form instead of AJAX
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '<?= base_url('admin/approve_booking') ?>';
                
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'booking_id';
                input.value = bookingId;
                
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        }

        function rejectBooking(bookingId) {
            if (confirm('Tolak booking ini? Data akan dihapus permanen dan tidak bisa dikembalikan!')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '<?= base_url('admin/reject_booking') ?>';
                
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'booking_id';
                input.value = bookingId;
                
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        }

        function deleteBooking(bookingId) {
            if (confirm('HAPUS PERMANEN booking ini? Data tidak bisa dikembalikan!')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '<?= base_url('admin/reject_booking') ?>';
                
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'booking_id';
                input.value = bookingId;
                
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>
</html>
