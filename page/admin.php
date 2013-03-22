<?php
class Page_admin extends Page {
	function init() {
		parent::init();
		
		$model=$this->add('Model_User');
		$model->getField('admin')->system(false)->visible(true)->editable(true);
		$crud=$this->add('CRUD');
		$crud->setModel($model);
		
		if ($crud->grid) {
			$crud->grid->addColumn('prompt','password');
			if ($_GET['password']) {
				if ($_GET['value']) {			
					$auth=$this->add('BasicAuth');
					$model=$this->add('Model_User');
					$auth->setModel($model);
					$auth->model->tryLoad($_GET['password']);
					$auth->usePasswordEncryption($this->api->getConfig('encriptacion'));
					if ($auth->model['id']) {
						$auth->model['password']=$_GET['value'];	
						$auth->model->update();
					}
					$this->js()->univ()->successMessage('Contraseña actualizada')->execute();
				}
				else $this->js()->univ()->successMessage('Cambio cancelado')->execute();
			}
		}
		
	}
}