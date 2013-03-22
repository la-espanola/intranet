<?php
class Frontend extends ApiFrontend {
    function init(){
        parent::init();
        
        $this->dbConnect();
        
        $this->requires('atk','4.2.0');
        $this->add('jUI');
                          
        $auth=$this->add('BasicAuth');
        $auth->setModel('Model_User');
        $auth->usePasswordEncryption($this->api->getConfig('encriptacion'));
        $auth->check();
        
        $menu=$this->add('Menu',null,'Menu');
        $menu->addMenuItem('cuenta','Mi cuenta');
        if ($auth->model['admin']=='S') {
        	$menu->addMenuItem('admin','Administrar');
        }
        $menu->addMenuItem('logout','Salir');
    }
    
}
