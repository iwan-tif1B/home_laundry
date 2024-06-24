<?php

namespace App\Models;

use CodeIgniter\Model;

class Transaksi extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id_transaksi';
    protected $allowedFields    = ['id_pegawai', 'id_pelanggan', 'tanggal_masuk', 'tanggal_selesai', 'total_harga', 'status_bayar', 'status', 'keluhan'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getAll()
    {
        // Mendapatkan semua transaksi dengan detail pelanggan dan pegawai
        $builder = $this->db->table('transaksi');
        $builder->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan');
        $builder->join('pegawai', 'pegawai.id_pegawai = transaksi.id_pegawai');
        $builder->select('transaksi.*, pelanggan.nama AS nama_pelanggan, pegawai.nama AS nama_pegawai');
        // Menggunakan 'nama' sebagai pengganti 'nama_pegawai'
        $query = $builder->get();

        // Memeriksa apakah query berhasil dieksekusi
        if ($query) {
            // Mengembalikan hasil query jika berhasil
            return $query->getResult();
        } else {
            // Mengembalikan null jika terjadi kesalahan
            return null;
        }
    }
    public function getTotalTransactionsByStatus($status)
    {
        return $this->where('status', $status)->countAllResults();
    }

    public function getTodayTransactionsWithCustomer()
    {
        // Get today's date
        $today = date("Y-m-d");

        // Get transactions for today with customer data
        return $this->select('transaksi.*, pelanggan.nama')
            ->join('pelanggan', 'pelanggan.id_pelanggan = transaksi.id_pelanggan')
            ->where('tanggal_masuk', $today)
            ->findAll();
    }
    public function getByCustomerId($customerId)
    {
        return $this->where('id_pelanggan', $customerId)->findAll();
    }
}
