<?php

namespace App\Models;

use CodeIgniter\Model;

class OauthClientsModel extends Model
{
  protected $table      = "oauth_clients";
  protected $primaryKey = "client_id";

  protected $useAutoIncrement = false;

  protected $returnType     = "object";
  protected $useSoftDeletes = false;

  protected $allowedFields = ["client_id", "client_secret", "redirect_uri", "grant_types", "scope", "user_id"];

  protected $useTimestamps = false;

  protected $validationRules    = [];
  protected $validationMessages = [];
  protected $skipValidation     = true;
}
