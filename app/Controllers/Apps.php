<?php

namespace App\Controllers;

use App\Models\HospitalModel;
use App\Models\OauthClientsModel;
use Myth\Auth\Models\UserModel;

class Apps extends BaseController
{
    public function __construct()
    {
        // Model
        $this->userModel            = new UserModel();
        $this->hospitalModel        = new HospitalModel();
        $this->oauthClientsModel    = new OauthClientsModel();
        $this->db                   = \Config\Database::connect();
    }

    public function show_hospital_credential()
    {
        // Get user
        $user   = $this->userModel->find(user_id());

        // Get hospital of user
        $builder = $this->db->table('hospitals');
        $builder->where('id_hospital', $user->id_hospital);
        $hospital = $builder->get()->getRow();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Hospital_credential']),
            'page_title' => view('partials/page-title', ['title' => 'Hospital_credential', 'li_1' => 'Apps', 'li_2' => 'Hospital Credential']),
            'user'          => $user,
            'hospital'      => $hospital,
            'validation'    => \Config\Services::validation(),
        ];

        return view('apps-hospital-credential', $data);
    }

    public function show_smartcare_credential()
    {
        // Get user
        $user   = $this->userModel->find(user_id());

        // Get user oauth clients credential
        $builder = $this->db->table('oauth_clients');
        $builder->where('user_id', $user->username);
        $oauth_clients = $builder->get()->getRow();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Smartcare_credential']),
            'page_title' => view('partials/page-title', ['title' => 'Smartcare_credential', 'li_1' => 'Apps', 'li_2' => 'Smartcare Credential']),
            'user'          => $user,
            'oauth_client'  => $oauth_clients,
        ];

        return view('apps-smartcare-credential', $data);
    }

    public function process_edit_hospital_credential()
    {
        // Validation Rules
        $rules = [
            'email'             => 'required|valid_email',
            'username'          => 'required',
            'password'          => 'required|strong_password|min_length[2]|alpha_numeric',
            'client_id'         => 'required|min_length[2]|alpha_numeric',
            'client_secret'     => 'required|min_length[2]|alpha_numeric',
            'grant_type'        => 'required',
            'base_url'          => 'required|valid_url|max_length[255]',
            'medical_resume_uri'        => 'required|alpha_dash',
            'medical_resume_detail_uri' => 'required|alpha_dash',
        ];

        // Validation Check
        if (!$this->validate($rules)) {
            session()->setFlashdata('pesan', 'Data validation failed, pelase check again!|error');
            return redirect()->to(base_url('apps/hospital-credential'))->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update credential for selected hospital
        $data = [
            'id'            => $this->request->getVar('id'),
            'email'         => $this->request->getVar('email'),
            'username'      => $this->request->getVar('username'),
            'password'      => $this->request->getVar('password'),
            'client_id'     => $this->request->getVar('client_id'),
            'client_secret' => $this->request->getVar('client_secret'),
            'grant_type'    => $this->request->getVar('grant_type'),
            'base_url'                  => $this->request->getVar('base_url'),
            'medical_resume_uri'        => $this->request->getVar('medical_resume_uri'),
            'medical_resume_detail_uri' => $this->request->getVar('medical_resume_detail_uri'),
        ];


        // Update data hospital
        if (!$this->hospitalModel->save($data)) {
            session()->setFlashdata('pesan', 'Failed to save data!|error');
            return redirect()->to(base_url('apps/hospital-credential'))->withInput();
        }

        session()->setFlashdata('pesan', 'Data has been saved!|success');
        return redirect()->to(base_url('apps/hospital-credential'))->withInput();
    }

    public function show_api_request_sent()
    {
        // Get user
        $id_hospital   = user()->id_hospital;

        $builder = $this->db->table('transactions');
        $builder->where('id_hospital_req', $id_hospital);
        $builder->limit(500);
        $api_req = $builder->get()->getResultArray();

        $count = $this->db->table('transactions')->where('id_hospital_req', $id_hospital)->countAllResults();


        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Smartcare_api_req']),
            'page_title' => view('partials/page-title', ['title' => 'Smartcare_api_req', 'li_1' => 'Apps', 'li_2' => 'Smartcare API Request Sent']),
            'api_req'    => $api_req,
            'count'      => $count,
        ];

        return view('apps-api-request-sent', $data);
    }

    public function show_api_request_accepted()
    {
        // Get user
        $id_hospital   = user()->id_hospital;

        $builder = $this->db->table('transactions');
        $builder->where('id_hospital_destination', $id_hospital);
        $builder->limit(500);
        $api_accepted = $builder->get()->getResultArray();

        $count = $this->db->table('transactions')->where('id_hospital_destination', $id_hospital)->countAllResults();


        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Smartcare_api_accepted']),
            'page_title' => view('partials/page-title', ['title' => 'Smartcare_api_accepted', 'li_1' => 'Apps', 'li_2' => 'Smartcare API Request Accepted']),
            'api_accepted'  => $api_accepted,
            'count'         => $count,
        ];

        return view('apps-api-request-accepted', $data);
    }
}
