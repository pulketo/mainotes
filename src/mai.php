<?php
	DEFINE("VERSION", "v0.01");
	DEFINE("MAN", <<<EOT
		Create or edit quick notes (or big notes)
			mai -h
			mai --help
				Shows help
			mai -e filename.mai
			mai filename.mai
			mai filename
				Opens if exists or create new note named "filename"
			mai 
				create a new note
			mai -n
EOT
	);
	require __DIR__ ."/../vendor/autoload.php";
	require "misc-fn.php";
	require "mai.class.php";
	
	/**test**/
	$mai = new maistuff();
	// $mai->setPosition(8,1);
	// $tmp = $mai->getHeader();
	$mai->listNotes();
	exit();
	
		