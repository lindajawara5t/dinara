<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServiceModel;

class Kalkulator extends BaseController
{ 
    public function index()
    {
        $db = \Config\Database::connect();
        
        // 0. SET BAHASA - CEK GET PARAMETER UNTUK SWITCH BAHASA
        $lang = $this->request->getGet('lang') ?? session('language') ?? 'id';
        if(in_array($lang, ['id', 'en'])) {
            session()->set('language', $lang);
        } else {
            $lang = 'id';
            session()->set('language', $lang);
        }
        
        // Load language file using service
        helper('number');
        service('language')->setLocale($lang);
        
        // 1. AMBIL MENU DESTINASI
        $destinasi_menu = [];
        if ($db->tableExists('destinations')) {
            $destinasi_menu = $db->table('destinations')->where('is_active', 1)->get()->getResultArray();
        }
        if(empty($destinasi_menu)) {
            $destinasi_menu = [['name' => 'Karimunjawa', 'slug' => 'karimunjawa']];
        }

        // 2. DATA PETA & KOTA ASAL
        $kota_db = [];
        if ($db->tableExists('ref_cities')) {
            $kota_db = $db->table('ref_cities')->get()->getResultArray();
        }
        if(empty($kota_db)){
             $kota_db = [
                ['name'=>'Jepara (Alun-alun)', 'lat'=>'-6.5818', 'lng'=>'110.6784'],
                ['name'=>'Semarang', 'lat'=>'-6.9667', 'lng'=>'110.4167']
             ];
        }

        $transport_darat = $db->table('service_categories')->where('type', 'transport_land')->get()->getResultArray();
        $peta_data = [];
        
        foreach($kota_db as $k) {
            $kota_name = $k['name'];
            $koordinat = ['lat' => $k['lat'], 'lng' => $k['lng']];
            
            $keywords = [$kota_name]; 
            if(stripos($kota_name, 'Solo') !== false) $keywords[] = 'Surakarta';
            if(stripos($kota_name, 'Jogja') !== false) $keywords[] = 'Yogyakarta';

            $opsi = array_filter($transport_darat, function($t) use ($keywords) {
                foreach($keywords as $key) {
                    if (stripos($t['name'], $key) !== false || stripos($t['description'], $key) !== false) return true; 
                }
                return false;
            });
            
            $peta_data[$kota_name] = [
                'coords' => $koordinat,
                'opsi'   => array_values($opsi)
            ];
        }

        // 3. HELPER: AMBIL DATA LAYANAN (TERMASUK GAMBAR)
        $getRichData = function($types) use ($db) {
            if(!is_array($types)) $types = [$types];
            
            $items = $db->table('service_categories')
                        ->select('id, name, type, description, price_publish, price_net, image_url')
                        ->whereIn('type', $types)
                        ->orderBy('price_publish', 'ASC')
                        ->get()->getResultArray();
            
            // Jika field gambar kosong tapi ada di service_gallery, ambil dari sana
            foreach($items as &$item) {
                // Jika tidak ada gambar di service_categories, coba ambil dari service_gallery
                if(empty($item['image_url'])) {
                    $gallery = $db->table('service_gallery')
                                  ->where('service_id', $item['id'])
                                  ->select('image_url')
                                  ->get()->getRowArray();
                    if($gallery) {
                        $item['image_url'] = $gallery['image_url'];
                    }
                }
                
                if($db->tableExists('service_gallery')){
                    $item['gallery'] = $db->table('service_gallery')->where('service_id', $item['id'])->get()->getResultArray();
                } else {
                    $item['gallery'] = [];
                }
            }
            return $items;
        };

        // 4. PEMBAGIAN KATEGORI (UPDATE: DIPISAH LAUT & DARAT)
        $hotels    = $getRichData(['stay', 'homestay']); 
        
        // Load dari tabel wisata_darat dan wisata_laut yang baru
        $wisataDaratModel = new \App\Models\WisataDaratModel();
        $wisataLautModel = new \App\Models\WisataLautModel();
        $itineraryModel = new \App\Models\ItineraryModel();
        
        $tour_darat = $wisataDaratModel->where('is_active', 1)->findAll();
        $tour_laut = $wisataLautModel->where('is_active', 1)->findAll();
        
        // Load itinerary untuk semua durasi
        $itinerary_2d = $itineraryModel->getByDuration(2);
        $itinerary_3d = $itineraryModel->getByDuration(3);
        $itinerary_4d = $itineraryModel->getByDuration(4);
        
        $fasilitas = $getRichData(['service_other', 'facility']); 
        $lokal     = $getRichData(['transport_local']);  
        $guide     = $getRichData(['guide']); 

        $kapal     = $db->table('service_categories')->where('type', 'transport_sea')->get()->getResultArray();
        
        // [NEW] DESTINASI LAUT (HOPPING ISLAND - OPEN TRIP / PRIVATE TRIP / DIVING / MANCING)
        $destinasi_laut = $getRichData(['destinasi_laut']); // Ambil tipe 'destinasi_laut' dari database

        // 5. AMBIL SETTINGS WEB
        $settings = [];
        if ($db->tableExists('site_settings')) {
            $query = $db->query("SELECT * FROM site_settings");
            foreach($query->getResultArray() as $row){
                $settings[$row['setting_key']] = $row['setting_value'];
            }
        }

        // 6. AMBIL KONTEN PROMO (Filter: exclude estimasi)
        $promos = [];
        if ($db->tableExists('site_content')) {
            // Get all non-estimasi content, then group by ID
            $allContent = $db->table('site_content')
                ->where('page_name !=', 'estimasi')
                ->orderBy('id', 'DESC')
                ->get()
                ->getResultArray();
            
            // Reformat: group by ID to reconstruct promo objects
            $promoMap = [];
            foreach ($allContent as $row) {
                if (!isset($promoMap[$row['id']])) {
                    $promoMap[$row['id']] = ['id' => $row['id']];
                }
                $promoMap[$row['id']][$row['content_key']] = $row['content_value'];
            }
            $promos = array_values($promoMap);
        }

        // 7. AMBIL INFO DESCRIPTIONS (UNTUK TOOLTIP/POPOVER)
        $service_info = [];
        if ($db->tableExists('service_info')) {
            $info_list = $db->table('service_info')->get()->getResultArray();
            foreach ($info_list as $info) {
                $service_info[$info['key_name']] = [
                    'title' => $info['title'],
                    'description' => $info['description'],
                    'icon' => $info['icon']
                ];
            }
        }

        // 7b. AMBIL ESTIMASI SETTINGS (untuk info popover)
        $estimasi_settings = [];
        if ($db->tableExists('site_content')) {
            $estimasi_list = $db->table('site_content')
                ->where('page_name', 'estimasi')
                ->get()
                ->getResultArray();
            
            // Group by section_name
            foreach ($estimasi_list as $item) {
                $section = $item['section_name'];
                if (!isset($estimasi_settings[$section])) {
                    $estimasi_settings[$section] = [];
                }
                $estimasi_settings[$section][$item['content_key']] = $item['content_value'];
            }
        }

        // 8. KIRIM DATA KE VIEW
        $data = [
            'settings'       => $settings,
            'destinasi_list' => $destinasi_menu,
            'promos'         => $promos,
            'current_lang'   => $lang,
            'service_info'   => $service_info,  // <--- NEW: Info descriptions
            
            // 1. Kirim sebagai ARRAY
            'hotels'         => $hotels,
            'tour_laut'      => $tour_laut,      // <--- BARU: Wisata Laut
            'tour_darat'     => $tour_darat,     // <--- BARU: Wisata Darat
            'destinasi_laut' => $destinasi_laut,
            'guide'          => $guide,
            'itinerary_2d'   => $itinerary_2d,
            'itinerary_3d'   => $itinerary_3d,
            'itinerary_4d'   => $itinerary_4d,
            
            // 2. Kirim sebagai JSON
            'json_kota_asal' => json_encode($peta_data),
            'json_kapal'     => json_encode($kapal),
            'json_lokal'     => json_encode($lokal),
            'json_hotels'    => json_encode($hotels),
            'json_tour_laut' => json_encode($tour_laut),    // <--- BARU
            'json_tour_darat' => json_encode($tour_darat),  // <--- BARU
            'json_destinasi_laut' => json_encode($destinasi_laut),
            'json_fasilitas' => json_encode($fasilitas),
            'json_guide'     => json_encode($guide),
            'json_itinerary_2d' => json_encode($itinerary_2d),
            'json_itinerary_3d' => json_encode($itinerary_3d),
            'json_itinerary_4d' => json_encode($itinerary_4d),
            'json_service_info' => json_encode($service_info),
            'json_estimasi_settings' => json_encode($estimasi_settings),
            
            // Koordinat Peta
            'coord_jepara'   => json_encode(['lat' => -6.5950, 'lng' => 110.6690]),
            'coord_karimun'  => json_encode(['lat' => -5.8465, 'lng' => 110.4371])
        ];

        // Prevent cache - Force browser to always fetch fresh version
        $this->response->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        $this->response->setHeader('Pragma', 'no-cache');
        $this->response->setHeader('Expires', '0');
        
        return view('landing_page_story', $data);
    } 

