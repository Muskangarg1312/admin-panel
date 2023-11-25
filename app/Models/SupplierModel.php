<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
	protected $table = 'suppliers';
	protected $primaryKey = 'id';
	protected $useAutoIncrement = true;
    protected $returnType     = 'array';
	protected $allowedFields = ['name', 'address', 'gst_type', 'contact_person_name', 'contact_number'];
}