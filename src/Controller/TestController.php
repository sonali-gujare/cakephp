<?php  
    namespace App\Controller;
    use App\Controller\AppController;
    class TestController extends AppController{
        public function initialize()
        {
            parent::initialize();
            $this->viewBuilder()->layout('ownLayout');
        }
        public function index(){
            // $this->autoRender = false;
            echo "CLASS";
        }
        public function onlineChannel(){
            $this->autoRender = false;
            echo "online channel";
            
        }
    }

?>