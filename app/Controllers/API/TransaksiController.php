<?php

namespace App\Controllers\API;

use App\Models\Pegawai;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use CodeIgniter\RESTful\ResourceController;

class TransaksiController extends ResourceController
{
    protected $modelName = 'App\Models\Transaksi';
    protected $format = 'json';
    protected $transaksiModel;
    protected $pelangganModel;
    protected $pegawaiModel;

    public function __construct()
    {
        $this->transaksiModel = new Transaksi();
        $this->pelangganModel = new Pelanggan();
        $this->pegawaiModel = new Pegawai();
    }

    public function index()
    {
        $data = $this->transaksiModel->findAll();
        return $this->respond($data);
    }

    public function show($id_transaksi = null)
    {
        $Transaksi = $this->transaksiModel->find($id_transaksi);

        if ($Transaksi == null) {
            return $this->failNotFound('Data Transaksi tidak ditemukan');
        }

        $data = [
            'message' => 'success',
            'transaksi_byid' => $Transaksi
        ];

        return $this->respond($data, 200);
    }

    public function create()
    {
        $rules = $this->validate([
            'id_pelanggan' => 'required',
            'tanggal_masuk' => 'required',
        ]);

        if (!$rules) {
            $response = [
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        $this->transaksiModel->insert([
            'id_pegawai' => 16,
            'id_pelanggan' => esc($this->request->getVar('id_pelanggan')),
            'tanggal_masuk' => esc($this->request->getVar('tanggal_masuk')),
            'status' => 'pending',
            'status_bayar' => 'belum',
        ]);

        $response = [
            'message' => 'Data Transaksi berhasil ditambahkan'
        ];

        return $this->respondCreated($response);
    }

    public function update($id = null)
    {
        $rules = $this->validate([
            'id_pegawai' => 'required',
            'id_pelanggan' => 'required',
            'tanggal_masuk' => 'required',
            'keluhan'
        ]);

        if (!$rules) {
            $response = [
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        $this->transaksiModel->update($id, [
            'id_pegawai' => esc($this->request->getVar('id_pegawai')),
            'id_pelanggan' => esc($this->request->getVar('id_pelanggan')),
            'tanggal_masuk' => esc($this->request->getVar('tanggal_masuk')),
            'keluhan' => esc($this->request->getVar('keluhan')),
        ]);

        $response = [
            'message' => 'Data Transaksi berhasil diubah'
        ];

        return $this->respond($response, 200);
    }

    public function updateKeluhan($id = null)
    {
        $rules = $this->validate([
            'keluhan' => 'required'
        ]);

        if (!$rules) {
            $response = [
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        $keluhan = esc($this->request->getVar('keluhan'));

        $transaksi = $this->transaksiModel->find($id);
        if (!$transaksi) {
            return $this->failNotFound('Transaksi tidak ditemukan');
        }

        $this->transaksiModel->update($id, ['keluhan' => $keluhan]);

        $response = [
            'message' => 'Keluhan berhasil diupdate'
        ];

        return $this->respond($response, 200);
    }


    public function delete($id = null)
    {
        $this->transaksiModel->delete($id);

        $response = [
            'message' => 'Data Transaksi berhasil dihapus'
        ];

        return $this->respondDeleted($response);
    }

    public function getByCustomerId($id_pelanggan = null)
    {
        $model = new Transaksi();
        $data = $model->getByCustomerId($id_pelanggan);

        if (!$data) {
            return $this->failNotFound('No transactions found for this customer ID.');
        }

        return $this->respond($data);
    }
}
