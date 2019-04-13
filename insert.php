<?php
		 
//verifier les saisie
$tab=array("nom"=>"","pnom"=>"","age"=>"","local"=>"","grpe"=>"","actu"=>"","nomvide"=>"","pnomvide"=>"","agevide"=>"","localvide"=>"","actuvide"=>"","valid"=>false);
$image="";
// les affectations
if (!empty($_POST))
{
	   $tab["nom"]=verifsaisi($_POST['nom']);
       $tab["pnom"]=verifsaisi($_POST['pnom']);
       $tab["age"]=verifsaisi($_POST['age']);
	   $tab["age"]=2019-$tab["age"];
       $tab["local"]=verifsaisi($_POST['local']);
	   $tab["actu"]=verifsaisi($_POST['actu']);
	   $tab["grpe"]=verifsaisi($_POST['grpe']);
	   $image=verifsaisi($_FILES["image"]["name"]);
	   $chemin="images/".basename($image);
	   $extension=pathinfo($chemin,PATHINFO_EXTENSION);
       $tab["valid"]=true;
	   $upload=false;
	   
	if ( empty($tab["nom"]))
	{
		$tab["nomvide"]="Quel est le nom de  cet ingredient? ";
		$tab["valid"]=false;
	}
    if(empty($tab["pnom"]))
	{
	   $tab["pnomvide"]="Quel est votre prenoms? ";
	   $tab["valid"]=false;
	}
	
	if(empty($tab["age"]))
	{
	   $tab["agevide"]="Quel est votre date de naissance ? ";
	   $tab["valid"]=false;
	}
	if(empty($tab["local"]))
	{
	   $tab["localvide"]="Votre lieu de residence? ";
	   $tab["valid"]=false;
	}
	if(empty($tab["grpe"]))
	{
	   $tab["grpevide"]="Quel est votre groupe? ";
	   $tab["valid"]=false;
	}
	if(empty($tab["actu"]))
	{
	   $tab["actuvide"]="Quel est votre profession? ";
	   $tab["valid"]=false;
	}
	
	if(empty($image))
	{
	   $tab["imvide"]="postez une photo svp? ";
	   $tab["valid"]=false;
	}else
	     {
			 $upload=true;
			 if($extension !='png' && $extension !='gif' && $extension !='jpeg' && $extension !='jpg')
			 	{
					$tab["imvide"]="les formats autorisé sont png, gif,jpeg ou jpg";
					$upload=false;
					
				}
			  if(file_exists($chemin))
			    {
					$tab["imvide"]="l'image existe d&eacute;ja";
					$upload=false;
				}
			 if ($_FILES["image"]["size"]>500000)
			    {
					$tab["imvide"]="l'image ne doit pas depasser 500KB";
					$upload=false;
				}
			 if($upload)
			   {
				   if(! move_uploaded_file($_FILES["image"]["tmp_name"],$chemin))
				     {
						 $tab["imvide"]="une erreur lors du upload ,Veillez ressayer SVP !";
					     $upload=false;
					 }
			   }
	     }
	if ($upload && $tab["valid"])
	   {
		   // connection base donne
		   try
	  {
		 $bd=New PDO('mysql:host=localhost;dbname=alimentation','root','');
	
	  }
	  catch(exception $e)
	  {
		  die('Erreur:'.$e->getMessage());
	  }
	

		   // insertion des données dans la table
		  $req=$bd->prepare('INSERT INTO `T_etudiant`(``Id_etd`, `nom_etd`, `pnom_etd`, `age_etd`,`local_etd`,`act_etd`,im, `groupe`,date) VALUES(NULL,?,?,?,?,?,?,?,Now())');;
		  // afficher
		  $req->execute(array($tab["nom"],$tab["pnom"],$tab["age"],$tab["local"],$tab["actu"],$image,$tab["grpe"]));
		  $req->closeCursor();
		  //  se rediriger vers  la page d'administration
		  header("location:#.php");
		  
	   }
	
	
}
   function verifsaisi($var)
 {
	 $var=trim($var);
	 $var=stripslashes($var);
	 $var=htmlspecialchars($var);
	 return $var;
 }
 //++++++++
  
         ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
</head>

<body>
<!-- creer le formulaire pour recuperer les données-->
<form method="post" action="<?php echo  $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                   
                     <div class="form-group" >
                    <label for="nom">NOM</label><input type="text" placeholder="NOM" class="form-control" name="nom" id="nom"  value="<?php  echo $valeur["titr_item"];  ?>"/>
                     <p style="color:red; font-style:italic"><?php echo $tab["nomvide"]; ?>  </p>
                     </div>
                     <div class="form-group" >
                     <label>PRENOMS</label><input type="text"  class="form-control" name="descr"  value="<?php  echo $valeur["pnom"];  ?>"/>
                     <p style="color:red; font-style:italic"><?php echo $tab["descrvide"]; ?>  </p>
                     </div>
                     <div class="form-group" >
                     <label for="ag">AGE</label><input type="number"  class="form-control" name="age" id="ag"  value="<?php  echo $valeur["age"];  ?>"/>
                     <p style="color:red; font-style:italic"><?php echo $tab["agevide"]; ?>  </p>
                     </div>
                     <div class="form-group" >
                     <label for="local">LIEU DE RESIDENCE</label><input type="number"   class="form-control" name="local" id="local"  value="<?php  echo $valeur["local"];  ?>"/>
                     <p style="color:red; font-style:italic"><?php echo $tab["loaclide"]; ?>  </p>
                     </div>
                     <div class="form-group" >
                     <label for="actu">PROFESSION</label><input type="number"   class="form-control" name="actu" id="prix"  value="<?php  echo $valeur["actu"];  ?>"/>
                     <p style="color:red; font-style:italic"><?php echo $tab["actuvide"]; ?>  </p>
                     </div>
                     <div class="form-group" >
                   >
                     <label>SELECTIONNNER UNE IMAGE</label><input type="file" name="image"  value="<?php  echo $tab["im"];  ?>" />
                     <p style="color:red; font-style:italic"><?php echo $tab["imvide"]; ?>  </p>
                   </div>
                           <div class="form-group" > 
                    <label>GROUPE</label>
                       <select name="grp" class="form-control">
                        <?php 
						
							   try
	  {
		 $bd=New PDO('mysql:host=localhost;dbname=etudiant','root','');
	
	  }
	  catch(exception $e)
	  {
		  die('Erreur:'.$e->getMessage());
	  }
						
						foreach($req2=$bd->query('SELECT * FROM `group`') as $result)
						
					{	
                          if($result['Id_grp']==$valeur["categorie"])
						  {
						  echo '<option value="'.$result['Id_grp'].'"> 			
				'.$result['nom_grp'].'</option>';
						  }else 
						       {
						echo '<option value="'.$result['I_grp'].'"> 
				'.$result['nom_grp'].'</option>';
								}
			
				    } 
                          
                          
                          ?>
                       </select>
                    </div>
                    
                   <div class="form-actions" style="margin-bottom:20px"  >
                   <button type="submit" class="btn btn-primary">VALIDER</button>
                   
                   <a href="admin.php" class="btn btn-success"><span class="glyphicon glyphicon-arrow-left"></span> RETOUR</a>
                   </div>
                   
                   
                </form>


</body>
</html>