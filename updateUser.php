<?php
require_once __DIR__."/header.php";
if(isset($_POST["name"]) && isset($_POST["value"])){
	if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"]){
		$myDalClass = ChosenDAL;
		$dal = new $myDalClass(DB_HOST, DB_DATABASE, DB_USER, DB_PASSWORD);
		$user = $dal->getUserByID($_SESSION["user"]->getUserID());

		if($_POST["name"] == "fname"){
			$user->setFname($_POST["value"]);
			$dal->updateUser($user);
			outputSuccess($user);
		}
		else if($_POST["name"] == "lname"){
			$user->setLname($_POST["value"]);
			$dal->updateUser($user);
			outputSuccess($user);
		}
		else if($_POST["name"] == "gender"){
			if($_POST["value"] == 1 || $_POST["value"] == 2 || $_POST["value"] == 3){
				$user->setGender($_POST["value"]);
				$dal->updateUser($user);
				outputSuccess($user);
			}
			else{
				outputGenericError();
			}
		}
		else if($_POST["name"] == "email"){
			if(filter_var($_POST["value"], FILTER_VALIDATE_EMAIL) && !$dal->emailExists($_POST["value"])){
				$user->setEmail($_POST["value"]);
				$dal->updateUser($user);
				outputSuccess($user);
			}
			else{
				echo json_encode(["success"=>false, "error"=>"Email invalid or is already registered!"]);
			}
		}
		else if($_POST["name"] == "feedLen"){
			$user->setFeedLength($_POST["value"]);
			$dal->updateUser($user);
			outputSuccess($user);
		}
		else if($_POST["name"] == "webID"){
			if(!$dal->webIDExists($_POST["value"])){
				$user->setWebID($_POST["value"]);
				$dal->updateUser($user);
				outputSuccess($user);
			}
			else{
				echo json_encode(["success"=>false, "error"=>"WebID invalid or is already registered!"]);
			}
		}
		else{
			outputGenericError();
		}
	}
	else{
		echo json_encode(["success"=>false, "error"=>"Must be logged in to change data!"]);
	}
}
else{
	outputGenericError();
}

/**
 * Output json encoded array that success is true
 * Updates the session user variable
 * @param \User $user
 */
function outputSuccess(User $user){
	$_SESSION["user"] = $user;
	$_SESSION["loggedIn"] = true;
	echo json_encode(["success"=>true]);
}

/**
 * Outputs generic json encoded failure
 */
function outputGenericError(){
	echo json_encode(["success"=>false, "error"=>"Invalid Data Received!"]);
}