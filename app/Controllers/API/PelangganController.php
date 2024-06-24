<?php

namespace App\Controllers\API;

use App\Helpers\JwtHelper;
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
        // Validasi token
        $authHeader = $this->request->getHeader('Authorization');
        if ($authHeader) {
            $token = $authHeader->getValue();
            $data = JwtHelper::validateToken($token);

            if ($data) {
                $pelangganData = $this->pelangganModel->findAll();
                return $this->respond($pelangganData);
            } else {
                return $this->failUnauthorized('Invalid token');
            }
        } else {
            return $this->failUnauthorized('Token not provided');
        }
    }

    public function show($id_Pelanggan = null)
    {
        $Pelanggan = $this->pelangganModel->find($id_Pelanggan);

        if ($Pelanggan == null) {
            return $this->failNotFound('Data Pelanggan tidak ditemukan');
        }

        $data = [
            'message' => 'success',
            'Pelanggan_byid' => $Pelanggan
        ];

        return $this->respond($data, 200);
    }

    public function create()
    {
        $rules = $this->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'username' => 'required|is_unique[Pelanggan.username]',
            'password' => 'required'
        ]);

        if (!$rules) {
            $response = [
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        $this->pelangganModel->insert([
            'nama' => esc($this->request->getVar('nama')),
            'no_hp' => esc($this->request->getVar('no_hp')),
            'alamat' => esc($this->request->getVar('alamat')),
            'username' => esc($this->request->getVar('username')),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
        ]);

        $response = [
            'message' => 'Data Pelanggan berhasil ditambahkan'
        ];

        return $this->respondCreated($response);
    }
    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $pelanggan = $this->pelangganModel->where('username', $username)->first();
        if ($pelanggan) {
            if (password_verify($password, $pelanggan['password'])) {
                $tokenData = [
                    'id_pelanggan' => $pelanggan['id_pelanggan'],
                    'nama' => $pelanggan['nama'],
                    'username' => $pelanggan['username']
                ];

                $token = JwtHelper::createToken($tokenData);

                $response = [
                    'message' => 'Login successful',
                    'token' => $token,
                    'id_pelanggan' => $pelanggan['id_pelanggan'],
                    'nama' => $pelanggan['nama']
                ];

                log_message('info', 'Login successful for username: ' . $username);
                return $this->respond($response, 200);
            } else {
                log_message('error', 'Invalid password for username: ' . $username);
                return $this->fail('Invalid password', 401);
            }
        } else {
            log_message('error', 'User not found for username: ' . $username);
            return $this->failNotFound('User not found');
        }
    }

    public function update($id = null)
    {
        $rules = $this->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'username' => 'required|is_unique[Pelanggan.username,id,' . $id . ']',
            'password' => 'required'
        ]);

        if (!$rules) {
            $response = [
                'message' => 'Validation failed',
                'errors' => $this->validator->getErrors()
            ];

            return $this->failValidationErrors($response);
        }

        $this->pelangganModel->update($id, [
            'nama' => esc($this->request->getVar('nama')),
            'no_hp' => esc($this->request->getVar('no_hp')),
            'alamat' => esc($this->request->getVar('alamat')),
            'username' => esc($this->request->getVar('username')),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
        ]);

        $response = [
            'message' => 'Data Pelanggan berhasil diubah'
        ];

        return $this->respond($response, 200);
    }

    public function delete($id = null)
    {
        $this->pelangganModel->delete($id);

        $response = [
            'message' => 'Data Pelanggan berhasil dihapus'
        ];

        return $this->respondDeleted($response);
    }
}
