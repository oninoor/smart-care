<?php

namespace App\Controllers;

use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;

class Auth extends BaseController
{
  public function __construct()
  {
    // Model
    $this->userModel = new UserModel();
  }


  public function show_register()
  {
    $data = [
      'title_meta' => view('partials/title-meta', ['title' => 'Register']),
      'page_title' => view('partials/page-title', ['title' => 'Register', 'li_1' => 'Admin', 'li_2' => 'Regular User List']),
      'validation' => \Config\Services::validation()
    ];

    return view('auth-register', $data);
  }

  public function process_register()
  {
    $rules = [
      'username'      => 'required|is_unique[users.username]',
      'firstname'     => 'required',
      'lastname'      => 'required',
      'email'         => 'required|valid_email|is_unique[users.email]',
      'password'      => 'required|strong_password',
    ];

    // Cek validasi
    if (!$this->validate($rules)) {
      session()->setFlashdata('pesan', 'Data validation failed, pelase check again!|error');
      return redirect()->to($this->request->getVar('redirect'))->withInput()->with('errors', $this->validator->getErrors());
    }

    $data = [
      'username'        => $this->request->getVar('username'),
      'email'           => $this->request->getVar('email'),
      'password_hash'   => Password::hash($this->request->getVar('password')),
      'firstname'       => $this->request->getVar('firstname'),
      'lastname'        => $this->request->getVar('lastname'),
      'active'          => 1,
      'email_verified'  => 1,
      'scope'           => 'app',
      'image'           => 'default.svg',
    ];

    if (!$this->userModel->save($data)) {
      session()->setFlashdata('pesan', 'Failed to save data!|error');
      return redirect()->to($this->request->getVar('redirect'));
    }

    session()->setFlashdata('pesan', 'Data has been saved!|success');
    return redirect()->to($this->request->getVar('redirect'));
  }
}
