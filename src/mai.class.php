<?php
/***
precomandos:
	p.ej: verificar si existe el archivo, 
comandos:
	posicionar el cursor en alguna linea
postcomandos:
	hacer el commit y el push. etc
*/
	DEFINE("FILE_EXT", ".mai");
	class maistuff{
		function __construct($fname=null, $title=null, $keywords=array(), $password=null){
			$this->theDate = date("Ymd/His");
			$this->theKeywords = $keywords;
			$this->theFName = $this->accondition($fname);
			$this->thePass = $password;
			$this->theTitle = $title;
		}
		private function accondition($name){
			$name = rtrim($name, FILE_EXT).".mai";
			$name = strtr($name, array( " "	=>"_", 	"\""=>"-", "'"=>"-", "`"=>"-", "|"=>"-", ","=>"_", "?"=>"_", "*"=>"_", "/"=>"_"	));
			return $name;
		}

		public function setPosition($L=1,$C=1){
			$this->EditorPosL = $L;
			$this->EditorPosC = $C;			
		}
		public function getHeader(){
		$keywordList = implode(",", $this->theKeywords);
$o = <<<EOT
****************************************
Date:$this->theDate
Fname:$this->theFName
Title:$this->theTitle
Keywords:$keywordList
Password(Blank=Do not encrypt):$this->thePass
****************************************
EOT;
		return $o;
		}

		private function genPreCMD(){
			// 
		}

		private function genCMD(){
			// populate Header
			// position cursos
			// 
		}
		
		private function genPostCMD(){
			// commit
			// push
		}

		public function listNotes($dir=".", $nice=false){
			$cmd = "find $dir -iname '*'".FILE_EXT." | sed 's/^\.\///g'";
			echo trim(`$cmd`).PHP_EOL;
			exit(0);
		}
		
	}