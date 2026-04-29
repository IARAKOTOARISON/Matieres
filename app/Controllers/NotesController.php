<?php

namespace App\Controllers;

use App\Models\NotesElevesModel;
use App\Models\ElevesModel;
use App\Models\MatieresModel;
use CodeIgniter\HTTP\RedirectResponse;

class NotesController extends BaseController
{
    protected NotesElevesModel $notesElevesModel;
    protected ElevesModel $elevesModel;
    protected MatieresModel $matieresModel;

    public function __construct()
    {
        $this->notesElevesModel = new NotesElevesModel();
        $this->elevesModel = new ElevesModel();
        $this->matieresModel = new MatieresModel();
    }

    /**
     * Affiche la liste des étudiants pour sélectionner
     * 
     * @return string
     */
    public function index(): string
    {
        // Vérifier que l'utilisateur est connecté
        if (!session()->get('user')) {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $eleves = $db->table('eleves e')
            ->select('e.id, e.nom, e.ETU, e.idParcours, p.nomParcours')
            ->join('parcours p', 'e.idParcours = p.id', 'left')
            ->get()
            ->getResultArray();

        $data = [
            'title'   => 'Gestion des Notes',
            'eleves'  => $eleves,
        ];

        return view('notes/liste-eleves', $data);
    }

    /**
     * Affiche le formulaire d'ajout/modification des notes pour un étudiant
     * 
     * @param int $idEleve
     * @return string
     */
    public function formulaire(int $idEleve): string
    {
        $eleve = $this->elevesModel->find($idEleve);

        if (!$eleve) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Élève non trouvé');
        }

        $matieres = $this->matieresModel->findAll();
        $matieres_avec_notes = [];

        foreach ($matieres as $matiere) {
            $noteExistante = $this->notesElevesModel->where('idEleve', $idEleve)
                ->where('idMatiere', $matiere['id'])
                ->first();

            $matieres_avec_notes[] = [
                'matiere' => $matiere,
                'note' => $noteExistante,
            ];
        }

        $data = [
            'title'   => 'Gestion des Notes - ' . htmlspecialchars($eleve['nom']),
            'eleve'   => $eleve,
            'matieres_avec_notes' => $matieres_avec_notes,
        ];

        return view('notes/formulaire-notes', $data);
    }

    /**
     * Ajoute ou met à jour plusieurs notes via formulaire
     * 
     * @return RedirectResponse
     */
    public function add(): RedirectResponse
    {
        $idEleve = $this->request->getPost('idEleve');

        if (!$idEleve || !$this->elevesModel->find($idEleve)) {
            return redirect()->back()->with('error', 'Élève invalide.');
        }

        $notes = $this->request->getPost('notes') ?? [];
        $semesters = $this->request->getPost('semesters') ?? [];

        foreach ($notes as $idMatiere => $valeurNote) {
            $valeurNote = trim($valeurNote);
            $numSemestre = isset($semesters[$idMatiere]) ? (int)$semesters[$idMatiere] : null;

            // Valider le semestre
            if ($numSemestre === null || $numSemestre < 1 || $numSemestre > 8) {
                return redirect()->back()->withInput()->with('error', 'Semestre invalide pour la matière ID ' . $idMatiere);
            }

            // Vérifier si une note existe déjà
            $noteExistante = $this->notesElevesModel->where('idEleve', $idEleve)
                ->where('idMatiere', $idMatiere)
                ->first();

            if (!empty($valeurNote)) {
                // Valider la note
                if (!is_numeric($valeurNote) || $valeurNote < 0 || $valeurNote > 20) {
                    return redirect()->back()->withInput()->with('error', 'Note invalide pour la matière ID ' . $idMatiere);
                }

                if ($noteExistante) {
                    // Mise à jour
                    $this->notesElevesModel->update($noteExistante['id'], [
                        'valeurNote' => $valeurNote,
                        'numSemestre' => $numSemestre,
                    ]);
                } else {
                    // Insertion
                    $this->notesElevesModel->insert([
                        'idEleve' => $idEleve,
                        'idMatiere' => $idMatiere,
                        'valeurNote' => $valeurNote,
                        'numSemestre' => $numSemestre,
                    ]);
                }
            } elseif ($noteExistante) {
                // Supprimer la note si vide
                $this->notesElevesModel->delete($noteExistante['id']);
            }
        }

        return redirect()->to('/notes')->with('success', 'Notes mises à jour avec succès.');
    }

    /**
     * Supprime une note
     * 
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $note = $this->notesElevesModel->find($id);

        if (!$note) {
            return redirect()->back()->with('error', 'Note introuvable.');
        }

        if ($this->notesElevesModel->delete($id)) {
            return redirect()->back()->with('success', 'Note supprimée avec succès.');
        } else {
            return redirect()->back()->with('error', 'Erreur lors de la suppression de la note.');
        }
    }
}
