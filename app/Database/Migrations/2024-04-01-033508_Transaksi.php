<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_pegawai' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'id_pelanggan' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'total_harga' => [
                'type' => 'DECIMAL(14,2)',
            ],
            'tanggal_masuk' => [
                'type'       => 'DATE',
            ],
            'tanggal_selesai' => [
                'type'       => 'DATE'
            ],
            'status_bayar' => [
                'type' => 'ENUM', // Ubah menjadi ENUM
                'constraint' => "'sudah', 'belum'", // Nilai-nilai ENUM
                'default' => 'belum', // Nilai default
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => "'pending', 'prosess', 'dicuci', 'selesai', 'diambil'", // Ubah menjadi ENUM dan perbaiki nilai-nilai yang valid
                'default' => 'pending',
            ],
            'keluhan' => [
                'type'       => 'VARCHAR',
                'constraint' => '300',
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
        $this->forge->addKey('id_transaksi', true);
        $this->forge->addForeignKey('id_pegawai', 'pegawai', 'id_pegawai');
        $this->forge->addForeignKey('id_pelanggan', 'pelanggan', 'id_pelanggan');
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}
