<?php
class Model_User extends Model_Table {
	public $table='user';
	
	function init() {
		parent::init();
		
		$this->addField('name')->caption('Nombre');
		$this->addField('email');
		$this->addField('password')->system(true);
		$this->addField('admin')->system(true)
			->setValueList(array('S'=>'Sí', 'N'=>'No'));
		$this->hasOne('Factoria');
	}
}