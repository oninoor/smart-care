<?php

namespace App\Controllers;

use App\Models\HospitalModel;
use App\Models\OauthClientsModel;
use Myth\Auth\Models\UserModel;

class SetUp extends BaseController
{
    public function __construct()
    {
        // Model
        $this->userModel            = new UserModel();
        $this->hospitalModel        = new HospitalModel();
        $this->oauthClientsModel    = new OauthClientsModel();
        $this->db                   = \Config\Database::connect();

        // Check if set up is alredy done
        $set_up = $this->userModel->find(user_id());
        if ($set_up->set_up == 2) {
            return redirect()->to(base_url('dashboard'));
        }
    }

    // Show set up settings
    public function index()
    {
        // Check if set up step one is alredy done
        $set_up = $this->userModel->find(user_id());
        if ($set_up->set_up == 1) {
            return redirect()->to(base_url('set-up/credentials'));
        }

        $data = [
            'title_meta'    => view('partials/title-meta', ['title' => 'Setup']),
            'page_title'    => view('partials/page-title', ['title' => 'Setup', 'li_1' => 'Smart Care', 'li_2' => 'Set Up']),
            'validation'    => \Config\Services::validation(),
        ];
        return view('set-up-index', $data);
    }


    // Provide data for hospital selection in set up
    public function provide_hospitals()
    {
        // Get search keyword
        $keyword = $this->request->getVar('keyword');
        $data = [];

        // If no keyword found
        if (!$keyword) {
            $hospital = $this->hospitalModel->findAll(50);

            // Foreach to match choices.js format data
            foreach ($hospital as $row) {
                array_push($data, ['value' => $row->id, 'label' => '(' . $row->id_hospital . ')' . ' - ' . $row->name . ' - ' . $row->province]);
            }

            return $this->response->setJSON($data);
        }

        // If there was a keyword
        $builder = $this->db->table('hospitals');
        $builder->like('id_hospital', $keyword);
        $builder->orLike('name', $keyword);
        $builder->limit(50);
        $hospital = $builder->get()->getResult();

        // Foreach to match choices.js format data
        foreach ($hospital as $row) {
            array_push($data, ['value' => $row->id, 'label' => '(' . $row->id_hospital . ')' . ' - ' . $row->name . ' - ' . $row->province]);
        }

        return $this->response->setJSON($data);
    }

    public function process_hospital_data()
    {
        // Validation Rules
        $rules = [
            'hospital'          => 'required',
            'email'             => 'required|valid_email',
            'username'          => 'required',
            'password'          => 'required|strong_password|min_length[2]|alpha_numeric',
            'client_id'         => 'required|min_length[2]|alpha_numeric',
            'client_secret'     => 'required|min_length[2]|alpha_numeric',
            'grant_type'        => 'required',
        ];

        // Validation Check
        if (!$this->validate($rules)) {
            session()->setFlashdata('pesan', 'Data validation failed, pelase check again!|error');
            return redirect()->to(base_url('set-up'))->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update user profile to integrate with hospital data
        $hospital       = $this->hospitalModel->find($this->request->getVar('hospital'));
        $id_hospital    = $hospital->id_hospital;

        // Update id_hospital to Users
        $data = [
            'id'            => user_id(),
            'id_hospital'   => $id_hospital,
            'setup'        => 1
        ];
        if (!$this->userModel->save($data)) {
            session()->setFlashdata('pesan', 'Failed to save data!|error');
            return redirect()->to(base_url('set-up'))->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update credential for selected hospital
        $data = [
            'id'            => $this->request->getVar('hospital'),
            'email'         => $this->request->getVar('email'),
            'username'      => $this->request->getVar('username'),
            'password'      => $this->request->getVar('password'),
            'client_id'     => $this->request->getVar('client_id'),
            'client_secret' => $this->request->getVar('client_secret'),
            'grant_type'    => $this->request->getVar('grant_type'),
        ];

        // Update data hospital
        if (!$this->hospitalModel->save($data)) {
            session()->setFlashdata('pesan', 'Failed to save data!|error');
            return redirect()->to(base_url('set-up'))->withInput()->with('errors', $this->validator->getErrors());
        }

        // Create oauth clients for user
        $user           = $this->userModel->find(user_id());

        // Create random alphanumeric for client id and client secret
        $client_id      = $this->generateRandomString(40);
        $client_secret  = $this->generateRandomString(40);

        if ($this->oauthClientsModel->find($client_id)) {
            $client_id      = $this->generateRandomString(40);
            $client_secret  = $this->generateRandomString(40);
        }

        // Check if there are oauth clients wiht user_id same as user
        $builder = $this->db->table('oauth_clients');
        $builder->where('user_id', $user->username);
        $isExist = $builder->get()->getRow();
        if (isset($isExist)) {
            $this->oauthClientsModel->delete($isExist->client_id);
        }

        $data = [
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri'  => '',
            'grant_types'   => 'password',
            'scope'         => 'app',
            'user_id'       => $user->username,
        ];

        // Insert data credential to oauth clients
        $this->oauthClientsModel->save($data);

        session()->setFlashdata('pesan', 'Data has been saved!|success');
        return redirect()->to(base_url('set-up/credentials/'));
    }

    // Generate random alphanum for client id and secret
    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    // Show Credentials for user after initial set up
    public function show_credentials()
    {
        // Check if set up step one is alredy done
        $set_up = $this->userModel->find(user_id());
        if ($set_up->set_up == 0) {
            return redirect()->to(base_url('set-up'));
        }

        // Get user
        $user   = $this->userModel->find(user_id());

        // Get user oauth clients credential
        $builder = $this->db->table('oauth_clients');
        $builder->where('user_id', $user->username);
        $oauth_clients = $builder->get()->getRow();

        // Get hospital of user
        $builder = $this->db->table('hospitals');
        $builder->where('id_hospital', $user->id_hospital);
        $hospital = $builder->get()->getRow();

        $data = [
            'title_meta'    => view('partials/title-meta', ['title' => 'Setup']),
            'page_title'    => view('partials/page-title', ['title' => 'Setup', 'li_1' => 'Smart Care', 'li_2' => 'Your Smart Care Credentials']),
            'validation'    => \Config\Services::validation(),
            'user'          => $user,
            'oauth_client'  => $oauth_clients,
            'hospital'      => $hospital
        ];
        return view('set-up-credentials', $data);
    }

    public function process_credential()
    {
        // Update user to finish Set Up
        $data = [
            'id'        => user_id(),
            'set_up'    => 2
        ];

        if (!$this->userModel->save($data)) {
            session()->setFlashdata('pesan', 'Failed to save data!|error');
            return redirect()->to(base_url('set-up/credentials/'));
        }
        session()->setFlashdata('pesan', 'Data has been saved!|success');
        return redirect()->to(base_url('dashboard'));
    }
}
