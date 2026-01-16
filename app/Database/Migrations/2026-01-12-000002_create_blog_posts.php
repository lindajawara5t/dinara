<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBlogPosts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'unique' => true,
            ],
            'excerpt' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'content' => [
                'type' => 'LONGTEXT',
                'null' => true,
            ],
            'featured_image' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'default' => 'wisata',
                'null' => false,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['published', 'draft'],
                'default' => 'published',
                'null' => false,
            ],
            'views' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
                'on_update' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('blog_posts');

        // Insert sample blog posts
        $data = [
            [
                'title' => 'Eksplorasi Keindahan Pulau Karimunjawa',
                'slug' => 'eksplorasi-keindahan-pulau-karimunjawa',
                'excerpt' => 'Karimunjawa adalah surga tersembunyi dengan 27 pulau yang menakjubkan. Temukan pengalaman snorkeling terbaik di nusantara.',
                'content' => 'Karimunjawa terletak di Laut Jawa sekitar 80 km barat laut Jepara. Kepulauan ini terdiri dari 27 pulau dengan pantai berpasir putih yang memukau dan kehidupan bawah laut yang sangat kaya. Setiap pulau memiliki keunikan tersendiri yang patut dijelajahi.',
                'category' => 'wisata',
                'status' => 'published',
            ],
            [
                'title' => 'Snorkeling 4 Pulau: Petualangan Bawah Laut',
                'slug' => 'snorkeling-4-pulau-petualangan-bawah-laut',
                'excerpt' => 'Jelajahi 4 pulau terindah dengan aktivitas snorkeling yang tak terlupakan. Saksikan terumbu karang dan ikan warna-warni.',
                'content' => 'Paket snorkeling 4 pulau adalah salah satu paket paling populer di Karimunjawa. Anda akan mengunjungi pulau-pulau dengan daya tarik unik masing-masing, termasuk terumbu karang yang sehat dan ikan-ikan yang berwarna-warni.',
                'category' => 'wisata',
                'status' => 'published',
            ],
            [
                'title' => 'Waktu Terbaik Berkunjung ke Karimunjawa',
                'slug' => 'waktu-terbaik-berkunjung-ke-karimunjawa',
                'excerpt' => 'Panduan lengkap tentang waktu terbaik mengunjungi Karimunjawa. Hindari musim gelombang tinggi dan nikmati cuaca terbaik.',
                'content' => 'Waktu terbaik berkunjung ke Karimunjawa adalah April hingga Oktober, saat musim kemarau. Selama periode ini, cuaca cerah, ombak tenang, dan visibility bawah laut sangat baik. Hindari Desember hingga Februari karena merupakan musim hujan dengan gelombang tinggi.',
                'category' => 'tips',
                'status' => 'published',
            ],
        ];

        $this->db->table('blog_posts')->insertBatch($data);
    }

    public function down()
    {
        $this->forge->dropTable('blog_posts');
    }
}
