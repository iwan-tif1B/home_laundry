<?php

namespace App\Models;

use CodeIgniter\Model;

class Pelanggan extends Model
{
    protected $table            = 'pelanggan';
    protected $primaryKey       = 'id_pelanggan';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nama', 'no_hp', 'alamat', 'username', 'password', 'created_at', 'updated_at'];
    protected $returnType = 'array';

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime'; // Jika format tanggal di database adalah datetime

    public function getTotalCustomers()
    {
        return $this->countAll();
    }
}
