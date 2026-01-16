<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSettingGroupToSiteSettings extends Migration
{
    public function up()
    {
        // Check if setting_group column exists before adding
        $fields = $this->db->getFieldData('site_settings');
        $fieldNames = array_column($fields, 'name');

        if (!in_array('setting_group', $fieldNames)) {
            $this->forge->addColumn('site_settings', [
                'setting_group' => [
                    'type'       => 'VARCHAR',
                    'constraint' => '100',
                    'default'    => 'general',
                    'after'      => 'setting_value'
                ],
            ]);
        }
    }

    public function down()
    {
        $fields = $this->db->getFieldData('site_settings');
        $fieldNames = array_column($fields, 'name');

        if (in_array('setting_group', $fieldNames)) {
            $this->forge->dropColumn('site_settings', 'setting_group');
        }
    }
}
