<?php

	$input = file_get_contents('input.txt');
	$input = explode("\n",$input);
	$finaloutput = "";
	$currentstate = 'data';
	foreach($input as $line){
		if($currentstate == 'data' && strpos($line,' System:    5/26/2011') === false){
			$finaloutput .= "\n".$line;
		}elseif($currentstate != 'headstarted' && $currentstate != 'headfinishing' && strpos($line,' System:    5/26/2011') !== false){
			//We're starting a page header
			$currentstate = 'headstarted';
		}elseif($currentstate == 'headstarted' && strpos($line,'------------------------------------------------------------') !== false){
			//We're about to finish a page header
			$currentstate = 'headfinishing';
		}elseif($currentstate == 'headfinishing' && strpos($line,'------------------------------------------------------------') !== false){
			//This is the last line of a page header
			$currentstate = 'data';
		}		
	}
	touch('output.txt');
	file_put_contents('output.txt',$finaloutput);
?>