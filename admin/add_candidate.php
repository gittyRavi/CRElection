<?php
	//Add Candidate
	require_once("../config.php");
        
        if ( isset($_POST["candidate_name"]) ) {
            $name = $_POST["candidate_name"];
	    if ( strpos($name, 'remove:') !== 0 ) {
		$query = mysqli_prepare($DB, "INSERT INTO `candidates` (name, votes) VALUES ('$name', 0)");
		//mysqli_stmt_bind_result($query, 's', $_POST["candidate_name"]);
		if ( !mysqli_stmt_execute($query) ) { 
			die("Some Error Occured. Coundn't remove candidate. Contact Administrator.");
		}
	    }
	    else {
		$name = str_replace('remove:','',$name);
		$name = trim($name);
		$query = mysqli_prepare($DB, "DELETE FROM `candidates` WHERE name = '$name'");
		if ( !mysqli_stmt_execute($query) ) { 
			die("Some Error Occured. Coundn't add candidate. Contact Administrator.");
		}
	    }
        }
        else {
            die("Name Can't be empty");
        }
        
        header("Location: ".$base_url."admin/candidates.php");