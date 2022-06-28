<?php

namespace App\Controllers;

use App\Models\HospitalModel;
use App\Models\OauthClientsModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\LoginModel;
use Myth\Auth\Password;

class Admin extends BaseController
{
  public function __construct()
  {
    // Model
    $this->userModel            = new UserModel();
    $this->loginModel           = new LoginModel();
    $this->hospitalModel        = new HospitalModel();
    $this->oauthClientsModel    = new OauthClientsModel();
    $this->db                   = \Config\Database::connect();
  }

  public function show_hospital()
  {
    $id_hospital = $this->request->getVar('id_hospital');
    $name = $this->request->getVar('name');

    if (!$id_hospital && !$name) {
      $hospitals = $this->hospitalModel->findAll(50);
    } else {
      $builder = $this->db->table('hospitals');
      $builder->like('id_hospital', $id_hospital);
      $builder->like('name', $name);
      $builder->limit(50);
      $hospitals = $builder->get()->getResult();
    }


    $data = [
      'title_meta' => view('partials/title-meta', ['title' => 'Hospital']),
      'page_title' => view('partials/page-title', ['title' => 'Hospital', 'li_1' => 'Hospital', 'li_2' => 'Show Hospital']),
      'hospitals'  => $hospitals,
      'id_hospital' => $id_hospital,
      'name'        => $name,
      'validation' => \Config\Services::validation()
    ];

    return view('hospital-index', $data);
  }

  public function show_edit_hospital($id)
  {
    $hospital = $this->hospitalModel->find($id);

    $data = [
      'title_meta' => view('partials/title-meta', ['title' => 'Hospital']),
      'page_title' => view('partials/page-title', ['title' => 'Hospital', 'li_1' => 'Hospital', 'li_2' => 'Edit Hospital']),
      'hospital'  => $hospital,
      'validation' => \Config\Services::validation()
    ];

    return view('hospital-edit-hospital', $data);
  }

  public function process_edit_hospital()
  {
    // Validation Rules
    $rules = [
      'id_hospital'       => 'required',
      'name'              => 'required',
      'province'          => 'required',
      'type'              => 'required',
      'class'             => 'required',
      'ownership'         => 'required',
    ];

    // Validation Check
    if (!$this->validate($rules)) {
      session()->setFlashdata('pesan', 'Data validation failed, pelase check again!|error');
      return redirect()->to(base_url('admin/edit-hospital/' . $this->request->getVar('id')))->withInput()->with('errors', $this->validator->getErrors());
    }

    // Set data hospital
    $data = [
      'id'            => $this->request->getVar('id'),
      'id_hospital'   => $this->request->getVar('id_hospital'),
      'name'          => $this->request->getVar('name'),
      'province'      => $this->request->getVar('province'),
      'type'          => $this->request->getVar('type'),
      'class'         => $this->request->getVar('class'),
      'ownership'     => $this->request->getVar('ownership'),
      'email'         => $this->request->getVar('email'),
      'password'      => $this->request->getVar('password'),
      'client_id'     => $this->request->getVar('client_id'),
      'client_secret' => $this->request->getVar('client_secret'),
      'grant_type'    => $this->request->getVar('grant_type'),
      'uri'           => $this->request->getVar('uri'),
    ];

    // Update data credentials hospital
    if (!$this->hospitalModel->save($data)) {
      session()->setFlashdata('pesan', 'Failed to update data!|error');
      return redirect()->to(base_url('admin/edit-hospital/' . $this->request->getVar('id')))->withInput()->with('errors', $this->validator->getErrors());
    }

    session()->setFlashdata('pesan', 'Data has been updated|success');
    return redirect()->to(base_url('admin/edit-hospital/' . $this->request->getVar('id')));
  }
}
