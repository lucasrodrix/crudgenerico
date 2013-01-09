<?php
	require_once("classes/teste.class.php");
	abstract class base extends banco{
		
		//propriedade
		public $tabela = "";
		public $campos_valores = array();
		public $campopk = NULL;
		public $valorpk = NULL;
		public $extras_select = "";

		//metodos
		public function addCampo($campo=NULL, $valor=NULL){
			if($campo!=NULL):
				$this->campos_valores[$campo] = $valor;
			endif:
		}//fim addCampo.

		public function delCampo($campo){
			if(array_key_exists($campo, $this->campos_valores)):
				unset($this->campos_valores[$campo]);
			endif;
		}//fim delCampo.
	}//fim classe base.
 ?>