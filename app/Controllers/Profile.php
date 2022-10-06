<?php

namespace App\Controllers;

use App\Models\HospitalModel;
use App\Models\OauthClientsModel;
use CodeIgniter\Database\MySQLi\Builder;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Models\LoginModel;
use Myth\Auth\Password;

class Profile extends BaseController
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
        // Get group user to know the user role
        $builder = $this->db->table('auth_groups_users');
        $builder->select('auth_groups_users.group_id, auth_groups.description');
        $builder->join('auth_groups', 'auth_groups_users.group_id = auth_groups.id');
        $builder->where('user_id', user()->id);
        $auth_group = $builder->get()->getRowArray();

        // Get group user to know the user permission
        $builder = $this->db->table('auth_groups_permissions');
        $builder->select('auth_permissions.name, auth_permissions.description');
        $builder->join('auth_permissions', 'auth_groups_permissions.permission_id = auth_permissions.id');
        $builder->where('group_id', $auth_group['group_id']);
        $auth_group_permission = $builder->get()->getResultArray();

        $access_history = $this->loginModel->where('email', user()->email)->orderBy('date', 'desc')->findAll(30);

        $builder = $this->db->table('hospitals');
        $builder->where('id_hospital', user()->id_hospital);
        $hospital = $builder->get()->getRow();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'My Profile']),
            'page_title' => view('partials/page-title', ['title' => 'My Profile', 'li_1' => 'Profile', 'li_2' => 'My Profile']),
            'auth_group' => $auth_group,
            'auth_group_permission' => $auth_group_permission,
            'access_history' => $access_history,
            'hospital' => $hospital,
            'validation'     => \Config\Services::validation(),
        ];
        return view('profile-my-profile', $data);
    }

    // Show change password page
    public function show_change_password()
    {
        return view('profile-change-password');
    }

    // Process change password
    public function process_change_password()
    {
        // Rules
        $rules = [
            'old_password'  => 'required',
            'password'      => 'required|strong_password',
            'pass_confirm'  => 'required|matches[password]',
        ];

        // Validate
        if (!$this->validate($rules)) {
            return redirect()->to(base_url('profile/change-password'))->withInput()->with('errors', $this->validator->getErrors());
        }

        $old_password = $this->request->getVar('old_password');
        $password = $this->request->getVar('password');

        // Check if the new password is the same as the old password 
        if ($old_password == $password) {
            session()->setFlashdata('pesan', 'The new password cannot be the same as the old password|error');
            return redirect()->to(base_url('profile/change-password'));
        }

        // Check if the password entered is correct
        if (!Password::verify($old_password, user()->password_hash)) {
            session()->setFlashdata('pesan', 'The password you entered does not match|error');
            return redirect()->to(base_url('profile/change-password'));
        }

        // Set Update data
        $data = [
            'id'              => user_id(),
            'password_hash'   => Password::hash($password),
        ];

        // Update password data
        if (!$this->userModel->save($data)) {
            session()->setFlashdata('pesan', 'Failed password to update|error');
            return redirect()->to(base_url('profile/change-password'));
        }

        session()->setFlashdata('pesan', 'Password has been updated successfully, please try to login|success');
        return redirect()->to(base_url('logout'));
    }

    public function process_edit_user()
    {
        $id = user_id();

        // Rules
        $rules = [
            'email'         => "required|valid_email|is_unique[users.email,id,$id]",
            'username'      => "required|is_unique[users.username,id,$id]",
            'firstname'     => 'required',
            'lastname'      => 'required',
        ];

        // Validate
        if (!$this->validate($rules)) {
            session()->setFlashdata('pesan', 'Validation failed, please check again|error');
            return redirect()->to(base_url('profile'))->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id'        => user_id(),
            'email'     => $this->request->getVar('email'),
            'username'  => $this->request->getVar('username'),
            'firstname' => $this->request->getVar('firstname'),
            'lastname'  => $this->request->getVar('lastname'),
        ];

        // Update data user
        if (!$this->userModel->save($data)) {
            session()->setFlashdata('pesan', 'Failed to update data|error');
            return redirect()->to(base_url('profile'))->withInput()->with('errors', $this->validator->getErrors());
        }

        session()->setFlashdata('pesan', 'Data has been updated|success');
        return redirect()->to(base_url('profile'));
    }

    public function process_edit_photo()
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
            'user_image'  => $result
        ];

        // Update gambar
        if (!$this->userModel->save($data)) {
            session()->setFlashdata('pesan', 'Failed to update data|error');
            return redirect()->to(base_url('profile'));
        }
        session()->setFlashdata('pesan', 'Data has been updated|success');
        return redirect()->to(base_url('profile'));
    }
}
