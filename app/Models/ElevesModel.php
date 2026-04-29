<?php

namespace App\Models;

use CodeIgniter\Model;

class ElevesModel extends Model
{
    protected $table      = 'eleves';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'nom',
        'ETU',
        'idParcours',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'nom'       => 'required|max_length[100]',
        'ETU'       => 'required|integer|is_unique[eleves.ETU]',
        'idParcours' => 'required|integer',
    ];

    protected $validationMessages = [
        'nom' => [
            'required'   => 'Le nom de l\'élève est requis.',
            'max_length' => 'Le nom ne peut pas dépasser 100 caractères.',
        ],
        'ETU' => [
            'required'   => 'Le numéro ETU est requis.',
            'integer'    => 'Le numéro ETU doit être un nombre entier.',
            'is_unique'  => 'Ce numéro ETU existe déjà.',
        ],
        'idParcours' => [
            'required' => 'L\'ID du parcours est requis.',
            'integer'  => 'L\'ID du parcours doit être un nombre entier.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
