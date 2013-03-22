<?php
class Page_admin extends Page {
	function init() {
		parent::init();
		if ($this->api->auth->model['admin']!='S') {
			$this->add('P')->set('ERROR');
			return;	 
		}
		
		
		$tabs=$this->add('Tabs');
		$tabusers=$tabs->addTab('Usuarios');
		$tabfact=$tabs->addTab('Factorias');
		
		$model=$this->add('Model_User');
		$model->getField('admin')->system(false)->visible(true)->editable(true);
		$crud=$tabusers->add('CRUD');
		$crud->setModel($model);
		
		$modelfact=$this->add('Model_Factoria');
		$crudfact=$tabfact->add('CRUD');
		$crudfact->setModel($modelfact);
		
		if ($crud->grid) {
			$crud->grid->addColumn('prompt','password');
			if ($_GET['password']) {
				if ($_GET['value']) {			
					$auth=$this->add('BasicAuth');
					$auth->setModel($model);
					$auth->model->tryLoad($_GET['password']);
					$auth->usePasswordEncryption($this->api->getConfig('encriptacion'));
					if ($auth->model['id']) {
						$auth->model['password']=$_GET['value'];	
						//$auth->model->set('password',$_GET['value']);
						$auth->model->update();
					}
					$this->js()->univ()->successMessage('Contraseña actualizada')->execute();
				}
				else $this->js()->univ()->errorMessage('Cambio cancelado')->execute();
			}
		}
		
	}
}