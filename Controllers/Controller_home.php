<?php

class Controller_home extends Controller{

  public function action_default(){//fonction appele par defaut
    header('location:?controller=home&action=changePage&page=1');//set les parametres dans l'URL
    //$this->action_changePage();//appel la fonction action_changePage
  }

  public function action_changePage(){
    $m = Model::getModel();//recupere le modele (la base de données)
    $tab = ['tab' => $m->getDataPage($_GET['page']),'nbdata' => $m->getNbData()];//utilise les fonctions sur modele et mets les données dans un tableau
    $this->render('home',$tab);//envoie du tableau avec les données dans la Vue
  }
  
  public function action_upload(){
    $maxsize = 2097152;
    
    if(!empty($_FILES['fichier']))
    {
      if(($_FILES['fichier']['size'] >= $maxsize) || ($_FILES["fichier"]["size"] == 0)) {// si la taille du fichier est superieur à 2MB
        echo('<script type="text/javascript">alert("Le fichier est trop gros (> 2MB)")</script>');
        echo("<script>window.location = 'index.php';</script>");
      }else{
        $tmp_nom = $_FILES['fichier']['tmp_name'];
        $name = $_FILES['fichier']['name'];
        $tmp = explode(".", $name);
        $type = end($tmp);
        $random = rand(1, 15000);

        if (move_uploaded_file($tmp_nom, 'Upload/'.$random."-".$name)){//ajoute le fichier à dossier de stockage du serveur)
          $m = Model::getModel();//recupere le modele (la base de données) 
          $info = ['name'=>(explode(".", $name))[0],'filename'=>$random."-".$name,'type'=>$type,'size'=>intval($_FILES["fichier"]["size"])];
          $m->addNewFile($info);//ajoute le fichier à la BDD
          echo '<script type="text/javascript">alert("Le fichier a bien été upload")</script>';//met une pop up
          echo("<script>window.location = 'index.php';</script>");
        }
      }
    }else{
    }
    //$this->action_default();//redirige vers la page principale
  }
}

?>