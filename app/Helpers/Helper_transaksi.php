<?php

namespace App\Helpers;

use App\Models\Pegawai;

class Helper_transaksi
{
    public static function resource_pelanggan($model)
    {
        $arr_pelanggan = [];
        foreach ($model as $pelanggan) {
            $arr_pelanggan[$pelanggan['id_pelanggan']] = $pelanggan['nama'];
        }
        return $arr_pelanggan;
    }

    public static function resource_layanan($model)
    {
        $arr_layanan = [];
        foreach ($model as $layanan) {
            $arr_layanan[$layanan['id_layanan']] = $layanan['nama_layanan'] . " / " . $layanan['harga'] . " / " . $layanan['waktu_pengerjaan'];
        }
        return $arr_layanan;
    }

    public static function get_pegawai($id)
    {
        $pegawaiModel = new Pegawai();
        return $pegawaiModel->where('id_users', $id)->findAll();
    }
}
