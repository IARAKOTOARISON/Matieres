<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function list()
    {
        // Vérifier que l'utilisateur est connecté
        if (!session()->get('user')) {
            return redirect()->to('/login');
        }

        $model = new \App\Models\ElevesModel();

        $perPage = 2;
        $keyword = $this->request->getGet('q');

        $builder = $model
            ->select('eleves.*, parcours.nomParcours')
            ->join('parcours', 'parcours.id = eleves.idParcours');

        if (!empty($keyword)) {
            $builder = $builder->like('eleves.ETU', $keyword);
        }

        $eleves = $builder->paginate($perPage);

        $data = [
            'eleves' => $eleves,
            'pager' => $model->pager,
            'message' => empty($eleves) ? "Aucun étudiant trouvé" : null
        ];

        return view('notes/liste-eleves', $data);
    }
}
