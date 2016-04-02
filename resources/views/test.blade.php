<?php 
	foreach($applicant as $app){
		echo '<table><tr><td>';
		echo $app->nama_applicant;echo '</td><td>';
		echo $app->ipk;echo '</td></tr></table>';
		echo '</br>';
	}
?>