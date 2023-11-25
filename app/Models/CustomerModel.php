<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
	protected $table = 'customers';
	protected $primaryKey = 'id';
	protected $useAutoIncrement = true;
    protected $returnType     = 'array';
	protected $allowedFields = ['name', 'address', 'contact_person_name', 'contact_number'];
}