<?php
	/***
		Disclaimer: 
		*/
		DEFINE("VERSION", "v0.01");
		DEFINE("MAN", 
	"
	Create or edit quick notes (or big notes)
	mai -h
	mai --help
	  Shows help
	mai -e filename.mai
	mai filename.mai
	mai filename
	  Opens if exists or create new note named filename
	mai
	  create a new note
	mai 
	");
	require __DIR__ ."/../vendor/autoload.php";

	function fixEncoding($i){
		$t = array(
		  "\u00c0" =>"À",     "\u00c1" =>"Á",     "\u00c2" =>"Â",     "\u00c3" =>"Ã",     "\u00c4" =>"Ä",     "\u00c5" =>"Å",     "\u00c6" =>"Æ",     "\u00c7" =>"Ç",     "\u00c8" =>"È",     "\u00c9" =>"É",     "\u00ca" =>"Ê",     "\u00cb" =>"Ë",     "\u00cc" =>"Ì",     "\u00cd" =>"Í",     "\u00ce" =>"Î",     "\u00cf" =>"Ï",     "\u00d1" =>"Ñ",     "\u00d2" =>"Ò",     "\u00d3" =>"Ó",     "\u00d4" =>"Ô",     "\u00d5" =>"Õ",     "\u00d6" =>"Ö",     "\u00d8" =>"Ø",     "\u00d9" =>"Ù",     "\u00da" =>"Ú",     "\u00db" =>"Û",     "\u00dc" =>"Ü",     "\u00dd" =>"Ý",     "\u00df" =>"ß",     "\u00e0" =>"à",     "\u00e1" =>"á",     "\u00e2" =>"â",     "\u00e3" =>"ã",     "\u00e4" =>"ä",     "\u00e5" =>"å",     "\u00e6" =>"æ",     "\u00e7" =>"ç",     "\u00e8" =>"è",     "\u00e9" =>"é",     "\u00ea" =>"ê",     "\u00eb" =>"ë",     "\u00ec" =>"ì",     "\u00ed" =>"í",     "\u00ee" =>"î",     "\u00ef" =>"ï",     "\u00f0" =>"ð",     "\u00f1" =>"ñ",     "\u00f2" =>"ò",     "\u00f3" =>"ó",     "\u00f4" =>"ô",     "\u00f5" =>"õ",     "\u00f6" =>"ö",     "\u00f8" =>"ø",     "\u00f9" =>"ù",     "\u00fa" =>"ú",     "\u00fb" =>"û",     "\u00fc" =>"ü",     "\u00fd" =>"ý", "\u00ff" =>"ÿ");
		return strtr($i, $t);
	}

	function arrSearch($hayStack, $needle){
		$o = array_filter($hayStack, function($el) use ($needle) {
			return ( stripos($el['name'], $needle) !== false || stripos($el['cmd'], $needle) !== false );
		});
		return $o;
	}

	function trimapp($what){
		$o= trim($what, "() \t\n\r\0\x0B");	
		return $o;
	}

	function atrim($arr){
		$arr = array_map('trimapp', $arr);
		return $arr;
	}

	function json_enc_show($arr){
		$o = json_encode($arr, JSON_PRETTY_PRINT);
		$o = fixEncoding($o);
		echo $o;
	}

	/**main**/
	$opts = new Commando\Command();
	// define script switches and check them
	$opts->option('m')->aka('man')->
		describedAs(MAN)->boolean()->defaultsTo(false);
	$opts->option('e')->aka('edit')->
		describedAs('Edit a note followed by a filename or part of filename')->boolean()->defaultsTo(false);
	$opts->option('c')->aka('commit')->
		describedAs('Stands for Commit changes, the commit message should follow after the -c')->boolean()->defaultsTo(false);
	$opts->option('P')->aka('push')->
	describedAs('Will push your changes')->boolean()->defaultsTo(false);
	$opts->option('p')->aka('pull')->
		describedAs('Will get you latest changes from git repo')->boolean()->defaultsTo(false);
	$opts->option('R')->aka('reset')->
		describedAs('Will reset to get latest...')->boolean()->defaultsTo(false);
	$opts->option('d')->aka('diff')->
		describedAs('Will show diff')->boolean()->defaultsTo(false);
	$opts->option('l')->aka('log')->
		describedAs('Show the log')->boolean()->defaultsTo(false);
	$opts->option('V')->aka('version')->
		describedAs(VERSION)->boolean()->defaultsTo(false);
	if ($opts['version']){
		echo VERSION.PHP_EOL;
		exit;
	}
	// has arguments?
	$noargs = ($opts[0] == null)?true:false;
	
	// help
	if ($opts['help'] ){
		fwrite(STDERR, "showing help".PHP_EOL);
		// json_enc_show($);
		echo MAN;
		fwrite(STDERR, PHP_EOL);
		exit(0);
	}
	
	// check script arguments maximum 15 arguments...
	$numArgs=0;
	for ($i=0;$i<=15;$i++){
		if ($opts[$i]=="")
			break;
		// echo "$i:".$opts[$i].PHP_EOL;
		$numArgs=$i+1;
	}

	for($i=0;$i<$numArgs;$i++){
		$o = arrSearch($o, $opts[$i]);
	}
	switch(sizeOf($o)){
		case 0:
			break;
		case 1:
			break;
		default:
			break;
	}



