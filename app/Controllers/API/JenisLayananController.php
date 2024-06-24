<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;

class JenislayananController extends ResourceController
{
    protected $modelName = 'App\Models\Jenislayanan';
    protected $format = 'json';

    public function index()
    {
        $jenislayanans = $this->model->findAll();

        $data = [
            'message' => 'success',
            'data_jenislayanan' => $jenislayanans
        ];
        return $this->respond($data, 200);
    }

    public function show($id = null)
    {
        $jenislayanan = $this->model->find($id);

        if (!$jenislayanan) {
            return $this->failNotFound('Data jenis layanan tidak ditemukan');
        }

        $data = [
            'message' => 'success',
            'jenislayanan' => $jenislayanan
        ];

        return $this->respond($data, 200);
    }

    public function create()
    {
        $rules = $this->validate([
            'nama_layanan' => 'required',
            'harga' => 'required',
            'waktu_pengerjaan' => 'required',
            'deskripsi' => 'required'
        ]);

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        $this->model->insert([
            'nama_layanan' => esc($this->request->getVar('nama_layanan')),
            'harga' => esc($this->request->getVar('harga')),
            'waktu_pengerjaan' => esc($this->request->getVar('waktu_pengerjaan')),
            'deskripsi' => esc($this->request->getVar('deskripsi'))
        ]);
        $response = [
            'message' => 'Data jenis layanan berhasil ditambahkan'
        ];
        return $this->respondCreated($response);
    }

    public function update($id = null)
    {
        $rules = $this->validate([
            'nama_layanan' => 'required',
            'harga' => 'required',
            'waktu_pengerjaan' => 'required',
            'deskripsi' => 'required'
        ]);

        if (!$rules) {
            $response = [
                'message' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        $this->model->update($id, [
            'nama_layanan' => esc($this->request->getVar('nama_layanan')),
            'harga' => esc($this->request->getVar('harga')),
            'waktu_pengerjaan' => esc($this->request->getVar('waktu_pengerjaan')),
            'deskripsi' => esc($this->request->getVar('deskripsi'))
        ]);
        $response = [
            'message' => 'Data jenis layanan berhasil diubah'
        ];
        return $this->respond($response, 200);
    }

    public function delete($id = null)
    {
        $this->model->delete($id);

        $response = [
            'message' => 'Data jenis layanan berhasil dihapus'
        ];
        return $this->respondDeleted($response);
    }
}
