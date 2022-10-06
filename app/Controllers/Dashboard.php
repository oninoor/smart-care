<?php

namespace App\Controllers;

use App\Models\HospitalModel;
use App\Models\OauthClientsModel;
use Myth\Auth\Models\UserModel;

class Dashboard extends BaseController
{
    public function __construct()
    {
        // Model
        $this->userModel            = new UserModel();
        $this->hospitalModel        = new HospitalModel();
        $this->oauthClientsModel    = new OauthClientsModel();
        $this->db                   = \Config\Database::connect();
    }

    public function index()
    {
        $builder = $this->db->table('auth_groups_users');
        $builder->where('user_id', user_id());
        $role = $builder->get()->getRowArray();

        if ($role['group_id'] == 1) {
            return redirect()->to(base_url('admin'));
        }

        if (!user()->id_hospital) {
            return redirect()->to(base_url('set-up'));
        }


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
            $where = "DATE(created_at) = DATE(NOW() - INTERVAL " . $i . " DAY) AND id_hospital_req = " . user()->id_hospital . "";
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
            $where = "DATE(created_at) = DATE(NOW() - INTERVAL " . $i . " DAY) AND id_hospital_destination = " . user()->id_hospital . "";
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
            $where = "DATE(created_at) = DATE(NOW() - INTERVAL " . $i . " DAY) AND id_hospital_destination = " . user()->id_hospital . "";
            $builder->where($where);
            $result = $builder->countAllResults();
            $total_request_accepted_last_week += $result;
        }


        // All api req 
        $builder = $this->db->table('transactions');
        $where = "id_hospital_destination = " . user()->id_hospital . " OR id_hospital_req = " . user()->id_hospital . "";
        $builder->where($where);
        $builder->orderBy('created_at', 'DESC');
        $builder->limit(20);
        $api_all = $builder->get()->getResultArray();


        // All api sent 
        $builder = $this->db->table('transactions');
        $where = "id_hospital_req = " . user()->id_hospital . "";
        $builder->where($where);
        $builder->orderBy('created_at', 'DESC');
        $builder->limit(20);
        $api_sent = $builder->get()->getResultArray();


        // All api accepted 
        $builder = $this->db->table('transactions');
        $where = "id_hospital_destination = " . user()->id_hospital . "";
        $builder->where($where);
        $builder->orderBy('created_at', 'DESC');
        $builder->limit(20);
        $api_accept = $builder->get()->getResultArray();


        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
            'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Smart Care', 'li_2' => 'Dashboard']),
            'api_all'      => $api_all,
            'api_sent'      => $api_sent,
            'api_accept'      => $api_accept,
            'request_sent'      => $request_sent,
            'request_accepted'      => $request_accepted,
            'total_request_sent'      => $total_request_sent,
            'total_request_accepted'      => $total_request_accepted,
            'total_request_sent_last_week'      => $total_request_sent_last_week,
            'total_request_accepted_last_week'      => $total_request_accepted_last_week,
        ];

        return view('dashboard-index', $data);
    }
}
