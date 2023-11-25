<?php

namespace App\Models;

use CodeIgniter\Model;

class BankEntryModel extends Model
{
	protected $table = 'bank_entries';
	protected $primaryKey = 'id';
	// protected $foreignKey = 'parent_category_id';
	protected $useAutoIncrement = true;
    protected $returnType     = 'array';
	protected $allowedFields = ['bank_name', 'mode', 'date', 'suppliers', 'bank_id', 'value'];

	public function getSuppliers()
    {
        return $this->db->table($this->table)
            ->join('suppliers', 'entries.supplier_id = suppliers.id', 'left')
            ->join('categories', 'entries.parent_category_id = categories.id', 'left')
            ->join('sub_categories', 'entries.sub_category_id = sub_categories.id', 'left')
            ->select('entries.*, suppliers.name as supplier, suppliers.gst_type as gst_type, sub_categories.name as sub_category, categories.name as category')
            ->get()
            ->getResultArray();
    }

    public function getEntries($id)
    {
        return $this->db->table($this->table)
            ->join('suppliers', 'entries.supplier_id = suppliers.id', 'left')
            ->join('categories', 'entries.parent_category_id = categories.id', 'left')
            ->join('sub_categories', 'entries.sub_category_id = sub_categories.id', 'left')
            ->select('entries.*, suppliers.name as supplier, suppliers.gst_type as gst_type, sub_categories.name as sub_category, categories.name as category')
            ->where('entries.id', $id)
            ->get()
            ->getResultArray();
    }
}