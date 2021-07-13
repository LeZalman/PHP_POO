<?php

function chargerClasse($classe)
{
    require $classe . '.php';
}

spl_autoload_register('chargerClasse');
require('traits.php');
//Utilisation lib addendum
require('addendum/annotations.php');
require('MyAnnotations.php');
require('Personnage.class.php');


$connexion = new Connexion('localhost', 'root', '', 'PHP_POO');

$_SESSION['connexion'] = serialize($connexion);

function html_table($data = array())
{
    $result = '';
    foreach ($data as $key => $value) {

        $result .= "<br />$key = $value";
    }
    return $result;
}

//Conserver le code ci-dessus, il simplifie l'edition de code pour les exercices et TPs

