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

  public function index()
  {
    // Request Sent
    $request_sent = [];
    $total_request_sent = 0;
    $total_request_sent_last_week = 0;
    $container = '';
    for ($i = 7; $i >= 1; $i--) {
      $builder = $this->db->table('transactions');
      $where = "DATE(created_at) = DATE(NOW() - INTERVAL " . $i . " DAY) AND id_hospital_req = " . user()->id_hospital . "";
      $builder->where($where);
      $result = $builder->countAllResults();
      $total_request_sent += $result;

      if ($i == 7) {
        $container .= $result;
      } else {
        $container .= ' ,' . $result;
      }
    }
    array_push($request_sent, $container);

    // Request sent last week
    for ($i = 14; $i >= 7; $i--) {
      $builder = $this->db->table('transactions');
      $where = "DATE(created_at) = DATE(NOW() - INTERVAL " . $i . " DAY)";
      $builder->where($where);
      $result = $builder->countAllResults();
      $total_request_sent_last_week += $result;
    }


    // Request accept
    $request_accepted = [];
    $total_request_accepted = 0;
    $total_request_accepted_last_week = 0;
    $container = '';
    for ($i = 7; $i >= 1; $i--) {
      $builder = $this->db->table('transactions');
      $where = "DATE(created_at) = DATE(NOW() - INTERVAL " . $i . " DAY)";
      $builder->where($where);
      $result = $builder->countAllResults();
      $total_request_accepted += $result;

      if ($i == 7) {
        $container .= $result;
      } else {
        $container .= ' ,' . $result;
      }
    }
    array_push($request_accepted, $container);

    // Request sent last week
    for ($i = 14; $i >= 7; $i--) {
      $builder = $this->db->table('transactions');
      $where = "DATE(created_at) = DATE(NOW() - INTERVAL " . $i . " DAY)";
      $builder->where($where);
      $result = $builder->countAllResults();
      $total_request_accepted_last_week += $result;
    }


    // All api req 
    $builder = $this->db->table('transactions');
    $builder->orderBy('created_at', 'DESC');
    $builder->limit(20);
    $api_all = $builder->get()->getResultArray();


    $data = [
      'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
      'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Smart Care', 'li_2' => 'Dashboard']),
      'api_all'      => $api_all,
      'request_sent'      => $request_sent,
      'request_accepted'      => $request_accepted,
      'total_request_sent'      => $total_request_sent,
      'total_request_accepted'      => $total_request_accepted,
      'total_request_sent_last_week'      => $total_request_sent_last_week,
      'total_request_accepted_last_week'      => $total_request_accepted_last_week,
    ];

    return view('admin-index', $data);
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
      'id_hospital'       => 'required|is_unique[hospitals.id_hospital,id,{id}]',
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
      'base_url'      => $this->request->getVar('base_url'),
      'medical_resume_uri'        => $this->request->getVar('medical_resume_uri'),
      'medical_resume_detail_uri' => $this->request->getVar('medical_resume_detail_uri'),
    ];

    // Update data credentials hospital
    if (!$this->hospitalModel->save($data)) {
      session()->setFlashdata('pesan', 'Failed to update data!|error');
      return redirect()->to(base_url('admin/edit-hospital/' . $this->request->getVar('id')))->withInput()->with('errors', $this->validator->getErrors());
    }

    session()->setFlashdata('pesan', 'Data has been updated|success');
    return redirect()->to(base_url('admin/edit-hospital/' . $this->request->getVar('id')));
  }

  public function delete_hospital()
  {
    if (!$this->hospitalModel->delete($this->request->getVar('id'))) {
      session()->setFlashdata('pesan', 'Failed to delete data!|error');
      return redirect()->to(base_url('admin/hospital'));
    }
    session()->setFlashdata('pesan', 'Data has been deleted|success');
    return redirect()->to(base_url('admin/hospital'));
  }

  public function show_add_hospital()
  {

    $data = [
      'title_meta' => view('partials/title-meta', ['title' => 'Hospital']),
      'page_title' => view('partials/page-title', ['title' => 'Hospital', 'li_1' => 'Hospital', 'li_2' => 'Edit Hospital']),
      'validation' => \Config\Services::validation()
    ];

    return view('hospital-add-hospital', $data);
  }

  public function process_add_hospital()
  {
    // Validation Rules
    $rules = [
      'id_hospital'       => 'required|is_unique[hospitals.id_hospital]',
      'name'              => 'required',
      'province'          => 'required',
      'type'              => 'required',
      'class'             => 'required',
      'ownership'         => 'required',
    ];

    // Validation Check
    if (!$this->validate($rules)) {
      session()->setFlashdata('pesan', 'Data validation failed, pelase check again!|error');
      return redirect()->to(base_url('admin/add-hospital/'))->withInput()->with('errors', $this->validator->getErrors());
    }

    // Set data hospital
    $data = [
      'id_hospital'   => $this->request->getVar('id_hospital'),
      'name'          => $this->request->getVar('name'),
      'province'      => $this->request->getVar('province'),
      'type'          => $this->request->getVar('type'),
      'class'         => $this->request->getVar('class'),
      'ownership'     => $this->request->getVar('ownership'),
    ];

    // Update data credentials hospital
    if (!$this->hospitalModel->save($data)) {
      session()->setFlashdata('pesan', 'Failed to saved data!|error');
      return redirect()->to(base_url('admin/add-hospital/'))->withInput()->with('errors', $this->validator->getErrors());
    }

    session()->setFlashdata('pesan', 'Data has been saved|success');
    return redirect()->to(base_url('admin/add-hospital/'));
  }

  public function show_users()
  {
    // Get all user
    $builder = $this->db->table('users');
    $builder->select('users.*, auth_groups.id as group_id, auth_groups.description');
    $builder->join('auth_groups_users', 'users.id = auth_groups_users.user_id');
    $builder->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id');
    $users = $builder->get()->getResultArray();

    $data = [
      'title_meta' => view('partials/title-meta', ['title' => 'Users']),
      'page_title' => view('partials/page-title', ['title' => 'Users', 'li_1' => 'Admin', 'li_2' => 'Users']),
      'users'      => $users,
      'validation' => \Config\Services::validation()
    ];
    return view('admin-users', $data);
  }

  public function show_edit_user($id)
  {
    // Get user by id
    $user = $this->userModel->find($id);

    // Get Role
    $builder = $this->db->table('auth_groups_users');
    $builder->select('auth_groups_users.group_id, auth_groups.description');
    $builder->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id');
    $builder->where('user_id', $id);
    $auth_group = $builder->get()->getRowArray();

    // Get permission
    $builder = $this->db->table('auth_groups_permissions');
    $builder->select('auth_permissions.name, auth_permissions.description');
    $builder->join('auth_permissions', 'auth_groups_permissions.permission_id = auth_permissions.id');
    $builder->where('group_id', $auth_group['group_id']);
    $auth_group_permission = $builder->get()->getResultArray();

    // Get all role
    $builder = $this->db->table('auth_groups');
    $builder->select('auth_groups.id, auth_groups.description');
    $groups = $builder->get()->getResultArray();

    // Get hospital
    $builder = $this->db->table('hospitals');
    $builder->where('id_hospital', $user->id_hospital);
    $hospital = $builder->get()->getRow();

    $data = [
      'title_meta' => view('partials/title-meta', ['title' => 'Users']),
      'page_title' => view('partials/page-title', ['title' => 'Users', 'li_1' => 'Users', 'li_2' => 'Edit User']),
      'validation'     => \Config\Services::validation(),
      'user'       => $user,
      'hospital'   => $hospital,
      'auth_group' => $auth_group,
      'groups'     => $groups,
      'auth_group_permission' => $auth_group_permission,
      'id'    => $id,
    ];
    return view('admin-edit-user', $data);
  }

  public function process_edit_user()
  {
    // Rules
    $rules = [
      'email'         => "required|valid_email|is_unique[users.email,id,{id}]",
      'username'      => "required|is_unique[users.username,id,{id}]",
      'firstname'     => 'required',
      'lastname'      => 'required',
    ];

    // Validation
    if (!$this->validate($rules)) {
      session()->setFlashdata('pesan', 'Data validation failed, pelase check again!|error');
      return redirect()->to($this->request->getVar('redirect'))->withInput();
    }

    $data = [
      'id'                => $this->request->getVar('id'),
      'email'             => $this->request->getVar('email'),
      'username'          => $this->request->getVar('username'),
      'firstname'         => $this->request->getVar('firstname'),
      'lastname'          => $this->request->getVar('lastname'),
    ];

    // Update data user
    if (!$this->userModel->save($data)) {
      session()->setFlashdata('pesan', 'Failed to update data!|error');
      return redirect()->to($this->request->getVar('redirect'))->withInput();
    }

    session()->setFlashdata('pesan', 'Data has been updated|success');
    return redirect()->to($this->request->getVar('redirect'));
  }

  // Process edit image user reguler
  public function process_edit_image_user()
  {
    $user_image = $this->request->getFile('user_image');

    //Cek apakah ada gambar baru
    if ($user_image->getError() == 4) {
      $result = $this->request->getVar('old_user_image');
    } else {
      $result = $user_image->getRandomName();
      $user_image->move('assets/images/users/', $result);
      if ($this->request->getVar('old_user_image') != null && $this->request->getVar('old_user_image') != 'default.svg') {
        unlink('assets/images/users/' . $this->request->getVar('old_user_image'));
      }
    }

    $data = [
      'id'          => user_id(),
      'user_image'       => $result
    ];

    // Update gambar
    if (!$this->userModel->save($data)) {
      session()->setFlashdata('pesan', 'Failed to update data!|error');
      return redirect()->to($this->request->getVar('redirect'))->withInput();
    }

    session()->setFlashdata('pesan', 'Data has been updated|success');
    return redirect()->to($this->request->getVar('redirect'));
  }

  public function show_add_user()
  {
    // Get all role
    $builder = $this->db->table('auth_groups');
    $groups = $builder->get()->getResultArray();

    $data = [
      'title_meta'      => view('partials/title-meta', ['title' => 'Users']),
      'page_title'      => view('partials/page-title', ['title' => 'Users', 'li_1' => 'Users', 'li_2' => 'Add New User']),
      'validation'      => \Config\Services::validation(),
      'groups'          => $groups,
    ];
    return view('admin-add-user', $data);
  }

  public function process_add_user()
  {
    $rules = [
      'username'      => 'required|is_unique[users.username]',
      'firstname'     => 'required',
      'lastname'      => 'required',
      'email'         => 'required|valid_email|is_unique[users.email]',
      'password'      => 'required|strong_password',
      'pass_confirm'  => 'matches[password]',
    ];

    // Cek validasi
    if (!$this->validate($rules)) {
      session()->setFlashdata('pesan', 'Data validation failed, pelase check again!|error');
      return redirect()->to($this->request->getVar('redirect'))->withInput()->with('errors', $this->validator->getErrors());
    }

    $user_image = $this->request->getFile('user_image');

    //Cek apakah ada gambar baru
    if ($user_image->getError() == 4) {
      $result = 'default.svg';
    } else {
      $result = $user_image->getRandomName();
      $user_image->move('assets/images/users/', $result);
    }

    $data = [
      'email'             => $this->request->getVar('email'),
      'username'          => $this->request->getVar('username'),
      'firstname'         => $this->request->getVar('firstname'),
      'lastname'          => $this->request->getVar('lastname'),
      'user_image'             => $result,
      'password_hash'     => Password::hash($this->request->getVar('password')),
      'active'            => 1,
      'email_verified'    => 1,
      'set_up'            => 0,
      'scope'             => 'app',
    ];

    if (!$this->userModel->save($data)) {
      session()->setFlashdata('pesan', 'Failed to save data!|error');
      return redirect()->to($this->request->getVar('redirect'))->withInput();
    }
    $dataGroups = [
      'group_id'    => $this->request->getVar('groups'),
      'user_id'     => $this->userModel->getInsertID()
    ];

    $builder = $this->db->table('auth_groups_users');
    $update = $builder->insert($dataGroups);

    if (!$update) {
      session()->setFlashdata('pesan', 'Failed to save user role!|error');
      return redirect()->to($this->request->getVar('redirect'));
    }

    session()->setFlashdata('pesan', 'Data has been saved|success');
    return redirect()->to($this->request->getVar('redirect'));
  }

  public function process_active()
  {
    $id = $this->request->getVar('id');

    // Ambil data user
    $user = $this->userModel->find($id);

    if ($user->active == 1) {
      $data = [
        'id'      => $id,
        'active'  => 0
      ];

      if (!$this->userModel->save($data)) {
        $message = [
          'status' => 'failed',
          'message' => 'User gagal dinonaktifkan'
        ];

        return $this->response->setJSON($message);
      } else {
        $message = [
          'status' => 'success',
          'message' => 'User berhasil dinonaktifkan'
        ];

        return $this->response->setJSON($message);
      }
    } else {
      $data = [
        'id'      => $id,
        'active'  => 1
      ];

      if (!$this->userModel->save($data)) {
        $message = [
          'status' => 'failed',
          'message' => 'User gagal diaktifkan'
        ];

        return $this->response->setJSON($message);
      } else {
        $message = [
          'status' => 'success',
          'message' => 'User berhasil diaktifkan'
        ];

        return $this->response->setJSON($message);
      }
    }
  }

  public function process_role()
  {
    $id = $this->request->getVar('id');
    $value = $this->request->getVar('value');

    // Cari hak akses dari user
    $builder = $this->db->table('auth_groups_users');
    $builder->select('*');
    $builder->where('user_id', $id);
    $auth_groups_users = $builder->get()->getRowArray();

    if (!$auth_groups_users) {
      $message = [
        'status' => 'failed',
        'message' => 'Data user tidak ditemukan'
      ];

      return $this->response->setJSON($message);
    }

    // Update hak akses dari user
    $data = [
      'group_id'    => $value,
      'user_id'     => $id
    ];

    $builder = $this->db->table('auth_groups_users');
    $builder->where('user_id', $id);
    $update = $builder->update($data);

    if (!$update) {
      $message = [
        'status' => 'failed',
        'message' => 'Hak akses gagal diubah'
      ];

      return $this->response->setJSON($message);
    } else {
      $message = [
        'status' => 'success',
        'message' => 'Hak akses berhasil diubah'
      ];

      return $this->response->setJSON($message);
    }
  }

  public function delete_user()
  {
    if (!$this->userModel->delete($this->request->getVar('id'))) {
      session()->setFlashdata('pesan', 'Failed to update data!|error');
      return redirect()->to($this->request->getVar('redirect'))->withInput();
    }

    session()->setFlashdata('pesan', 'Data has been updated|success');
    return redirect()->to($this->request->getVar('redirect'));
  }
}
