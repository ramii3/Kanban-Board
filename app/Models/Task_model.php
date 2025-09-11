<?php namespace App\Models;

use CodeIgniter\Model;

class Task_model extends Model
{

    public function getTasks()
    {
        $this->tasks = $this->db->table('tasks');
        $this->tasks->select('tasks.*, personen.name, personen.vorname, spalten.spalte');

        $this->tasks->join('personen', 'tasks.personenid = personen.id');
        $this->tasks->join('spalten', 'tasks.spaltenid = spalten.id');

        $this->tasks->orderBy('tasks', 'desc');

        $result = $this->tasks->get();
        return $result->getResultArray();
    }

    public function getSpalten()
    {
        $this->spalten = $this->db->table('spalten');

        $this->spalten->select('spalten.*, boards.id as idboard');

        $this->spalten->join('boards', 'spalten.boardsid = boards.id');


        $result = $this->spalten->get();
        return $result->getResultArray();
    }



    public function getBoards()
    {
        $result = $this->db->table('boards')->get();
        return $result->getResultArray();
    }

    public function getData()
    {
        $this->tasks = $this->db->table('tasks');

        $this->tasks->select('tasks.*');
        $this->tasks->join('personen', 'personen.id = tasks.personenid');
        $this->tasks->join('spalten', 'spalten.id = tasks.spaltenid');


        $result = $this->tasks->get();
        return $result->getResultArray();


    }

    public function getTask($id = null)
    {
        $this->tasks = $this->db->table('tasks');
        $this->tasks->select('*');


        if ($id != NULL) {
            $this->tasks->where('id', $id);
        }

        $this->tasks->orderBy('tasks');
        $result = $this->tasks->get();

        if ($id != NULL) {
            return $result->getRowArray();
        } else return $result->getResultArray();
    }

    public function createSpalte()
    {
        $this->spalten = $this->db->table('spalten');
        $this->spalten->insert(array(
            'spalte' => $_POST['spalte'],
            'spaltenbeschreibung' => $_POST['spaltenbeschreibung'],
            'sortid' => $_POST['sortid'],
            'boardsid' => $_POST['boardsid']
        ));
    }

    public function getSpalteById($id)
    {
        $this->spalten = $this->db->table('spalten');
        $this->spalten->where('id', $id);
        $query = $this->spalten->get();
        return $query->getRowArray();
    }

    public function getBoardById($id)
    {
        $this->boards = $this->db->table('boards');
        $this->boards->where('id', $id);
        $query = $this->boards->get();
        return $query->getRowArray();
    }


public function updateSpalte()
{
    $this->spalten = $this->db->table('spalten');
    $this->spalten->where('id', $_POST['id']);
    $this->spalten->update([
        'spalte' => $_POST['spalte'],
        'spaltenbeschreibung' => $_POST['spaltenbeschreibung'],
        'sortid' => $_POST['sortid'],
        'boardsid' => $_POST['boardsid'] // Direkte Verwendung von boardsid
    ]);
}
    public function deleteSpalte()
    {
        $this->tasks = $this->db->table('spalten');
        $this->tasks->where('id', $_POST['id']);
        $this->tasks->delete();
    }


    public function deleteBoard()
    {
        $this->tasks = $this->db->table('boards');
        $this->tasks->where('id', $_POST['id']);
        $this->tasks->delete();
    }



    public function createTasks()
    {
        $this->tasks = $this->db->table('tasks');
        $this->tasks->insert(array('personenid' => $_POST['Person'],
            'spaltenid' => $_POST['Spalte'],
            'sortid' => 1,
            'tasks' => $_POST['Task'],
            'erstelldatum' => date("Y-m-d"),
            'erinnerungsdatum' => $_POST['Erinnerungsdatum'],
            'erinnerung' => $_POST['Erinnerung'],
            'notizen' => $_POST['Notiz'],
            'erledigt' => '0',
            'geloescht' => '0',));
    }

    public function updateTasks()
    {
        $this->tasks = $this->db->table('tasks');
        $this->tasks->where('id', $_POST['id']);
        $this->tasks->update(array('personenid' => $_POST['Person'],

        'spaltenid' => $_POST['Spalte'],
            'sortid' => 1,
            'tasks' => $_POST['Task'],
            'erstelldatum' => '2024-01-19',
            'erinnerungsdatum' => $_POST['Erinnerungsdatum'],
            'erinnerung' => $_POST['Erinnerung'],
            'notizen' => $_POST['Notiz'],
            'erledigt' => '0',
            'geloescht' => '0',));
    }


public function deleteTask($id)
{
    return $this->db->table('tasks')->where('id', $id)->delete();
}




    public function createBoards()
    {
        $this->tasks = $this->db->table('boards');
        $this->tasks->insert(array('id' => $_POST['id'],
            'board' => $_POST['board'],
         ));
    }


public function updateBoards()
{
    $this->boards = $this->db->table('boards');
    $this->boards->where('id', $_POST['id']);
    $this->boards->update([
        'board' => $_POST['board']
    ]);
}




   
public function getPersonen()
{
    return $this->db->table('personen')->get()->getResultArray();
}

public function getPersonById($id)
{
    return $this->db->table('personen')->where('id', $id)->get()->getRowArray();
}

public function createPerson()
{
    $data = [
        'vorname' => $_POST['vorname'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'passwort' => password_hash($_POST['passwort'], PASSWORD_DEFAULT)
    ];
    return $this->db->table('personen')->insert($data);
}

public function updatePerson()
{
    $id = $_POST['id'];
    $data = [
        'vorname' => $_POST['vorname'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        // Passwort nur ändern, wenn ein neues eingegeben wurde
    ];
    if (!empty($_POST['passwort'])) {
        $data['passwort'] = password_hash($_POST['passwort'], PASSWORD_DEFAULT);
    }
    return $this->db->table('personen')->where('id', $id)->update($data);
}

public function deletePerson($id)
{
    return $this->db->table('personen')->where('id', $id)->delete();
}



}
