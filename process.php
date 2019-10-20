<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'dapphp') or die(mysqli_error($mysqli));

$idClient = 0;
$update = false;
$codeDestinataire = '';
$raisonSociale= '';



/**
 * Ajouter une entréé
 */
if (isset($_POST['sauvegarder']) and !empty($_POST['idClient']) and !empty($_POST['codeDestinataire']) and !empty($_POST['raisonSociale'])) {

    $idClient = $_POST['idClient'];
    $codeDestinataire = $_POST['codeDestinataire'];
    $raisonSociale = $_POST['raisonSociale'];


    $mysqli->query("INSERT INTO destinataires (idClient, codeDestinataire, raisonSociale) VALUES ('$idClient', '$codeDestinataire', '$raisonSociale')") or die($mysqli->error());

    $_SESSION['message'] = "Entrée sauvegardée !";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}
if (isset($_POST['sauvegarder']) and empty($_POST['idClient']) and empty($_POST['codeDestinataire']) and empty($_POST['raisonSociale'])) {

    $_SESSION['message'] = "Aucune entrée ! Les champs sont vides";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}
if (isset($_POST['sauvegarder']) and !empty($_POST['idClient']) and empty($_POST['codeDestinataire']) and !empty($_POST['raisonSociale'])) {

    $_SESSION['message'] = "Aucune entrée ! Pas de codeDestinataire";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}
if (isset($_POST['sauvegarder']) and empty($_POST['idClient']) and !empty($_POST['codeDestinataire']) and !empty($_POST['raisonSociale'])) {

    $_SESSION['message'] = "Aucune entrée ! Pas de idClient";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}
if (isset($_POST['sauvegarder']) and !empty($_POST['idClient']) and empty($_POST['codeDestinataire']) and empty($_POST['raisonSociale'])) {

    $_SESSION['message'] = "Aucune entrée ! Que le idClient";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}
if (isset($_POST['sauvegarder']) and empty($_POST['idClient']) and !empty($_POST['codeDestinataire']) and empty($_POST['raisonSociale'])) {

    $_SESSION['message'] = "Aucune entrée ! Que le codeDestinataire";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}
if (isset($_POST['sauvegarder']) and empty($_POST['idClient']) and empty($_POST['codeDestinataire']) and !empty($_POST['raisonSociale'])) {

    $_SESSION['message'] = "Aucune entrée ! Que raison Sociale";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}
if (isset($_POST['sauvegarder']) and !empty($_POST['idClient']) and !empty($_POST['codeDestinataire']) and empty($_POST['raisonSociale'])) {

    $_SESSION['message'] = "Aucune entrée ! Pas d'age";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

/**
 * Effacer une entrée
 */
if (isset($_GET['delete'])) {
    $idClient = $_GET['delete'];
    $mysqli->query("DELETE FROM destinataires WHERE idClient=$id") or die($mysqli->error());

    $_SESSION['message'] = "Entrée supprimée !";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

/**
 * Editer une entrée
 */
if (isset($_GET['edit'])) {
    $idClient = $_GET['edit'];
    $update = true;

    $result = $mysqli->query("SELECT * FROM destinataires WHERE idClient=$idClient") or die($mysqli->error());

    $row = $result->fetch_array();
    if ($result) {
        $idClient = $row['idClient'];
        $codeDestinataire = $row['codeDestinataire'];
        $raisonSociale = $row['raisonSociale'];
    }
}

/**
 * Modifier une entrée
 */
if (isset($_POST['modifier'])) {
    // $id = $_POST['id'];
    $idClient = $_POST['idClient'];
    $codeDestinataire = $_POST['codeDestinataire'];
    $raisonSociale = $_POST['raisonSociale'];

    $mysqli->query("UPDATE destinataires SET idClient='$idClient', codeDestinataire='$codeDestinataire', raisonSociale='$raisonSociale' WHERE idClient=$idClient") or die($mysqli->error());
    $_SESSION['message'] = "Entrée mise à jour";
    $_SESSION['msg_type'] = "warning";

    header('location: index.php');
}
