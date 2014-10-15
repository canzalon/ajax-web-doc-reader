<?php

/**
 * Project: ajax-web-doc-reader
 * @author Christopher Anzalone
 * File: PageServer.php
 */
 
 error_reporting(0);
 /* Check which function is being requested */
 $params = $_GET;
 if ($params["name"] != "dracula") {
   die("document \"".$params["name"]."\" not found");
 }

 switch ($params["function"])
 {
    case "info":
        echo "{\"name\":\"Dracula: A Mystery Story\",\"author\":\"Bram Stoker\",\"numChapters\":27}";
        break;
    case "getchapter":
        $chapter=$params["chapter"];
        settype($chapter, "int");
    	if ($chapter < 9) {
	  $chapter = "0".$chapter;
	}
    	$chapterFile="dracula/dracula-$chapter.html";

  	$fh = fopen($chapterFile, 'r') or die("can't open chapter $chapter");
	$chapter = fread($fh, filesize($chapterFile));
  	fclose($fh);
	echo $chapter;
        break;
    default: echo "Bad Request";
 } 
?>