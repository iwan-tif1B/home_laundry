<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisLayanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_layanan' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_layanan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'harga' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
            ],
            'waktu_pengerjaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_layanan', true); //primary key true buat auto increment
        $this->forge->createTable('jenislayanan');
    }

    public function down()
    {
        $this->forge->dropTable('jenislayanan');
    }
}