    // --- HALAMAN PAKET ALTERNATIF ---
    public function paket_alternatif()
    {
        $data = [
            'budget' => $this->request->getGet('budget'),
            'pax'    => $this->request->getGet('pax'),
            'durasi' => $this->request->getGet('durasi'),
            'date'   => $this->request->getGet('date')
        ];
        return view('paket_detail_view', $data);
    }

    // ========================================================
    // TAHAP 1: ENDPOINT UNTUK HARGA TERMURAH (AJAX)
    // ========================================================
    public function get_cheapest_estimate()
    {
        $db = \Config\Database::connect();
        $kotaKey = $this->request->getGet('kota');  // Untuk support kota-specific estimates di masa depan
        
        // Helper function untuk ambil harga termurah per kategori
        $getLowPrice = function($type) use ($db) {
            $query = $db->table('service_categories')
                        ->where('type', $type)
                        ->orderBy('price_publish', 'ASC')
                        ->limit(1)
                        ->get()
                        ->getRowArray();
            return $query ? (int)$query['price_publish'] : 0;
        };

        // Helper untuk ambil nama termurah per kategori
        $getLowPriceName = function($type) use ($db) {
            $query = $db->table('service_categories')
                        ->where('type', $type)
                        ->orderBy('price_publish', 'ASC')
                        ->limit(1)
                        ->get()
                        ->getRowArray();
            return $query ? $query['name'] : 'Standard';
        };

        // 1. Ambil Data Termurah dari Database
        $hotel      = $getLowPrice('stay');              // Penginapan termurah
        $hotel_name = $getLowPriceName('stay');          // Nama penginapan termurah
        $tiket_laut = $getLowPrice('transport_sea');     // Tiket Kapal termurah
        $darat      = $getLowPrice('transport_local');   // Sewa Motor/Mobil termurah
        $makan      = $getLowPrice('food') ?: 50000;    // Paket makan termurah (default 50rb)
        $activity   = $getLowPrice('activity');          // Activity/Trip Laut termurah
        $dest_laut  = $getLowPrice('destinasi_laut');   // Destinasi Laut termurah (NEW)
        $dest_laut_name = $getLowPriceName('destinasi_laut'); // Nama destinasi laut (NEW)
        $guide      = $getLowPrice('guide');             // Guide termurah

        // 2. Hitung Total Estimasi (Asumsi Default: 1 Pax, 1 Hari/Malam)
        // Transport: Kapal PP (x2) + Darat (x1)
        $transport_sea_total = $tiket_laut * 2;    // Kapal PP
        $transport_land_total = $darat;             // Darat 1x
        $total_transport = $transport_sea_total + $transport_land_total;
        
        // Hotel: 1 malam
        $total_hotel = $hotel;
        
        // Wisata: Activity + Guide + Destinasi Laut
        $total_wisata = $activity + $dest_laut + $guide;
        
        // Konsumsi: Makan 3x per hari
        $total_konsumsi = $makan * 3;

        $grand_total = $total_transport + $total_hotel + $total_wisata + $total_konsumsi;

        // 3. Return format sesuai dengan ekspektasi JavaScript dengan breakdown detail
        return $this->response->setJSON([
            'success' => true,
            'hotel_name' => $hotel_name,
            
            // Detail breakdown
            'transport_sea' => $transport_sea_total,
            'transport_sea_text' => 'Rp ' . number_format($transport_sea_total, 0, ',', '.'),
            'transport_land' => $transport_land_total,
            'transport_land_text' => 'Rp ' . number_format($transport_land_total, 0, ',', '.'),
            'transport_total' => $total_transport,
            'transport_text' => 'Rp ' . number_format($total_transport, 0, ',', '.'),
            
            'hotel' => $total_hotel,
            'hotel_text' => 'Rp ' . number_format($total_hotel, 0, ',', '.'),
            
            'activity' => $activity,
            'dest_laut' => $dest_laut,  // NEW
            'dest_laut_name' => $dest_laut_name,  // NEW
            'guide' => $guide,
            'wisata' => $total_wisata,
            'activity_text' => 'Rp ' . number_format($total_wisata, 0, ',', '.'),
            
            'food' => $total_konsumsi,
            'food_text' => 'Rp ' . number_format($total_konsumsi, 0, ',', '.'),
            
            'grand_total' => $grand_total,
            'total_text' => 'Rp ' . number_format($grand_total, 0, ',', '.')
        ]);
    }

    public function itinerary($durasi = 3)
    {
        $durasi = (int) filter_var($durasi, FILTER_SANITIZE_NUMBER_INT);
        $durasi = in_array($durasi, [2, 3, 4]) ? $durasi : 3;
        
        $db = \Config\Database::connect();
        
        // Set language
        $lang = session('language') ?? 'id';
        helper('number');
        service('language')->setLocale($lang);
        
        // Load itinerary data
        $itineraryModel = new \App\Models\ItineraryModel();
        $itinerary = $itineraryModel->where('duration_day', $durasi)
                                   ->where('is_active', 1)
                                   ->orderBy('day_number, time_start', 'ASC')
                                   ->findAll();
        
        $data = [
            'durasi' => $durasi,
            'itinerary' => $itinerary,
            'json_itinerary' => json_encode($itinerary),
            'titles' => [
                2 => '2 Hari 1 Malam',
                3 => '3 Hari 2 Malam',
                4 => '4 Hari 3 Malam'
            ],
            'current_lang' => $lang
        ];
        
        return view('itinerary_detail', $data);
    }
}