<?php

namespace App\Models;

use CodeIgniter\Model;

class Dealers extends Model
{
    protected $table            = 'dealers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id','user_id','city','state','zip_code','first_login'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getDealers(){
		$db = $this->db;
		$query = "SELECT d.id as dealer_id, d.user_id as user_id, d.city, d.state, d.zip_code, d.first_login, u.id AS user_id, CONCAT(u.first_name, ' ', u.last_name) AS full_name, u.email, u.password, u.user_type
              FROM dealers d
              INNER JOIN users u on u.id = d.user_id";
		return $db->query($query)->getResultArray();
	}
}

