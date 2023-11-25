<?php

namespace App\Models;

use CodeIgniter\Model;

class SubCategoryModel extends Model
{
	protected $table = 'sub_categories';
	protected $primaryKey = 'id';
	// protected $foreignKey = 'parent_category_id';
	protected $useAutoIncrement = true;
    protected $returnType     = 'array';
	protected $allowedFields = ['name', 'parent_category_id', 'description'];

	public function getCategoriesWithParent()
    {
        return $this->db->table($this->table)
            ->join('categories', 'sub_categories.parent_category_id = categories.id', 'left')
            ->select('sub_categories.*, categories.name as category_name, categories.description as category_description')
            ->get()
            ->getResultArray();
    }
}