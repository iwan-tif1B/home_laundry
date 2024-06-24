<?php

namespace App\Controllers\Web;

use App\Models\Pelanggan;
use CodeIgniter\RESTful\ResourceController;

class PelangganController extends ResourceController
{
    protected $modelName = 'App\Models\Pelanggan';
    protected $format = 'json';
    protected $pelangganModel;

    public function __construct()
    {
        $this->pelangganModel = new Pelanggan();
    }

    public function index()
    {
        $data['pelanggan'] = $this->pelangganModel->findAll();
        return view('Pelanggan/index', $data);
    }

    public function show($id_pelanggan = null)
    {
        $pelanggan = $this->pelangganModel->find($id_pelanggan);

        if ($pelanggan == null) {
            return $this->failNotFound('Data pelanggan tidak ditemukan');
        }

        return $this->respond(['message' => 'success', 'pelanggan_byid' => $pelanggan], 200);
    }

    public function store()
    {
        if ($this->request->isAJAX()) {
            // Get the form data
            $formData = $this->request->getPost();

            // Hash password if needed
            if (isset($formData['password'])) {
                $formData['password'] = password_hash($formData['password'], PASSWORD_BCRYPT, ['cost' => 12]);
            }

            // Run the validation
            $rules = [
                'username' => 'required',
                'password' => 'required',
                'nama' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
            ];

            if ($this->validate($rules)) {
                $this->pelangganModel->save($formData);
                return $this->response->setJSON(['status' => 'success', 'message' => 'Data saved successfully']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Validation failed', 'errors' => $this->validator->getErrors()]);
            }
        } else {
            return redirect()->to('pelanggan/create')->withInput()->with('error', 'Invalid request');
        }
    }

    public function update($id = null)
    {
        if ($this->request->isAJAX()) {
            // Get the form data
            $formData = $this->request->getPost();
            $rules = [
                'username' => 'required',
                'password' => 'required',
                'nama' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
            ];

            // Run the validation
            if ($this->validate($rules)) {
                // Validation passed

                // Hash password if needed
                if (isset($formData['password'])) {
                    $formData['password'] = password_hash($formData['password'], PASSWORD_BCRYPT, ['cost' => 12]);
                }

                $this->pelangganModel->update($id, $formData);

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
        // Example: Retrieve data for the specified pelanggan from the model
        $pelangganModel = new \App\Models\Pelanggan();
        $data = $pelangganModel->find($id);

        return $this->response->setJSON($data);
    }

    public function delete($id = null)
    {
        $pelanggan = $this->pelangganModel->find($id);

        if ($pelanggan === null) {
            return $this->failNotFound('Data pelanggan tidak ditemukan');
        }

        $this->pelangganModel->delete($id);
        return $this->respondDeleted(['message' => 'Data pelanggan berhasil dihapus']);
    }
}
