<?php

namespace App\Controllers;

use CodeIgniter\Database\Database;

class Settings extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // ==================== UNIFIED SETTINGS (NEW 2027 DESIGN) ====================
    
    // Halaman debug untuk cek database dan file
    public function debugSettings()
    {
        // Ambil semua settings dari site_settings table
        $settingsData = $this->db->table('site_settings')
            ->get()
            ->getResultArray();

        // Convert to key-value array
        $settings = [];
        foreach ($settingsData as $item) {
            $settings[$item['setting_key']] = $item['setting_value'];
        }

        $data = [
            'title' => 'Debug Settings',
            'settings' => $settings,
        ];

        return view('admin_settings_debug', $data);
    }
    
    // Halaman settings unified yang modern
    public function settingsUnified()
    {
        // Ambil semua settings dari site_settings table
        $settingsData = $this->db->table('site_settings')
            ->get()
            ->getResultArray();

        // Convert to key-value array
        $settings = [];
        foreach ($settingsData as $item) {
            $settings[$item['setting_key']] = $item['setting_value'];
        }

        $data = [
            'title' => 'Settings Website',
            'settings' => $settings,
        ];

        return view('admin_settings_unified', $data);
    }
    
    // Save unified settings
    public function saveUnified()
    {
        // Log untuk debug
        log_message('info', '=== SAVE UNIFIED START ===');
        
        $section = $this->request->getPost('section');
        $postData = $this->request->getPost();
        
        log_message('info', 'Section: ' . $section);
        log_message('info', 'POST Data: ' . json_encode($postData));
        log_message('info', 'Files: ' . json_encode($this->request->getFiles()));
        
        // Remove section from data
        unset($postData['section']);
        
        try {
            // Handle text inputs
            foreach ($postData as $key => $value) {
                // Skip empty values
                if ($value === '' || $value === null) continue;
                
                log_message('info', "Saving text: $key = $value");
                
                // Check if setting exists
                $exists = $this->db->table('site_settings')
                    ->where('setting_key', $key)
                    ->get()
                    ->getRow();
                
                if ($exists) {
                    $this->db->table('site_settings')
                        ->where('setting_key', $key)
                        ->update([
                            'setting_value' => $value,
                            'setting_group' => $section,
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                } else {
                    $this->db->table('site_settings')->insert([
                        'setting_key' => $key,
                        'setting_value' => $value,
                        'setting_group' => $section,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }
            
            // Handle file uploads with organized folders and auto-delete old files
            $files = $this->request->getFiles();
            
            if (!empty($files)) {
                log_message('info', 'Files found: ' . count($files));
                
                // Define folder mapping for each type
                $folderMapping = [
                    'logo_image' => 'uploads',
                    'hero_image' => 'uploads',
                    'km_photo_' => 'uploads/karimunjawa',
                    'promo_' => 'uploads/promo',
                    'flyer_' => 'uploads/flyer',
                    'gallery_' => 'uploads/gallery',
                ];
                
                foreach ($files as $key => $file) {
                    log_message('info', "Processing file: $key");
                    
                    // Check if file is empty or not valid
                    if (empty($file) || !is_object($file)) {
                        log_message('info', "File $key is empty or not object");
                        continue;
                    }
                    if (!$file->isValid()) {
                        log_message('info', "File $key is not valid. Error: " . $file->getError());
                        continue;
                    }
                    if ($file->hasMoved()) {
                        log_message('info', "File $key already moved");
                        continue;
                    }
                    
                    // Determine folder based on key prefix
                    $targetFolder = 'uploads';
                    foreach ($folderMapping as $prefix => $folder) {
                        if (strpos($key, $prefix) === 0) {
                            $targetFolder = $folder;
                            break;
                        }
                    }
                    
                    log_message('info', "Target folder: $targetFolder");
                    
                    // Create folder if not exists
                    $fullPath = FCPATH . $targetFolder;
                    if (!is_dir($fullPath)) {
                        @mkdir($fullPath, 0777, true);
                        log_message('info', "Created folder: $fullPath");
                    }
                    
                    // Get old file name from database
                    $oldFile = $this->db->table('site_settings')
                        ->where('setting_key', $key)
                        ->get()
                        ->getRow();
                    
                    // Delete old file if exists
                    if ($oldFile && !empty($oldFile->setting_value)) {
                        $oldFilePath = $fullPath . '/' . $oldFile->setting_value;
                        if (file_exists($oldFilePath)) {
                            @unlink($oldFilePath);
                            log_message('info', "Deleted old file: $oldFilePath");
                        }
                    }
                    
                    // Generate new filename
                    $newName = $file->getRandomName();
                    
                    log_message('info', "Moving file to: $fullPath / $newName");
                    
                    // Move new file
                    if ($file->move($fullPath, $newName)) {
                        log_message('info', "File moved successfully");
                        
                        // Update or insert to database
                        if ($oldFile) {
                            $this->db->table('site_settings')
                                ->where('setting_key', $key)
                                ->update([
                                    'setting_value' => $newName,
                                    'setting_group' => $section,
                                    'updated_at' => date('Y-m-d H:i:s')
                                ]);
                            log_message('info', "Updated DB for: $key");
                        } else {
                            $this->db->table('site_settings')->insert([
                                'setting_key' => $key,
                                'setting_value' => $newName,
                                'setting_group' => $section,
                                'created_at' => date('Y-m-d H:i:s'),
                                'updated_at' => date('Y-m-d H:i:s')
                            ]);
                            log_message('info', "Inserted DB for: $key");
                        }
                    } else {
                        log_message('error', "Failed to move file: " . $file->getError());
                    }
                }
            } else {
                log_message('info', 'No files in request');
            }
            
            session()->setFlashdata('success', 'Pengaturan berhasil disimpan!');
            return redirect()->to('/settings/unified');
            
        } catch (\Exception $e) {
            log_message('error', 'Exception: ' . $e->getMessage());
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            return redirect()->to('/settings/unified');
        }
    }
    
    // ==================== HOMEPAGE SETTINGS (OLD) ====================
    
    // Halaman settings homepage
    public function homepage()
    {
        // Ambil semua settings dari site_settings table
        $settingsData = $this->db->table('site_settings')
            ->get()
            ->getResultArray();

        // Convert to key-value array
        $settings = [];
        foreach ($settingsData as $item) {
            $settings[$item['setting_key']] = $item['setting_value'];
        }

        $data = [
            'title' => 'Settings Home Page',
            'settings' => $settings,
        ];

        return view('admin_settings_homepage', $data);
    }

    // Save homepage settings
    public function saveHomepage()
    {
        $section = $this->request->getPost('section');
        $postData = $this->request->getPost();
        
        // Remove section from data
        unset($postData['section']);
        
        try {
            foreach ($postData as $key => $value) {
                // Skip file inputs
                if (strpos($key, '_file') !== false) {
                    continue;
                }
                
                // Check if setting exists
                $exists = $this->db->table('site_settings')
                    ->where('setting_key', $key)
                    ->get()
                    ->getRow();
                
                if ($exists) {
                    $this->db->table('site_settings')
                        ->where('setting_key', $key)
                        ->update([
                            'setting_value' => $value,
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                } else {
                    $this->db->table('site_settings')->insert([
                        'setting_key' => $key,
                        'setting_value' => $value,
                        'setting_group' => $section,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
            }
            
            // Handle file uploads
            $files = $this->request->getFiles();
            foreach ($files as $key => $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(FCPATH . 'uploads', $newName);
                    
                    // Get the actual setting key (remove _file suffix)
                    $settingKey = str_replace('_file', '', $key);
                    
                    // Update or insert
                    $exists = $this->db->table('site_settings')
                        ->where('setting_key', $settingKey)
                        ->get()
                        ->getRow();
                    
                    if ($exists) {
                        $this->db->table('site_settings')
                            ->where('setting_key', $settingKey)
                            ->update([
                                'setting_value' => base_url('uploads/' . $newName),
                                'updated_at' => date('Y-m-d H:i:s')
                            ]);
                    } else {
                        $this->db->table('site_settings')->insert([
                            'setting_key' => $settingKey,
                            'setting_value' => base_url('uploads/' . $newName),
                            'setting_group' => $section,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                }
            }
            
            session()->setFlashdata('success', 'Pengaturan berhasil disimpan!');
            return redirect()->to('/settings/homepage');
            
        } catch (\Exception $e) {
            session()->setFlashdata('error', 'Error: ' . $e->getMessage());
            return redirect()->to('/settings/homepage');
        }
    }

    // ==================== ESTIMASI SETTINGS ====================
    
    // Test method untuk debug
    public function testEstimasi()
    {
        echo "<h1>Test Estimasi Settings</h1>";
        echo "<p>Controller method berjalan!</p>";
        
        // Test database
        $count = $this->db->table('site_content')
            ->where('page_name', 'estimasi')
            ->countAllResults();
        
        echo "<p>Data count: $count</p>";
        
        if ($count > 0) {
            $data = $this->db->table('site_content')
                ->where('page_name', 'estimasi')
                ->get()
                ->getResultArray();
            
            echo "<pre>";
            print_r($data);
            echo "</pre>";
        }
        
        echo "<p><a href='" . base_url('settings/estimasi-info') . "'>Go to Estimasi Info</a></p>";
    }
    
    public function estimasiInfo()
    {
        try {
            // Force fresh query - no cache
            $estimasiList = $this->db->table('site_content')
                ->where('page_name', 'estimasi')
                ->orderBy('id', 'ASC')
                ->get(0, 0, false)
                ->getResultArray();

            // DEBUG: Show raw data
            if($this->request->getGet('debug') === '1') {
                echo "<h2>DEBUG MODE - FRESH QUERY</h2>";
                echo "<p><strong>Total rows:</strong> " . count($estimasiList) . "</p>";
                echo "<p><strong>Query:</strong> " . $this->db->getLastQuery() . "</p>";
                echo "<pre>"; print_r($estimasiList); echo "</pre>";
                
                // Test direct count
                $countQuery = $this->db->query("SELECT COUNT(*) as total FROM site_content WHERE page_name='estimasi'");
                $count = $countQuery->getRow()->total;
                echo "<p><strong>Direct SQL Count:</strong> $count</p>";
                
                // Test all sections
                $sectionsQuery = $this->db->query("SELECT DISTINCT section_name FROM site_content WHERE page_name='estimasi' ORDER BY MIN(id)");
                echo "<p><strong>Sections in DB:</strong></p><ul>";
                foreach($sectionsQuery->getResultArray() as $s) {
                    echo "<li>{$s['section_name']}</li>";
                }
                echo "</ul>";
                die();
            }

            log_message('info', '=== ESTIMASI INFO DEBUG ===');
            log_message('info', 'Raw data count: ' . count($estimasiList));
            log_message('info', 'Raw data: ' . json_encode($estimasiList));

            // Jika tidak ada data, buat default
            if (empty($estimasiList)) {
                $defaults = [
                    ['page_name' => 'estimasi', 'section_name' => 'floating_box', 'content_key' => 'title', 'content_value' => 'Deskripsi Box Total'],
                    ['page_name' => 'estimasi', 'section_name' => 'floating_box', 'content_key' => 'description', 'content_value' => '<span style="color:#ffe082;">Ini total estimasi termurah</span> liburan ke Karimunjawa 3H2M.<br>Kamu bisa <b>upgrade</b> dengan klik pilihan yang ada. Buat liburanmu makin seru dan sesuai keinginan!'],
                    ['page_name' => 'estimasi', 'section_name' => 'transport_land', 'content_key' => 'title', 'content_value' => 'Transportasi Darat'],
                    ['page_name' => 'estimasi', 'section_name' => 'transport_land', 'content_key' => 'description', 'content_value' => 'Biaya transportasi darat dari titik jemput ke Jepara PP'],
                    ['page_name' => 'estimasi', 'section_name' => 'transport_sea', 'content_key' => 'title', 'content_value' => 'Transportasi Laut'],
                    ['page_name' => 'estimasi', 'section_name' => 'transport_sea', 'content_key' => 'description', 'content_value' => 'Harga tiket kapal PP dari Jepara ke Karimunjawa'],
                    ['page_name' => 'estimasi', 'section_name' => 'hotel', 'content_key' => 'title', 'content_value' => 'Penginapan'],
                    ['page_name' => 'estimasi', 'section_name' => 'hotel', 'content_key' => 'description', 'content_value' => 'Harga per kamar per malam (sharing room)'],
                    ['page_name' => 'estimasi', 'section_name' => 'activity', 'content_key' => 'title', 'content_value' => 'Wisata Laut'],
                    ['page_name' => 'estimasi', 'section_name' => 'activity', 'content_key' => 'description', 'content_value' => 'Paket snorkeling, diving, dan aktivitas water sports'],
                    ['page_name' => 'estimasi', 'section_name' => 'dest_laut', 'content_key' => 'title', 'content_value' => 'Wisata Darat'],
                    ['page_name' => 'estimasi', 'section_name' => 'dest_laut', 'content_key' => 'description', 'content_value' => 'Tiket masuk destinasi wisata lokal dan tempat bersejarah'],
                    ['page_name' => 'estimasi', 'section_name' => 'guide', 'content_key' => 'title', 'content_value' => 'Guide Lokal'],
                    ['page_name' => 'estimasi', 'section_name' => 'guide', 'content_key' => 'description', 'content_value' => 'Jasa pemandu wisata profesional (1 guide per 8 orang)'],
                    ['page_name' => 'estimasi', 'section_name' => 'transport', 'content_key' => 'title', 'content_value' => 'Transport Lokal'],
                    ['page_name' => 'estimasi', 'section_name' => 'transport', 'content_key' => 'description', 'content_value' => 'Biaya sewa motor/mobil lokal per hari di Karimunjawa'],
                    ['page_name' => 'estimasi', 'section_name' => 'food', 'content_key' => 'title', 'content_value' => 'Konsumsi'],
                    ['page_name' => 'estimasi', 'section_name' => 'food', 'content_key' => 'description', 'content_value' => 'Biaya makan 3x sehari (breakfast, lunch, dinner)'],
                    ['page_name' => 'estimasi', 'section_name' => 'facility', 'content_key' => 'title', 'content_value' => 'Fasilitas Tambahan'],
                    ['page_name' => 'estimasi', 'section_name' => 'facility', 'content_key' => 'description', 'content_value' => 'Fasilitas optional seperti dokumentasi, BBQ, dll'],
                ];

                foreach ($defaults as $d) {
                    $this->db->table('site_content')->insert($d);
                }

                // Fetch again
                $estimasiList = $this->db->table('site_content')
                    ->where('page_name', 'estimasi')
                    ->orderBy('id', 'ASC')
                    ->get()
                    ->getResultArray();
            }

            // Format data untuk view - group by section_name
            $serviceInfo = [];
            foreach ($estimasiList as $item) {
                if (!isset($serviceInfo[$item['section_name']])) {
                    $serviceInfo[$item['section_name']] = ['id' => $item['id'], 'key_name' => $item['section_name']];
                }
                $serviceInfo[$item['section_name']][$item['content_key']] = $item['content_value'];
            }

            // DEBUG OUTPUT
            if($this->request->getGet('show') === '1') {
                echo "<h2>Debug Controller Output</h2>";
                echo "<p>Raw rows: " . count($estimasiList) . "</p>";
                echo "<p>Grouped sections: " . count($serviceInfo) . "</p>";
                echo "<p>Section names: " . implode(', ', array_keys($serviceInfo)) . "</p>";
                echo "<pre>"; print_r(array_values($serviceInfo)); echo "</pre>";
                die();
            }

            log_message('info', 'Grouped sections count: ' . count($serviceInfo));
            log_message('info', 'Section names: ' . implode(', ', array_keys($serviceInfo)));
            log_message('info', 'Final serviceInfo: ' . json_encode(array_values($serviceInfo)));

            $data = [
                'title' => 'Settings Estimasi Biaya',
                'serviceInfo' => array_values($serviceInfo),
            ];

            return view('admin_settings_estimasi', $data);
        } catch (\Exception $e) {
            log_message('error', 'Error in estimasiInfo: ' . $e->getMessage());
            die('Error: ' . $e->getMessage() . '<br>Trace: ' . $e->getTraceAsString());
        }
    }

    // Update satu estimasi info (by section_name)
    public function updateEstimasiInfo($sectionName)
    {
        $description = $this->request->getPost('description');

        if (empty($description)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Description tidak boleh kosong']);
        }

        try {
            // Update description in site_content
            $this->db->table('site_content')
                ->where('page_name', 'estimasi')
                ->where('section_name', $sectionName)
                ->where('content_key', 'description')
                ->update(['content_value' => $description, 'updated_at' => date('Y-m-d H:i:s')]);

            // ✅ CLEAR CACHE OTOMATIS - Agar langsung sync tanpa refresh manual
            \Config\Services::cache()->clean();
            
            // Clear writable cache files
            $cacheDir = WRITEPATH . 'cache';
            if (is_dir($cacheDir)) {
                $files = glob($cacheDir . '/*');
                foreach ($files as $file) {
                    if (is_file($file)) {
                        @unlink($file);
                    }
                }
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Berhasil diperbarui dan otomatis tersinkronisasi!'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    // Reset ke default
    public function resetEstimasiInfoDefaults()
    {
        try {
            // Hapus semua estimasi entries
            $this->db->table('site_content')
                ->where('page_name', 'estimasi')
                ->delete();

            // Insert defaults
            $defaults = [
                ['page_name' => 'estimasi', 'section_name' => 'transport_land', 'content_key' => 'title', 'content_value' => 'Transportasi Darat'],
                ['page_name' => 'estimasi', 'section_name' => 'transport_land', 'content_key' => 'description', 'content_value' => 'Biaya transportasi darat dari titik jemput ke Jepara PP'],
                ['page_name' => 'estimasi', 'section_name' => 'transport_sea', 'content_key' => 'title', 'content_value' => 'Transportasi Laut'],
                ['page_name' => 'estimasi', 'section_name' => 'transport_sea', 'content_key' => 'description', 'content_value' => 'Harga tiket kapal PP dari Jepara ke Karimunjawa'],
                ['page_name' => 'estimasi', 'section_name' => 'hotel', 'content_key' => 'title', 'content_value' => 'Penginapan'],
                ['page_name' => 'estimasi', 'section_name' => 'hotel', 'content_key' => 'description', 'content_value' => 'Harga per kamar per malam (sharing room)'],
                ['page_name' => 'estimasi', 'section_name' => 'wisata_laut', 'content_key' => 'title', 'content_value' => 'Wisata Laut'],
                ['page_name' => 'estimasi', 'section_name' => 'wisata_laut', 'content_key' => 'description', 'content_value' => 'Paket Island Hopping dengan snorkeling dan aktivitas laut'],
                ['page_name' => 'estimasi', 'section_name' => 'wisata_darat', 'content_key' => 'title', 'content_value' => 'Wisata Darat'],
                ['page_name' => 'estimasi', 'section_name' => 'wisata_darat', 'content_key' => 'description', 'content_value' => 'Paket City Tour dengan tiket masuk dan pemandu lokal'],
                ['page_name' => 'estimasi', 'section_name' => 'guide', 'content_key' => 'title', 'content_value' => 'Guide Lokal'],
                ['page_name' => 'estimasi', 'section_name' => 'guide', 'content_key' => 'description', 'content_value' => 'Jasa pemandu wisata profesional (1 guide per 8 orang)'],
                ['page_name' => 'estimasi', 'section_name' => 'transport', 'content_key' => 'title', 'content_value' => 'Transport Lokal'],
                ['page_name' => 'estimasi', 'section_name' => 'transport', 'content_key' => 'description', 'content_value' => 'Biaya sewa motor/mobil lokal per hari di Karimunjawa'],
                ['page_name' => 'estimasi', 'section_name' => 'food', 'content_key' => 'title', 'content_value' => 'Konsumsi'],
                ['page_name' => 'estimasi', 'section_name' => 'food', 'content_key' => 'description', 'content_value' => 'Biaya makan 3x sehari (breakfast, lunch, dinner)'],
            ];

            foreach ($defaults as $d) {
                $this->db->table('site_content')->insert($d);
            }

            return $this->response->setJSON(['success' => true, 'message' => 'Berhasil reset ke default']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }
}
