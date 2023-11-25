<?php

namespace App\Models;

use CodeIgniter\Model;

class SmsChargeModel extends Model
{
	protected $table = 'sms_charges';
	protected $primaryKey = 'id';
	// protected $foreignKey = 'parent_category_id';
	protected $useAutoIncrement = true;
    protected $returnType     = 'array';
	protected $allowedFields = ['bank_id','bank_name', 'date', 'value', 'sgst', 'cgst', 'igst'];

	public function getBanks()
    {
        return $this->db->table($this->table)
        ->join('bank_accounts', 'sms_charges.bank_id = bank_accounts.id', 'left')
            ->select('sms_charges.*, bank_accounts.name as bank_name')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResultArray();
    }
}