<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    function __construct()
    {
        helper('form');
        // Set timezone agar waktu login sesuai dengan WIB
        date_default_timezone_set('Asia/Jakarta'); 
    }

    public function login()
    {
        if ($this->request->getPost()) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $users = [
                ['username' => 'raihan', 'password' => '202cb962ac59075b964b07152d234b70', 'role' => 'admin', 'email' => 'raihanramadhanhamzah@gmail.com'],
                ['username' => 'nana', 'password' => '202cb962ac59075b964b07152d234b70', 'role' => 'user', 'email' => 'nana@example.com'],
            ];

            $foundUser = null;

            // Cari user yang cocok di dalam array
            foreach ($users as $user) {
                if ($user['username'] == $username) {
                    $foundUser = $user;
                    break;
                }
            }

            if ($foundUser) {
                if (md5($password) == $foundUser['password']) {
                    // Simpan data lengkap ke session termasuk email dan waktu login
                    session()->set([
                        'username'    => $foundUser['username'],
                        'role'        => $foundUser['role'],
                        'email'       => $foundUser['email'],
                        'waktu_login' => date('Y-m-d H:i:s'), // Format tanggal dan waktu saat ini
                        'isLoggedIn'  => TRUE
                    ]);
                    
                    // Redirect ke halaman profile atau home setelah login sukses
                    return redirect()->to(base_url('/profile')); // Ubah sesuai route kamu
                } else {
                    session()->setFlashdata('failed', 'Username & Password Salah');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('failed', 'Username Tidak Ditemukan');
                return redirect()->back();
            }
        } else {
            return view('v_login');
        }
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}