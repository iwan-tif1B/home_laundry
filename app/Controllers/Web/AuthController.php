<?php

namespace App\Controllers;

use App\Models\Pegawai;

class AuthController extends BaseController
{
    protected $pegawaiModel;

    public function __construct()
    {
        $this->pegawaiModel = new Pegawai();
    }

    public function login()
    {
        $session_id = session('id');
        $session_name = session('name');
        $session_role = session('role');

        if ($session_id && $session_name && $session_role) {
            if ($session_role == 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/pegawai/dashboard');
            }
        }

        return view('auth/login');
    }

    public function auth()
    {
        // Validasi input
        $validationRules = [
            'username' => 'required',
            'password' => 'required|min_length[4]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('error', 'Invalid input');
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cek keberadaan pengguna
        $pegawai = $this->pegawaiModel->where('username', $username)->first();

        if (!$pegawai) {
            return redirect()->back()->withInput()->with('error', 'User not found');
        }

        // Verifikasi password
        if (!password_verify($password, $pegawai['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid password');
        }

        // Set session data
        $session_data = [
            'id' => $pegawai['id'],
            'name' => $pegawai['name'],
            'role' => $pegawai['role']
        ];

        session()->set($session_data);

        // Redirect berdasarkan role
        if ($pegawai['role'] == 'admin') {
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->to('/pegawai/dashboard');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
