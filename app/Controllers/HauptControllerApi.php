<?php
namespace App\Controllers;

use App\Models\Task_model;

class HauptcontrollerApi extends BaseController
{
    protected $tasksmodel;
    protected $validation;

    public function __construct()
    {
        $this->tasksmodel = new Task_Model();
        $this->validation = \Config\Services::validation();
        helper(['form', 'url']);
    }

    // GET: Boards
    public function getBoard()
    {
        $data = [
            'boards' => $this->tasksmodel->getBoards(),
        ];

        return $this->response->setJSON($data);
    }

    // GET: Spalten
    public function getSpalte($id = 0)
    {
        $data = [
            'spalten' => $this->tasksmodel->getSpalten(),
            'boards'  => $this->tasksmodel->getBoards(),
        ];

        return $this->response->setJSON($data);
    }

    // GET: Spalten-Ersteller (mit optionalem Update-Datensatz)
    public function getSpaltenersteller($id = 0)
    {
        $data = [
            'spalten' => $this->tasksmodel->getSpalten(),
            'boards'  => $this->tasksmodel->getBoards(),
        ];

        if ($id > 0) {
            $data['update'] = $this->tasksmodel->getSpalteById($id);
        }

        return $this->response->setJSON($data);
    }

    // GET: Tasks
    public function getTasks()
    {
        $data = [
            'tasks'    => $this->tasksmodel->getTasks(),
            'spalten'  => $this->tasksmodel->getSpalten(),
            'personen' => $this->tasksmodel->getPersonen(),
            'boards'   => $this->tasksmodel->getBoards(),
        ];

        return $this->response->setJSON($data);
    }

    // GET: Task-Ersteller (mit optionalem Update-Datensatz)
    public function getTaskersteller($id = 0, $todo = 0)
    {
        $data = [
            'personen' => $this->tasksmodel->getPersonen(),
            'spalten'  => $this->tasksmodel->getSpalten(),
            'tasks'    => $this->tasksmodel->getTasks(),
        ];

        if ($id > 0) {
            $data['update'] = $this->tasksmodel->getTask($id);
        }

        return $this->response->setJSON($data);
    }

    // GET: Board-Ersteller (mit optionalem Update-Datensatz)
    public function getBoardersteller($id = 0, $todo = 0)
    {
        $data = [
            'boards' => $this->tasksmodel->getBoards(),
        ];

        if ($id > 0) {
            $data['update'] = $this->tasksmodel->getBoardById($id);
        }

        return $this->response->setJSON($data);
    }

    // GET: Personen
    public function getPersonen()
    {
        $data = [
            'personen' => $this->tasksmodel->getPersonen(),
        ];

        return $this->response->setJSON($data);
    }

    // GET: Personen-Ersteller (mit optionalem Update-Datensatz)
    public function getPersonenersteller($id = 0)
    {
        $data = [
            'personen' => $this->tasksmodel->getPersonen(),
        ];

        if ($id > 0) {
            $data['update'] = $this->tasksmodel->getPersonById($id);
        }

        return $this->response->setJSON($data);
    }

