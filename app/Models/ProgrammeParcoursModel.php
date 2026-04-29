<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgrammeParcoursModel extends Model
{
    protected $table      = 'programmeParcours';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'idParcours',
        'idMatiere',
        'numSemestre',
        'idGroupeOption',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'idParcours'    => 'required|integer',
        'idMatiere'     => 'required|integer',
        'numSemestre'   => 'required|integer|greater_than[0]',
        'idGroupeOption' => 'permit_empty|integer',
    ];

    protected $validationMessages = [
        'idParcours' => [
            'required' => 'L\'ID du parcours est requis.',
            'integer'  => 'L\'ID du parcours doit être un nombre entier.',
        ],
        'idMatiere' => [
            'required' => 'L\'ID de la matière est requis.',
            'integer'  => 'L\'ID de la matière doit être un nombre entier.',
        ],
        'numSemestre' => [
            'required'     => 'Le numéro du semestre est requis.',
            'integer'      => 'Le numéro du semestre doit être un nombre entier.',
            'greater_than' => 'Le numéro du semestre doit être supérieur à 0.',
        ],
        'idGroupeOption' => [
            'integer' => 'L\'ID du groupe d\'option doit être un nombre entier.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
