<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;

class Errors extends BaseController
{
    use ResponseTrait;
    public function forbidden()
    {
        // Forbidden action
        return $this->failForbidden("Access Forbidden");
    }
}
