<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServiceModel;

class Admin extends BaseController
{
    // =========================================================================
    // 1. DASHBOARD & DATABASE WISATA (GABUNGAN FITUR LAMA & BARU)
    // =========================================================================
    public function index()
    {
        $db = \Config\Database::connect();
        $model = new ServiceModel();
        
        // --- A. HITUNG KAS BESAR (KEUANGAN) ---
        if ($db->tableExists('bookings')) {
            // Updated: Use new bookings table
            $bookingModel = new \App\Models\BookingModel();
            $paymentModel = new \App\Models\PaymentModel();
            
            // HANYA HITUNG BOOKING YANG CONFIRMED & COMPLETED (BUKAN PENDING/CANCELLED)
            $querySum = $db->table('bookings')
                                ->whereIn('status', ['confirmed', 'completed'])
                                ->selectSum('total_price', 'omset')
                                ->selectSum('estimated_margin', 'laba')
                                ->selectSum('num_people', 'total_pax')
                                ->get()->getRow();
                                
            $data['total_omset'] = $querySum->omset ?? 0;
            $data['total_laba']  = $querySum->laba ?? 0;
            $data['total_tamu']  = $querySum->total_pax ?? 0;
            
            // Ambil semua bookings dengan payment summary
            $allBookings = $db->table('bookings')
                ->select('bookings.*, 
                    (SELECT SUM(amount) FROM payments WHERE payments.booking_id = bookings.id AND payments.status = "confirmed") as paid_amount,
                    (SELECT COUNT(*) FROM payments WHERE payments.booking_id = bookings.id) as payment_count,
                    (bookings.total_price - COALESCE(bookings.total_net_cost, 0)) as profit')
                ->orderBy('bookings.created_at', 'DESC')
                ->limit(5)
                ->get()
                ->getResultArray();
            
            $data['booking_list'] = $allBookings;

            // Data Pie Chart
            $data['chart_confirmed'] = $db->table('bookings')->where('status', 'confirmed')->countAllResults();
            $data['chart_pending']   = $db->table('bookings')->where('status', 'pending')->countAllResults();
            $data['chart_completed'] = $db->table('bookings')->where('status', 'completed')->countAllResults();
            $data['chart_cancelled'] = $db->table('bookings')->where('status', 'cancelled')->countAllResults();
        } else {
            $data['total_omset'] = 0; $data['total_laba'] = 0; $data['total_tamu'] = 0;
            $data['booking_list'] = []; 
            $data['chart_confirmed'] = 0; $data['chart_pending'] = 0; $data['chart_completed'] = 0; $data['chart_cancelled'] = 0;
        }

        // --- B. LOAD DATABASE WISATA ---
        $data['darat']          = $model->where('type', 'transport_land')->orderBy('id', 'DESC')->findAll();
        $data['karimun_darat']  = $model->where('type', 'transport_karimun')->orderBy('id', 'DESC')->findAll();
        $data['laut']           = $model->where('type', 'transport_sea')->orderBy('id', 'DESC')->findAll();
        $data['rental']         = $model->where('type', 'transport_local')->orderBy('id', 'DESC')->findAll();
        $data['penginapan']     = $model->groupStart()->where('type', 'stay')->orWhere('type', 'homestay')->groupEnd()->orderBy('id', 'DESC')->findAll();
        $data['destinasi']      = $model->where('type', 'activity')->orderBy('id', 'DESC')->findAll();
        $data['destinasi_laut'] = $model->where('type', 'destinasi_laut')->orderBy('id', 'DESC')->findAll(); // NEW: Hopping Island
        $data['guide']          = $model->where('type', 'guide')->orderBy('id', 'DESC')->findAll();
        $data['fasilitas']      = $model->where('type', 'facility')->orderBy('id', 'DESC')->findAll();

        // --- NEW: WISATA DARAT & LAUT ---
        $wisataDaratModel = new \App\Models\WisataDaratModel();
        $wisataLautModel = new \App\Models\WisataLautModel();
        $konsumsiModel = new \App\Models\KonsumsiModel();
        $itineraryModel = new \App\Models\ItineraryModel();
        $data['wisata_darat'] = $wisataDaratModel->orderBy('id', 'DESC')->findAll();
        $data['wisata_laut'] = $wisataLautModel->orderBy('id', 'DESC')->findAll();
        $data['konsumsi'] = $konsumsiModel->orderBy('id', 'DESC')->findAll();
        $data['itinerary'] = $itineraryModel->orderBy('duration_day, day_number, time_start', 'ASC')->findAll();

        if ($db->tableExists('ref_cities')) {
            $data['list_kota'] = $db->table('ref_cities')->orderBy('id', 'DESC')->get()->getResultArray();
        } else { $data['list_kota'] = []; }

        // Settings
        $query = $db->query("SELECT * FROM site_settings");
        $data['settings'] = [];
        foreach($query->getResultArray() as $row){
            $data['settings'][$row['setting_key']] = $row['setting_value'];
        }

        // Konten Promo - Filter only promo content (exclude estimasi)
        if ($db->tableExists('site_content')) {
            // Group promo content by section_name (promo entries)
            $allContent = $db->table('site_content')
                ->where('page_name', 'promo')
                ->orderBy('section_name', 'DESC')
                ->get()
                ->getResultArray();
            
            // Format promo data - group by section_name to reconstruct promo entries
            $promoMap = [];
            $counter = 0;
            foreach ($allContent as $row) {
                if (!isset($promoMap[$row['section_name']])) {
                    // Extract id from section_name (promo_123 -> 123)
                    $idPart = str_replace('promo_', '', $row['section_name']);
                    $promoMap[$row['section_name']] = ['id' => $idPart];
                    $counter++;
                }
                $promoMap[$row['section_name']][$row['content_key']] = $row['content_value'];
            }
            $data['konten_promo'] = array_values($promoMap);
        } else {
            $data['konten_promo'] = [];
        }

        // Load Jadwal Kapal
        if ($db->tableExists('jadwal_kapal')) {
            $data['jadwals'] = $db->table('jadwal_kapal')->orderBy('jam_berangkat', 'ASC')->get()->getResultArray();
        } else {
            $data['jadwals'] = [];
        }

        // Load Tiket Pesawat
        if ($db->tableExists('tiket_pesawat')) {
            $data['pesawats'] = $db->table('tiket_pesawat')->where('is_active', 1)->orderBy('harga', 'ASC')->get()->getResultArray();
        } else {
            $data['pesawats'] = [];
        }

        return view('admin_dashboard', $data);
    }

    // =========================================================================
    // 2. KELOLA TRIP / OPERASIONAL (FITUR BARU: KEUANGAN PER GRUP)
    // =========================================================================
    
    // Halaman Detail Trip (Mencatat pengeluaran bensin, tiket, dll)
    public function booking_detail($id)
    {
        $db = \Config\Database::connect();
        
        // Cek Tabel Expenses (Buat otomatis jika belum ada)
        if (!$db->tableExists('booking_expenses')) {
            $this->create_expense_table();
        }

        // Ambil Data Booking Utama
        $data['booking'] = $db->table('bookings')->where('id', $id)->get()->getRowArray();
        
        if(!$data['booking']) {
            return redirect()->to('/admin')->with('error', 'Data booking tidak ditemukan.');
        }

        // Ambil Rincian Pengeluaran Trip Ini
        $data['expenses'] = $db->table('booking_expenses')->where('booking_id', $id)->orderBy('id', 'DESC')->get()->getResultArray();
        
        // Hitung Total Pengeluaran
        $rowExp = $db->table('booking_expenses')->selectSum('amount')->where('booking_id', $id)->get()->getRow();
        $data['total_expense'] = $rowExp->amount ?? 0;
        
        // Hitung Profit Trip Ini (Total Price - Total Expense)
        $data['profit_trip'] = ($data['booking']['total_price'] ?? 0) - $data['total_expense'];

        // Daftar Guide untuk dipilih
        $model = new ServiceModel();
        $data['guides'] = $model->where('type', 'guide')->findAll();

        return view('admin_booking_ops', $data);
    }

    // Simpan Catatan Pengeluaran Kecil
    public function simpan_pengeluaran()
    {
        $db = \Config\Database::connect();
        $booking_id = $this->request->getPost('booking_id');
        $amount = $this->request->getPost('amount');

        // 1. Simpan ke tabel expenses
        $db->table('booking_expenses')->insert([
            'booking_id'   => $booking_id,
            'expense_name' => $this->request->getPost('expense_name'),
            'category'     => $this->request->getPost('category'),
            'amount'       => $amount
        ]);

        // 2. UPDATE KAS BESAR (Otomatis update profit di tabel bookings)
        $this->recalculate_profit($booking_id);

        return redirect()->to('/admin/booking_detail/' . $booking_id)->with('sukses', 'Pengeluaran Tercatat!');
    }

    // Update Status & Guide
    public function update_guide_booking()
    {
        $db = \Config\Database::connect();
        $id = $this->request->getPost('booking_id');
        
        $db->table('bookings')->where('id', $id)->update([
            'guide_name' => $this->request->getPost('guide_name'),
            'status'     => $this->request->getPost('status')
        ]);
        return redirect()->to('/admin/booking_detail/' . $id)->with('sukses', 'Status Trip Diupdate!');
    }

    // =========================================================================
    // APPROVE BOOKING - Setujui booking dari pending ke confirmed
    // =========================================================================
    public function approve_booking()
    {
        $id = $this->request->getPost('booking_id');
        $db = \Config\Database::connect();
        
        // Update status ke confirmed
        $db->table('bookings')->where('id', $id)->update([
            'status' => 'confirmed',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        
        return redirect()->back()->with('sukses', 'Booking berhasil disetujui!');
    }

    // =========================================================================
    // REJECT BOOKING - Tolak dan hapus booking
    // =========================================================================
    public function reject_booking()
    {
        $id = $this->request->getPost('booking_id');
        $db = \Config\Database::connect();
        
        // Hapus data terkait terlebih dahulu
        if ($db->tableExists('booking_items')) {
            $db->table('booking_items')->where('booking_id', $id)->delete();
        }
        if ($db->tableExists('booking_expenses')) {
            $db->table('booking_expenses')->where('booking_id', $id)->delete();
        }
        if ($db->tableExists('payments')) {
            $db->table('payments')->where('booking_id', $id)->delete();
        }
        
        // Hapus booking utama
        $db->table('bookings')->where('id', $id)->delete();
        
        return redirect()->to('/admin')->with('sukses', 'Booking berhasil ditolak dan dihapus!');
    }

    // =========================================================================
    // AUTO CLEANUP - Hapus otomatis booking cancelled (>7 hari)
    // =========================================================================
    public function cleanup_cancelled_bookings()
    {
        $db = \Config\Database::connect();
        
        // Cari booking cancelled yang lebih dari 7 hari
        $oldCancelled = $db->table('bookings')
            ->where('status', 'cancelled')
            ->where('updated_at <', date('Y-m-d H:i:s', strtotime('-7 days')))
            ->get()
            ->getResultArray();
        
        $deleted = 0;
        foreach ($oldCancelled as $booking) {
            $bookingId = $booking['id'];
            
            // Hapus data terkait
            if ($db->tableExists('booking_items')) {
                $db->table('booking_items')->where('booking_id', $bookingId)->delete();
            }
            if ($db->tableExists('booking_expenses')) {
                $db->table('booking_expenses')->where('booking_id', $bookingId)->delete();
            }
            if ($db->tableExists('payments')) {
                $db->table('payments')->where('booking_id', $bookingId)->delete();
            }
            
            // Hapus booking
            $db->table('bookings')->where('id', $bookingId)->delete();
            $deleted++;
        }
        
        return redirect()->back()->with('sukses', "Berhasil menghapus {$deleted} booking cancelled lama.");
    }

    // Helper: Hitung Ulang Profit
    private function recalculate_profit($booking_id) {
        $db = \Config\Database::connect();
        // Hitung total expense
        $rowExp = $db->table('booking_expenses')->selectSum('amount')->where('booking_id', $booking_id)->get()->getRow();
        $total_cost = $rowExp->amount ?? 0;
        
        // Ambil booking data
        $booking = $db->table('bookings')->where('id', $booking_id)->get()->getRowArray();
        $total_price = $booking['total_price'] ?? 0;
        $profit_baru = $total_price - $total_cost;

        // Update tabel induk
        $db->table('bookings')->where('id', $booking_id)->update([
            'total_net_cost' => $total_cost,
            'estimated_margin'     => $profit_baru
        ]);
    }

    // Helper: Buat Tabel Expense Otomatis jika hilang
    private function create_expense_table() {
        $db = \Config\Database::connect();
        $sql = "CREATE TABLE IF NOT EXISTS booking_expenses (
            id INT AUTO_INCREMENT PRIMARY KEY,
            booking_id INT,
            expense_name VARCHAR(255),
            amount DECIMAL(15,2),
            category VARCHAR(50),
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        $db->query($sql);
    }

    // =========================================================================
    // 3. FITUR RESET DATA (DANGEROUS ZONE)
    // =========================================================================
    public function reset_data()
    {
        $db = \Config\Database::connect();
        $mode = $this->request->getPost('reset_mode');

        $db->query('SET FOREIGN_KEY_CHECKS = 0'); // Matikan kunci

        if ($mode == 'tamu' || $mode == 'all') {
            if($db->tableExists('booking_expenses')) $db->table('booking_expenses')->truncate();
            if($db->tableExists('bookings')) $db->table('bookings')->truncate();
        }
        
        if ($mode == 'produk' || $mode == 'all') {
            $db->table('service_categories')->truncate();
            $db->table('service_gallery')->truncate();
            $db->table('ref_cities')->truncate();
        }

        $db->query('SET FOREIGN_KEY_CHECKS = 1'); // Nyalakan lagi

        return redirect()->to('/admin')->with('sukses', 'Data Berhasil Direset!');
    }

    // =========================================================================
    // 4. CRUD DATABASE WISATA (SIMPAN, UPDATE, HAPUS) - DARI SCRIPT LAMA
    // =========================================================================
    
    public function simpan()
    {
        $model = new ServiceModel();
        $type = $this->request->getVar('type');
        
        // Jika type adalah wisata_laut atau wisata_darat, redirect ke save_wisata
        if (in_array($type, ['wisata_laut', 'wisata_darat'])) {
            return $this->save_wisata_from_modal();
        }
        
        $namaGambar = null;

        if (in_array($type, ['stay', 'homestay', 'activity'])) {
            $file = $this->request->getFile('image');
            if ($file && $file->isValid() && ! $file->hasMoved()) {
                $namaGambar = $file->getRandomName();
                $file->move('uploads/services', $namaGambar);
            }
        }

        $model->save([
            'name' => $this->request->getVar('name'), 'type' => $type,
            'description' => $this->request->getVar('description'),
            'price_publish' => $this->request->getVar('price_publish'),
            'price_net' => $this->request->getVar('price_net'),
            'image' => $namaGambar
        ]);

        // Setelah simpan, tetap di halaman yang sama dengan pesan sukses
        session()->setFlashdata('sukses', 'Data berhasil ditambah! Anda dapat menambah data lagi.');
        
        // Redirect ke halaman admin dengan tab yang sesuai
        $tabMap = [
            'stay' => 'tab-hotel',
            'activity' => 'tab-destinasi',
            'transport_land' => 'tab-transport-darat',
            'transport_sea' => 'tab-kapal',
            'transport_local' => 'tab-lokal',
            'transport_karimun' => 'tab-kdarat',
            'guide' => 'tab-guide',
            'facility' => 'tab-fasilitas',
            'konsumsi' => 'tab-konsumsi'
        ];
        $tab = $tabMap[$type] ?? 'tab-hotel';
        
        return redirect()->to(base_url('admin') . '#' . $tab)->with('sukses', 'Data Ditambah! Tambah lagi jika perlu.');
    }
    
    // Fungsi untuk menyimpan wisata dari modal dropdown
    private function save_wisata_from_modal()
    {
        try {
            $type = $this->request->getVar('type');
            $model = $type === 'wisata_darat' ? new \App\Models\WisataDaratModel() : new \App\Models\WisataLautModel();
            
            $file = $this->request->getFile('image');
            $namaFile = null;

            if ($file && $file->isValid() && !$file->hasMoved()) {
                $namaFile = $file->getRandomName();
                $file->move('uploads', $namaFile);
            }

            $data = [
                'name' => $this->request->getVar('name'),
                'description' => $this->request->getVar('description'),
                'location' => $this->request->getVar('location') ?? '',
                'lat' => $this->request->getVar('lat') ?? null,
                'lng' => $this->request->getVar('lng') ?? null,
                'price_publish' => $this->request->getVar('price_publish') ?? 0,
                'price_net' => $this->request->getVar('price_net') ?? 0,
                'is_active' => 1
            ];

            if ($namaFile) {
                $data['image_url'] = $namaFile;
            }

            $model->insert($data);
            
            $tabName = $type === 'wisata_darat' ? 'tab-wisata-darat' : 'tab-wisata-laut';
            session()->setFlashdata('sukses', 'Wisata berhasil ditambahkan!');
            session()->setFlashdata('active_tab', 'database');
            return redirect()->to(base_url('admin') . '#' . $tabName);
        } catch (\Exception $e) {
            log_message('error', 'Save Wisata From Modal Error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            return redirect()->to(base_url('admin'));
        }
    }

    public function update_layanan()
    {
        $model = new ServiceModel();
        $id = $this->request->getPost('id');
        $oldData = $model->find($id);
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price_publish' => $this->request->getPost('price_publish'),
            'price_net' => $this->request->getPost('price_net'),
        ];
        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            if (!empty($oldData['image']) && file_exists('uploads/services/' . $oldData['image'])) unlink('uploads/services/' . $oldData['image']);
            $namaGambar = $file->getRandomName();
            $file->move('uploads/services', $namaGambar);
            $data['image'] = $namaGambar;
        }
        $model->update($id, $data);
        
        // Tentukan tab berdasarkan type data
        $tabMap = [
            'stay' => 'tab-hotel', 'homestay' => 'tab-hotel',
            'activity' => 'tab-destinasi',
            'transport_land' => 'tab-darat',
            'transport_sea' => 'tab-laut',
            'transport_local' => 'tab-rental',
            'transport_karimun' => 'tab-kdarat',
            'guide' => 'tab-guide',
            'facility' => 'tab-fasilitas'
        ];
        $activePill = $tabMap[$oldData['type']] ?? 'tab-hotel';
        
        session()->setFlashdata('sukses', 'Data berhasil diperbarui!');
        session()->setFlashdata('active_tab', 'database');
        session()->setFlashdata('active_pill', $activePill);
        return redirect()->to('/admin');
    }

    public function delete_layanan($id)
    {
        $model = new ServiceModel();
        $item = $model->find($id);
        
        // Tentukan tab berdasarkan type data sebelum dihapus
        $tabMap = [
            'stay' => 'tab-hotel', 'homestay' => 'tab-hotel',
            'activity' => 'tab-destinasi',
            'transport_land' => 'tab-darat',
            'transport_sea' => 'tab-laut',
            'transport_local' => 'tab-rental',
            'transport_karimun' => 'tab-kdarat',
            'guide' => 'tab-guide',
            'facility' => 'tab-fasilitas'
        ];
        $activePill = $tabMap[$item['type'] ?? ''] ?? 'tab-hotel';
        
        try {
            if ($item && !empty($item['image']) && file_exists('uploads/services/' . $item['image'])) {
                unlink('uploads/services/' . $item['image']);
            }
            $model->delete($id);
            session()->setFlashdata('sukses', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            log_message('error', 'Delete Layanan Error: ' . $e->getMessage());
            session()->setFlashdata('gagal', 'Gagal menghapus data!');
        }
        
        session()->setFlashdata('active_tab', 'database');
        session()->setFlashdata('active_pill', $activePill);
        return redirect()->back();
    }

    // =========================================================================
    // 5. FITUR PENDUKUNG (KOTA, SETTINGS, GALLERY, KONTEN) - DARI SCRIPT LAMA
    // =========================================================================

    public function simpan_kota() {
        $db = \Config\Database::connect();
        $db->table('ref_cities')->insert(['name' => $this->request->getPost('name'), 'lat' => $this->request->getPost('lat'), 'lng' => $this->request->getPost('lng')]);
        session()->setFlashdata('sukses', 'Lokasi berhasil ditambahkan!');
        session()->setFlashdata('active_tab', 'database');
        session()->setFlashdata('active_pill', 'tab-kota');
        return redirect()->to('/admin');
    }
    
    public function hapus_kota($id) {
        $db = \Config\Database::connect();
        $db->table('ref_cities')->where('id', $id)->delete();
        session()->setFlashdata('sukses', 'Lokasi berhasil dihapus!');
        session()->setFlashdata('active_tab', 'database');
        session()->setFlashdata('active_pill', 'tab-kota');
        return redirect()->to('/admin');
    }

    public function update_settings() {
        try {
            $db = \Config\Database::connect();
            
            log_message('info', '=== UPDATE_SETTINGS START ===');
            
            // Handle hero slides (multi-slide)
            $heroSlides = $this->request->getPost('hero_slides');
            $heroSlidesArr = [];
            if ($heroSlides && is_array($heroSlides)) {
                foreach ($heroSlides as $i => $slide) {
                    // Handle image upload for each slide
                    $imgField = "hero_slides.{$i}.image_file";
                    $file = $this->request->getFile($imgField);
                    if ($file && $file->isValid() && !$file->hasMoved()) {
                        $nama = $file->getRandomName();
                        if ($file->move('uploads', $nama)) {
                            $slide['image'] = $nama;
                        }
                    }
                    // Clean up slide data
                    $heroSlidesArr[] = [
                        'title' => $slide['title'] ?? '',
                        'subtitle' => $slide['subtitle'] ?? '',
                        'image' => $slide['image'] ?? '',
                        'button_label' => $slide['button_label'] ?? '',
                        'button_action' => $slide['button_action'] ?? '',
                        'button_class' => $slide['button_class'] ?? 'btn-warning',
                        'duration' => (int)($slide['duration'] ?? 4000)
                    ];
                }
                $jsonSlides = json_encode($heroSlidesArr, JSON_UNESCAPED_UNICODE);
                $db->query("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?", ['hero_slides', $jsonSlides, $jsonSlides]);
            }

            // Handle other file uploads (logo, hero_image_mobile, etc)
            $files = ['logo_image', 'hero_image_mobile']; 
            foreach($files as $f){
                $file = $this->request->getFile($f);
                log_message('info', "Checking file: $f");
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $nama = $file->getRandomName();
                    log_message('info', "Processing file $f, new name: $nama");
                    if($file->move('uploads', $nama)) {
                        $db->query("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?", [$f, $nama, $nama]);
                        log_message('info', "File $f saved successfully");
                    } else {
                        throw new \Exception('Gagal upload file: ' . $f);
                    }
                }
            }

            // Handle text inputs
            $texts = ['announcement'];
            foreach($texts as $t){
                $val = $this->request->getPost($t);
                log_message('info', "Processing text field: $t = " . substr($val, 0, 50));
                if($val !== null && $val !== '') {
                    $db->query("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?", [$t, $val, $val]);
                    log_message('info', "Text field $t saved");
                }
            }
            
            log_message('info', '=== UPDATE_SETTINGS SUCCESS ===');
            return redirect()->to('/admin')->with('sukses', 'Tampilan website berhasil diupdate!');
            
        } catch (\Exception $e) {
            log_message('error', 'Update Settings Error: ' . $e->getMessage());
            return redirect()->to('/admin')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function manage_service($id) {
        $db = \Config\Database::connect();
        $model = new ServiceModel();
        $data['service'] = $model->find($id);
        $data['photos']  = $db->table('service_gallery')->where('service_id', $id)->get()->getResultArray();
        return view('admin_service_detail', $data);
    }

    public function upload_service_photo() {
        $db = \Config\Database::connect();
        $service_id = $this->request->getPost('service_id');
        $files = $this->request->getFileMultiple('photos'); 
        $uploadCount = 0;
        
        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && ! $file->hasMoved()) {
                    $namaFile = $file->getRandomName();
                    // Ubah path ke /uploads/ bukan /uploads/services/
                    $file->move('uploads', $namaFile);
                    // Simpan di service_gallery dengan image_url (konsisten dengan database)
                    $db->table('service_gallery')->insert([
                        'service_id' => $service_id, 
                        'image_url' => $namaFile
                    ]);
                    $uploadCount++;
                }
            }
        }
        
        // Notifikasi sukses dengan alert
        if($uploadCount > 0) {
            session()->setFlashdata('sukses', 'Berhasil upload ' . $uploadCount . ' foto! Gambar tersimpan dan siap ditampilkan.');
        } else {
            session()->setFlashdata('error', 'Tidak ada file yang diupload. Pilih gambar terlebih dahulu.');
        }
        
        return redirect()->to('/admin/manage_service/' . $service_id);
    }

    public function delete_service_photo($id, $service_id) {
        $db = \Config\Database::connect();
        $foto = $db->table('service_gallery')->where('id', $id)->get()->getRowArray();
        if($foto) {
            // Cek field image_url atau file_name
            $filename = !empty($foto['image_url']) ? $foto['image_url'] : $foto['file_name'];
            if(file_exists('uploads/'.$filename)) {
                unlink('uploads/'.$filename);
            }
            $db->table('service_gallery')->where('id', $id)->delete();
            session()->setFlashdata('sukses', 'Foto berhasil dihapus!');
        }
        return redirect()->to('/admin/manage_service/' . $service_id);
    }

    public function update_long_desc() {
        $model = new ServiceModel();
        $model->update($this->request->getPost('id'), ['long_description' => $this->request->getPost('long_description')]);
        session()->setFlashdata('sukses', 'Deskripsi berhasil disimpan!');
        return redirect()->to('/admin/manage_service/' . $this->request->getPost('id'));
    }

    // --- MANAJEMEN KONTEN PROMO ---
    public function simpan_konten()
    {
        $db = \Config\Database::connect();
        $file = $this->request->getFile('image');
        $namaGambar = null;

        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $namaGambar = $file->getRandomName();
            $file->move('uploads/content', $namaGambar);
        }

        try {
            // Get next promo ID for unique section_name
            $maxId = $db->table('site_content')->selectMax('id')->get()->getRowArray()['id'] ?? 0;
            $nextId = $maxId + 1;
            
            // Insert promo as separate entries (title, description, image)
            $promoKey = 'promo_' . $nextId;
            
            $db->table('site_content')->insertBatch([
                [
                    'page_name' => 'promo',
                    'section_name' => $promoKey,
                    'content_key' => 'title',
                    'content_value' => $this->request->getPost('title')
                ],
                [
                    'page_name' => 'promo',
                    'section_name' => $promoKey,
                    'content_key' => 'description',
                    'content_value' => $this->request->getPost('description')
                ],
                [
                    'page_name' => 'promo',
                    'section_name' => $promoKey,
                    'content_key' => 'image',
                    'content_value' => $namaGambar ?? ''
                ]
            ]);

            return redirect()->to('/admin')->with('sukses', 'Konten Promo Ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->to('/admin')->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function hapus_konten($id)
    {
        $db = \Config\Database::connect();
        
        // Get the promo section_name from the id (promo_$id format)
        $promoKey = 'promo_' . $id;
        
        // Get image filename first for deletion
        $imageItem = $db->table('site_content')
            ->where('page_name', 'promo')
            ->where('section_name', $promoKey)
            ->where('content_key', 'image')
            ->get()
            ->getRowArray();

        if ($imageItem && !empty($imageItem['content_value']) && file_exists('uploads/content/' . $imageItem['content_value'])) {
            unlink('uploads/content/' . $imageItem['content_value']);
        }

        // Delete all entries for this promo
        $db->table('site_content')
            ->where('page_name', 'promo')
            ->where('section_name', $promoKey)
            ->delete();
            
        return redirect()->to('/admin')->with('sukses', 'Konten Dihapus!');
    }

    // --- MANAJEMEN WISATA DARAT & LAUT ---
    public function save_wisata()
    {
        try {
            $type = $this->request->getPost('type');
            $model = $type === 'wisata_darat' ? new \App\Models\WisataDaratModel() : new \App\Models\WisataLautModel();
            
            $file = $this->request->getFile('image_url');
            $namaFile = null;

            if ($file && $file->isValid() && !$file->hasMoved()) {
                $namaFile = $file->getRandomName();
                $file->move('uploads', $namaFile);
            }

            $data = [
                'name' => $this->request->getPost('name'),
                'location' => $this->request->getPost('location'),
                'price_publish' => $this->request->getPost('price_publish') ?? 0,
                'price_net' => $this->request->getPost('price_net') ?? 0,
                'is_active' => 1
            ];

            if ($namaFile) {
                $data['image_url'] = $namaFile;
            }

            $model->insert($data);
            
            $activePill = $type === 'wisata_darat' ? 'tab-wisata-darat' : 'tab-wisata-laut';
            session()->setFlashdata('sukses', 'Wisata berhasil ditambahkan!');
            session()->setFlashdata('active_tab', 'database');
            session()->setFlashdata('active_pill', $activePill);
            return redirect()->to(base_url('admin'));
        } catch (\Exception $e) {
            log_message('error', 'Save Wisata Error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            return redirect()->to(base_url('admin'));
        }
    }

    public function delete_wisata($id, $type)
    {
        try {
            $model = $type === 'wisata_darat' ? new \App\Models\WisataDaratModel() : new \App\Models\WisataLautModel();
            $wisata = $model->find($id);

            if ($wisata && !empty($wisata['image_url']) && file_exists('uploads/' . $wisata['image_url'])) {
                unlink('uploads/' . $wisata['image_url']);
            }

            $model->delete($id);
            $activePill = $type === 'wisata_darat' ? 'tab-wisata-darat' : 'tab-wisata-laut';
            session()->setFlashdata('sukses', 'Wisata berhasil dihapus!');
            session()->setFlashdata('active_tab', 'database');
            session()->setFlashdata('active_pill', $activePill);
            return redirect()->to(base_url('admin'));
        } catch (\Exception $e) {
            log_message('error', 'Delete Wisata Error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            return redirect()->to('/admin');
        }
    }

    public function update_wisata()
    {
        try {
            $id = $this->request->getPost('id');
            $type = $this->request->getPost('type');
            $model = $type === 'wisata_darat' ? new \App\Models\WisataDaratModel() : new \App\Models\WisataLautModel();
            
            $data = [
                'name' => $this->request->getPost('name'),
                'location' => $this->request->getPost('location'),
                'price_publish' => $this->request->getPost('price_publish') ?? 0,
                'price_net' => $this->request->getPost('price_net') ?? 0,
            ];

            $model->update($id, $data);
            $activePill = $type === 'wisata_darat' ? 'tab-wisata-darat' : 'tab-wisata-laut';
            session()->setFlashdata('sukses', 'Wisata berhasil diperbarui!');
            session()->setFlashdata('active_tab', 'database');
            session()->setFlashdata('active_pill', $activePill);
            return redirect()->to(base_url('admin'));
        } catch (\Exception $e) {
            log_message('error', 'Update Wisata Error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            return redirect()->to(base_url('admin'));
        }
    }

    // --- MANAJEMEN KONSUMSI ---
    public function save_konsumsi()
    {
        try {
            $model = new \App\Models\KonsumsiModel();
            
            $data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'meal_type' => $this->request->getPost('meal_type'),
                'price_per_person' => $this->request->getPost('price_per_person') ?? 0,
                'is_active' => 1
            ];

            $model->insert($data);
            
            session()->setFlashdata('sukses', 'Konsumsi berhasil ditambahkan!');
            session()->setFlashdata('active_tab', 'database');
            session()->setFlashdata('active_pill', 'tab-konsumsi');
            return redirect()->to(base_url('admin'));
        } catch (\Exception $e) {
            log_message('error', 'Save Konsumsi Error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            return redirect()->to(base_url('admin'));
        }
    }

    public function delete_konsumsi($id)
    {
        try {
            $model = new \App\Models\KonsumsiModel();
            $model->delete($id);
            session()->setFlashdata('sukses', 'Konsumsi berhasil dihapus!');
            session()->setFlashdata('active_tab', 'database');
            session()->setFlashdata('active_pill', 'tab-konsumsi');
            return redirect()->to('/admin');
        } catch (\Exception $e) {
            log_message('error', 'Delete Konsumsi Error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            return redirect()->to('/admin');
        }
    }

    public function update_konsumsi()
    {
        try {
            $id = $this->request->getPost('id');
            $model = new \App\Models\KonsumsiModel();
            
            $data = [
                'name' => $this->request->getPost('name'),
                'description' => $this->request->getPost('description'),
                'meal_type' => $this->request->getPost('meal_type'),
                'price_per_person' => $this->request->getPost('price_per_person') ?? 0,
            ];

            $model->update($id, $data);
            session()->setFlashdata('sukses', 'Konsumsi berhasil diperbarui!');
            session()->setFlashdata('active_tab', 'database');
            session()->setFlashdata('active_pill', 'tab-konsumsi');
            return redirect()->to('/admin');
        } catch (\Exception $e) {
            log_message('error', 'Update Konsumsi Error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            return redirect()->to('/admin');
        }
    }

    // --- MANAJEMEN ITINERARY ---
    public function save_itinerary()
    {
        try {
            $model = new \App\Models\ItineraryModel();
            
            $data = [
                'duration_day' => $this->request->getPost('duration_day'),
                'day_number' => $this->request->getPost('day_number'),
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'time_start' => $this->request->getPost('time_start'),
                'time_end' => $this->request->getPost('time_end'),
                'location' => $this->request->getPost('location'),
                'icon' => $this->request->getPost('icon') ?? 'bi-star',
                'is_active' => 1
            ];

            $model->insert($data);
            
            session()->setFlashdata('sukses', 'Itinerary berhasil ditambahkan!');
            session()->setFlashdata('active_tab', 'database');
            session()->setFlashdata('active_pill', 'tab-itinerary');
            return redirect()->to('/admin');
        } catch (\Exception $e) {
            log_message('error', 'Save Itinerary Error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            return redirect()->to('/admin');
        }
    }

    public function delete_itinerary($id)
    {
        try {
            $model = new \App\Models\ItineraryModel();
            $model->delete($id);
            session()->setFlashdata('sukses', 'Itinerary berhasil dihapus!');
            session()->setFlashdata('active_tab', 'database');
            session()->setFlashdata('active_pill', 'tab-itinerary');
            return redirect()->to('/admin');
        } catch (\Exception $e) {
            log_message('error', 'Delete Itinerary Error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            return redirect()->to('/admin');
        }
    }

    public function update_itinerary()
    {
        try {
            $id = $this->request->getPost('id');
            $model = new \App\Models\ItineraryModel();
            
            $data = [
                'duration_day' => $this->request->getPost('duration_day'),
                'day_number' => $this->request->getPost('day_number'),
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'time_start' => $this->request->getPost('time_start'),
                'time_end' => $this->request->getPost('time_end'),
                'location' => $this->request->getPost('location'),
            ];

            $model->update($id, $data);
            session()->setFlashdata('sukses', 'Itinerary berhasil diperbarui!');
            session()->setFlashdata('active_tab', 'database');
            session()->setFlashdata('active_pill', 'tab-itinerary');
            return redirect()->to('/admin');
        } catch (\Exception $e) {
            log_message('error', 'Update Itinerary Error: ' . $e->getMessage());
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            return redirect()->to('/admin');
        }
    }

    // =========================================================================
    // JADWAL KAPAL MANAGEMENT
    // =========================================================================
    
    public function simpan_jadwal_kapal()
    {
        $db = \Config\Database::connect();
        
        // Buat table jadwal_kapal jika belum ada
        if (!$db->tableExists('jadwal_kapal')) {
            $forge = \Config\Database::forge();
            
            // Add fields
            $forge->addField([
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'auto_increment' => true,
                ],
                'pelabuhan_asal' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => false,
                ],
                'nama_kapal' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => false,
                ],
                'jam_berangkat' => [
                    'type' => 'TIME',
                    'null' => false,
                ],
                'waktu_tempuh' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => false,
                ],
                'harga_tiket' => [
                    'type' => 'DECIMAL',
                    'constraint' => [15, 2],
                    'null' => false,
                ],
                'tipe_kapal' => [
                    'type' => 'VARCHAR',
                    'constraint' => 100,
                    'null' => false,
                ],
                'keterangan' => [
                    'type' => 'LONGTEXT',
                    'null' => true,
                ],
                'created_at' => [
                    'type' => 'TIMESTAMP',
                    'default' => 'CURRENT_TIMESTAMP',
                ],
                'updated_at' => [
                    'type' => 'TIMESTAMP',
                    'default' => 'CURRENT_TIMESTAMP',
                    'on_update' => true,
                ],
            ]);
            
            // Add primary key
            $forge->addKey('id', 'PRIMARY');
            
            // Create table
            $forge->createTable('jadwal_kapal');
        }

        // Simpan data jadwal kapal
        $data = [
            'pelabuhan_asal' => $this->request->getPost('pelabuhan_asal'),
            'nama_kapal' => $this->request->getPost('nama_kapal'),
            'jam_berangkat' => $this->request->getPost('jam_berangkat'),
            'waktu_tempuh' => $this->request->getPost('waktu_tempuh'),
            'harga_tiket' => $this->request->getPost('harga_tiket'),
            'tipe_kapal' => $this->request->getPost('tipe_kapal'),
            'keterangan' => $this->request->getPost('keterangan'),
        ];

        try {
            $db->table('jadwal_kapal')->insert($data);
            session()->setFlashdata('sukses', 'Jadwal kapal berhasil ditambahkan!');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            log_message('error', 'Save Jadwal Kapal Error: ' . $e->getMessage());
        }

        return redirect()->to('/admin#hp-jadwal-kapal');
    }

    public function delete_jadwal_kapal($id)
    {
        $db = \Config\Database::connect();

        try {
            $db->table('jadwal_kapal')->where('id', $id)->delete();
            session()->setFlashdata('sukses', 'Jadwal kapal berhasil dihapus!');
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            log_message('error', 'Delete Jadwal Kapal Error: ' . $e->getMessage());
        }

        return redirect()->to('/admin#hp-jadwal-kapal');
    }

    public function update_jadwal_kapal()
    {
        $db = \Config\Database::connect();
        
        try {
            $id = $this->request->getPost('id');
            $data = [
                'pelabuhan_asal' => $this->request->getPost('pelabuhan_asal'),
                'nama_kapal' => $this->request->getPost('nama_kapal'),
                'jam_berangkat' => $this->request->getPost('jam_berangkat'),
                'waktu_tempuh' => $this->request->getPost('waktu_tempuh'),
                'harga_tiket' => (int)$this->request->getPost('harga_tiket'),
                'tipe_kapal' => $this->request->getPost('tipe_kapal'),
                'keterangan' => $this->request->getPost('keterangan'),
            ];
            
            $db->table('jadwal_kapal')->where('id', $id)->update($data);
            session()->setFlashdata('sukses', 'Jadwal kapal berhasil diperbarui!');
        } catch (\Exception $e) {
            log_message('error', 'Update Jadwal Kapal Error: ' . $e->getMessage());
            session()->setFlashdata('gagal', 'Gagal memperbarui jadwal kapal!');
        }
        
        return redirect()->to('/admin#hp-jadwal-kapal');
    }

    public function get_jadwal_kapal_json()
    {
        $db = \Config\Database::connect();
        
        // Return empty array jika table belum ada
        if (!$db->tableExists('jadwal_kapal')) {
            return $this->response->setJSON([]);
        }

        // Fetch jadwal kapal dari database
        $jadwals = $db->table('jadwal_kapal')->orderBy('jam_berangkat', 'ASC')->get()->getResultArray();
        
        return $this->response->setJSON($jadwals);
    }

    // =========================================================================
    // HERO SLIDESHOW MANAGEMENT
    // =========================================================================
    public function get_slideshows()
    {
        $slideshowModel = new \App\Models\HeroSlideshowModel();
        $slideshows = $slideshowModel->getAllSlideshows();
        return $this->response->setJSON($slideshows);
    }

    public function save_slideshow()
    {
        $slideshowModel = new \App\Models\HeroSlideshowModel();
        
        // Handle file upload
        $image = $this->request->getFile('slideshow_image');
        $imageUrl = '';
        
        if ($image && $image->isValid()) {
            $fileName = uniqid() . '_' . $image->getClientName();
            $image->move('uploads/hero', $fileName);
            $imageUrl = 'uploads/hero/' . $fileName;
        }
        
        if (!$imageUrl) {
            return $this->response->setJSON(['success' => false, 'message' => 'Image is required']);
        }
        
        $data = [
            'title'        => $this->request->getPost('title'),
            'description'  => $this->request->getPost('description'),
            'image_url'    => $imageUrl,
            'sort_order'   => $slideshowModel->countAllResults(),
            'is_active'    => 1,
            'duration'     => (int)$this->request->getPost('duration') ?: 5000,
            'button_label' => $this->request->getPost('button_label'),
            'button_url'   => $this->request->getPost('button_url'),
            'button_class' => $this->request->getPost('button_class') ?: 'btn-warning'
        ];
        
        if ($slideshowModel->insert($data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Slideshow added successfully']);
        }
        
        return $this->response->setJSON(['success' => false, 'message' => 'Failed to add slideshow']);
    }

    public function update_slideshow()
    {
        $slideshowModel = new \App\Models\HeroSlideshowModel();
        $id = $this->request->getPost('id');
        $oldData = $slideshowModel->find($id);
        
        if (!$oldData) {
            return $this->response->setJSON(['success' => false, 'message' => 'Slideshow not found']);
        }
        
        $imageUrl = $oldData['image_url'];
        
        // Handle file upload
        $image = $this->request->getFile('slideshow_image');
        if ($image && $image->isValid()) {
            $fileName = uniqid() . '_' . $image->getClientName();
            $image->move('uploads/hero', $fileName);
            $imageUrl = 'uploads/hero/' . $fileName;
            
            // Delete old image
            if (!empty($oldData['image_url']) && file_exists($oldData['image_url'])) {
                unlink($oldData['image_url']);
            }
        }
        
        $data = [
            'title'        => $this->request->getPost('title'),
            'description'  => $this->request->getPost('description'),
            'image_url'    => $imageUrl,
            'duration'     => (int)$this->request->getPost('duration') ?: 5000,
            'button_label' => $this->request->getPost('button_label'),
            'button_url'   => $this->request->getPost('button_url'),
            'button_class' => $this->request->getPost('button_class') ?: 'btn-warning'
        ];
        
        if ($slideshowModel->update($id, $data)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Slideshow updated successfully']);
        }
        
        return $this->response->setJSON(['success' => false, 'message' => 'Failed to update slideshow']);
    }

    public function delete_slideshow($id)
    {
        $slideshowModel = new \App\Models\HeroSlideshowModel();
        $slideshow = $slideshowModel->find($id);
        
        if (!$slideshow) {
            return $this->response->setJSON(['success' => false, 'message' => 'Slideshow not found']);
        }
        
        // Delete image file
        if (!empty($slideshow['image_url']) && file_exists($slideshow['image_url'])) {
            unlink($slideshow['image_url']);
        }
        
        if ($slideshowModel->delete($id)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Slideshow deleted successfully']);
        }
        
        return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete slideshow']);
    }

    public function toggle_slideshow_active($id)
    {
        $slideshowModel = new \App\Models\HeroSlideshowModel();
        
        if ($slideshowModel->toggleActive($id)) {
            return $this->response->setJSON(['success' => true]);
        }
        
        return $this->response->setJSON(['success' => false]);
    }

    public function update_slideshow_order()
    {
        $slideshowModel = new \App\Models\HeroSlideshowModel();
        $order = $this->request->getJSON();
        
        foreach ($order as $index => $item) {
            $slideshowModel->update($item->id, ['sort_order' => $index]);
        }
        
        return $this->response->setJSON(['success' => true]);
    }

    // TIKET PESAWAT MANAGEMENT
    // =========================================================================
    
    public function simpan_tiket_pesawat()
    {
        $db = \Config\Database::connect();
        
        // Buat table tiket_pesawat jika belum ada
        if (!$db->tableExists('tiket_pesawat')) {
            $forge = \Config\Database::forge();
            $forge->addField([
                'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
                'nama_maskapai' => ['type' => 'VARCHAR', 'constraint' => 255],
                'rute' => ['type' => 'VARCHAR', 'constraint' => 255],
                'harga' => ['type' => 'DECIMAL', 'constraint' => [15, 2]],
                'deskripsi' => ['type' => 'TEXT', 'null' => true],
                'is_active' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
                'created_at' => ['type' => 'TIMESTAMP', 'default' => 'CURRENT_TIMESTAMP'],
                'updated_at' => ['type' => 'TIMESTAMP', 'default' => 'CURRENT_TIMESTAMP', 'on_update' => true],
            ]);
            $forge->addKey('id', 'PRIMARY');
            $forge->createTable('tiket_pesawat');
        }

        // Simpan data tiket pesawat
        $data = [
            'nama_maskapai' => $this->request->getPost('nama_maskapai'),
            'rute' => $this->request->getPost('rute'),
            'harga' => (int)$this->request->getPost('harga'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'is_active' => (int)$this->request->getPost('is_active'),
        ];
        
        try {
            $db->table('tiket_pesawat')->insert($data);
            session()->setFlashdata('sukses', 'Tiket pesawat berhasil ditambahkan!');
        } catch (\Exception $e) {
            log_message('error', 'Insert Tiket Pesawat Error: ' . $e->getMessage());
            session()->setFlashdata('gagal', 'Gagal menambahkan tiket pesawat!');
        }

        return redirect()->back();
    }

    public function delete_tiket_pesawat($id)
    {
        $db = \Config\Database::connect();
        
        try {
            $db->table('tiket_pesawat')->where('id', $id)->delete();
            session()->setFlashdata('sukses', 'Tiket pesawat berhasil dihapus!');
        } catch (\Exception $e) {
            log_message('error', 'Delete Tiket Pesawat Error: ' . $e->getMessage());
            session()->setFlashdata('gagal', 'Gagal menghapus tiket pesawat!');
        }

        return redirect()->back();
    }
}
