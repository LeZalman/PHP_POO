<?php

class Connexion
{
    protected $pdo, $serveur, $utilisateur, $motDePasse, $dataBase;

    public function __construct($serveur, $utilisateur, $motDePasse, $dataBase)
    {
        $this->serveur = $serveur;
        $this->utilisateur = $utilisateur;
        $this->motDePasse = $motDePasse;
        $this->dataBase = $dataBase;

        $this->connexionBDD();
    }

    protected function connexionBDD()
    {
        try {
            $this->pdo = new PDO('mysql:host=' . $this->serveur . ';dbname=' . $this->dataBase, $this->utilisateur, $this->motDePasse);
        } catch (PDOException $e) {
            echo 'La connexion a échoué.<br />';
            echo 'Informations : [', $e->getCode(), '] ', $e->getMessage() . '<br />';
        } finally {
            echo 'Base de données connectée <br />';
        }
    }

    public function __sleep()
    {
        // Ici sont à placer des instructions à exécuter juste avant la linéarisation.
        // On retourne ensuite la liste des attributs qu'on veut sauver.
        return ['serveur', 'utilisateur', 'motDePasse', 'dataBase'];
    }
}
