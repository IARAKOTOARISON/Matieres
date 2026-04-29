<?php

namespace App\Models;

use CodeIgniter\Model;

class MatieresModel extends Model
{
    protected $table      = 'matieres';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'codeMatiere',
        'intituleMatiere',
        'nombreCredit',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'codeMatiere'     => 'required|min_length[3]|max_length[20]',
        'intituleMatiere' => 'required|max_length[150]',
        'nombreCredit'    => 'required|integer',
    ];

    protected $validationMessages = [
        'codeMatiere'     => [
            'required'     => 'Le code de la matière est requis.',
            'min_length'   => 'Le code doit contenir au moins 3 caractères.',
            'max_length'   => 'Le code ne peut pas dépasser 20 caractères.',
        ],
        'intituleMatiere' => [
            'required'   => 'L\'intitulé de la matière est requis.',
            'max_length' => 'L\'intitulé ne peut pas dépasser 150 caractères.',
        ],
        'nombreCredit' => [
            'required' => 'Le nombre de crédits est requis.',
            'integer'  => 'Le nombre de crédits doit être un nombre entier.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
