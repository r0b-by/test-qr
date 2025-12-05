<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentModel extends Model
{
    protected $table            = 'documents';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields    = [
        'filename',
        'original_name',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'filename'      => 'required|max_length[255]',
        'original_name' => 'required|max_length[255]',
    ];

    protected $validationMessages = [
        'filename' => [
            'required'   => 'Nama file harus diisi',
            'max_length' => 'Nama file maksimal 255 karakter'
        ],
        'original_name' => [
            'required'   => 'Nama asli file harus diisi',
            'max_length' => 'Nama asli file maksimal 255 karakter'
        ]
    ];

    protected $skipValidation = false;
}