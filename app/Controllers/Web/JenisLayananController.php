<?php

namespace App\Controllers\Web;

use App\Models\Jenislayanan;
use CodeIgniter\RESTful\ResourceController;

class JenislayananController extends ResourceController
{
    protected $modelName = 'App\Models\Jenislayanan';
    protected $format = 'json';
    protected $jenislayananModel;

    public function __construct()
    {
        $this->jenislayananModel = new Jenislayanan();
    }

    public function index()
    {
        $data['jenislayanan'] = $this->jenislayananModel->findAll();
        return view('Jenislayanan/index', $data);
    }

    public function showForm()
    {
        $data['jenislayanan'] = $this->jenislayananModel->findAll();
        return view('Jenislayanan/tambah', $data);
    }

    public function show($id_jenislayanan = null)
    {
        $jenislayanan = $this->jenislayananModel->find($id_jenislayanan);

        if ($jenislayanan == null) {
            return $this->respond(['status' => 'error', 'message' => 'Data jenis layanan tidak ditemukan'], 404);
        }

        return $this->respond(['status' => 'success', 'jenislayanan_byid' => $jenislayanan], 200);
    }
    public function update_data($id)
    {
        // Example: Retrieve data for the specified pelanggan from the model
        $layanan_model = new \App\Models\Jenislayanan();
        $data = $layanan_model->find($id);

        return $this->response->setJSON($data);
    }
    public function update($id = null)
    {
        if ($this->request->isAJAX()) {
            $rules = [
                'nama_layanan' => 'required',
                'harga' => 'required|numeric',
                'waktu_pengerjaan' => 'required|numeric',
                'deskripsi' => 'required'
            ];

            if (!$this->validate($rules)) {
                return $this->respond(['status' => 'error', 'message' => 'Validation failed', 'errors' => $this->validator->getErrors()]);
            }

            $data = [
                'nama_layanan' => $this->request->getPost('nama_layanan'),
                'harga' => $this->request->getPost('harga'),
                'waktu_pengerjaan' => $this->request->getPost('waktu_pengerjaan'),
                'deskripsi' => $this->request->getPost('deskripsi')
            ];

            try {
                $this->jenislayananModel->update($id, $data);
                return $this->respond(['status' => 'success', 'message' => 'Data updated successfully']);
            } catch (\Exception $e) {
                return $this->respond(['status' => 'error', 'message' => 'Failed to update data']);
            }
        } else {
            return redirect()->to('/');
        }
    }

    public function store()
    {
        $rules = [
            'nama_layanan' => 'required',
            'harga' => 'required|numeric',
            'waktu_pengerjaan' => 'required|numeric',
            'deskripsi' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors(),
            ]);
        }

        $data = [
            'nama_layanan' => $this->request->getPost('nama_layanan'),
            'harga' => $this->request->getPost('harga'),
            'waktu_pengerjaan' => $this->request->getPost('waktu_pengerjaan'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ];

        $this->jenislayananModel->insert($data);

        return $this->response->setJSON(['status' => 'success', 'message' => 'Data saved successfully']);
    }

    public function delete($id = null)
    {
        $jenislayanan = $this->jenislayananModel->find($id);

        if ($jenislayanan === null) {
            return $this->failNotFound('Data jenis layanan tidak ditemukan');
        }

        $this->jenislayananModel->delete($id);

        return $this->respondDeleted(['message' => 'Data jenis layanan berhasil dihapus']);
    }
}
