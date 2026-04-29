<?php

namespace App\Models;

use CodeIgniter\Model;

class ParcoursModel extends Model
{
    protected $table      = 'parcours';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'nomParcours',
        'responsableParcours',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'nomParcours'         => 'required|max_length[100]',
        'responsableParcours' => 'required|max_length[100]',
    ];

    protected $validationMessages = [
        'nomParcours' => [
            'required'   => 'Le nom du parcours est requis.',
            'max_length' => 'Le nom ne peut pas dépasser 100 caractères.',
        ],
        'responsableParcours' => [
            'required'   => 'Le responsable du parcours est requis.',
            'max_length' => 'Le nom du responsable ne peut pas dépasser 100 caractères.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
