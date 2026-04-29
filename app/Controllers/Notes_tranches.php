<?php

namespace App\Controllers;

use App\Models\NotesElevesModel;

class Notes_tranches extends BaseController
{
    public function notes_tranches($type = null)
    {
        $model = new NotesElevesModel();

        $builder = $model
            ->select('eleves.nom, matieres.intituleMatiere, notesEleves.valeurNote, programmeParcours.numSemestre')
            ->join('eleves', 'eleves.id = notesEleves.idEleve')
            ->join('matieres', 'matieres.id = notesEleves.idMatiere')
            ->join('programmeParcours', 'programmeParcours.idMatiere = matieres.id');

        // S3
        if ($type == 'S3') {
            $builder->where('programmeParcours.numSemestre', 3);
        }

        // S4
        if ($type == 'S4') {
            $builder->where('programmeParcours.numSemestre', 4);
        }

        $notes = $builder->findAll();

        // L2 = moyenne S3 + S4
        if ($type == 'L2') {

            $notes = $model
                ->select('eleves.nom, AVG(notesEleves.valeurNote) as moyenne')
                ->join('eleves', 'eleves.id = notesEleves.idEleve')
                ->join('matieres', 'matieres.id = notesEleves.idMatiere')
                ->join('programmeParcours', 'programmeParcours.idMatiere = matieres.id')
                ->whereIn('programmeParcours.numSemestre', [3, 4])
                ->groupBy('eleves.id')
                ->findAll();
        }

        return view('notes_tranches', [
            'notes' => $notes,
            'type' => $type
        ]);
    }
}