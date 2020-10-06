<?php

/*
 * Main Model class
 * contains basic query to DB
 *
 * */

class Model
{
    /*
     * name of current db table
     * @var string
     * */
    protected $table;

    /*
     * select data by id
     * @param string $value to query
     * @param string $field to select
     */
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

    /*
     * select all data from specific table
     *
     * */
    public function selectAll()
    {
        try {
            $sql = "SELECT * FROM $this->table";
            $req = Database::getBdd()->prepare($sql);
            $req->execute();
            return $req->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }

    /*
     * Inserting data to the table
     * @param array $data $data['key'] => fields ,  $data['values'] => values
     *
     * @return bool
     * */
    public function create($data)
    {
        try {
            foreach ($data as $field => $value) {
                $fields[] = $field;
                $fieldsPlaceHolder[] = ':' . $field;
            }

            $sql = "INSERT INTO $this->table (" . implode(',', $fields) . " ) VALUES (" . implode(
                    ',',
                    $fieldsPlaceHolder
                ) . ")";
            $req = Database::getBdd()->prepare($sql);
            // echo $req->execute($data);
            return $req->execute($data);
        } catch (PDOException $e) {
            // echo $e;
            // todo log error
            //echo $e->getMessage();
            //var_dump($e->errorInfo());
            return false;
        }
    }

    /*
     * Updating data in the table
     * @param array $data $data['key'] => fields ,  $data['values'] => values
     *
     * @return bool
     * */
    public function update($data, $id)
    {
        try {
            foreach ($data as $field => $value) {
                $fields[] = $field . ' = :' . $field;
            }

            $sql = "UPDATE $this->table SET " . implode(',', $fields) . " WHERE " . $this->table . "_id = :id";
            //echo "$sql";
            $data['id'] = $id;
            $req = Database::getBdd()->prepare($sql);

            return $req->execute($data);
        } catch (PDOException $e) {
            echo "s";
            // todo log error
            //echo $e->getMessage();
            //var_dump($e->errorInfo());
            return true;
        }
    }

    /*
     * checkin if data exist in the DB
     * @param string $tabel table to query
     * @param string $field field to select
     * @param string $value value to check
     *
     * @return bool
     * */
    public function checkIfExists($tabel, $field, $value)
    {
        try {
            $sql = "SELECT EXISTS(SELECT * from $tabel WHERE $field = $value)";
            $req = Database::getBdd()->prepare($sql);
            $req->execute();
            $results = $req->fetch();

            return $results[0];
        } catch (PDOException $e) {
            // todo log error
            //echo $e->getMessage();
            //var_dump($e->errorInfo());
            return false;
        }
    }
}

?>