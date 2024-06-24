<?php

namespace App\Controllers\Web;

use App\Models\Pegawai;
use CodeIgniter\RESTful\ResourceController;

class PegawaiController extends ResourceController
{
    protected $modelName = 'App\Models\Pegawai';
    protected $format = 'json';
    protected $pegawaiModel;

    public function __construct()
    {
        $this->pegawaiModel = new Pegawai();
    }

    public function index()
    {
        $data['pegawai'] = $this->pegawaiModel->findAll();
        return view('Pegawai/index', $data);
    }

    public function showForm()
    {
        $data['pegawai'] = $this->pegawaiModel->findAll();

        log_message('debug', 'Pegawai data: ' . print_r($data['pegawai'], true));

    }

    public function show($id_pegawai = null)
    {
        $pegawai = $this->pegawaiModel->find($id_pegawai);

        if ($pegawai == null) {
            return $this->failNotFound('Data pegawai tidak ditemukan');
        }

        return $this->respond(['message' => 'success', 'pegawai_byid' => $pegawai], 200);
    }

    public function store()
    {
        if ($this->request->isAJAX()) {
            // Get the form data
            $formData = $this->request->getPost();

            $rules = [
                'nama' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
                'email' => 'required|valid_email', // Adding email field with validation
            ];

            // Run the validation
            if ($this->validate($rules)) {
                $pegawaiModel = new \App\Models\Pegawai();
                $pegawaiModel->save($formData);

                // Return a success response
                return $this->response->setJSON(['status' => 'success', 'message' => 'Data saved successfully']);
            } else {
                // Return a JSON response with validation errors
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $this->validator->getErrors(),
                ]);
            }
        } else {
            // If it's not an AJAX request, redirect to the appropriate route
            return redirect()->to('pegawai/create')->withInput()->with('error', 'Invalid request');
        }
    }
    public function update($id = null)
    {
        if ($this->request->isAJAX()) {
            // Get the form data
            $formData = $this->request->getPost();
            $rules = [
                'nama' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
                'email' => 'required',
            ];

            // Run the validation
            if ($this->validate($rules)) {
                // Validation passed

                $pegawaiModel = new Pegawai(); // Replace with your actual model
                $pegawaiModel->update($id, $formData);

                // Return a success response
                return $this->response->setJSON(['status' => 'success', 'message' => 'Data updated successfully']);
            } else {
                // Validation failed

                // Return a JSON response with validation errors
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $this->validator->getErrors(),
                ]);
            }
        } else {
            // If it's not an AJAX request, redirect or handle accordingly
            return redirect()->to('/');
        }
    }



    public function update_data($id)
    {
        // Example: Retrieve data for the specified pegawai from the model
        $pegawaiModel = new \App\Models\Pegawai();
        $data = $pegawaiModel->find($id);

        return $this->response->setJSON($data);
    }


    public function delete($id = null)
    {
        $pegawai = $this->pegawaiModel->find($id);

        if ($pegawai == null) {
            return $this->failNotFound('Data pegawai tidak ditemukan');
        }

        $this->pegawaiModel->delete($id);

        return $this->respondDeleted(['message' => 'Data pegawai berhasil dihapus']);
    }
}
