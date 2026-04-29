<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupeOptionModel extends Model
{
    protected $table      = 'groupeOption';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'idMatiere',
        'idParcours',
        'numSemestre',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'idMatiere'   => 'required|integer',
        'idParcours'  => 'required|integer',
        'numSemestre' => 'required|integer|greater_than[0]',
    ];

    protected $validationMessages = [
        'idMatiere' => [
            'required' => 'L\'ID de la matière est requis.',
            'integer'  => 'L\'ID de la matière doit être un nombre entier.',
        ],
        'idParcours' => [
            'required' => 'L\'ID du parcours est requis.',
            'integer'  => 'L\'ID du parcours doit être un nombre entier.',
        ],
        'numSemestre' => [
            'required'    => 'Le numéro du semestre est requis.',
            'integer'     => 'Le numéro du semestre doit être un nombre entier.',
            'greater_than' => 'Le numéro du semestre doit être supérieur à 0.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
