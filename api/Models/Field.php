<?php


class Field extends Model
{
    protected $table;

    public function __construct()
    {
        $this->table = "fields";
    }

    public function selectBySubscriber($field, $value)
    {
        try {

            $sql = "SELECT name ,value, type_name , f.fields_types_id , f.subscribers_id  ,f.fields_id FROM fields f JOIN fields_types ft ON f.fields_types_id = ft.fields_types_id WHERE $field ='$value' AND f.deleted = '0'";
            $req = Database::getBdd()->prepare($sql);
            $req->execute();
            return $req->fetchAll(\PDO::FETCH_ASSOC);

        }
        catch(PDOException $e)
        {

            return false;
        }
        // return $req->fetch();
    }
}