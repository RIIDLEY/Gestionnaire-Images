<?php
require('view_begin.php');
?>
<center>
<h1>Pagination</h1>

<table>
<?php 
$i=1;
echo "<tr>";
foreach($tab as $ligne)://Affiche les données present dans le tableau donné par le controller ?>
    <td>
    <center>
    <table>
        <td>
       <center><img src="Upload/<?=$ligne['filename']?>" width="250" height="auto" ></center> 
        <p> Titre : <?=$ligne['name']?> | Poid : <?=$ligne['size']?> octets | Type : <?=$ligne['type']?></p>
        </td>
    </table>
    </center> 
    </td>
<?php 
if ($i==2) {
    echo "</tr>";
    echo "<tr>";
}
$i++;
endforeach; ?>
</table>

<!-- Systeme de pagination dynamique, la liste des boutons s'actualise en fonction de la page où l'utilisateur est -->
<?php

echo '<br><br>Systeme de pagination dynamique :<br>';
$nbPage = $nbdata/4;
//[(page-debut)-fix;page+fin]

$debut = $_GET['page']-1;//set la valeur qui sera utilisé pour initialiser le debut de la liste
$fin = (ceil($nbPage)-$_GET['page']);//set la valeur qui sera utilisé pour initialiser la fin de la liste. Nombre de page-page actuelle. Pour voir il nous reste combien de page suivante avant d'atteindre la derniere page
$fix = 1;// variable utiliser pour fix un declagae dans la liste

if($fin>2){//s'il reste plus de 2 pages disponible apres la page actuelle
    $fin=2;//met la var à 2
}

if ($debut>3) {//s'il y a plus de 2 pages (+1 avec la page actuelle) avant
    $debut=3;//met la var a 3
}

if ($_GET['page']>3) {
    $fix=0;
}

if ($_GET['page']>1) {//mise en place du bouton precedent
    echo "<a href='?controller=home&action=changePage&page=".($_GET['page']-1)."' class='btn btn-danger'>Avant</a> ";
}

//[(page-debut)-fix;page+fin]
for ($i=$_GET['page']-$debut-$fix; $i < $_GET['page']+$fin; $i++) {//affiche un bouton pour les pages proches de la page actuelle [(page-debut)-fix;page+fin]
    if ($_GET['page']!=$i+1) {//si le numero de la page est different de la page actuelle
        echo "<a href='?controller=home&action=changePage&page=".($i+1)."' class='btn btn-secondary'>".($i+1)."</a> ";// Affiche le bouton et le met en gris
    }else {
        echo "<a href='?controller=home&action=changePage&page=".($i+1)."' class='btn btn-primary'>".($i+1)."</a> ";// Affiche le bouton et le met en bleu
    }
}

if ($_GET['page']<$nbPage) {//mise en place du bouton suivant
    echo "<a href='?controller=home&action=changePage&page=".($_GET['page']+1)."' class='btn btn-danger'>Suivant</a> ";
}


?>
    <p>Téléverser une image :</p>
<table>
<td>
    <form action = "?controller=home&action=upload" method="post" enctype="multipart/form-data">
   <label >Format accepté : JPEG, PNG, JPG et GIF | Taille max : 2MB</label><br>
            <input type="file" name="fichier" accept="image/png, image/jpeg, image/jpg, image/gif"> <!-- Accept uniquement des png jpeg jpg et gif -->
			<input type="submit" value="Envoyer"/>
    </form>
</td>

</table>


</center>
<p>Par Lahoucine HAMSEK</p>
<?php
require('view_end.php');
?>
