<?php
include '../connexion/db.php'; // Assurez-vous d'inclure votre connexion à la base de données

$response = ["lignes" => '', "message" => ""];
$idbesoin = mysqli_real_escape_string($conn, $_POST['idbesoin']);
if (isset($_POST['idbesoin']) && !empty($_POST['idbesoin'])) {
   
    $sql_select = "SELECT date,origine,client,objet FROM besoin WHERE idBesoin = '$idbesoin'";
    $result = mysqli_query($conn, $sql_select);
    if ($result) {	
		if ($row = mysqli_fetch_assoc($result)) {
			$date=$row['date'];
			$origine=$row['origine'];
			$client=$row['client'];
			$objet=$row['objet'];
			$sql_insert_demande="
			INSERT demande_achat (idBesoin,date,origine,client,objet)
			VALUES
			('$idbesoin','$date','$origine','$client','$objet') ";
			
			$result = mysqli_query($conn, $sql_insert_demande);				
			$idDemande = mysqli_insert_id($conn);
		}	
	}
}	
if (isset($_POST['besoin_details']) && !empty($_POST['besoin_details'])) {
	$tbesoin=array();
	$tbesoin=$_POST['besoin_details'];
	$lbesoin=implode(",",$tbesoin);
	$sql_select =" SELECT  id, fournisseur, categorie, sous_categorie, qualite, longueur, largeur, epaisseur, unite, quantite, designation FROM details WHERE id in ($lbesoin)  ";
	$result = mysqli_query($conn, $sql_select);
	if ($result) {	
		while ($row = mysqli_fetch_assoc($result)) {
			$id=$row['id'];
			$fournisseur=$row['fournisseur'];
			$categorie=$row['categorie'];
			$sous_categorie=$row['sous_categorie'];
			$qualite=$row['qualite'];
			$longueur=$row['longueur'];
			$largeur=$row['largeur'];
			$epaisseur=$row['epaisseur'];
			$unite=$row['unite'];
			$quantite=$row['quantite'];
			$designation=$row['designation'];
			$sql_insert_produits="
			INSERT INTO demande_produit(idDemande , designation, unite, quantite) 
			VALUES
			('$idDemande','$designation','$unite','$quantite') ";
			$rs = mysqli_query($conn, $sql_insert_produits);	
		}
		if($rs){
			echo json_encode(["status" => "success", "idDemande" => $idDemande, "message" => "Transformation réussie", ]);
		}else{
			echo json_encode(["status" => "error", "message" => "Erreur : " . mysqli_error($conn)]);
		}
	}
	
}	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	