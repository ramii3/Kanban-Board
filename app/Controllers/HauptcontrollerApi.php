<?php

namespace App\Controllers;

use App\Models\Task_model;
use App\Models\TasksModel;



class HauptcontrollerApi extends BaseController
{


    public function __construct()
    {
        $this->tasksmodel = new Task_Model();
        $this->validation = \Config\Services::validation();
        helper(['form', 'url']);


    }


  

    public function getBoardsData()
{
    $tasksmodel = new Task_Model();
    $data['boards'] = $tasksmodel->getBoards();

    return $this->response->setJSON($data);
}



    public function getSpaltenData()
{
    $tasksmodel = new Task_Model();
    $data['spalten'] = $tasksmodel->getSpalten(); // returns [ ['id'=>..,'spalte'=>..,'spaltenbeschreibung'=>..,'boardsid'=>..], ... ]
    return $this->response->setJSON($data);
}



    




public function getPersonenData()
{
    $tasksmodel = new Task_Model();
    $data['personen'] = $tasksmodel->getPersonen();




    
    return $this->response->setJSON($data); // content-type set automatically

}






    public function postDeleteSpalteData($id = 0)
{
    if (!$id) {
        return $this->response
            ->setStatusCode(400)
            ->setJSON(['ok' => false, 'error' => 'ID fehlt']);
    }

    try {
        $this->tasksmodel->deleteSpalte($id);
        return $this->response->setJSON(['ok' => true]);
    } catch (\Throwable $e) {
        log_message('error', 'deleteSpalte error: {msg}', ['msg' => $e->getMessage()]);
        return $this->response
            ->setStatusCode(500)
            ->setJSON(['ok' => false, 'error' => 'Interner Fehler beim Löschen']);
    }
}



    
    // New: used by React form (create + edit)
public function getSpaltenFormData($id = null)
{
    $tasksmodel = new Task_Model();

    $boards = $tasksmodel->getBoards();
    $out = ['boards' => $boards];

    if ($id) {
        // Your existing model method name suggests this already exists
        $spalte = $tasksmodel->getSpalteById($id);
        if (!$spalte) {
            return $this->response->setStatusCode(404)->setJSON([
                'ok' => false,
                'errors' => ['not_found' => 'Spalte nicht gefunden.'],
            ]);
        }
        // Expected keys: id, spalte, spaltenbeschreibung, boardsid, sortid
        $out['spalte'] = $spalte;
    }

    return $this->response->setJSON($out);
}




    





public function postSubmitPersonenData()
{
    $request = $this->request;

    // Accept either JSON or form-encoded
    $data = $request->getJSON(true) ?? $request->getPost();

    $validation = \Config\Services::validation();
    // reuse your existing rule group 'personenbearbeiten'
    if (!$validation->run($data, 'personenbearbeiten')) {
        return $this->response->setStatusCode(422)
            ->setJSON(['ok' => false, 'errors' => $validation->getErrors(), 'data' => $data]);
    }

    $tasksmodel = new Task_Model();

    try {
        if (!empty($data['id'])) {
            // allow optional password change
            $tasksmodel->updatePerson($data);
        } else {
            $tasksmodel->createPerson($data);
        }
        return $this->response->setJSON(['ok' => true]);
    } catch (\Throwable $e) {
        log_message('error', 'submitPersonenData error: {message}', ['message' => $e->getMessage()]);
        return $this->response->setStatusCode(500)
            ->setJSON(['ok' => false, 'errors' => ['server' => 'Interner Fehler.']]);
    }
}






    


}


