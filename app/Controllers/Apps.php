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

    public function show_simrs_credential()
    {
        // Get user
        $user   = $this->userModel->find(user_id());

        // Get hospital of user
        $builder = $this->db->table('hospitals');
        $builder->where('id_hospital', $user->id_hospital);
        $hospital = $builder->get()->getRow();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Simrs_Credential']),
            'page_title' => view('partials/page-title', ['title' => 'Simrs_Credential', 'li_1' => 'Apps', 'li_2' => 'SIMRS Credential']),
            'user'          => $user,
            'hospital'      => $hospital
        ];

        return view('apps-simrs-credential', $data);
    }

    public function show_my_credential()
    {
        // Get user
        $user   = $this->userModel->find(user_id());

        // Get user oauth clients credential
        $builder = $this->db->table('oauth_clients');
        $builder->where('user_id', $user->username);
        $oauth_clients = $builder->get()->getRow();

        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Simrs_Credential']),
            'page_title' => view('partials/page-title', ['title' => 'Simrs_Credential', 'li_1' => 'Apps', 'li_2' => 'SIMRS Credential']),
            'user'          => $user,
            'oauth_client'  => $oauth_clients,
        ];

        return view('apps-my-credential', $data);
    }
}
