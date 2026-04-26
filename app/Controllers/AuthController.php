<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    function __construct()
    {
        helper('form');
    }

    public function login()
    {
        if ($this->request->getPost()) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            // Simpan semua user dalam satu array (multi-dimensi)
            $users = [
                ['username' => 'raihan', 'password' => '202cb962ac59075b964b07152d234b70', 'role' => 'admin'],
                ['username' => 'nana', 'password' => '202cb962ac59075b964b07152d234b70', 'role' => 'user']
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
                    session()->set([
                        'username'   => $foundUser['username'],
                        'role'       => $foundUser['role'],
                        'isLoggedIn' => TRUE
                    ]);
                    return redirect()->to(base_url('/'));
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