    // POST: Spalte löschen
    public function postDeletespalte($id)
    {
        if (empty($id) || (int)$id === 0) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Ungültige ID für das Löschen der Spalte.',
            ]);
        }

        try {
            $this->tasksmodel->deleteSpalte($id);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Spalte erfolgreich gelöscht.',
                'id'      => (int)$id,
            ]);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Fehler beim Löschen der Spalte.',
                'error'   => $e->getMessage(),
            ]);
        }
    }

    // POST: Spalte anlegen/aktualisieren
    public function postSubmitSpalten()
    {
        $post = $this->request->getPost();


        if ($this->validation->run($post, 'spaltenbearbeiten')) {
            try {
                $isUpdate = isset($post['id']) && $post['id'] !== '';
                if ($isUpdate) {
                    $this->tasksmodel->updateSpalte();
                } else {
                    $this->tasksmodel->createSpalte();
                }

                return $this->response->setJSON([
                    'success'  => true,
                    'message'  => $isUpdate ? 'Spalte aktualisiert.' : 'Spalte erstellt.',
                    'isUpdate' => $isUpdate,
                ]);
            } catch (\Throwable $e) {
                return $this->response->setStatusCode(500)->setJSON([
                    'success' => false,
                    'message' => 'Fehler beim Speichern der Spalte.',
                    'error'   => $e->getMessage(),
                ]);
            }
        } else {
            return $this->response->setStatusCode(422)->setJSON([
                'success' => false,
                'message' => 'Validierung fehlgeschlagen.',
                'error'   => $this->validation->getErrors(),
                'data'    => [
                    'spalten' => $post,
                    'boards'  => $this->tasksmodel->getBoards(),
                ],
            ]);
        }
    }

    // POST: Task anlegen/aktualisieren
    public function postSubmitTasks()
    {
        $post = $this->request->getPost();

        if ($this->validation->run($post, 'taskbearbeiten')) {
            try {
                $isUpdate = isset($post['id']) && $post['id'] !== '';
                if ($isUpdate) {
                    $this->tasksmodel->updateTasks();
                } else {
                    $this->tasksmodel->createTasks();
                }

                return $this->response->setJSON([
                    'success'  => true,
                    'message'  => $isUpdate ? 'Task aktualisiert.' : 'Task erstellt.',
                    'isUpdate' => $isUpdate,
                ]);
            } catch (\Throwable $e) {
                return $this->response->setStatusCode(500)->setJSON([
                    'success' => false,
                    'message' => 'Fehler beim Speichern des Tasks.',
                    'error'   => $e->getMessage(),
                ]);
            }
        } else {
            return $this->response->setStatusCode(422)->setJSON([
                'success' => false,
                'message' => 'Validierung fehlgeschlagen.',
                'error'   => $this->validation->getErrors(),
                'data'    => [
                    'tasks'    => $post,
                    'spalten'  => $this->tasksmodel->getSpalten(),
                    'personen' => $this->tasksmodel->getPersonen(),
                ],
            ]);
        }
    }

    // POST: Task löschen
    public function postDeleteTasks($id = 1)
    {
        if (empty($id) || (int)$id === 0) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Ungültige ID für das Löschen des Tasks.',
            ]);
        }

        try {
            $this->tasksmodel->deleteTask($id);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Task erfolgreich gelöscht.',
                'id'      => (int)$id,
            ]);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Fehler beim Löschen des Tasks.',
                'error'   => $e->getMessage(),
            ]);
        }
    }

    // POST: Board anlegen/aktualisieren
    public function postSubmitBoard()
    {
        $post = $this->request->getPost();

        if ($this->validation->run($post, 'boardbearbeiten')) {
            try {
                $isUpdate = isset($post['id']) && $post['id'] !== '';
                if ($isUpdate) {
                    $this->tasksmodel->updateBoards();
                } else {
                    $this->tasksmodel->createBoards();
                }

                return $this->response->setJSON([
                    'success'  => true,
                    'message'  => $isUpdate ? 'Board aktualisiert.' : 'Board erstellt.',
                    'isUpdate' => $isUpdate,
                ]);
            } catch (\Throwable $e) {
                return $this->response->setStatusCode(500)->setJSON([
                    'success' => false,
                    'message' => 'Fehler beim Speichern des Boards.',
                    'error'   => $e->getMessage(),
                ]);
            }
        } else {
            return $this->response->setStatusCode(422)->setJSON([
                'success' => false,
                'message' => 'Validierung fehlgeschlagen.',
                'error'   => $this->validation->getErrors(),
                'data'    => [
                    'boards' => $this->tasksmodel->getBoards(),
                    'board'  => $post,
                ],
            ]);
        }
    }

    // POST: Board löschen
    public function postDeleteBoard($id)
    {
        if (empty($id) || (int)$id === 0) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Ungültige ID für das Löschen des Boards.',
            ]);
        }

        try {
            $this->tasksmodel->deleteBoard($id);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Board erfolgreich gelöscht.',
                'id'      => (int)$id,
            ]);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Fehler beim Löschen des Boards.',
                'error'   => $e->getMessage(),
            ]);
        }
    }

    // POST: Person anlegen/aktualisieren
    public function postSubmitPersonen()
    {
        $post = $this->request->getPost();

        if ($this->validation->run($post, 'personenbearbeiten')) {
            try {
                $isUpdate = isset($post['id']) && $post['id'] !== '';
                if ($isUpdate) {
                    $this->tasksmodel->updatePerson();
                } else {
                    $this->tasksmodel->createPerson();
                }

                return $this->response->setJSON([
                    'success'  => true,
                    'message'  => $isUpdate ? 'Person aktualisiert.' : 'Person erstellt.',
                    'isUpdate' => $isUpdate,
                ]);
            } catch (\Throwable $e) {
                return $this->response->setStatusCode(500)->setJSON([
                    'success' => false,
                    'message' => 'Fehler beim Speichern der Person.',
                    'error'   => $e->getMessage(),
                ]);
            }
        } else {
            return $this->response->setStatusCode(422)->setJSON([
                'success' => false,
                'message' => 'Validierung fehlgeschlagen.',
                'error'   => $this->validation->getErrors(),
                'data'    => [
                    'personen' => $post,
                ],
            ]);
        }
    }

    // POST: Person löschen
    public function postDeletePerson($id)
    {
        if (empty($id) || (int)$id === 0) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Ungültige ID für das Löschen der Person.',
            ]);
        }

        try {
            $this->tasksmodel->deletePerson($id);
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Person erfolgreich gelöscht.',
                'id'      => (int)$id,
            ]);
        } catch (\Throwable $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Fehler beim Löschen der Person.',
                'error'   => $e->getMessage(),
            ]);
        }
    }
}
