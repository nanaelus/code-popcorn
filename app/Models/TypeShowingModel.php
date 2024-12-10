<?php

namespace App\Models;

use CodeIgniter\Model;

class TypeShowingModel extends Model
{
    protected $table            = 'type_showing';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

   public function getAllTypeShowing() {
       return $this->findAll();
   }
}
