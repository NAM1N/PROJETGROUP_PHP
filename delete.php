<?php 
// recuperer Id_etd  transmis par URL 
  if(!empty($_GET['id']))
  {
	$id=verifsaisi($_GET['id']); 
	
  }
  // se connecter a la BD
  if ($_POST)
  {
	  
   try
	  {
		 $bd=New PDO('mysql:host=localhost;dbname=etudiant','root','');
		 
		 // faire une requête pour supprimer
		$req=$bd->prepare(" DELETE FROM T_etudiant  WHERE Id_etd=?");
		$req->execute(array($id));
		 
		 
	  }
	  catch(exception $e)
	  {
		  die('Erreur:'.$e->getMessage());
	  }
  
  }
  
 // verifier  les données recupéré par la methode $_GET
    function verifsaisi($var)
 {
	 $var=trim($var);
	 $var=stripslashes($var);
	 $var=htmlspecialchars($var);
	 return $var;
 }
  ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
</head>

<body>
<!-- creer un formulaire pour confirmer la suppresseion-->
<form method="post" action="#" >
<input type="hidden" name="<?php echo $id ?>" />
<p>Voulez vous vraiment supprimer cet etudiant</p>
<button type="submit">OK</button>&nbsp;<a href="#">Annuler</a><!--ce lien nous ramène la page admin -->

</form>
</body>
</html>