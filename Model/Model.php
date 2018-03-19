<?php

abstract class Model {

    protected $cont = null;

    public function __construct() {
        $this->init();
    }

    public function init() {
        $db_host = 'db.mis.kuas.edu.tw';
        $db_user = 's1101137142';
        $db_name = 's1101137142';
        $db_password=                                                                                                           'zxc74102';
        $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";
        try {
            $this->cont = new PDO($dsn, $db_user, $db_password);
            
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

}

?>
