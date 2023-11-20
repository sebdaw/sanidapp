<?php
class TestController extends ViewController{

    public function __construct(){
        parent::__construct();
        $this->id_section = 1;
    }

    public function main(){
        if (!$this->hasAccessPermission(1)){
            http_response_code(401);
            exit;
        }

        $this->showView('main-view.php');
    }
}
?>