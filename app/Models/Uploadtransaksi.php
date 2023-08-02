<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Model\belanja;

class Uploadtransaksi extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'uploadtransaksi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['belanja_id', 'file', 'created_at', 'updated_at'];

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

    public function belanja()
    {
        $builder = $this->db->table($this->table);
        $builder->select('uploadtransaksi.*, belanja.nama, belanja.jumlah, belanja.harga');
        $builder->join('belanja', 'belanja.id = uploadtransaksi.belanja_id', 'left');
        $builder->orderBy('created_at', 'ASC');

        return $builder->get()->getResult();
    }
}
