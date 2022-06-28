<?php

namespace App\Controllers;

use App\Models\HospitalModel;
use CodeIgniter\RESTful\ResourceController;

class ApiHospitals extends ResourceController
{
    // protected $modelName = 'App\Models\Hospital';
    protected $format    = 'json';

    public function __construct()
    {
        $this->hospitalModel    = new HospitalModel();
    }

    public function index()
    {
        $hospitals = $this->hospitalModel->findAll(50);

        return $this->respond($hospitals);
    }
}
