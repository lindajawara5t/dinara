<?php

namespace App\Controllers;
use App\Models\ServiceModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    
    /**
     * Halaman Hotel - Menampilkan daftar penginapan dari database
     */
    public function hotel()
    {
        $serviceModel = new ServiceModel();
        $db = \Config\Database::connect();
        
        // Ambil data hotel/penginapan - type 'stay' atau 'homestay'
        $hotels = $serviceModel->whereIn('type', ['stay', 'homestay'])
                               ->orderBy('price_publish', 'ASC')
                               ->findAll();
        
        // Ambil foto untuk setiap hotel dari service_gallery jika ada
        foreach ($hotels as &$hotel) {
            // Cek apakah tabel service_gallery ada
            if ($db->tableExists('service_gallery')) {
                $photos = $db->table('service_gallery')
                             ->where('service_id', $hotel['id'])
                             ->get()->getResultArray();
                $hotel['photos'] = $photos;
            } else {
                $hotel['photos'] = [];
            }
        }
        
        // Ambil settings untuk hero (cek tabel mana yang ada)
        $settings = [];
        if ($db->tableExists('settings')) {
            $settings = $db->table('settings')->get()->getRowArray() ?? [];
        } elseif ($db->tableExists('site_settings')) {
            $settingsData = $db->table('site_settings')->get()->getResultArray();
            foreach ($settingsData as $row) {
                $settings[$row['setting_key']] = $row['setting_value'];
            }
        }
        
        return view('hotel_page', [
            'hotels' => $hotels,
            'settings' => $settings
        ]);
    }
    
    /**
     * Halaman Destinasi - Menampilkan tempat wisata dari database
     */
    public function destinasi()
    {
        $db = \Config\Database::connect();
        
        // Ambil data wisata menggunakan Model
        $wisata_darat = [];
        $wisata_laut = [];
        
        if ($db->tableExists('wisata_darat')) {
            $wisataDaratModel = new \App\Models\WisataDaratModel();
            $wisata_darat = $wisataDaratModel->where('is_active', 1)
                                             ->orderBy('name', 'ASC')
                                             ->findAll();
        }
        
        if ($db->tableExists('wisata_laut')) {
            $wisataLautModel = new \App\Models\WisataLautModel();
            $wisata_laut = $wisataLautModel->where('is_active', 1)
                                           ->orderBy('name', 'ASC')
                                           ->findAll();
        }
        
        // Ambil settings untuk hero
        $settings = [];
        if ($db->tableExists('settings')) {
            $settings = $db->table('settings')->get()->getRowArray() ?? [];
        } elseif ($db->tableExists('site_settings')) {
            $settingsData = $db->table('site_settings')->get()->getResultArray();
            foreach ($settingsData as $row) {
                $settings[$row['setting_key']] = $row['setting_value'];
            }
        }
        
        return view('destinasi_page', [
            'wisata_darat' => $wisata_darat,
            'wisata_laut' => $wisata_laut,
            'settings' => $settings
        ]);
    }
}
