<?php
class Page_cuenta extends Page {
	function init() {
		parent::init();
		
		$model=$this->api->auth->model;
		
		$form=$this->add('Form');
		$form->setModel($model);
		$form->addField('password','set_password');
		$form->addSubmit('Modificar');
		
		if ($form->isSubmitted()) {
			$model->set($form->get());
			$p=$form->get('set_password');
			if ($p) {
				$model->set('password',$p);
			}
			$model->update();
			
			$this->js()->univ()->successMessage('Datos actualizados')->execute();
		}
	}
}