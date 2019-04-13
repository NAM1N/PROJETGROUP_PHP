<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans titre</title>
</head>

<body>
<!-- la partie controle des etudiants ajout supression modifier -->
<!-- créer un tableau qui va contenu la liste des etudians -->
          <table class="table table-striped table-bordered" style="box-shadow:2px 4px #FF6600" >
               <thead>
                  <tr>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Pr&eacute;noms</th>
                    <th>Age</th>
                    <th>localite</th>
                    <th>Activit&eacute;</th>
                    <th>image</th> 
                    <th>groupe</th> 
                    <th>Action</th>
                 </tr>
               </thead>
               <tbody>
                <?php 
// connection
  
	   try
	  {
		 $bd=New PDO('mysql:host=localhost;dbname=etudiant','root','');
	
	  }
	  catch(exception $e)
	  {
		  die('Erreur:'.$e->getMessage());
	  }
	
			// faire ine requete
		  $req=$bd->query('SELECT `Id_etd`, `nom_etd`, `pnom_etd`, `age_etd`,`local_etd`,`act_etd`,im, `groupe` FROM `T_etudiant` LEFT JOIN `groupe` ON `groupe`= `id_grp`  ORDER BY `Id_etd` DESC');
		  // afficher
		    while ($result = $req->fetch())
			{
			
		       echo '<tr>';
               echo '<td>'.$result['Id_etd'].'</td>'; 
               echo '<td>'.$result['nom_etd'].'</td>'; 
			   echo '<td>'.$result['pnom_etd'].'</td>';
               echo '<td>'.$result['age_etd'].'</td>';
			   echo '<td>'.$result['local_etd'].'</td>'; 
               echo '<td>'.$result['act_etd'].'</td>';
			   echo '<td>'.$result['im'].'</td>';
			   echo '<td>'.$result['groupe'].'</td>'; 
               echo '<td>
                      <a class="btn btn-default" href="voir.php?id='.$result['Id_etd'].'"><span class="glyphicon glyphicon-eye-open"></span> Voir</a>&nbsp;&nbsp;
                      <a class="btn btn-primary" href="modif.php?id='.$result['Id_etd'].'"><span class="glyphicon glyphicon-edit"></span> Modifier</a>&nbsp;&nbsp;
                      <a class="btn btn-danger" href="delete.php?id='.$result['Id_etd'].'"><span class="glyphicon glyphicon-trash"></span> Supprimer</a>
                      
                    </td> 
                 </tr>';
		  
			}
			 
		  
?>
          </tbody>
               <tfoot>
                
               </tfoot>
             </table>
</body>
</html>