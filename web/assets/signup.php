<?php

// Email address verification
function isEmail($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isValidTel($tel) {
    return filter_var($tel, FILTER_VALIDATE_INT);
}

if($_POST) {

    // Enter the email where you want to receive the message
    $emailTo = 'gabaquentin@gmail.com';

    $name = addslashes(trim($_POST['name']));
    $prenom = addslashes(trim($_POST['prenom']));
    $clientEmail = addslashes(trim($_POST['email']));
    $tel = addslashes(trim($_POST['tel']));
    $password = addslashes(trim($_POST['password']));
    $Cpassword = addslashes(trim($_POST['Cpassword']));
    $metier = addslashes(trim($_POST['metier']));

    $array = array('nameMessage' => '','prenomMessage' => '', 'emailMessage' => '', 'telMessage' => '', 'passwordMessage' => '','CpasswordMessage' => '','metierMessage' => '');

    if($name == '') {
    	$array['nameMessage'] = 'Nom Vide';
    }
    if($prenom == '') {
        $array['prenomMessage'] = 'Prenom Vide';
    }
    if(!isEmail($clientEmail)) {
        $array['emailMessage'] = 'Adresse E-Mail Invalide';
    }
    if(!isValidTel($tel)) {
        $array['telMessage'] = 'Telephone invalide';
    }
    else
    {
        if(strlen($tel) != 8)
        {
            $array['telMessage'] = 'Telephone invalide';
        }
    }
    if($password == '') {
        $array['passwordMessage'] = 'Mot de Passe Vide';
    }
    if($Cpassword == '') {
        $array['CpasswordMessage'] = 'Mot de Passe Vide';
    }
    if($Cpassword != $password) {
        $array['CpasswordMessage'] = 'Doit etre identique au mot de passe';
    }
    if($metier == '') {
        $array['metierMessage'] = 'Selectionner un metier';
    }

    echo json_encode($array);

}

?>