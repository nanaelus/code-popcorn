<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiTokenModel extends Model
{
    protected $table            = 'api_tokens';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['user_id', 'token', 'created_at', 'expires_at'];
    protected $useTimestamps = false;
}
