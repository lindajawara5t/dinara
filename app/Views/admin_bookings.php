<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Booking - DINARA Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .admin-header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; margin-bottom: 30px; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        .admin-header h2 { margin: 0; font-weight: 700; }
        .admin-header .notification-badge { background: #ff6b6b; border-radius: 50%; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center; font-weight: 600; margin-left: 10px; }
        .booking-card { background: white; border-radius: 10px; padding: 15px; margin-bottom: 15px; border-left: 4px solid #667eea; transition: all 0.3s; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .booking-card:hover { box-shadow: 0 4px 12px rgba(0,0,0,0.12); }
        .booking-code { font-weight: 700; color: #667eea; font-size: 0.9rem; }
        .customer-name { font-weight: 600; color: #333; }
        .booking-info { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px; margin-top: 10px; font-size: 0.85rem; }
        .info-item { display: flex; flex-direction: column; }
        .info-label { color: #999; font-weight: 500; font-size: 0.75rem; text-transform: uppercase; }
        .info-value { color: #333; font-weight: 600; margin-top: 3px; }
        .status-badge { display: inline-block; padding: 5px 12px; border-radius: 20px; font-weight: 600; font-size: 0.8rem; }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-confirmed { background: #d4edda; color: #155724; }
        .status-completed { background: #cfe2ff; color: #084298; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
        .btn-action { margin-top: 10px; display: flex; gap: 8px; }
        .filter-tabs { display: flex; gap: 10px; margin-bottom: 20px; }
        .filter-tab { padding: 8px 15px; border-radius: 20px; background: #e9ecef; border: none; cursor: pointer; font-weight: 500; transition: all 0.3s; }
        .filter-tab.active { background: #667eea; color: white; }
        .empty-state { text-align: center; padding: 40px; color: #999; }
        .empty-state i { font-size: 3rem; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container-fluid p-4">
        <!-- Header -->
        <div class="admin-header">
            <div style="display: flex; align-items: center;">
                <div>
                    <h2><i class="bi bi-journal-text"></i> Manajemen Booking</h2>
                    <small>Kelola semua reservasi pelanggan</small>
                </div>
                <?php if($pending_count > 0): ?>
                    <div class="notification-badge ms-auto"><?= $pending_count ?></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <button class="filter-tab active" onclick="filterBookings('all')">Semua (<?= $total_bookings ?>)</button>
            <button class="filter-tab" onclick="filterBookings('pending')">Menunggu Approval <span style="background: #ff6b6b; color: white; padding: 0px 6px; border-radius: 10px; font-size: 0.8rem; margin-left: 5px;"><?= $pending_count ?></span></button>
            <button class="filter-tab" onclick="filterBookings('confirmed')">Dikonfirmasi</button>
            <button class="filter-tab" onclick="filterBookings('completed')">Selesai</button>
            <button class="filter-tab" onclick="filterBookings('cancelled')">Batal</button>
        </div>

        <!-- Booking List -->
        <div id="bookings-container">
            <?php if(!empty($bookings)): ?>
                <?php foreach($bookings as $booking): ?>
                    <div class="booking-card" data-status="<?= $booking['status'] ?>">
                        <div style="display: grid; grid-template-columns: 1fr auto; gap: 15px; align-items: start;">
                            <div>
                                <div class="booking-code"><?= $booking['booking_code'] ?></div>
                                <div class="customer-name"><?= $booking['customer_name'] ?></div>
                                <div class="booking-info">
                                    <div class="info-item">
                                        <span class="info-label">📅 Tanggal Liburan</span>
                                        <span class="info-value"><?= date('d M Y', strtotime($booking['travel_date'])) ?></span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">👥 Peserta</span>
                                        <span class="info-value"><?= $booking['num_people'] ?> Orang <?php if($booking['num_children'] > 0): ?>(+<?= $booking['num_children'] ?> anak)<?php endif; ?></span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">💰 Total</span>
                                        <span class="info-value">Rp <?= number_format($booking['total_price']) ?></span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">📞 Kontak</span>
                                        <span class="info-value"><?= $booking['customer_phone'] ?></span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">📧 Email</span>
                                        <span class="info-value" style="font-size: 0.75rem;"><?= $booking['customer_email'] ?></span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Status</span>
                                        <span class="status-badge status-<?= $booking['status'] ?>"><?= ucfirst($booking['status']) ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-action">
                                <a href="<?= base_url('admin/booking/' . $booking['id']) ?>" class="btn btn-sm btn-primary">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <?php if($booking['status'] === 'pending'): ?>
                                    <button class="btn btn-sm btn-success" onclick="approveBooking(<?= $booking['id'] ?>)">
                                        <i class="bi bi-check-circle"></i> Setujui
                                    </button>
                                    <button class="btn btn-sm btn-danger" onclick="rejectBooking(<?= $booking['id'] ?>)">
                                        <i class="bi bi-x-circle"></i> Tolak
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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

            // Filter cards
            const cards = document.querySelectorAll('.booking-card');
            cards.forEach(card => {
                if (status === 'all' || card.getAttribute('data-status') === status) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function approveBooking(bookingId) {
            if (confirm('Setujui booking ini?')) {
                fetch('<?= base_url('admin/booking/update-status') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        booking_id: bookingId,
                        status: 'confirmed'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Booking berhasil disetujui!');
                        location.reload();
                    } else {
                        alert('Error: ' + (data.message || 'Gagal update status'));
                    }
                })
                .catch(err => alert('Error: ' + err));
            }
        }

        function rejectBooking(bookingId) {
            if (confirm('Tolak booking ini?')) {
                fetch('<?= base_url('admin/booking/update-status') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        booking_id: bookingId,
                        status: 'cancelled'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Booking berhasil ditolak!');
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
