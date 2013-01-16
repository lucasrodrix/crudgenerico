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

		public function inserir($objeto){
			//insert into nomedatabela (campo1, campo2) values (valor1, valor2)
			$sql="INSERT INTO ".$objeto->tabela." (";
				for($i=0; $i<count($objeto->campos_valores); $i++):
					$sql .= key($objeto->campos_valores);
					if ($i < (count($objeto->campos_valores)-1)):
						$sql .= ", ";
					else:
						$sql .= ") ";
					endif;
					next($objeto->campos_valores);
				endfor;
				reset($objeto->campos_valores);

				$sql .= "VALUES (";
					for($i=0; $i<count($objeto->campos_valores); $i++):
						$sql .= is_numeric($objeto->campos_valores[key($objeto->campos_valores)]) ?
							$objeto->campos_valores[key($objeto->campos_valores)]:
							"'".$objeto->campos_valores[key($objeto->campos_valores)]."'";
						if($i < (count($objeto->campos_valores)-1)):
							$sql .= ", ";
						else:
							$sql .=") ";
						endif;
						next($objeto->campos_valores);
					endfor;
			return $this->executaSQL($sql);

		}//inserir

		public function deletar($objeto){
			//delete from tabela where campopk=valorpk
			$sql = "DELETE FROM ".$objeto->tabela;
			$sql .= " WHERE ".$objeto->campopk."=";
			$sql .= is_numeric($objeto->valorpk) ? $objeto->valorpk : "'".$objeto->valorpk."'";
			// echo ($sql);
			return $this->executaSQL($sql);
		}//deletar

		public function atualizar($objeto){
			//update nomedatabela set campo1=valor1, campo2=valor2 where campochave=valorchave
			$sql="UPDATE ".$objeto->tabela." SET ";
				for($i=0; $i<count($objeto->campos_valores); $i++):
					$sql .= key($objeto->campos_valores)."=";
					$sql .= is_numeric($objeto->campos_valores[key($objeto->campos_valores)]) ?
						$objeto->campos_valores[key($objeto->campos_valores)]:
						"'".$objeto->campos_valores[key($objeto->campos_valores)]."'";					
					if ($i < (count($objeto->campos_valores)-1)):
						$sql .= ", ";
					else:
						$sql .= " ";
					endif;
					next($objeto->campos_valores);
				endfor;
				$sql .="WHERE ".$objeto->campopk."=";
				$sql .=is_numeric($objeto->valorpk) ? $objeto->valorpk : "'".$objeto->valorpk ."'";
			return $this->executaSQL($sql);			
		}//atualizar

		public function executaSQL($sql=NULL){
			if($sql!=NULL):
				$query = mysql_query($sql) or $this->trataerro(__FILE__,__FUNCTION__);
				$this->linhasafetadas = mysql_affected_rows($this->conexao);
			else:
				$this->trataerro(__FILE__,__FUNCTION__,NULL,'Comando SQL nao informado na rotina',FALSE);
			endif;
		}//executaSQL

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