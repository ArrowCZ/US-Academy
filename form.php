<?php
				if( isset($_POST['n']) && isset($_POST['e']) && isset($_POST['m']) ){
				$n = $_POST['n'];
				$e = $_POST['e'];
				$m = nl2br($_POST['m']);
				$to = "11georgina@seznam.cz";
				$from = $e;
				$subject = 'Zpr�va z webu';
				$message = '<b>Jm�no:</b> '.$n.' <br><b>Email:</b> '.$e.' <p>'.$m.'</p>';
				$headers = "Od: $from\n";
				$headers .= "MIME-Version: 1.0\n";
				$headers .="Content-type: text/html; charset=utf-8\n";
				if( mail($to, $subject, $message, $headers) ){
					echo "succes";
				} else {
					echo "Server nedoru�il zpr�vu. Pros�m, opakujte akci";
				}
			}	
?>