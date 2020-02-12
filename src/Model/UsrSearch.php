<?php


namespace src\Model;


class UsrSearch
{

    public function SqlSearch(\PDO $bdd,$searchmot){
        $requete = $bdd->prepare('SELECT * FROM User where /*Etat=2 and*/ Ville or age or passion or  LIKE :search');
        $requete->execute(
            ['search'=> "%".$searchmot."%"]
        );
        $arrayArticle = $requete->fetchAll( );

        $listArticle = [];
        foreach ($arrayArticle as $articleSQL){
            $article = new Article();
            $article->setId($articleSQL['Id']);
            $article->setTitre($articleSQL['Titre']);
            $article->setDescription($articleSQL['Description']);
            $article->setDateAjout($articleSQL['DateAjout']);
            $article->setAuteur($articleSQL['Auteur']);
            $article->setImageRepository($articleSQL['ImageRepository']);
            $article->setImageFileName($articleSQL['ImageFileName']);
            //$article->setCategorie($articleSQL['cat_nom']);

            $listArticle[] = $article;

            return $listArticle;

        }
    }

}