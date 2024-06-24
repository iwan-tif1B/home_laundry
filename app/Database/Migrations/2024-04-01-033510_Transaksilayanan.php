<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransaksiLayanan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_transaksi' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'id_layanan' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'qty' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'total_harga' => [
                'type' => 'DECIMAL',
                'constraint' => '14,2',
                'unsigned' => true, // Tambahkan unsigned untuk total_harga
            ]
        ]);

        $this->forge->addForeignKey('id_transaksi', 'transaksi', 'id_transaksi', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_layanan', 'jenislayanan', 'id_layanan');
        $this->forge->addKey('id', true);
        $this->forge->createTable('transaksi_layanan');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi_layanan');
    }
}
