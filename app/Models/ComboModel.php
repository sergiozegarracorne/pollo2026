<?php

namespace App\Models;

use CodeIgniter\Model;

class ComboModel extends Model
{
    protected $table = 'combos';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['name', 'description', 'combo_price', 'active'];
}
