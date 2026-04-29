<?php

namespace App\Models;

use CodeIgniter\Model;

class TodoModel extends Model
{
    protected $table = 'todos';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['version'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];
    /**
     * Get Filtered Data
     * 
     * @param array $filter
     * @return array
     */
    public function getFiltered($filter)
    {
        $return = array();
        $builder = $this->db->table($this->table);
        if (!empty($filter['limit'])) {
            if (!empty($filter['offset'])) {
                $builder->limit($filter['limit'], $filter['offset']);
            } else {
                $builder->limit($filter['limit']);
            }
        }
        if (!empty($filter['order'])) {
            $builder->orderBy($filter['order']);
        }
        if (!empty($filter['version'])) {
            $builder->where('version', $filter['version']);
        }
        $query = $builder->get();
        $return['total'] = $builder->countAll();
        $return['data'] = array();
        foreach ($query->getResultArray() as $row) {
            $return['data'][$row[$this->primaryKey]] = $row;
        };
        return $return;
    }

}