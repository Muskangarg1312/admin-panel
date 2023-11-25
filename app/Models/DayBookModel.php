<?php

namespace App\Models;

use CodeIgniter\Model;

class DayBookModel extends Model
{
	protected $table = 'day_book';
	protected $primaryKey = 'id';
	// protected $foreignKey = 'parent_category_id';
	protected $useAutoIncrement = true;
    protected $returnType     = 'array';
	protected $allowedFields = ['date', 'type_id', 'type', 'event', 'data'];

    public function getDates()
    {
        $query = $this->db->table('day_book')
                          ->select('date')
                          ->orderBy('date', 'DESC')
                          ->distinct()
                          ->get();
        return $query->getResult();
    }
}