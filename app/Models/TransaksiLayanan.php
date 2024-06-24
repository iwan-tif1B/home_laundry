<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiLayanan extends Model
{

    protected $table            = 'transaksi_layanan';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'id', 'id_transaksi', 'id_layanan', 'qty', 'subtotal'
    ];

    // join sama table barang supaya nama barangnya tampil
    public function tampilDataTemp($id_transaksi)
    {
        return $this->table('transaksi_layanan')
            ->join('layanan', 'id_layanan=id_layanan')
            ->where('id_transaksi', $id_transaksi)->get();
    }

    // public function hapusDataDetail($faktur)
    // {
    //     return $this->table('detail_barangkeluar')->delete(['detfaktur'=>$faktur]);

    // }

    function ambilTotalHarga($id_transaksi)
    {
        $query = $this->table('transaksi_layanan')->getWhere([
            'id_transaksi' => $id_transaksi
        ]);

        $totalHarga = 0;
        foreach ($query->getResultArray() as $r) :
            $totalHarga += $r['subtotal'];
        endforeach;
        return $totalHarga;
    }

    // public function get_array($id_transaksi)
    // {
    //     $query = $this->db->table('transaksi_layanan')->getWhere([
    //         'id_transaksi' => $id_transaksi
    //     ]);

    //     return $query->getResultArray();
    // }
    public function get_array($id_transaksi)
    {
        $query = $this->db->table('transaksi_layanan')
            ->select('transaksi_layanan.*, jenislayanan.nama_layanan, jenislayanan.harga, jenislayanan.waktu_pengerjaan')
            ->join('jenislayanan', 'transaksi_layanan.id_layanan = jenislayanan.id_layanan')
            ->where('transaksi_layanan.id_transaksi', $id_transaksi)
            ->get();

        return $query->getResultArray();
    }
}

// formData.push({
//     name: "data_keluarga",
//     value: JSON.stringify(table_keluarga_pasien.getData()),
//   });
// if ($data_keluarga !== '[]') {
//     foreach (Json::decode($data_keluarga) as $dk) {
//         if (!array_key_exists('id_pasien', $dk)) {
//             $pasien_keluarga = new PasienInfoKeluarga();
//             $pasien_keluarga->id_pasien = $pasien->id_pasien;
//             $pasien_keluarga->nama_keluarga = $dk['nama_keluarga'];
//             $pasien_keluarga->id_pasien_keluarga = $dk['id_pasien_keluarga'];
//             $pasien_keluarga->jenis_kelamin = $dk['jenis_kelamin'];
//             $pasien_keluarga->no_hp = $dk['no_hp'];
//             $pasien_keluarga->alamat = $dk['alamat'];
//             $pasien_keluarga->hubungan_pasien = $dk['hubungan_pasien'];
//             $pasien_keluarga->created_at = date("Y-m-d H:i:s");
//             $pasien_keluarga->created_by = Yii::$app->user->identity->getId();

//             if (!$pasien_keluarga->save()) {
//                 throw new Exception("Data pasien keluarga tidak valid!");
//             }
//         } else {
            // $existing_records = PasienInfoKeluarga::findAll(['id_pasien' => $pasien->id_pasien]);
            // $current_ids = array_column(Json::decode($data_keluarga), 'id');

            // // // Loop melalui catatan yang ada
            // foreach ($existing_records as $existing_record) {
            //     // Periksa apakah 'id' dari catatan yang ada tidak hadir dalam $current_ids saat ini
            //     if (!in_array($existing_record->id, $current_ids)) {
            //         // Hapus catatan yang tidak hadir dalam data yang diposting
            //         if (!$existing_record->delete()) {
            //             throw new Exception("Gagal menghapus catatan pasien keluarga!");
            //         }
            //     }
            // }
//         }
//     }
// } else {

//     $existing_records = PasienInfoKeluarga::findAll(['id_pasien' => $pasien->id_pasien]);
//     // $current_ids = array_column(Json::decode($data_keluarga), 'id');

//     // // Loop melalui catatan yang ada
//     foreach ($existing_records as $existing_record) {
//         // Periksa apakah 'id' dari catatan yang ada tidak hadir dalam $current_ids saat ini
//         // if (!in_array($existing_record->id, $current_ids)) {
//         // Hapus catatan yang tidak hadir dalam data yang diposting
//         if (!$existing_record->delete()) {
//             throw new Exception("Gagal menghapus catatan pasien keluarga!");
//         }
//         // }
//     }
//             }

// $data_keluarga = $post['data_keluarga'];
//         if ($data_keluarga !== "") {
//             foreach (Json::decode($data_keluarga) as $dk) {
//                 $pasien_keluarga = new PasienInfoKeluarga();
//                 $pasien_keluarga->id_pasien = $pasien->id_pasien;
//                 $pasien_keluarga->id_pasien_keluarga = $dk['id_pasien_keluarga'];
//                 $pasien_keluarga->nama_keluarga = $dk['nama_keluarga'];
//                 $pasien_keluarga->jenis_kelamin = $dk['jenis_kelamin'];
//                 $pasien_keluarga->no_hp = $dk['no_hp'];
//                 $pasien_keluarga->alamat = $dk['alamat'];
//                 $pasien_keluarga->hubungan_pasien = $dk['hubungan_pasien'];
//                 $pasien_keluarga->created_at = date("Y-m-d H:i:s");
//                 $pasien_keluarga->created_by = Yii::$app->user->identity->getId();

//                 if (!$pasien_keluarga->save()) {
//                     throw new Exception("Data pasien keluarga tidak valid!");
//                 }
//             }
//         }

// $query = PasienInfoKeluarga::find()
//       ->where(['id_pasien' => $id]);

//     // Mengambil data sebagai array
//     $data = $query->asArray()->all();
//     var jsonData = <?= json_encode($data ?? "") 

 // function setData() {
// if (table_keluarga_pasien) {
// table_keluarga_pasien.setData(jsonData);
// } else {
// console.log("Table is not available yet, retrying...");
// setTimeout(setData, 3000);
//   }
// } 