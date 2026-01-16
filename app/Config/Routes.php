<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// 1. RUTE UTAMA (Bisa diarahkan ke kalkulator langsung biar tamu gak bingung)
$routes->get('/', 'Kalkulator::index'); 

// 2. RUTE ADMIN (Back Office)
$routes->get('admin', 'Admin::index');                   // Buka Dashboard
$routes->get('admin/dashboard', 'Admin::index');         // Dashboard (alias)
$routes->post('admin/simpan', 'Admin::simpan');          // Simpan Layanan Baru
$routes->post('admin/update_settings', 'Admin::update_settings'); // Update Header/Foto
$routes->get('admin/tambah', 'Admin::index');            // Tombol Tambah (Arahkan ke form index)
$routes->post('admin/update_info', 'Admin::update_info');        // Untuk simpan info cuaca
$routes->post('admin/upload_gallery', 'Admin::upload_gallery');  // Untuk upload foto
$routes->get('admin/delete_gallery/(:num)', 'Admin::delete_gallery/$1'); // Untuk hapus foto
// ... route admin lainnya ...
$routes->post('admin/update_layanan', 'Admin::update_layanan'); // Proses Edit
$routes->get('admin/delete_layanan/(:num)', 'Admin::delete_layanan/$1'); // Proses Hapus
$routes->get('admin/manage_service/(:num)', 'Admin::manage_service/$1');
$routes->post('admin/upload_service_photo', 'Admin::upload_service_photo');
$routes->get('admin/delete_service_photo/(:num)/(:num)', 'Admin::delete_service_photo/$1/$2');
$routes->post('admin/update_long_desc', 'Admin::update_long_desc');
$routes->post('admin/simpan_kota', 'Admin::simpan_kota');   // Simpan Titik Baru
$routes->get('admin/hapus_kota/(:num)', 'Admin::hapus_kota/$1'); // Hapus Titik
$routes->get('paket-alternatif', 'Kalkulator::paket_alternatif');
// === [BARU] ROUTE OPERASIONAL BOOKING (Perbaikan Error 404) ===
$routes->get('admin/booking_detail/(:num)', 'Admin::booking_detail/$1'); // Halaman Kelola Trip
$routes->post('admin/simpan_pengeluaran', 'Admin::simpan_pengeluaran');   // Simpan Pengeluaran
$routes->post('admin/update_guide_booking', 'Admin::update_guide_booking'); // Update Status & Guide
$routes->post('admin/simpan_konten', 'Admin::simpan_konten'); // Untuk upload promo
$routes->get('admin/hapus_konten/(:num)', 'Admin::hapus_konten/$1'); // Untuk hapus promo

// === [BARU] ROUTE WISATA DARAT & LAUT ===
$routes->post('admin/save_wisata', 'Admin::save_wisata'); // Simpan wisata darat/laut
$routes->post('admin/update_wisata', 'Admin::update_wisata'); // Update wisata
$routes->get('admin/delete_wisata/(:num)/(:any)', 'Admin::delete_wisata/$1/$2'); // Hapus wisata

// === [BARU] ROUTE KONSUMSI ===
$routes->post('admin/save_konsumsi', 'Admin::save_konsumsi'); // Simpan konsumsi
$routes->post('admin/update_konsumsi', 'Admin::update_konsumsi'); // Update konsumsi
$routes->get('admin/delete_konsumsi/(:num)', 'Admin::delete_konsumsi/$1'); // Hapus konsumsi

// === [BARU] ROUTE ITINERARY ===
$routes->post('admin/save_itinerary', 'Admin::save_itinerary'); // Simpan itinerary
$routes->post('admin/update_itinerary', 'Admin::update_itinerary'); // Update itinerary
$routes->get('admin/delete_itinerary/(:num)', 'Admin::delete_itinerary/$1'); // Hapus itinerary

// === [BARU] ROUTE JADWAL KAPAL ===
$routes->post('admin/simpan_jadwal_kapal', 'Admin::simpan_jadwal_kapal'); // Simpan jadwal kapal
$routes->post('admin/update_jadwal_kapal', 'Admin::update_jadwal_kapal'); // Update jadwal kapal
$routes->get('admin/delete_jadwal_kapal/(:num)', 'Admin::delete_jadwal_kapal/$1'); // Hapus jadwal kapal
$routes->get('admin/get_jadwal_kapal_json', 'Admin::get_jadwal_kapal_json'); // Get jadwal kapal as JSON

// === [BARU] ROUTE RESET DATA ===
$routes->post('admin/reset_data', 'Admin::reset_data');

// 3. RUTE KALKULATOR (Front End)
$routes->get('kalkulator', 'Kalkulator::index');         // Buka Halaman Depan
$routes->post('kalkulator/hitung', 'Kalkulator::hitung'); // <--- INI YANG TADINYA HILANG
$routes->get('itinerary', 'Kalkulator::itinerary');     // Halaman Itinerary Detail
$routes->get('itinerary/(:num)', 'Kalkulator::itinerary/$1'); // Halaman Itinerary dengan durasi

// 4. RUTE SETTINGS
$routes->get('settings/unified', 'Settings::settingsUnified');         // [NEW] Halaman settings unified modern 2027
$routes->post('settings/save-unified', 'Settings::saveUnified');       // [NEW] Simpan settings unified
$routes->get('settings/debug', 'Settings::debugSettings');             // [NEW] Debug page untuk cek database dan file
$routes->get('settings/estimasi-info', 'Settings::estimasiInfo');      // Halaman settings estimasi
$routes->post('settings/update-estimasi-info/(:any)', 'Settings::updateEstimasiInfo/$1'); // Update satu info
$routes->post('settings/reset-estimasi-info-defaults', 'Settings::resetEstimasiInfoDefaults'); // Reset defaults
$routes->get('settings/homepage', 'Settings::homepage');               // Halaman settings homepage (OLD)
$routes->post('settings/save-homepage', 'Settings::saveHomepage');     // Simpan settings homepage (OLD)

// 4B. RUTE BLOG
$routes->get('blog', 'Blog::index');                        // Halaman blog list
$routes->get('blog/(:slug)', 'Blog::detail/$1');           // Detail blog post
$routes->get('blog/category/(:any)', 'Blog::category/$1'); // Blog by category
$routes->get('blog/search', 'Blog::search');               // Search blog
$routes->get('blog/all', 'Blog::all');                     // [ADMIN] Get all posts
$routes->post('blog', 'Blog::create');                     // [ADMIN] Create post
$routes->post('blog/(:num)', 'Blog::update/$1');           // [ADMIN] Update post
$routes->delete('blog/(:num)', 'Blog::delete/$1');         // [ADMIN] Delete post

// 5. RUTE LAINNYA
$routes->get('/travel', 'Travel::index');
$routes->get('travel/karimunjawa', 'Travel::karimunjawa');   // Detail Karimunjawa

// 6. RUTE HALAMAN HOTEL & DESTINASI
$routes->get('hotel', 'Home::hotel');           // Halaman Hotel
$routes->get('destinasi', 'Home::destinasi');   // Halaman Destinasi