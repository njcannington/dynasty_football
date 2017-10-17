<?php
namespace Lib\Db;

require_once(ROOT."/lib/db/db.php");

class Models
{
    public $db;

    //empty private construct to prevent new object istance;
    public function __construct()
    {
        $this->db = DB::getInstance();
    }
}
