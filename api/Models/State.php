<?php


class State extends Model
{
    protected $table;

    public function __construct()
    {
        $this->table = "states";
    }
}