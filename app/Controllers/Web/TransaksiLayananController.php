<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\JenisLayanan;
use App\Models\Transaksi;
use App\Models\TransaksiLayanan;
use CodeIgniter\Exceptions\PageNotFoundException;

class TransaksiLayananController extends BaseController
{
    protected $transaksiLayananModel;
    protected $transaksiModel;
    protected $layananModel;

    public function __construct()
    {
        $this->transaksiLayananModel = new TransaksiLayanan();
        $this->transaksiModel = new Transaksi();
        $this->layananModel = new JenisLayanan();
    }

    public function index()
    {
        return view('Transaksi/forminput');
    }

    public function store()
    {
        if ($this->request->getMethod() === 'post') {
            // Get the form data
            $formData = $this->request->getPost();

            // Run the validation
            $rules = [
                'id_transaksi' => 'required|numeric',
                'id_layanan.*' => 'required|numeric',
                'qty.*' => 'required|numeric',
                'total_harga.*' => 'required|numeric',
            ];

            if ($this->validate($rules)) {
                try {
                    // Simpan data transaksi utama ke tabel transaksi
                    $transaksiData = [
                        'id_transaksi' => $formData['id_transaksi'],
                        // Tambahkan data transaksi lainnya yang diperlukan
                    ];
                    $transaksiId = $this->transaksiModel->insert($transaksiData, true); // Return ID of the inserted row

                    if (!$transaksiId) {
                        throw new \Exception('Failed to save transaction data');
                    }

                    // Simpan detail transaksi ke tabel transaksi layanan
                    $detailTransaksiData = [];
                    foreach ($formData['id_layanan'] as $index => $id_layanan) {
                        $detailTransaksiData[] = [
                            'id_transaksi' => $transaksiId,
                            'id_layanan' => $id_layanan,
                            'qty' => $formData['qty'][$index],
                            'total_harga' => $formData['total_harga'][$index],
                            // Tambahkan data detail transaksi lainnya yang diperlukan
                        ];
                    }

                    $success = $this->transaksiLayananModel->insertBatch($detailTransaksiData);

                    if ($success) {
                        return $this->response->setJSON(['status' => 'success', 'message' => 'Data saved successfully']);
                    } else {
                        throw new \Exception('Failed to save transaction details');
                    }
                } catch (\Exception $e) {
                    return $this->response->setJSON(['status' => 'error', 'message' => $e->getMessage()]);
                }
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Validation failed', 'errors' => $this->validator->getErrors()]);
            }
        } else {
            return redirect()->to('transaksi/forminput')->withInput()->with('error', 'Invalid request');
        }
    }

    public function create()
    {
        $data['transaksi'] = $this->transaksiModel->findAll();
        $data['jenislayanan'] = $this->layananModel->findAll();
        return view('Transaksi/forminput', $data);
    }

    public function edit($id)
    {
        $data = $this->transaksiLayananModel->find($id);

        if ($data) {
            return $this->response->setJSON($data);
        } else {
            throw PageNotFoundException::forPageNotFound();
        }
    }

    public function delete($id)
    {
        if ($this->transaksiLayananModel->delete($id)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data deleted successfully']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete data']);
        }
    }
}
