<?php


class FieldsType extends Model
{
    protected $table;

    public function __construct()
    {
        $this->table = "fields_types";
    }
}