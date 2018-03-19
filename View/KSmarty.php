<?php
require_once 'libs/Smarty-3.1.19/libs/Smarty.class.php';
class KSmarty extends Smarty {

    function __construct() {
        parent::__construct();
        $VIEW="View";
        $this->template_dir = "View/templates/"; 
        $this->compile_dir = "View/templates_c/";
        
        $this->left_delimiter = '<{';
        $this->right_delimiter = '}>';
        
        $this->debugging = FALSE;
    }

}
