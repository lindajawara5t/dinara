<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddServiceFields extends Migration
{
    public function up()
    {
        // Check if columns exist before adding
        $fields = $this->db->getFieldData('service_categories');
        $fieldNames = array_column($fields, 'name');

        if (!in_array('long_description', $fieldNames)) {
            $this->forge->addColumn('service_categories', [
                'long_description' => [
                    'type'       => 'LONGTEXT',
                    'null'       => true,
                    'after'      => 'description'
                ],
            ]);
        }

        if (!in_array('price_publish', $fieldNames)) {
            $this->forge->addColumn('service_categories', [
                'price_publish' => [
                    'type'       => 'DECIMAL',
                    'constraint' => '15,2',
                    'default'    => 0,
                    'after'      => 'image_url'
                ],
            ]);
        }

        if (!in_array('price_net', $fieldNames)) {
            $this->forge->addColumn('service_categories', [
                'price_net' => [
                    'type'       => 'DECIMAL',
                    'constraint' => '15,2',
                    'default'    => 0,
                    'after'      => 'price_publish'
                ],
            ]);
        }
    }

    public function down()
    {
        $fields = $this->db->getFieldData('service_categories');
        $fieldNames = array_column($fields, 'name');

        if (in_array('long_description', $fieldNames)) {
            $this->forge->dropColumn('service_categories', 'long_description');
        }
        if (in_array('price_publish', $fieldNames)) {
            $this->forge->dropColumn('service_categories', 'price_publish');
        }
        if (in_array('price_net', $fieldNames)) {
            $this->forge->dropColumn('service_categories', 'price_net');
        }
    }
}
