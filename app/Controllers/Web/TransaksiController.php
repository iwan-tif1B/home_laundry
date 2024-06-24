<?php

namespace App\Controllers\Web;

use App\Helpers\Helper_transaksi;
use App\Models\JenisLayanan;
use App\Models\Pegawai;
use App\Models\Pelanggan;
use App\Models\TempDetail;
use App\Models\Transaksi;
use App\Models\TransaksiLayanan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use CodeIgniter\RESTful\ResourceController;
use Config\Services;

class TransaksiController extends ResourceController
{
    protected $modelName = 'App\Models\Transaksi';
    protected $format = 'json';
    protected $transaksiModel;
    protected $pelangganModel;
    protected $pegawaiModel;
    protected $layanan_model;
    protected $transaksi_layanan;


    public function __construct()
    {
        $this->transaksiModel = new Transaksi();
        $this->pelangganModel = new Pelanggan();
        $this->pegawaiModel = new Pegawai();
        $this->layanan_model = new JenisLayanan();
        $this->transaksi_layanan = new TransaksiLayanan();
    }

    public function index()
    {

        $data_pelanggan = Helper_transaksi::resource_pelanggan($this->pelangganModel->findAll()); // Mengambil semua data pelanggan

        $data_layanan = Helper_transaksi::resource_layanan($this->layanan_model->findAll());
        // Kemudian, Anda dapat menggunakan $arr_pelanggan untuk mengirimkannya ke tampilan atau di mana pun Anda memerlukannya
        $data['transaksi'] = $this->transaksiModel->getAll();
        $data['arr_pelanggan'] = $data_pelanggan;
        $data['arr_layanan'] = $data_layanan;
        return view('Transaksi/index', $data);

    }

    public function show($id_transaksi = null)
    {
        $transaksi = $this->transaksiModel->find($id_transaksi);

        if ($transaksi == null) {
            return $this->failNotFound('Data transaksi tidak ditemukan');
        }

        return $this->respond(['message' => 'success', 'transaksi_byid' => $transaksi], 200);
    }

