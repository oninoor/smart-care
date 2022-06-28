<?php

namespace App\Controllers;

use App\Models\VisitModel;
use CodeIgniter\RESTful\ResourceController;

class ApiVisits extends ResourceController
{
    // protected $modelName = 'App\Models\Hospital';
    protected $format    = 'json';

    public function __construct()
    {
        $this->visitModel = new VisitModel();
    }

    public function index()
    {
        // Rules
        $rules = [
            'id_hospital'   => 'required|numeric',
            'nik'           => 'required|numeric|exact_length[16]',
        ];

        // Validate
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        // Get all data sendd by POST
        $data = $this->request->getPost();

        // Try to insert into visit tables
        if (!$this->visitModel->save($data)) {
            return $this->fail($this->model->errors());
        }

        // Return Success
        $data['status'] = 'Data has ben saved!';
        return $this->respondCreated($data);
    }
}
