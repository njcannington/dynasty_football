<?php
namespace Lib\Db;

class Models
{
    public $db;

    //empty private construct to prevent new object istance;
    public function __construct()
    {
        $this->db = DB::getInstance();
    }
}
