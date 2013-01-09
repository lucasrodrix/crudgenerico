<?php
	abstract class banco{
		//propriedades
		public $servidor			= "localhost";
		public $usuario				= "root";
		public $senha				= "rodrix";
		public $nomebanco			= "crudgenerico";
		public $conexao				= NULL;
		public $dataset				= NULL;
		public $linhasafetadas		= -1;

		//metodos

		public function __construct(){
			$this->conecta();
			echo "Construtor da classe banco executado";
		}//construct

		public function __destruct(){
			if($this->conexao !=NULL):
				mysql_close($this->conexao);
			endif;
		}//destruct

		public function conecta(){
			$this->conexao = mysql_connect($this->servidor, $this->usuario, $this->senha, TRUE) 
			or die($this->trataerro(__FILE__,__FUNCTION__,mysql_errno(), mysql_error(),TRUE));
			mysql_select_db($this->nomebanco) or die($this->trataerro(__FILE__,__FUNCTION__,mysql_errno(), mysql_error(),TRUE));
			mysql_query("SET NAMES 'utf8'");
			mysql_query("SET character_set_conection=utf8");
			mysql_query("SET character_set_client=utf8");
			mysql_query("SET character_set_results=utf8");
			// echo "Metodo conecta foi chamado";
		}//conecta

		public function trataerro($arquivo=NULL, $rotina=NULL, $numerro=NULL, $msgerro=NULL, $geraexcept=FALSE){
			if($arquivo==NULL) $arquivo="não informado";
			if($rotina==NULL) $rotina="não informada";
			if($numerro==NULL) $numerro=mysql_errno($this->conexao);
			if($msgerro==NULL) $msgerro=mysql_error($this->conexao);
			$resultado = 	'Ocorreu um erro com os seguintes detalhes:<br />
							<strong>Arquivo: </strong>'.$arquivo.'<br />
							<strong>Rotina: </strong>'.$rotina.'<br />
							<strong>Codigo: </strong>'.$numerro.'<br />
							<strong>Mesagem: </strong>'.$msgerro;
			if($geraexcept==FALSE):
				echo($resultado);
			else:
				die($resultado);
			endif;
		}//trataerro
	}//fim classe banco
?>