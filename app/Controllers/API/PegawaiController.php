<?php

namespace App\Controllers\API;

use App\Models\Pegawai;
use CodeIgniter\RESTful\ResourceController;

class PegawaiController extends ResourceController
{
    protected $modelName = 'App\Models\Pegawai'; // Perbaikan pada penulisan nama model
    protected $format = 'json';
    protected $pegawaiModel;

    public function __construct()
    {
        $this->pegawaiModel = new Pegawai();
    }

    public function index()
    {
        $data = $this->pegawaiModel->findAll();
        return $this->respond($data);
    }

    public function show($id_pegawai = null)
    {
        $pegawai = $this->pegawaiModel->find($id_pegawai);

        if ($pegawai === null) { // Perbaikan pada pengecekan nilai null
            return $this->failNotFound('Data pegawai tidak ditemukan');
        }

        $data = [
            'message' => 'success',
            'pegawai_by_id' => $pegawai // Perbaikan pada nama kunci array
        ];

        return $this->respond($data, 200);
    }

    public function create()
    {
        $rules = $this->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'email' => 'required',
        ]);

        if (!$rules) {
            $response = [
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        $this->pegawaiModel->insert($this->request->getPost()); // Menggunakan semua data yang dipost

        $response = [
            'message' => 'Data pegawai berhasil ditambahkan'
        ];

        return $this->respondCreated($response);
    }

    public function update($id = null)
    {
        $rules = $this->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'email' => 'required',
        ]);

        if (!$rules) {
            $response = [
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        $this->pegawaiModel->update($id, $this->request->getRawInput()); // Menggunakan semua data input

        $response = [
            'message' => 'Data pegawai berhasil diubah'
        ];

        return $this->respond($response, 200);
    }

    public function delete($id = null)
    {
        $this->pegawaiModel->delete($id);

        $response = [
            'message' => 'Data pegawai berhasil dihapus'
        ];

        return $this->respondDeleted($response);
    }
}
