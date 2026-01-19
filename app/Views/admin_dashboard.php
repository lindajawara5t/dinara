<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Office - Dinara Travel</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', sans-serif; overflow-x: hidden; }
        
        /* SIDEBAR STYLE */
        .sidebar { min-height: 100vh; background: #2c3e50; color: white; padding-top: 20px; position: fixed; width: 250px; z-index: 1000; }
        .sidebar-brand { font-size: 1.3rem; font-weight: 800; text-align: center; margin-bottom: 40px; display: block; color: #ecf0f1; text-decoration: none; letter-spacing: 1px; }
        
        .nav-sidebar .nav-link { color: #bdc3c7; padding: 15px 25px; border-radius: 0; display: flex; align-items: center; transition: 0.3s; font-weight: 500; cursor: pointer; }
        .nav-sidebar .nav-link:hover, .nav-sidebar .nav-link.active { background: #34495e; color: #fff; border-left: 5px solid #3498db; padding-left: 20px; }
        .nav-sidebar .nav-link i { margin-right: 12px; font-size: 1.1rem; width: 25px; text-align: center; }
        
        /* MAIN CONTENT STYLE */
        .main-content { margin-left: 250px; padding: 30px; }
        
        /* CARDS */
        .card-stat { border: none; border-radius: 15px; padding: 25px; color: white; position: relative; overflow: hidden; height: 100%; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: 0.3s; }
        .bg-omset { background: linear-gradient(135deg, #11998e, #38ef7d); }
        .bg-profit { background: linear-gradient(135deg, #f2994a, #f2c94c); }
        .bg-tamu { background: linear-gradient(135deg, #2980b9, #6dd5fa); }
        .stat-icon { position: absolute; right: 20px; bottom: 20px; font-size: 4rem; opacity: 0.2; }
        
        /* TABS PILL */
        .nav-pills-db .nav-link { border-radius: 50px; font-size: 0.75rem; padding: 5px 14px; margin-right: 4px; color: #555; background: #fff; border: 1px solid #e0e0e0; margin-bottom: 4px; transition: all 0.2s; }
        .nav-pills-db .nav-link:hover { background: #f8f9fa; border-color: #3498db; color: #3498db; }
        .nav-pills-db .nav-link.active { background: linear-gradient(135deg, #2c3e50, #3498db); color: white; border-color: transparent; box-shadow: 0 2px 8px rgba(52,152,219,0.3); }
        
        /* HOMEPAGE SETTINGS TABS - 2 row layout for better visibility */
        #homepageSettingsTab {
            display: flex !important;
            flex-wrap: wrap !important;
            gap: 8px !important;
            margin-bottom: 25px !important;
            width: 100% !important;
            list-style: none !important;
        }
        
        /* All nav items must be visible */
        #homepageSettingsTab .nav-item {
            display: inline-flex !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        
        #homepageSettingsTab .nav-link {
            border-radius: 25px;
            font-size: 0.85rem;
            padding: 10px 18px;
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            color: #6c757d;
            transition: all 0.2s;
            white-space: nowrap;
            flex: 0 1 auto;
            min-width: fit-content;
            display: inline-block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
        #homepageSettingsTab .nav-link:hover {
            background: #e9ecef;
            border-color: #3498db;
            color: #3498db;
            transform: translateY(-2px);
        }
        #homepageSettingsTab .nav-link.active {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border-color: #2980b9;
            box-shadow: 0 4px 12px rgba(52,152,219,0.4);
            transform: translateY(-2px);
        }
        
        /* Jadwal Kapal Tab - FORCE EXTREME VISIBILITY */
        #hp-jadwal-kapal-tab {
            display: inline-block !important;
            visibility: visible !important;
            opacity: 1 !important;
            pointer-events: auto !important;
            height: auto !important;
            width: auto !important;
            max-width: none !important;
            overflow: visible !important;
            clip: auto !important;
            z-index: 10 !important;
            position: relative !important;
        }
        
        /* TAB PANE STYLING */
        .tab-pane {
            animation: fadeIn 0.3s ease-in;
        }
        
        /* SECTIONS VIEW */
        .section-view { display: none; }
        .section-view.active { display: block; animation: fadeIn 0.5s; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        
        /* ELEGANT COMPACT TABLE */
        .table-compact { font-size: 0.75rem; }
        .table-compact th { font-size: 0.68rem; text-transform: uppercase; letter-spacing: 0.5px; color: #6c757d; font-weight: 600; padding: 6px 8px; background: linear-gradient(135deg, #f8f9fa, #e9ecef); border: none; white-space: nowrap; }
        .table-compact td { padding: 5px 8px; vertical-align: middle; border-color: #f0f0f0; }
        .table-compact tbody tr:hover { background: linear-gradient(135deg, #f8f9fa, #fff); }
        .table-compact .badge { font-size: 0.6rem; font-weight: 500; padding: 2px 6px; }
        .table-compact .btn-xs { padding: 2px 5px; font-size: 0.6rem; border-radius: 3px; }
        
        /* ELEGANT FORM */
        .form-elegant { background: linear-gradient(135deg, #ffffff, #f8f9fa); border: 1px solid #e9ecef; border-radius: 10px; }
        .form-elegant .form-control, .form-elegant .form-select { font-size: 0.8rem; padding: 6px 10px; border-radius: 6px; border: 1px solid #e0e0e0; }
        .form-elegant .form-control:focus, .form-elegant .form-select:focus { border-color: #3498db; box-shadow: 0 0 0 2px rgba(52,152,219,0.1); }
        .form-elegant label { font-size: 0.7rem; margin-bottom: 2px; color: #6c757d; }
        
        /* PRICE BADGE */
        .price-badge { font-size: 0.68rem; font-weight: 600; padding: 2px 5px; border-radius: 3px; white-space: nowrap; }
        .price-badge.sell { background: linear-gradient(135deg, #d4edda, #c3e6cb); color: #155724; }
        .price-badge.cost { background: linear-gradient(135deg, #f8d7da, #f5c6cb); color: #721c24; }
        
        /* ACTION BUTTONS - INLINE */
        .btn-action { width: 22px; height: 22px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 4px; font-size: 0.65rem; }
        .action-group { display: flex; gap: 3px; justify-content: center; white-space: nowrap; }
    </style>
</head>
<body>
    <?php 
    // Tentukan tab aktif dari session
    $activeTab = session()->getFlashdata('active_tab') ?? 'dashboard';
    $activePill = session()->getFlashdata('active_pill') ?? '';
    ?>
    
    <div class="sidebar">
        <a href="#" class="sidebar-brand"><i class="bi bi-airplane-engines-fill text-warning"></i> DINARA ADMIN</a>
        
        <ul class="nav flex-column nav-sidebar">
            <li class="nav-item">
                <a class="nav-link <?= $activeTab === 'dashboard' ? 'active' : '' ?>" onclick="switchMenu('dashboard', this)">
                    <i class="bi bi-grid-1x2-fill"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $activeTab === 'database' ? 'active' : '' ?>" onclick="switchMenu('database', this)">
                    <i class="bi bi-database-fill-gear"></i> Database Wisata
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/bookings') ?>" style="display: flex; align-items: center; justify-content: space-between;">
                    <span><i class="bi bi-journal-text"></i> Manajemen Booking</span>
                    <?php if($chart_pending > 0): ?>
                        <span class="badge bg-danger"><?= $chart_pending ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $activeTab === 'booking' ? 'active' : '' ?>" onclick="switchMenu('booking', this)">
                    <i class="bi bi-journal-text"></i> Catatan Tamu (Legacy)
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('settings/unified') ?>">
                    <i class="bi bi-palette2"></i> Settings Website
                </a>
            </li>

            <li class="nav-item mt-5 pt-5 border-top border-secondary">
                <a href="<?= base_url('/') ?>" target="_blank" class="nav-link text-warning">
                    <i class="bi bi-globe"></i> Lihat Website
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        
        <?php if(session()->getFlashdata('sukses')): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    alert(<?= json_encode(session()->getFlashdata('sukses')) ?>);
                });
            </script>
        <?php endif; ?>
        
        <?php if(session()->getFlashdata('error')): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    alert(<?= json_encode(session()->getFlashdata('error')) ?>);
                });
            </script>
        <?php endif; ?>
        <div id="view-dashboard" class="section-view <?= $activeTab === 'dashboard' ? 'active' : '' ?>">
            <h3 class="fw-bold text-secondary mb-4">Ringkasan Bisnis</h3>
            <div class="row g-4 mb-4">
                <div class="col-md-4"><div class="card-stat bg-omset"><small class="text-uppercase fw-bold opacity-75">Total Omset</small><h2 class="fw-bold mb-0">Rp <?= number_format($total_omset ?? 0) ?></h2><i class="bi bi-wallet2 stat-icon"></i></div></div>
                <div class="col-md-4"><div class="card-stat bg-profit"><small class="text-uppercase fw-bold opacity-75">Keuntungan Bersih</small><h2 class="fw-bold mb-0">Rp <?= number_format($total_laba ?? 0) ?></h2><i class="bi bi-graph-up-arrow stat-icon"></i></div></div>
                <div class="col-md-4"><div class="card-stat bg-tamu"><small class="text-uppercase fw-bold opacity-75">Total Tamu</small><h2 class="fw-bold mb-0"><?= number_format($total_tamu ?? 0) ?> <span class="fs-6">Orang</span></h2><i class="bi bi-people-fill stat-icon"></i></div></div>
            </div>
            <div class="row">
                <div class="col-md-4"><div class="card border-0 shadow-sm p-3 h-100"><h6 class="fw-bold mb-3 text-secondary">Statistik Status Booking</h6><div style="height: 250px; display: flex; justify-content: center;"><canvas id="tamuChart"></canvas></div></div></div>
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm p-3 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold text-secondary m-0">Booking Terakhir Masuk</h6>
                            <button class="btn btn-sm btn-outline-primary" onclick="switchMenu('booking', document.querySelectorAll('.nav-sidebar .nav-link')[2])">Lihat Semua</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light"><tr><th>Kode</th><th>Tamu</th><th>Tanggal</th><th>Profit</th><th>Status</th><th>Aksi</th></tr></thead>
                                <tbody>
                                    <?php if(!empty($booking_list)): foreach($booking_list as $b): ?>
                                    <tr>
                                        <td><span class="badge bg-light text-dark border"><?= $b['booking_code'] ?></span></td>
                                        <td class="fw-bold"><?= $b['customer_name'] ?></td>
                                        <td><?= $b['travel_date'] ?></td>
                                        <td class="text-success fw-bold">Rp <?= number_format($b['profit'] ?? 0) ?></td>
                                        <td><span class="badge bg-<?= ($b['status']=='confirmed'?'success':($b['status']=='pending'?'warning':'danger')) ?>"><?= strtoupper($b['status']) ?></span></td>
                                        <td><a href="<?= base_url('admin/booking_detail/'.$b['id']) ?>" class="btn btn-sm btn-primary">Kelola</a></td>
                                    </tr>
                                    <?php endforeach; else: ?><tr><td colspan="6" class="text-center text-muted py-4">Belum ada booking masuk.</td></tr><?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="view-database" class="section-view <?= $activeTab === 'database' ? 'active' : '' ?>">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div><h5 class="fw-bold text-secondary m-0"><i class="bi bi-database-fill text-primary"></i> Database Wisata</h5></div>
                <button class="btn btn-success btn-sm fw-bold px-3" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="bi bi-plus-lg me-1"></i> Tambah</button>
            </div>

            <div class="card border-0 shadow-sm p-2">
                <ul class="nav nav-pills nav-pills-db mb-2" id="pills-tab" role="tablist">
                    <li class="nav-item"><button class="nav-link <?= (!$activePill || $activePill === 'tab-hotel') ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-hotel"><i class="bi bi-building"></i> Hotel</button></li>
                    <li class="nav-item"><button class="nav-link <?= $activePill === 'tab-wisata-darat' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-wisata-darat"><i class="bi bi-tree"></i> W.Darat</button></li>
                    <li class="nav-item"><button class="nav-link <?= $activePill === 'tab-wisata-laut' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-wisata-laut"><i class="bi bi-water"></i> W.Laut</button></li>
                    <li class="nav-item"><button class="nav-link <?= $activePill === 'tab-konsumsi' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-konsumsi"><i class="bi bi-cup-hot"></i> Konsumsi</button></li>
                    <li class="nav-item"><button class="nav-link <?= $activePill === 'tab-itinerary' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-itinerary"><i class="bi bi-calendar3"></i> Itinerary</button></li>
                    <li class="nav-item"><button class="nav-link <?= $activePill === 'tab-darat' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-darat"><i class="bi bi-bus-front"></i> Shuttle</button></li>
                    <li class="nav-item"><button class="nav-link <?= $activePill === 'tab-laut' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-laut"><i class="bi bi-ship"></i> Kapal</button></li>
                    <li class="nav-item"><button class="nav-link <?= $activePill === 'tab-pesawat' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-pesawat"><i class="bi bi-airplane"></i> Pesawat</button></li>
                    <li class="nav-item"><button class="nav-link <?= $activePill === 'tab-kdarat' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-kdarat"><i class="bi bi-car-front"></i> Trans.KJ</button></li>
                    <li class="nav-item"><button class="nav-link <?= $activePill === 'tab-rental' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-rental"><i class="bi bi-bicycle"></i> Rental</button></li>
                    <li class="nav-item"><button class="nav-link <?= $activePill === 'tab-guide' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-guide"><i class="bi bi-person-badge"></i> Guide</button></li>
                    <li class="nav-item"><button class="nav-link <?= $activePill === 'tab-fasilitas' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-fasilitas"><i class="bi bi-gear"></i> Fasilitas</button></li>
                    <li class="nav-item"><button class="nav-link <?= $activePill === 'tab-kota' ? 'active' : '' ?>" data-bs-toggle="pill" data-bs-target="#tab-kota"><i class="bi bi-geo-alt"></i> Lokasi</button></li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade <?= (!$activePill || $activePill === 'tab-hotel') ? 'show active' : '' ?>" id="tab-hotel"><?= renderTable('Hotel & Homestay', $penginapan, true) ?></div>
                    <div class="tab-pane fade <?= $activePill === 'tab-wisata-darat' ? 'show active' : '' ?>" id="tab-wisata-darat"><?= renderWisataTable('Wisata Darat', $wisata_darat ?? [], 'wisata_darat') ?></div>
                    <div class="tab-pane fade <?= $activePill === 'tab-wisata-laut' ? 'show active' : '' ?>" id="tab-wisata-laut"><?= renderWisataTable('Wisata Laut', $wisata_laut ?? [], 'wisata_laut') ?></div>
                    <div class="tab-pane fade <?= $activePill === 'tab-konsumsi' ? 'show active' : '' ?>" id="tab-konsumsi">
                        <div class="mb-4">
                            <form action="<?= base_url('admin/save_konsumsi') ?>" method="POST">
                                <?= csrf_field() ?>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Nama Paket Makanan</label>
                                        <input type="text" class="form-control" name="name" required placeholder="Contoh: Paket Breakfast">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Tipe Konsumsi</label>
                                        <select class="form-control" name="meal_type" required>
                                            <option value="">-- Pilih Tipe --</option>
                                            <option value="breakfast">Pagi (Breakfast)</option>
                                            <option value="lunch">Siang (Lunch)</option>
                                            <option value="dinner">Malam (Dinner)</option>
                                            <option value="snack">Snack</option>
                                            <option value="all">Semua Paket (All)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Harga Per Orang</label>
                                        <input type="number" class="form-control" name="price_per_person" required placeholder="50000">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">&nbsp;</label>
                                        <button type="submit" class="btn btn-primary fw-bold w-100">
                                            <i class="bi bi-plus-lg me-2"></i>Tambah Konsumsi
                                        </button>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Deskripsi</label>
                                        <textarea class="form-control" name="description" rows="2" placeholder="Contoh: Menu nasi goreng, soto ayam, minuman segar"></textarea>
                                    </div>
                                </div>
                            </form>
                            <hr>
                        </div>

                        <!-- DAFTAR KONSUMSI -->
                        <h6 class="fw-bold mb-3"><i class="bi bi-list-ul me-2"></i>Paket Konsumsi yang Tersedia</h6>
                        <?= renderKonsumsiTable('Konsumsi/Paket Makanan', $konsumsi ?? []) ?>
                    </div>
                    <div class="tab-pane fade <?= $activePill === 'tab-itinerary' ? 'show active' : '' ?>" id="tab-itinerary"><?= renderItineraryTable('Itinerary Perjalanan', $itinerary ?? []) ?></div>
                    <div class="tab-pane fade <?= $activePill === 'tab-darat' ? 'show active' : '' ?>" id="tab-darat"><?= renderTable('Shuttle Jepara', $darat, false) ?></div>
                    <div class="tab-pane fade <?= $activePill === 'tab-laut' ? 'show active' : '' ?>" id="tab-laut"><?= renderTable('Tiket Kapal', $laut, false) ?></div>
                    
                    <!-- TAB PESAWAT -->
                    <div class="tab-pane fade <?= $activePill === 'tab-pesawat' ? 'show active' : '' ?>" id="tab-pesawat">
                        <div class="mb-4">
                            <form action="<?= base_url('admin/simpan_tiket_pesawat') ?>" method="POST">
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Maskapai/Nama Pesawat</label>
                                        <input type="text" class="form-control" name="nama_maskapai" required placeholder="Contoh: Batik Air Charter">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold">Rute</label>
                                        <input type="text" class="form-control" name="rute" required placeholder="Contoh: Semarang → Karimunjawa">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label fw-bold">Harga</label>
                                        <input type="number" class="form-control" name="harga" required placeholder="2500000">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label fw-bold">Status</label>
                                        <select class="form-control" name="is_active" required>
                                            <option value="1">Aktif</option>
                                            <option value="0">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold">Deskripsi</label>
                                        <textarea class="form-control" name="deskripsi" rows="2" placeholder="Contoh: Charter Pesawat: Lebih cepat dan nyaman"></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary fw-bold">
                                    <i class="bi bi-plus-lg me-2"></i>Tambah Tiket Pesawat
                                </button>
                            </form>
                            <hr>
                        </div>

                        <!-- DAFTAR TIKET PESAWAT -->
                        <h6 class="fw-bold mb-3"><i class="bi bi-list-ul me-2"></i>Tiket Pesawat yang Tersedia</h6>
                        <div class="table-responsive">
                            <table class="table table-hover border">
                                <thead class="table-light">
                                    <tr>
                                        <th width="20%">Maskapai</th>
                                        <th width="20%">Rute</th>
                                        <th width="15%">Harga</th>
                                        <th width="15%">Status</th>
                                        <th width="20%">Deskripsi</th>
                                        <th width="10%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $db = \Config\Database::connect();
                                        if ($db->tableExists('tiket_pesawat')) {
                                            $pesawats = $db->table('tiket_pesawat')->orderBy('harga', 'ASC')->get()->getResultArray();
                                            if (!empty($pesawats)) {
                                                foreach($pesawats as $pesawat):
                                    ?>
                                    <tr>
                                        <td><strong><?= esc($pesawat['nama_maskapai']) ?></strong></td>
                                        <td><?= esc($pesawat['rute']) ?></td>
                                        <td><strong>Rp <?= number_format($pesawat['harga'], 0, ',', '.') ?></strong></td>
                                        <td>
                                            <span class="badge bg-<?= ($pesawat['is_active'] ? 'success' : 'danger') ?>">
                                                <?= ($pesawat['is_active'] ? 'Aktif' : 'Tidak Aktif') ?>
                                            </span>
                                        </td>
                                        <td><?= esc($pesawat['deskripsi'] ?? '-') ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/delete_tiket_pesawat/' . $pesawat['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                    <?php 
                                                endforeach;
                                            } else {
                                    ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox"></i> Belum ada tiket pesawat. Silakan tambahkan di atas.
                                        </td>
                                    </tr>
                                    <?php 
                                            }
                                        } else {
                                    ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox"></i> Tabel tiket pesawat belum ada.
                                        </td>
                                    </tr>
                                    <?php 
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade <?= $activePill === 'tab-kdarat' ? 'show active' : '' ?>" id="tab-kdarat"><?= renderTable('Transport Karimun', $karimun_darat, false) ?></div>
                    <div class="tab-pane fade <?= $activePill === 'tab-rental' ? 'show active' : '' ?>" id="tab-rental"><?= renderTable('Rental Motor/Mobil', $rental, false) ?></div>
                    <div class="tab-pane fade <?= $activePill === 'tab-guide' ? 'show active' : '' ?>" id="tab-guide"><?= renderTable('Guide', $guide, false) ?></div>
                    <div class="tab-pane fade <?= $activePill === 'tab-fasilitas' ? 'show active' : '' ?>" id="tab-fasilitas"><?= renderTable('Fasilitas', $fasilitas, false) ?></div>
                    
                    <div class="tab-pane fade <?= $activePill === 'tab-kota' ? 'show active' : '' ?>" id="tab-kota">
                        <div class="row g-3">
                            <!-- FORM TAMBAH DENGAN PETA -->
                            <div class="col-lg-5">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-gradient py-2" style="background: linear-gradient(135deg, #2c3e50, #3498db);">
                                        <h6 class="m-0 text-white small"><i class="bi bi-geo-alt-fill"></i> Tambah Titik Lokasi</h6>
                                    </div>
                                    <div class="card-body p-2">
                                        <!-- Mini Map untuk pick koordinat -->
                                        <div id="pickMap" style="height: 180px; border-radius: 8px; border: 2px solid #e9ecef;"></div>
                                        <div class="text-center mt-1">
                                            <small class="text-muted" style="font-size: 0.65rem;"><i class="bi bi-hand-index"></i> Klik peta untuk pilih lokasi</small>
                                        </div>
                                        
                                        <form action="<?= base_url('admin/simpan_kota') ?>" method="post" class="mt-2">
                                            <div class="mb-2">
                                                <input type="text" name="name" id="pick_name" class="form-control form-control-sm" placeholder="Nama Lokasi (cth: Stasiun Semarang)" required>
                                            </div>
                                            <div class="row g-1 mb-2">
                                                <div class="col-6">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text" style="font-size:0.65rem;">Lat</span>
                                                        <input type="text" name="lat" id="pick_lat" class="form-control form-control-sm" placeholder="-6.xxx" required readonly>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text" style="font-size:0.65rem;">Lng</span>
                                                        <input type="text" name="lng" id="pick_lng" class="form-control form-control-sm" placeholder="110.xxx" required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm w-100"><i class="bi bi-plus-lg"></i> Simpan Lokasi</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- TABEL DAFTAR LOKASI -->
                            <div class="col-lg-7">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header bg-light py-2 d-flex justify-content-between align-items-center">
                                        <span class="small fw-bold text-secondary"><i class="bi bi-list-ul"></i> Daftar Titik Jemput</span>
                                        <span class="badge bg-primary"><?= count($list_kota ?? []) ?> lokasi</span>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="table-responsive" style="max-height: 280px; overflow-y: auto;">
                                            <table class="table table-compact mb-0">
                                                <thead style="position: sticky; top: 0; z-index: 1;">
                                                    <tr><th>Lokasi</th><th>Koordinat</th><th class="text-center">Aksi</th></tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    $seen = [];
                                                    if(!empty($list_kota)): 
                                                        foreach($list_kota as $k): 
                                                            // Skip duplicate berdasarkan nama
                                                            $key = strtolower(trim($k['name']));
                                                            if(isset($seen[$key])) continue;
                                                            $seen[$key] = true;
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <span class="fw-semibold"><?= esc($k['name']) ?></span>
                                                        </td>
                                                        <td>
                                                            <code style="font-size: 0.65rem; background: #f8f9fa; padding: 2px 4px; border-radius: 3px;">
                                                                <?= number_format((float)$k['lat'], 5) ?>, <?= number_format((float)$k['lng'], 5) ?>
                                                            </code>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="action-group">
                                                                <button type="button" class="btn btn-info btn-action text-white" onclick="viewOnMap(<?= $k['lat'] ?>, <?= $k['lng'] ?>, '<?= esc($k['name']) ?>')" title="Lihat di Peta"><i class="bi bi-eye"></i></button>
                                                                <a href="<?= base_url('admin/hapus_kota/'.$k['id']) ?>" class="btn btn-outline-danger btn-action" onclick="return confirm('Hapus lokasi ini?')" title="Hapus"><i class="bi bi-trash"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; endif; ?>
                                                    <?php if(empty($list_kota)): ?>
                                                    <tr><td colspan="3" class="text-center py-3 text-muted small"><i class="bi bi-inbox"></i> Belum ada lokasi</td></tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="view-booking" class="section-view <?= $activeTab === 'booking' ? 'active' : '' ?>">
            <h3 class="fw-bold text-secondary mb-4">Catatan Tamu & Booking</h3>
            
            <div class="card border-0 shadow-sm p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold text-primary m-0">Daftar Booking</h5>
                    <input type="text" class="form-control form-control-sm" style="width: 200px;" placeholder="Cari booking code atau nama...">
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th width="120">Booking Code</th>
                                <th>Nama Tamu</th>
                                <th>Email</th>
                                <th width="120">Tgl Booking</th>
                                <th width="100">Jumlah</th>
                                <th width="130">Total Harga</th>
                                <th width="120">Status Booking</th>
                                <th width="120">Pembayaran</th>
                                <th width="100">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($booking_list)): foreach($booking_list as $b): ?>
                            <tr>
                                <td><code style="background: #f0f0f0; padding: 4px 8px; border-radius: 4px;"><?= esc($b['booking_code']) ?></code></td>
                                <td><strong><?= esc($b['customer_name']) ?></strong></td>
                                <td><small><?= esc($b['customer_email']) ?></small></td>
                                <td><small><?= date('d M Y', strtotime($b['created_at'])) ?></small></td>
                                <td class="text-center"><strong><?= $b['num_people'] ?> orang</strong></td>
                                <td class="fw-bold text-success">Rp <?= number_format($b['total_price'], 0, ',', '.') ?></td>
                                <td>
                                    <?php
                                    $statusColor = ['pending' => '#FFA500', 'confirmed' => '#0dcaf0', 'completed' => '#10b981', 'cancelled' => '#e74c3c'];
                                    $statusText = ['pending' => 'Pending', 'confirmed' => 'Confirmed', 'completed' => 'Completed', 'cancelled' => 'Cancelled'];
                                    $status = strtolower($b['status']);
                                    ?>
                                    <span style="background: <?= $statusColor[$status] ?? '#999' ?>; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: bold;">
                                        <?= $statusText[$status] ?? 'Unknown' ?>
                                    </span>
                                </td>
                                <td>
                                    <?php
                                    $paymentStatus = strtolower($b['payment_status']);
                                    $paymentColors = ['unpaid' => '#fbbf24', 'partial' => '#60a5fa', 'paid' => '#34d399'];
                                    ?>
                                    <span style="background: <?= $paymentColors[$paymentStatus] ?? '#999' ?>; color: <?= $paymentStatus === 'paid' ? '#065f46' : '#333' ?>; padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: bold;">
                                        <?php
                                        $paymentLabels = ['unpaid' => 'Belum Bayar', 'partial' => 'Sebagian', 'paid' => 'Sudah Bayar'];
                                        echo $paymentLabels[$paymentStatus] ?? 'Unknown';
                                        ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="viewBookingDetail(<?= $b['id'] ?>)" title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" onclick="managePayment(<?= $b['id'] ?>)" title="Kelola Pembayaran">
                                        <i class="bi bi-cash-coin"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox" style="font-size: 2rem;"></i><br>
                                    <small>Belum ada booking</small>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <small class="text-muted">Menampilkan <?= count($booking_list) ?> booking terbaru</small>
                    <a href="<?= base_url('admin/bookings') ?>" class="btn btn-sm btn-primary">Lihat Semua Booking</a>
                </div>
            </div>
        </div>

        <div id="view-website" class="section-view <?= $activeTab === 'website' ? 'active' : '' ?>">
            <h3 class="fw-bold text-secondary mb-4">Pengaturan Website & Promo</h3>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="card p-4 border-0 shadow-sm mb-4">
                        <h6 class="fw-bold text-primary mb-3">Tampilan Header Utama</h6>
                        <form method="POST" enctype="multipart/form-data" id="formUpdateSettings" action="<?= base_url('admin/update_settings') ?>">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label class="small fw-bold">Judul Besar</label>
                                <input type="text" name="hero_title" class="form-control" value="<?= htmlspecialchars($settings['hero_title'] ?? '') ?>">
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold">Running Text Info</label>
                                <textarea name="announcement" class="form-control" rows="2"><?= htmlspecialchars($settings['announcement'] ?? '') ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold">Gambar Background (PC)</label>
                                <input type="file" name="hero_image" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold text-success">Gambar Background (HP)</label>
                                <input type="file" name="hero_image_mobile" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold">Logo Website</label>
                                <input type="file" name="logo_image" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 fw-bold">Simpan Tampilan</button>
                        </form>
                    </div>
                    
                    <div class="alert alert-danger shadow-sm">
                        <h6 class="fw-bold text-danger"><i class="bi bi-exclamation-triangle-fill"></i> Reset Pabrik</h6>
                        <p class="small text-muted mb-2">Hati-hati! Data yang dihapus tidak bisa dikembalikan.</p>
                        <form action="<?= base_url('admin/reset_data') ?>" method="post" onsubmit="return confirm('ANDA YAKIN? SEMUA DATA AKAN HILANG PERMANEN!');">
                            <select name="reset_mode" class="form-select form-select-sm border-danger text-danger fw-bold mb-2">
                                <option value="" disabled selected>-- Pilih Opsi Reset --</option>
                                <option value="tamu">Hapus Data Tamu & Keuangan</option>
                                <option value="produk">Hapus Database Produk</option>
                                <option value="all">HAPUS SEMUA (RESET TOTAL)</option>
                            </select>
                            <button class="btn btn-danger btn-sm w-100 fw-bold">RESET SEKARANG</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card p-4 border-0 shadow-sm">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold text-success m-0"><i class="bi bi-megaphone-fill"></i> Konten Promo / Artikel</h6>
                        </div>
                        
                        <div class="bg-light p-3 rounded mb-4 border">
                            <h6 class="small fw-bold text-muted mb-2">Tambah Promo Baru</h6>
                            <form action="<?= base_url('admin/simpan_konten') ?>" method="post" enctype="multipart/form-data">
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <input type="text" name="title" class="form-control form-control-sm" placeholder="Judul Promo" required>
                                        <input type="file" name="image" class="form-control form-control-sm mt-2" required>
                                    </div>
                                    <div class="col-md-6">
                                        <textarea name="description" class="form-control form-control-sm h-100" placeholder="Deskripsi singkat promo..."></textarea>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-success btn-sm w-100 h-100 fw-bold">Upload</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light"><tr><th width="80">Gambar</th><th>Judul & Deskripsi</th><th class="text-end">Aksi</th></tr></thead>
                                <tbody>
                                    <?php if(!empty($konten_promo)): foreach($konten_promo as $p): ?>
                                    <tr>
                                        <td><?php if(!empty($p['image'])): ?><img src="<?= base_url('uploads/content/'.$p['image']) ?>" style="width:60px; height:45px; object-fit:cover; border-radius:6px;"><?php else: ?><span class="text-muted small">Tidak ada</span><?php endif; ?></td>
                                        <td>
                                            <div class="fw-bold text-dark"><?= esc($p['title'] ?? 'Untitled') ?></div>
                                            <div class="text-muted small text-truncate" style="max-width: 350px;"><?= esc($p['description'] ?? '') ?></div>
                                        </td>
                                        <td class="text-end">
                                            <a href="<?= base_url('admin/hapus_konten/'.$p['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus promo ini?')"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; else: ?>
                                    <tr><td colspan="3" class="text-center text-muted py-4">Belum ada promo yang ditampilkan.</td></tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== SETTINGS HOME PAGE SECTION ==================== -->
        <div id="view-settings_homepage" class="section-view <?= $activeTab === 'settings_homepage' ? 'active' : '' ?>">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-secondary mb-0"><i class="bi bi-house-gear-fill text-primary"></i> Settings Home Page</h3>
            </div>
            
            <!-- TAB NAVIGATION -->
            <ul class="nav nav-pills mb-4" id="homepageSettingsTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="hp-general-tab" data-bs-toggle="pill" data-bs-target="#hp-general" type="button">
                        <i class="bi bi-gear me-1"></i> General
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="hp-karimunjawa-tab" data-bs-toggle="pill" data-bs-target="#hp-karimunjawa" type="button">
                        <i class="bi bi-geo-alt me-1"></i> Tentang Karimunjawa
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="hp-info-tab" data-bs-toggle="pill" data-bs-target="#hp-info" type="button">
                        <i class="bi bi-info-circle me-1"></i> Info Penting
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="hp-promo-banner-tab" data-bs-toggle="pill" data-bs-target="#hp-promo-banner" type="button">
                        <i class="bi bi-megaphone me-1"></i> Promo Banner
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="hp-promo-tab" data-bs-toggle="pill" data-bs-target="#hp-promo" type="button">
                        <i class="bi bi-tag me-1"></i> Promo Cards
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="hp-flyer-tab" data-bs-toggle="pill" data-bs-target="#hp-flyer" type="button">
                        <i class="bi bi-images me-1"></i> Flyer
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="hp-gallery-tab" data-bs-toggle="pill" data-bs-target="#hp-gallery" type="button">
                        <i class="bi bi-camera me-1"></i> Gallery
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="hp-jadwal-kapal-tab" data-bs-toggle="pill" data-bs-target="#hp-jadwal-kapal" type="button">
                        <i class="bi bi-calendar-event me-1"></i> Jadwal Kapal
                    </button>
                </li>
            </ul>

            <!-- TAB CONTENT -->
            <div class="tab-content" id="homepageSettingsTabContent">
                <!-- GENERAL SETTINGS -->
                <div class="tab-pane fade show active" id="hp-general" role="tabpanel">
                    <form action="<?= base_url('settings/save-homepage') ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="section" value="general">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-header py-2" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                        <h6 class="mb-0 small"><i class="bi bi-card-heading me-2"></i>Header & Branding</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">App Name</label>
                                            <input type="text" class="form-control form-control-sm" name="app_name" value="<?= esc($settings['app_name'] ?? 'Dinara Travel') ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Welcome Text (Header)</label>
                                            <input type="text" class="form-control form-control-sm" name="welcome_text" value="<?= esc($settings['welcome_text'] ?? 'Selamat Datang di Dinara Travel!') ?>">
                                            <small class="text-muted">Teks di header saat Home page aktif</small>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Announcement (Running Text)</label>
                                            <input type="text" class="form-control form-control-sm" name="announcement" value="<?= esc($settings['announcement'] ?? '') ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-header py-2" style="background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%); color: white;">
                                        <h6 class="mb-0 small"><i class="bi bi-image me-2"></i>Hero Section</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Hero Title</label>
                                            <input type="text" class="form-control form-control-sm" name="hero_title" value="<?= esc($settings['hero_title'] ?? 'Hai kamu, mau ke mana?') ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label small fw-bold">Hero Subtitle</label>
                                            <input type="text" class="form-control form-control-sm" name="hero_subtitle" value="<?= esc($settings['hero_subtitle'] ?? '') ?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card border-0 shadow-sm">
                                    <div class="card-header py-2" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white;">
                                        <h6 class="mb-0 small"><i class="bi bi-whatsapp me-2"></i>Kontak WhatsApp</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-0">
                                            <label class="form-label small fw-bold">Nomor WhatsApp</label>
                                            <input type="text" class="form-control form-control-sm" name="whatsapp_number" value="<?= esc($settings['whatsapp_number'] ?? '6281234567890') ?>">
                                            <small class="text-muted">Format: 62812xxxxxxxx</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary fw-bold">
                            <i class="bi bi-check-lg me-2"></i>Simpan General
                        </button>
                    </form>
                </div>

                <!-- TENTANG KARIMUNJAWA -->
                <div class="tab-pane fade" id="hp-karimunjawa" role="tabpanel">
                    <form action="<?= base_url('settings/save-homepage') ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="section" value="karimunjawa">
                        
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header py-2" style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%); color: white;">
                                <h6 class="mb-0 small"><i class="bi bi-geo-alt me-2"></i>Tentang Karimunjawa</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Deskripsi Karimunjawa</label>
                                    <textarea class="form-control form-control-sm" name="about_karimunjawa" rows="3"><?= esc($settings['about_karimunjawa'] ?? 'Karimunjawa adalah kepulauan yang terdiri dari 27 pulau di Laut Jawa...') ?></textarea>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Foto Utama (URL)</label>
                                        <input type="url" class="form-control form-control-sm" name="km_photo_1" value="<?= esc($settings['km_photo_1'] ?? '') ?>" placeholder="https://...">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Foto Kedua (URL)</label>
                                        <input type="url" class="form-control form-control-sm" name="km_photo_2" value="<?= esc($settings['km_photo_2'] ?? '') ?>" placeholder="https://...">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label small fw-bold">Foto Ketiga (URL)</label>
                                        <input type="url" class="form-control form-control-sm" name="km_photo_3" value="<?= esc($settings['km_photo_3'] ?? '') ?>" placeholder="https://...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary fw-bold">
                            <i class="bi bi-check-lg me-2"></i>Simpan Karimunjawa
                        </button>
                    </form>
                </div>

                <!-- INFORMASI PENTING -->
                <div class="tab-pane fade" id="hp-info" role="tabpanel">
                    <form action="<?= base_url('settings/save-homepage') ?>" method="POST">
                        <input type="hidden" name="section" value="info">
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm mb-3">
                                    <div class="card-header py-2" style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%); color: white;">
                                        <h6 class="mb-0 small"><i class="bi bi-ship me-2"></i>Akses Kapal</h6>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control form-control-sm" name="info_kapal" rows="3"><?= esc($settings['info_kapal'] ?? 'Kapal Express Bahari dari Jepara (2 jam)...') ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm mb-3">
                                    <div class="card-header py-2" style="background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%); color: white;">
                                        <h6 class="mb-0 small"><i class="bi bi-calendar-check me-2"></i>Waktu Terbaik</h6>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control form-control-sm" name="info_waktu" rows="3"><?= esc($settings['info_waktu'] ?? 'April-Oktober (musim kemarau)...') ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm mb-3">
                                    <div class="card-header py-2" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white;">
                                        <h6 class="mb-0 small"><i class="bi bi-cash-stack me-2"></i>Biaya Masuk</h6>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control form-control-sm" name="info_biaya" rows="3"><?= esc($settings['info_biaya'] ?? 'Tiket masuk Taman Nasional: Rp 175.000...') ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary fw-bold">
                            <i class="bi bi-check-lg me-2"></i>Simpan Info Penting
                        </button>
                    </form>
                </div>

                <!-- PROMO BANNER -->
                <div class="tab-pane fade" id="hp-promo-banner" role="tabpanel">
                    <form action="<?= base_url('settings/save-homepage') ?>" method="POST">
                        <input type="hidden" name="section" value="promo_banner">
                        
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-header py-3" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white;">
                                        <h6 class="mb-0"><i class="bi bi-megaphone-fill me-2"></i>Promo Banner Pengumuman</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted small mb-3">Banner ini akan ditampilkan di bawah form input di halaman beranda.</p>
                                        
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Teks Promo</label>
                                            <textarea class="form-control" name="promo_banner_text" rows="3" placeholder="Yuk, cek ada promo apa aja yang bisa kamu pakai..."><?= esc($settings['promo_banner_text'] ?? '') ?></textarea>
                                            <small class="text-muted">Isi dengan pesan promo yang ingin ditampilkan</small>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Link Promo</label>
                                            <input type="url" class="form-control" name="promo_banner_link" placeholder="https://..." value="<?= esc($settings['promo_banner_link'] ?? '') ?>">
                                            <small class="text-muted">Kemana link akan diarahkan ketika diklik (contoh: halaman promo, WhatsApp, atau Instagram)</small>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Teks Tombol CTA</label>
                                            <input type="text" class="form-control" name="promo_banner_cta" placeholder="Cek promonya sekarang!" value="<?= esc($settings['promo_banner_cta'] ?? '') ?>">
                                            <small class="text-muted">Teks yang akan ditampilkan pada tombol call-to-action</small>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Icon (Bootstrap Icons)</label>
                                            <input type="text" class="form-control" name="promo_banner_icon" placeholder="bi-megaphone-fill" value="<?= esc($settings['promo_banner_icon'] ?? 'bi-megaphone-fill') ?>">
                                            <small class="text-muted">Nama icon Bootstrap Icons (cek di <a href="https://icons.getbootstrap.com/" target="_blank">icons.getbootstrap.com</a>)</small>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary fw-bold">
                                    <i class="bi bi-check-lg me-2"></i>Simpan Promo Banner
                                </button>
                            </div>

                            <div class="col-lg-4">
                                <div class="card border-0 shadow-sm bg-light">
                                    <div class="card-header py-3 bg-white">
                                        <h6 class="mb-0 fw-bold">Preview</h6>
                                    </div>
                                    <div class="card-body p-3">
                                        <div style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 8px; padding: 12px 14px; display: flex; align-items: center; gap: 12px;">
                                            <div style="font-size: 22px; color: white; flex-shrink: 0;">
                                                <i class="bi bi-megaphone-fill"></i>
                                            </div>
                                            <div style="flex: 1;">
                                                <p style="color: white; font-size: 13px; margin: 0; line-height: 1.5;">
                                                    Yuk, cek ada promo apa aja yang bisa kamu pakai biar biar pesan tiket pesawat jadi lebih hemat.
                                                    <a href="#" style="color: #fbbf24; font-weight: 600; text-decoration: none; display: inline; margin-left: 4px;">Cek promonya sekarang! →</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- PROMO CARDS -->
                <div class="tab-pane fade" id="hp-promo" role="tabpanel">
                    <form action="<?= base_url('settings/save-homepage') ?>" method="POST">
                        <input type="hidden" name="section" value="promo">
                        
                        <div class="row">
                            <?php for($i = 1; $i <= 3; $i++): ?>
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm mb-3">
                                    <div class="card-header py-2" style="background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%); color: white;">
                                        <h6 class="mb-0 small"><i class="bi bi-tag me-2"></i>Promo Card <?= $i ?></h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-2">
                                            <label class="form-label small fw-bold">Gambar URL</label>
                                            <input type="url" class="form-control form-control-sm" name="promo_<?= $i ?>_image" value="<?= esc($settings["promo_{$i}_image"] ?? '') ?>">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label small fw-bold">Badge</label>
                                            <input type="text" class="form-control form-control-sm" name="promo_<?= $i ?>_badge" value="<?= esc($settings["promo_{$i}_badge"] ?? 'DISKON 20%') ?>">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label small fw-bold">Judul</label>
                                            <input type="text" class="form-control form-control-sm" name="promo_<?= $i ?>_title" value="<?= esc($settings["promo_{$i}_title"] ?? '') ?>">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label small fw-bold">Deskripsi</label>
                                            <textarea class="form-control form-control-sm" name="promo_<?= $i ?>_desc" rows="2"><?= esc($settings["promo_{$i}_desc"] ?? '') ?></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="form-label small fw-bold">Harga Asli</label>
                                                <input type="number" class="form-control form-control-sm" name="promo_<?= $i ?>_price_old" value="<?= esc($settings["promo_{$i}_price_old"] ?? '') ?>">
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label small fw-bold">Harga Promo</label>
                                                <input type="number" class="form-control form-control-sm" name="promo_<?= $i ?>_price_new" value="<?= esc($settings["promo_{$i}_price_new"] ?? '') ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endfor; ?>
                        </div>
                        
                        <button type="submit" class="btn btn-primary fw-bold">
                            <i class="bi bi-check-lg me-2"></i>Simpan Promo Cards
                        </button>
                    </form>
                </div>

                <!-- FLYER PROMO -->
                <div class="tab-pane fade" id="hp-flyer" role="tabpanel">
                    <form action="<?= base_url('settings/save-homepage') ?>" method="POST">
                        <input type="hidden" name="section" value="flyer">
                        
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header py-2" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white;">
                                <h6 class="mb-0 small"><i class="bi bi-images me-2"></i>Flyer Promo (5 Slot)</h6>
                            </div>
                            <div class="card-body">
                                <p class="text-muted small mb-3">Masukkan URL gambar untuk flyer promo yang akan ditampilkan sebagai slider.</p>
                                <div class="row">
                                    <?php for($i = 1; $i <= 5; $i++): ?>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label small fw-bold">Flyer <?= $i ?></label>
                                        <input type="url" class="form-control form-control-sm" name="flyer_<?= $i ?>" value="<?= esc($settings["flyer_{$i}"] ?? '') ?>" placeholder="https://...">
                                    </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary fw-bold">
                            <i class="bi bi-check-lg me-2"></i>Simpan Flyer
                        </button>
                    </form>
                </div>

                <!-- GALLERY -->
                <div class="tab-pane fade" id="hp-gallery" role="tabpanel">
                    <form action="<?= base_url('settings/save-homepage') ?>" method="POST">
                        <input type="hidden" name="section" value="gallery">
                        
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header py-2" style="background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%); color: white;">
                                <h6 class="mb-0 small"><i class="bi bi-camera me-2"></i>Gallery Karimunjawa (8 Foto)</h6>
                            </div>
                            <div class="card-body">
                                <p class="text-muted small mb-3">Masukkan URL gambar untuk gallery foto Karimunjawa.</p>
                                <div class="row">
                                    <?php for($i = 1; $i <= 8; $i++): ?>
                                    <div class="col-md-3 mb-2">
                                        <label class="form-label small fw-bold">Foto <?= $i ?></label>
                                        <input type="url" class="form-control form-control-sm" name="gallery_<?= $i ?>" value="<?= esc($settings["gallery_{$i}"] ?? '') ?>" placeholder="https://...">
                                    </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary fw-bold">
                            <i class="bi bi-check-lg me-2"></i>Simpan Gallery
                        </button>
                    </form>
                </div>

                <!-- JADWAL KAPAL TAB CONTENT -->
                <div class="tab-pane fade" id="hp-jadwal-kapal" role="tabpanel">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header py-3" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); color: white;">
                            <h6 class="mb-0"><i class="bi bi-calendar-event me-2"></i>Kelola Jadwal Keberangkatan Kapal</h6>
                        </div>
                        <div class="card-body">
                            <!-- FORM INPUT JADWAL KAPAL -->
                            <form action="<?= base_url('admin/simpan_jadwal_kapal') ?>" method="POST" id="formJadwalKapal" class="mb-4">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Nama Pelabuhan Asal</label>
                                        <input type="text" class="form-control" name="pelabuhan_asal" placeholder="Contoh: Pelabuhan Jepara" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Nama Kapal</label>
                                        <input type="text" class="form-control" name="nama_kapal" placeholder="Contoh: Express Bahari" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Jam Keberangkatan</label>
                                        <input type="time" class="form-control" name="jam_berangkat" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Waktu Tempuh</label>
                                        <input type="text" class="form-control" name="waktu_tempuh" placeholder="Contoh: 2-2,5 jam" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Harga Tiket (Rp)</label>
                                        <input type="number" class="form-control" name="harga_tiket" placeholder="Contoh: 150000" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Tipe Kapal</label>
                                        <select class="form-control" name="tipe_kapal" required>
                                            <option value="">-- Pilih Tipe --</option>
                                            <option value="Express/Cepat">Express/Cepat (AC)</option>
                                            <option value="Ferry/Feri">Ferry/Feri (Standar)</option>
                                            <option value="PELNI">PELNI (Penyeberangan)</option>
                                            <option value="Pesawat Perintis">Pesawat Perintis</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label fw-bold">Keterangan Tambahan</label>
                                        <textarea class="form-control" name="keterangan" rows="3" placeholder="Contoh: AC, bisa bawa kendaraan, jadwal tetap, dll"></textarea>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary fw-bold">
                                    <i class="bi bi-plus-lg me-2"></i>Tambah Jadwal Kapal
                                </button>
                            </form>

                            <hr>

                            <!-- DAFTAR JADWAL KAPAL -->
                            <h6 class="fw-bold mb-3"><i class="bi bi-list-ul me-2"></i>Jadwal Kapal yang Tersedia</h6>
                            <div class="table-responsive">
                                <table class="table table-hover border">
                                    <thead class="table-light">
                                        <tr>
                                            <th width="15%">Asal</th>
                                            <th width="15%">Nama Kapal</th>
                                            <th width="10%">Jam</th>
                                            <th width="12%">Waktu Tempuh</th>
                                            <th width="12%">Harga</th>
                                            <th width="15%">Tipe</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="jadwalKapalList">
                                        <?php 
                                            $db = \Config\Database::connect();
                                            if ($db->tableExists('jadwal_kapal')) {
                                                $jadwals = $db->table('jadwal_kapal')->orderBy('id', 'DESC')->get()->getResultArray();
                                                foreach($jadwals as $jadwal):
                                        ?>
                                        <tr>
                                            <td><?= esc($jadwal['pelabuhan_asal']) ?></td>
                                            <td><?= esc($jadwal['nama_kapal']) ?></td>
                                            <td><?= esc($jadwal['jam_berangkat']) ?></td>
                                            <td><?= esc($jadwal['waktu_tempuh']) ?></td>
                                            <td><strong>Rp <?= number_format($jadwal['harga_tiket'], 0, ',', '.') ?></strong></td>
                                            <td>
                                                <span class="badge bg-info"><?= esc($jadwal['tipe_kapal']) ?></span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" onclick="editJadwal(<?= $jadwal['id'] ?>)">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </button>
                                                <a href="<?= base_url('admin/delete_jadwal_kapal/' . $jadwal['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                        <?php 
                                                endforeach;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <?php if ($db->tableExists('jadwal_kapal') && empty($jadwals)): ?>
                            <div class="alert alert-info text-center">
                                <i class="bi bi-info-circle me-2"></i>Belum ada jadwal kapal. Silakan tambahkan jadwal baru di atas.
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-gradient py-2" style="background: linear-gradient(135deg, #2c3e50, #3498db);">
                    <h6 class="modal-title m-0 text-white"><i class="bi bi-plus-circle"></i> Tambah Data Baru</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= base_url('admin/simpan') ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body p-3">
                        <div class="mb-2">
                            <label class="small fw-bold text-muted mb-1">KATEGORI</label>
                            <select name="type" id="kategori-select" class="form-select form-select-sm fw-bold" required onchange="toggleFoto(this.value)">
                                <option value="" disabled selected>-- Pilih Jenis --</option>
                                <optgroup label="Akomodasi">
                                    <option value="stay">🏨 Penginapan</option>
                                </optgroup>
                                <optgroup label="Wisata">
                                    <option value="wisata_laut">🌊 Wisata Laut</option>
                                    <option value="wisata_darat">🌲 Wisata Darat</option>
                                    <option value="activity">🎯 Destinasi Umum</option>
                                </optgroup>
                                <optgroup label="Transportasi">
                                    <option value="transport_sea">🚢 Tiket Kapal</option>
                                    <option value="transport_land">🚐 Shuttle Jepara</option>
                                    <option value="transport_karimun">🚙 Trans Karimun</option>
                                    <option value="transport_local">🛵 Rental</option>
                                </optgroup>
                                <optgroup label="Lainnya">
                                    <option value="guide">👨‍🏫 Guide</option>
                                    <option value="facility">✨ Fasilitas</option>
                                    <option value="konsumsi">🍽️ Konsumsi</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-elegant p-2 mt-2">
                            <div class="mb-2">
                                <label class="small">Nama</label>
                                <input type="text" name="name" class="form-control form-control-sm" placeholder="Nama layanan..." required>
                            </div>
                            <div class="mb-2">
                                <label class="small">Keterangan</label>
                                <textarea name="description" class="form-control form-control-sm" rows="2" placeholder="Deskripsi singkat..."></textarea>
                            </div>
                            <div class="row g-2 mb-2">
                                <div class="col-6">
                                    <label class="small text-success">💰 Harga Jual</label>
                                    <input type="number" name="price_publish" class="form-control form-control-sm" placeholder="0" required>
                                </div>
                                <div class="col-6">
                                    <label class="small text-danger">💸 Modal</label>
                                    <input type="number" name="price_net" class="form-control form-control-sm" placeholder="0" required>
                                </div>
                            </div>
                            <div id="box-foto" style="display: none;">
                                <label class="small text-primary">📷 Upload Foto</label>
                                <input type="file" name="image" class="form-control form-control-sm">
                            </div>
                            <div id="box-lokasi" style="display: none;" class="mt-2">
                                <label class="small text-info">� Deskripsi Paket</label>
                                <textarea name="location" class="form-control form-control-sm" rows="2" placeholder="Deskripsi detail paket wisata..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-2 bg-light">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-sm btn-primary px-4"><i class="bi bi-check-lg"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT LAYANAN -->
    <div class="modal fade" id="modalEdit" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark py-2">
                    <h6 class="modal-title m-0"><i class="bi bi-pencil-square"></i> Edit Data</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= base_url('admin/update_layanan') ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="modal-body">
                        <div class="mb-2">
                            <label class="small fw-bold">Nama</label>
                            <input type="text" name="name" id="edit_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Deskripsi</label>
                            <textarea name="description" id="edit_desc" class="form-control form-control-sm" rows="2"></textarea>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-6">
                                <label class="small fw-bold text-success">Harga Jual</label>
                                <input type="number" name="price_publish" id="edit_pub" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-6">
                                <label class="small fw-bold text-danger">Modal</label>
                                <input type="number" name="price_net" id="edit_net" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Ganti Foto (Opsional)</label>
                            <input type="file" name="image" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="modal-footer py-1">
                        <button type="submit" class="btn btn-warning btn-sm w-100 fw-bold">UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT WISATA -->
    <div class="modal fade" id="modalEditWisata" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white py-2">
                    <h6 class="modal-title m-0"><i class="bi bi-pencil-square"></i> Edit Wisata</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= base_url('admin/update_wisata') ?>" method="post">
                    <input type="hidden" name="id" id="edit_wisata_id">
                    <input type="hidden" name="type" id="edit_wisata_type">
                    <div class="modal-body">
                        <div class="mb-2">
                            <label class="small fw-bold">Nama Wisata</label>
                            <input type="text" name="name" id="edit_wisata_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Deskripsi</label>
                            <textarea name="location" id="edit_wisata_location" class="form-control form-control-sm" rows="2" placeholder="Deskripsi detail paket wisata..."></textarea>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-6">
                                <label class="small fw-bold text-success">Harga Jual</label>
                                <input type="number" name="price_publish" id="edit_wisata_pub" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-6">
                                <label class="small fw-bold text-danger">Modal</label>
                                <input type="number" name="price_net" id="edit_wisata_net" class="form-control form-control-sm" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-1">
                        <button type="submit" class="btn btn-info btn-sm w-100 fw-bold text-white">UPDATE WISATA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT KONSUMSI -->
    <div class="modal fade" id="modalEditKonsumsi" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white py-2">
                    <h6 class="modal-title m-0"><i class="bi bi-pencil-square"></i> Edit Konsumsi</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= base_url('admin/update_konsumsi') ?>" method="post">
                    <input type="hidden" name="id" id="edit_konsumsi_id">
                    <div class="modal-body">
                        <div class="mb-2">
                            <label class="small fw-bold">Nama Paket</label>
                            <input type="text" name="name" id="edit_konsumsi_name" class="form-control form-control-sm" required>
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Deskripsi</label>
                            <textarea name="description" id="edit_konsumsi_desc" class="form-control form-control-sm" rows="2"></textarea>
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Tipe Makan</label>
                            <select name="meal_type" id="edit_konsumsi_meal" class="form-select form-select-sm" required>
                                <option value="breakfast">Sarapan</option>
                                <option value="lunch">Makan Siang</option>
                                <option value="dinner">Makan Malam</option>
                                <option value="snack">Snack/Minuman</option>
                                <option value="all">Semua Waktu</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold text-success">Harga per Orang</label>
                            <input type="number" name="price_per_person" id="edit_konsumsi_price" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="modal-footer py-1">
                        <button type="submit" class="btn btn-success btn-sm w-100 fw-bold">UPDATE KONSUMSI</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT ITINERARY -->
    <div class="modal fade" id="modalEditItinerary" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white py-2">
                    <h6 class="modal-title m-0"><i class="bi bi-pencil-square"></i> Edit Itinerary</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= base_url('admin/update_itinerary') ?>" method="post">
                    <input type="hidden" name="id" id="edit_itin_id">
                    <div class="modal-body">
                        <div class="row g-2 mb-2">
                            <div class="col-6">
                                <label class="small fw-bold">Durasi</label>
                                <select name="duration_day" id="edit_itin_duration" class="form-select form-select-sm" required>
                                    <option value="2">2 Days</option>
                                    <option value="3">3 Days</option>
                                    <option value="4">4 Days</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="small fw-bold">Hari ke-</label>
                                <input type="number" name="day_number" id="edit_itin_day" class="form-control form-control-sm" required>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Judul</label>
                            <input type="text" name="title" id="edit_itin_title" class="form-control form-control-sm" required>
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Deskripsi</label>
                            <textarea name="description" id="edit_itin_desc" class="form-control form-control-sm" rows="2"></textarea>
                        </div>
                        <div class="row g-2 mb-2">
                            <div class="col-6">
                                <label class="small fw-bold">Jam Mulai</label>
                                <input type="time" name="time_start" id="edit_itin_start" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-6">
                                <label class="small fw-bold">Jam Selesai</label>
                                <input type="time" name="time_end" id="edit_itin_end" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Lokasi</label>
                            <input type="text" name="location" id="edit_itin_location" class="form-control form-control-sm">
                        </div>
                    </div>
                    <div class="modal-footer py-1">
                        <button type="submit" class="btn btn-primary btn-sm w-100 fw-bold">UPDATE ITINERARY</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT JADWAL KAPAL -->
    <div class="modal fade" id="modalEditJadwalKapal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white py-2">
                    <h6 class="modal-title m-0"><i class="bi bi-pencil-square"></i> Edit Jadwal Kapal</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="<?= base_url('admin/update_jadwal_kapal') ?>" method="post">
                    <input type="hidden" name="id" id="edit_jadwal_id">
                    <div class="modal-body">
                        <div class="mb-2">
                            <label class="small fw-bold">Nama Pelabuhan Asal</label>
                            <input type="text" name="pelabuhan_asal" id="edit_jadwal_asal" class="form-control form-control-sm" required>
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Nama Kapal</label>
                            <input type="text" name="nama_kapal" id="edit_jadwal_nama" class="form-control form-control-sm" required>
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Jam Keberangkatan</label>
                            <input type="time" name="jam_berangkat" id="edit_jadwal_jam" class="form-control form-control-sm" required>
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Waktu Tempuh</label>
                            <input type="text" name="waktu_tempuh" id="edit_jadwal_tempuh" class="form-control form-control-sm" placeholder="Contoh: 2-2,5 jam" required>
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Harga Tiket (Rp)</label>
                            <input type="number" name="harga_tiket" id="edit_jadwal_harga" class="form-control form-control-sm" required>
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Tipe Kapal</label>
                            <select class="form-control form-control-sm" name="tipe_kapal" id="edit_jadwal_tipe" required>
                                <option value="">-- Pilih Tipe --</option>
                                <option value="Express/Cepat">Express/Cepat (AC)</option>
                                <option value="Ferry/Feri">Ferry/Feri (Standar)</option>
                                <option value="PELNI">PELNI (Penyeberangan)</option>
                                <option value="Pesawat Perintis">Pesawat Perintis</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Keterangan Tambahan</label>
                            <textarea class="form-control form-control-sm" name="keterangan" id="edit_jadwal_ket" rows="2" placeholder="AC, bisa bawa kendaraan, dll"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer py-1">
                        <button type="submit" class="btn btn-info btn-sm w-100 fw-bold text-white">UPDATE JADWAL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    function renderWisataTable($title, $data, $type) {
        $html = '<div class="table-responsive"><table class="table table-compact mb-0"><thead><tr><th>Nama</th><th class="text-end">Jual</th><th class="text-end">Modal</th><th class="text-center">Aksi</th></tr></thead><tbody>';
        if(empty($data)) {
            $html .= '<tr><td colspan="4" class="text-center py-2 text-muted small"><i class="bi bi-inbox"></i> Kosong</td></tr>';
        } else {
            foreach($data as $d) {
                $d['type'] = $type;
                $jsData = htmlspecialchars(json_encode($d), ENT_QUOTES, 'UTF-8');
                $html .= '<tr>';
                $html .= '<td><span class="fw-semibold">'.esc($d['name']).'</span></td>';
                $html .= '<td class="text-end"><span class="price-badge sell">'.number_format($d['price_publish'] ?? 0, 0, ',', '.').'</span></td>';
                $html .= '<td class="text-end"><span class="price-badge cost">'.number_format($d['price_net'] ?? 0, 0, ',', '.').'</span></td>';
                $html .= '<td><div class="action-group">';
                $html .= '<button class="btn btn-warning btn-action" onclick="openEditWisata('.$jsData.')" title="Edit"><i class="bi bi-pencil"></i></button>';
                $html .= '<a href="'.base_url('admin/delete_wisata/'.$d['id'].'/'.$type).'" class="btn btn-outline-danger btn-action" onclick="return confirm(\'Hapus?\')" title="Hapus"><i class="bi bi-trash"></i></a>';
                $html .= '</div></td></tr>';
            }
        }
        $html .= '</tbody></table></div>';
        return $html;
    }

    function renderTable($title, $data, $showImage) {
        $html = '<div class="table-responsive"><table class="table table-compact mb-0"><thead><tr>';
        $html .= '<th>Nama</th><th class="text-end">Jual</th><th class="text-end">Modal</th><th class="text-center">Aksi</th></tr></thead><tbody>';
        if(empty($data)) {
            $html .= '<tr><td colspan="4" class="text-center py-2 text-muted small"><i class="bi bi-inbox"></i> Kosong</td></tr>';
        } else {
            foreach($data as $d) {
                $html .= '<tr>';
                $html .= '<td><span class="fw-semibold">'.esc($d['name']).'</span></td>';
                $html .= '<td class="text-end"><span class="price-badge sell">'.number_format($d['price_publish'],0,',','.').'</span></td>';
                $html .= '<td class="text-end"><span class="price-badge cost">'.number_format($d['price_net'],0,',','.').'</span></td>';
                $html .= '<td><div class="action-group">';
                if($showImage) $html .= '<a href="'.base_url('admin/manage_service/'.$d['id']).'" class="btn btn-info btn-action text-white" title="Foto"><i class="bi bi-image"></i></a>';
                $jsData = htmlspecialchars(json_encode($d), ENT_QUOTES, 'UTF-8');
                $html .= '<button class="btn btn-warning btn-action" onclick="openEdit('.$jsData.')" title="Edit"><i class="bi bi-pencil"></i></button>';
                $html .= '<a href="'.base_url('admin/delete_layanan/'.$d['id']).'" class="btn btn-outline-danger btn-action" onclick="return confirm(\'Hapus?\')" title="Hapus"><i class="bi bi-trash"></i></a>';
                $html .= '</div></td></tr>';
            }
        }
        $html .= '</tbody></table></div>';
        return $html;
    }

    function renderKonsumsiTable($title, $data) {
        $mealTypes = ['breakfast' => 'Pagi', 'lunch' => 'Siang', 'dinner' => 'Malam', 'snack' => 'Snack', 'all' => 'All'];
        $html = '<div class="table-responsive"><table class="table table-compact mb-0"><thead><tr><th>Paket</th><th>Tipe</th><th class="text-end">Harga</th><th class="text-center">Aksi</th></tr></thead><tbody>';
        if(empty($data)) {
            $html .= '<tr><td colspan="4" class="text-center py-2 text-muted small"><i class="bi bi-inbox"></i> Kosong</td></tr>';
        } else {
            foreach($data as $d) {
                $mealLabel = $mealTypes[$d['meal_type']] ?? $d['meal_type'];
                $html .= '<tr>';
                $html .= '<td><span class="fw-semibold">'.esc($d['name']).'</span></td>';
                $html .= '<td><span class="badge bg-secondary" style="font-size:0.6rem;">'.esc($mealLabel).'</span></td>';
                $html .= '<td class="text-end"><span class="price-badge sell">'.number_format($d['price_per_person'], 0, ',', '.').'</span></td>';
                $html .= '<td><div class="action-group">';
                $html .= '<a href="'.base_url('admin/delete_konsumsi/'.$d['id']).'" class="btn btn-outline-danger btn-action" onclick="return confirm(\'Hapus?\')" title="Hapus"><i class="bi bi-trash"></i></a>';
                $html .= '</div></td></tr>';
            }
        }
        $html .= '</tbody></table></div>';
        return $html;
    }

    function renderItineraryTable($title, $data) {
        $html = '<div class="table-responsive"><table class="table table-compact mb-0"><thead><tr><th>Dur</th><th>Day</th><th>Waktu</th><th>Aktivitas</th><th class="text-center">Aksi</th></tr></thead><tbody>';
        if(empty($data)) {
            $html .= '<tr><td colspan="5" class="text-center py-2 text-muted small"><i class="bi bi-inbox"></i> Kosong</td></tr>';
        } else {
            $grouped = [];
            foreach($data as $item) {
                $key = $item['duration_day'] . 'D';
                if(!isset($grouped[$key])) $grouped[$key] = [];
                $grouped[$key][] = $item;
            }
            foreach($grouped as $duration => $items) {
                foreach($items as $idx => $item) {
                    $time = substr($item['time_start'],0,5);
                    $html .= '<tr>';
                    if($idx === 0) $html .= '<td rowspan="'.count($items).'" class="fw-bold bg-light text-center align-middle">'.$duration.'</td>';
                    $html .= '<td class="text-center"><span class="badge bg-primary" style="font-size:0.58rem;">'.$item['day_number'].'</span></td>';
                    $html .= '<td><small>'.$time.'</small></td>';
                    $html .= '<td><span class="fw-semibold">'.substr(esc($item['title']),0,20).'</span></td>';
                    $jsData = htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8');
                    $html .= '<td><div class="action-group"><button class="btn btn-warning btn-action" onclick="openEditItinerary('.$jsData.')" title="Edit"><i class="bi bi-pencil"></i></button><a href="'.base_url('admin/delete_itinerary/'.$item['id']).'" class="btn btn-outline-danger btn-action" onclick="return confirm(\'Hapus?\')" title="Hapus"><i class="bi bi-trash"></i></a></div></td>';
                    $html .= '</tr>';
                }
            }
        }
        $html .= '</tbody></table></div>';
        return $html;
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function switchMenu(id, el) {
            document.querySelectorAll('.section-view').forEach(d => d.classList.remove('active'));
            document.getElementById('view-' + id).classList.add('active');
            document.querySelectorAll('.nav-sidebar .nav-link').forEach(l => l.classList.remove('active'));
            el.classList.add('active');
        }
        
        // Tab persistence sudah di-handle oleh PHP active class
        // Tidak perlu JavaScript switching lagi untuk menghindari kedipan
        
        function toggleFoto(kategori) {
            const boxFoto = document.getElementById('box-foto');
            const boxLokasi = document.getElementById('box-lokasi');
            
            // Kategori yang butuh foto
            const needFoto = ['stay', 'activity', 'wisata_laut', 'wisata_darat'];
            // Kategori yang butuh lokasi
            const needLokasi = ['wisata_laut', 'wisata_darat', 'activity'];
            
            if (needFoto.includes(kategori)) {
                boxFoto.style.display = 'block';
            } else {
                boxFoto.style.display = 'none';
            }
            
            if (needLokasi.includes(kategori)) {
                boxLokasi.style.display = 'block';
            } else {
                boxLokasi.style.display = 'none';
            }
        }
        function openEdit(data) {
            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_name').value = data.name;
            document.getElementById('edit_desc').value = data.description;
            document.getElementById('edit_pub').value = data.price_publish;
            document.getElementById('edit_net').value = data.price_net;
            new bootstrap.Modal(document.getElementById('modalEdit')).show();
        }
        
        function openEditWisata(data) {
            document.getElementById('edit_wisata_id').value = data.id;
            document.getElementById('edit_wisata_type').value = data.type;
            document.getElementById('edit_wisata_name').value = data.name;
            document.getElementById('edit_wisata_location').value = data.location || '';
            document.getElementById('edit_wisata_pub').value = data.price_publish || 0;
            document.getElementById('edit_wisata_net').value = data.price_net || 0;
            new bootstrap.Modal(document.getElementById('modalEditWisata')).show();
        }
        
        function openEditKonsumsi(data) {
            document.getElementById('edit_konsumsi_id').value = data.id;
            document.getElementById('edit_konsumsi_name').value = data.name;
            document.getElementById('edit_konsumsi_desc').value = data.description || '';
            document.getElementById('edit_konsumsi_meal').value = data.meal_type || 'all';
            document.getElementById('edit_konsumsi_price').value = data.price_per_person || 0;
            new bootstrap.Modal(document.getElementById('modalEditKonsumsi')).show();
        }
        
        function openEditItinerary(data) {
            document.getElementById('edit_itin_id').value = data.id;
            document.getElementById('edit_itin_duration').value = data.duration_day;
            document.getElementById('edit_itin_day').value = data.day_number;
            document.getElementById('edit_itin_title').value = data.title;
            document.getElementById('edit_itin_desc').value = data.description || '';
            document.getElementById('edit_itin_start').value = data.time_start || '';
            document.getElementById('edit_itin_end').value = data.time_end || '';
            document.getElementById('edit_itin_location').value = data.location || '';
            new bootstrap.Modal(document.getElementById('modalEditItinerary')).show();
        }
        
        function editJadwal(id) {
            // Load data jadwal dari database via AJAX
            fetch('<?= base_url('admin/get_jadwal_kapal_json') ?>')
                .then(response => response.json())
                .then(jadwals => {
                    // Find jadwal with matching id
                    const jadwal = jadwals.find(j => j.id == id);
                    if(!jadwal) {
                        alert('Data tidak ditemukan');
                        return;
                    }
                    
                    // Fill form fields
                    document.getElementById('edit_jadwal_id').value = jadwal.id;
                    document.getElementById('edit_jadwal_asal').value = jadwal.pelabuhan_asal || '';
                    document.getElementById('edit_jadwal_nama').value = jadwal.nama_kapal || '';
                    document.getElementById('edit_jadwal_jam').value = jadwal.jam_berangkat || '';
                    document.getElementById('edit_jadwal_tempuh').value = jadwal.waktu_tempuh || '';
                    document.getElementById('edit_jadwal_harga').value = jadwal.harga_tiket || '';
                    document.getElementById('edit_jadwal_tipe').value = jadwal.tipe_kapal || '';
                    document.getElementById('edit_jadwal_ket').value = jadwal.keterangan || '';
                    
                    // Show modal
                    new bootstrap.Modal(document.getElementById('modalEditJadwalKapal')).show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat data jadwal');
                });
        }
        
        const ctx = document.getElementById('tamuChart');
        if(ctx) {
            new Chart(ctx, { type: 'doughnut', data: { labels: ['Confirmed', 'Pending', 'Selesai', 'Batal'], datasets: [{ data: [<?= $chart_confirmed ?? 0 ?>, <?= $chart_pending ?? 0 ?>, <?= $chart_completed ?? 0 ?>, <?= $chart_cancelled ?? 0 ?>], backgroundColor: ['#2ecc71', '#f1c40f', '#3498db', '#e74c3c'], borderWidth: 0 }] }, options: { cutout: '70%', plugins: { legend: { position: 'bottom' } } } });
        }
        
        // ====================================================
        // AUTO-OPEN MODAL SETELAH SIMPAN DATA BERHASIL
        // ====================================================
        document.addEventListener('DOMContentLoaded', function() {
            const hash = window.location.hash;
            
            // Jika ada hash (#tab-destinasi), berarti baru submit
            if(hash && hash.includes('tab-')) {
                const tabName = hash.substring(1);
                
                // Map tab ke tipe kategori
                const categoryMap = {
                    'tab-hotel': 'stay',
                    'tab-destinasi': 'activity',
                    'tab-transport-darat': 'transport_land',
                    'tab-kapal': 'transport_sea',
                    'tab-lokal': 'transport_local',
                    'tab-guide': 'guide',
                    'tab-fasilitas': 'facility'
                };
                
                // Tunggu sebentar agar DOM siap
                setTimeout(() => {
                    // Pilih radio button yang sesuai
                    const categoryType = categoryMap[tabName];
                    if(categoryType) {
                        const radioBtn = document.querySelector(`input[name="type"][value="${categoryType}"]`);
                        if(radioBtn) {
                            radioBtn.checked = true;
                            radioBtn.dispatchEvent(new Event('change'));
                        }
                    }
                    
                    // Reset form
                    const form = document.querySelector('#modalTambah form');
                    if(form) form.reset();
                    
                    // Buka modal
                    const modalTambah = new bootstrap.Modal(document.getElementById('modalTambah'), {
                        backdrop: 'static',
                        keyboard: false
                    });
                    modalTambah.show();
                    
                    // Hapus hash dari URL agar tidak selalu buka modal
                    window.history.replaceState(null, null, window.location.pathname);
                }, 300);
            }
        });
        // ====================================================
        // LEAFLET MAP PICKER UNTUK LOKASI
        // ====================================================
        let pickMap = null;
        let pickMarker = null;
        
        function initPickMap() {
            if(pickMap) return; // sudah init
            
            const mapContainer = document.getElementById('pickMap');
            if(!mapContainer) return;
            
            // Default: Karimunjawa
            pickMap = L.map('pickMap').setView([-5.8544, 110.4472], 10);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap',
                maxZoom: 18
            }).addTo(pickMap);
            
            // Marker untuk lokasi yang dipilih
            pickMarker = L.marker([-5.8544, 110.4472], {
                draggable: true
            }).addTo(pickMap);
            
            // Klik pada peta
            pickMap.on('click', function(e) {
                const lat = e.latlng.lat.toFixed(6);
                const lng = e.latlng.lng.toFixed(6);
                
                pickMarker.setLatLng(e.latlng);
                document.getElementById('pick_lat').value = lat;
                document.getElementById('pick_lng').value = lng;
            });
            
            // Drag marker
            pickMarker.on('dragend', function(e) {
                const pos = e.target.getLatLng();
                document.getElementById('pick_lat').value = pos.lat.toFixed(6);
                document.getElementById('pick_lng').value = pos.lng.toFixed(6);
            });
        }
        
        function viewOnMap(lat, lng, name) {
            if(!pickMap) initPickMap();
            
            pickMap.setView([lat, lng], 14);
            pickMarker.setLatLng([lat, lng]);
            pickMarker.bindPopup('<strong>' + name + '</strong>').openPopup();
            
            // Scroll ke map jika perlu
            document.getElementById('pickMap').scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        
        // Init map ketika tab lokasi dibuka
        document.addEventListener('DOMContentLoaded', function() {
            // Observer untuk mendeteksi tab aktif
            const tabKota = document.getElementById('tab-kota');
            if(tabKota) {
                const observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        if(tabKota.classList.contains('show') && tabKota.classList.contains('active')) {
                            setTimeout(initPickMap, 100);
                        }
                    });
                });
                observer.observe(tabKota, { attributes: true, attributeFilter: ['class'] });
            }
            
            // Juga init jika langsung ke tab lokasi
            const pillTabKota = document.querySelector('[data-bs-target="#tab-kota"]');
            if(pillTabKota) {
                pillTabKota.addEventListener('shown.bs.tab', function() {
                    setTimeout(function() {
                        initPickMap();
                        if(pickMap) pickMap.invalidateSize();
                    }, 150);
                });
            }
        });
    </script>
</body>
</html>