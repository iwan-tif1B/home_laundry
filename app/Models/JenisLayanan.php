<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisLayanan extends Model
{
    protected $table         = 'jenislayanan';
    protected $primaryKey    = 'id_layanan';
    protected $allowedFields = ['nama_layanan', 'harga', 'waktu_pengerjaan', 'gambar'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Method to get service options
    public function getServiceOptions()
    {
        // Ambil data layanan dari database
        $layanan = $this->findAll();

        // Buat opsi untuk select element
        $options = '<option value="">Pilih Layanan</option>';
        foreach ($layanan as $service) {
            $options .= '<option value="' . $service['id_layanan'] . '">' . $service['nama_layanan'] . '</option>';
        }

        return $options;
    }

    // Method to get service price by ID
    public function getServicePriceById($layananId)
    {
        // Ambil harga layanan berdasarkan ID
        $layanan = $this->find($layananId);

        // Return the service price
        return $layanan['harga'];
    }
}
