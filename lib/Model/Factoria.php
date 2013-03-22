<?php
class Model_Factoria extends Model_Table {
	public $table='factoria';
	
	function init() {
		parent::init();
		
		$this->addField('name')->caption('Nombre');
	}
}