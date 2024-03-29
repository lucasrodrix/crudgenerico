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
			endif;
		}//fim addCampo.

		public function delCampo($campo=NULL){
			if(array_key_exists($campo, $this->campos_valores)):
				unset($this->campos_valores[$campo]);
			endif;
		}//fim delCampo.

		public function setValor($campo=NULL, $valor=NULL){
			if($campo!=NULL && $valor!=NULL):
				$this->campos_valores[$campo] = $valor;
			endif;
		}//fim setValor.

		public function getValor($campo=NULL){
			if($campo!=NULL && array_key_exists($campo, $this->campos_valores)):
				return $this->campos_valores[$campo];
			else:
				return FALSE;
			endif;
		}//fim getValor.


	}//fim classe base.
 ?>