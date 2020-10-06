<?php

/*
 * Subscriber Model extends root Model
 *
 * */

class Subscriber extends Model
{
    protected $table;

    public function __construct()
    {
        $this->table = "subscribers";
    }

    /*
     * Overwrites main selectAll join query to get full set of data
     *
     * */
    public function selectAll()
    {
        $sql = "SELECT s.*, st.name AS state_name FROM $this->table s JOIN states st ON s.states_id = st.states_id";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function selectBy($field, $value)
    {
        try {
            $sql = "SELECT * FROM $this->table  WHERE " . $this->table . "_" . $field . "='$value'";
            $req = Database::getBdd()->prepare($sql);
            $req->execute();
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
        // return $req->fetch();
    }

}