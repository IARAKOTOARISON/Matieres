<?php

namespace App\Models;

use CodeIgniter\Model;

class NotesElevesModel extends Model
{
    protected $table      = 'notesEleves';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'idEleve',
        'idMatiere',
        'valeurNote',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [
        'idEleve'   => 'required|integer',
        'idMatiere' => 'required|integer',
        'valeurNote' => 'permit_empty|decimal',
    ];

    protected $validationMessages = [
        'idEleve' => [
            'required' => 'L\'ID de l\'élève est requis.',
            'integer'  => 'L\'ID de l\'élève doit être un nombre entier.',
        ],
        'idMatiere' => [
            'required' => 'L\'ID de la matière est requis.',
            'integer'  => 'L\'ID de la matière doit être un nombre entier.',
        ],
        'valeurNote' => [
            'decimal' => 'La note doit être un nombre décimal valide.',
        ],
    ];

    protected $skipValidation       = false;
    protected $cleanValidationRules = true;
}
