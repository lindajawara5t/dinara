<?php

namespace App\Controllers;

class Travel extends BaseController
{
    public function index()
    {
        // Ini perintah untuk memanggil tampilan (View)
        return view('halaman_depan');
    }
    
    public function karimunjawa()
    {
        $db = \Config\Database::connect();
        
        // Load settings
        $query = $db->query("SELECT * FROM site_settings");
        $data['settings'] = [];
        foreach($query->getResultArray() as $row){
            $data['settings'][$row['setting_key']] = $row['setting_value'];
        }
        
        return view('karimunjawa_detail', $data);
    }
}