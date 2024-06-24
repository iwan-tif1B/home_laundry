<?php

namespace App\Controllers\API;

use App\Models\JenisLayanan;
use App\Models\Transaksi;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\TransaksiLayanan;

class TransaksiLayananController extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new TransaksiLayanan();
        $data = $model->findAll();

        return $this->respond($data);
    }

    public function show($id = null)
    {
        $model = new TransaksiLayanan();
        $data = $model->find($id);

        return $this->respond($data);
    }

    public function create()
    {
        $model = new TransaksiLayanan();

        $data = [
            'id_transaksi' => $this->request->getVar('id_transaksi'),
            'id_layanan'   => $this->request->getVar('id_layanan'),
        ];

        $model->insert($data);

        return $this->respondCreated(['message' => 'Data created successfully']);
    }
    // In your TransaksiLayananController
    public function createForm()
    {
        $transaksiModel = new Transaksi();
        $layananModel = new JenisLayanan();

        $data['transaksi'] = $transaksiModel->findAll();
        $data['layanan'] = $layananModel->findAll();

        return view('transaksilayanan/create_form', $data);
    }


    public function update($id = null)
    {
        $model = new TransaksiLayanan();

        $data = [
            'id_transaksi' => $this->request->getVar('id_transaksi'),
            'id_layanan'   => $this->request->getVar('id_layanan'),
        ];

        $model->update($id, $data);

        return $this->respond(['message' => 'Data updated successfully']);
    }

    public function delete($id = null)
    {
        $model = new TransaksiLayanan();
        $model->delete($id);

        return $this->respondDeleted(['message' => 'Data deleted successfully']);
    }
}
