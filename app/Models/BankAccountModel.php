<?php

namespace App\Models;

use CodeIgniter\Model;

class BankAccountModel extends Model
{
	protected $table = 'bank_accounts';
	protected $primaryKey = 'id';
	protected $useAutoIncrement = true;
    protected $returnType     = 'array';
	protected $allowedFields = ['name', 'description'];
}