    public function export()
    {
        // Fetch all transactions from the database
        $transactions = $this->transaksiModel->getAll();

        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headers for the Excel file
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nama Pelanggan');
        $sheet->setCellValue('C1', 'Nama Pegawai');
        $sheet->setCellValue('D1', 'Tanggal Masuk');
        $sheet->setCellValue('E1', 'Tanggal Selesai');
        $sheet->setCellValue('F1', 'Status Bayar');
        $sheet->setCellValue('G1', 'Status');

        // Populate the Excel file with transaction data
        $row = 2;
        foreach ($transactions as $transaction) {
            // Populate the Excel file with transaction data
            $row = 2;
            foreach ($transactions as $transaction) {
                $sheet->setCellValue('A' . $row, $transaction->id_transaksi);
                $sheet->setCellValue('B' . $row, $transaction->nama_pelanggan);
                $sheet->setCellValue('C' . $row, $transaction->nama_pegawai);
                $sheet->setCellValue('D' . $row, $transaction->tanggal_masuk);
                $sheet->setCellValue('E' . $row, $transaction->tanggal_selesai);
                $sheet->setCellValue('F' . $row, $transaction->status_bayar);
                $sheet->setCellValue('G' . $row, $transaction->status);
                $row++;
            }
        }

        // Create a new Xlsx writer
        $writer = new Xlsx($spreadsheet);

        // Set the filename and send the Excel file as the response
        $filename = 'transactions_' . date('Y-m-d_His') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function create()
    {
        $data['pelanggan'] = $this->pelangganModel->findAll();
        $data['pegawai'] = $this->pegawaiModel->findAll();
        return view('Transaksi/create', $data); // Ganti 'new' menjadi 'create'
    }

    public function store()
    {
        if ($this->request->isAJAX()) {
            $id_pegawai = Helper_transaksi::get_pegawai(user()->id);
            $id_pegawai = $id_pegawai[0];
            // Get the form data
            $post = $this->request->getPost();

            // Mengambil data dari POST request
            // $post = $this->request->getPost();

            // Menyiapkan data untuk tabel transaksi
            $dataTransaksi = [
                'id_pegawai' => $id_pegawai['id_pegawai'],
                'id_pelanggan' => $post['id_pelanggan'],
                'tanggal_masuk' => $post['tanggal_masuk'],
                'tanggal_selesai' => $post['tanggal_selesai'],
                'status_bayar' => $post['status_bayar'],
                'status' => $post['status'],
                'total_harga' => $post['total_harga_layanan'],
                'keluhan' => $post['keluhan']
            ];

            $this->transaksiModel->save($dataTransaksi);
            $id_transaksi = $this->transaksiModel->getInsertID();


            $data_layanan = $post['layanan_pelanggan'];
            if (!empty($data_layanan)) {
                foreach (json_decode($data_layanan, true) as $dk) {
                    $data_transaksi_layanan = [
                        'id_transaksi' => $id_transaksi,
                        'id_layanan' => $dk['id_layanan'], // Hapus double dollar sign ($$)
                        'qty' => $dk['qty'], // Hapus double dollar sign ($$)
                        'subtotal' => $dk['subtotal'], // Hapus double dollar sign ($$)
                    ];
                    $this->transaksi_layanan->save($data_transaksi_layanan);
                }
            }





            // if ($this->validate($rules)) {

            //     $this->transaksiModel->save($formData);
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data saved successfully']);
            // } else {
            //     return $this->response->setJSON(['status' => 'error', 'message' => 'Validation failed', 'errors' => $this->validator->getErrors()]);
            // }
        } else {
            return redirect()->to('transaksi/create')->withInput()->with('error', 'Invalid request');
        }
    }

    public function update($id = null)
    {
        if ($this->request->isAJAX()) {
            $id_pegawai = Helper_transaksi::get_pegawai(user()->id);
            $id_pegawai = $id_pegawai[0];
            // Get the form data
            $post = $this->request->getPost();
            $dataTransaksi = [
                'id_pegawai' => $id_pegawai['id_pegawai'],
                'id_pelanggan' => $post['id_pelanggan'],
                'tanggal_masuk' => $post['tanggal_masuk'],
                'tanggal_selesai' => $post['tanggal_selesai'],
                'status_bayar' => $post['status_bayar'],
                'status' => $post['status'],
                'total_harga' => $post['total_harga_layanan'],
                'keluhan' => $post['keluhan']
            ];

            $this->transaksiModel->update($id, $dataTransaksi);
            $data_layanan = $post['layanan_pelanggan'];
            if ($data_layanan !== '[]') {
                $layanan_pelanggan = json_decode($data_layanan, true);

                foreach ($layanan_pelanggan as $dk) {
                    // Siapkan data untuk transaksi layanan
                    if (!array_key_exists('id', $dk)) {
                        $data_transaksi_layanan = [
                            'id_transaksi' => $id,
                            'id_layanan' => $dk['id_layanan'],
                            'qty' => $dk['qty'],
                            'subtotal' => $dk['subtotal'],
                            // Tambahkan data lainnya jika diperlukan
                        ];
                        // Simpan catatan baru
                        $this->transaksi_layanan->save($data_transaksi_layanan);
                    }
                }

                // Ambil data transaksi layanan terkait dengan transaksi ini setelah pembaruan
                $existing_records = $this->transaksi_layanan->where('id_transaksi', $id)->findAll();
                $current_ids = array_column($layanan_pelanggan, 'id_layanan');

                // Loop melalui catatan yang ada
                foreach ($existing_records as $existing_record) {
                    // Periksa apakah 'id_layanan' dari catatan yang ada tidak hadir dalam $current_ids saat ini
                    if (!in_array($existing_record['id_layanan'], $current_ids)) {
                        // Hapus catatan yang tidak hadir dalam data yang diposting
                        $this->transaksi_layanan->delete($existing_record['id']);
                    }
                }
            } else {
                $existing_records = $this->transaksi_layanan->where('id_transaksi', $id)->findAll();
                foreach ($existing_records as $existing_record) {
                    $this->transaksi_layanan->delete($existing_record['id']);
                }
            }

            // Jika semua operasi berhasil, kembalikan respons sukses
            return $this->response->setJSON(['status' => 'success', 'message' => $this->transaksi_layanan]);
        } else {
            // If it's not an AJAX request, redirect or handle accordingly
            return redirect()->to('/');
        }
    }
    public function update_data($id)
    {
        // $query = $this->transaksi_layanan->find($id);
        // // ->where(['id_pasien' => $id]);

        // // Mengambil data sebagai array
        // // Example: Retrieve data for the specified transaksi from the model
        // $data = $this->transaksiModel->find($id);

        // return $this->response->setJSON($data);
        $transaksi_layanan_data = $this->transaksi_layanan->get_array($id);
        // $transaksi_layanan_array = $transaksi_layanan_data->getResultArray();

        $transaksi_data = $this->transaksiModel->find($id);

        $data = [
            'transaksi_layanan' => $transaksi_layanan_data,
            'transaksi' => $transaksi_data
        ];


        return $this->response->setJSON($data);
    }

    public function delete($id = null)
    {

        // Temukan data transaksi berdasarkan id
        $transaksi = $this->transaksiModel->find($id);

        // Jika data transaksi tidak ditemukan, kembalikan respons gagal
        if ($transaksi === null) {
            return $this->failNotFound('Data transaksi tidak ditemukan');
        }

        // Ambil semua catatan transaksi_layanan yang terkait dengan id_transaksi
        $existing_records = $this->transaksi_layanan->where('id_transaksi', $id)->findAll();

        // Loop melalui semua catatan transaksi_layanan yang ditemukan dan hapus
        foreach ($existing_records as $existing_record) {
            $this->transaksi_layanan->delete($existing_record);
        }

        // Setelah semua catatan transaksi_layanan dihapus, hapus data transaksi di transaksiModel
        // $this->transaksi_layanan->delete(127);
        $this->transaksiModel->delete($id);

        // Kembalikan respons berhasil
        return $this->respondDeleted(['message' => 'Data transaksi berhasil dihapus']);
    }
}
