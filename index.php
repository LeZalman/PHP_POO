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



$connexion = PDOFactory::getMysqlConnexion();

//$_SESSION['connexion'] = serialize($connexion);

function html_table($data = array())
{
    $result = '';
    foreach ($data as $key => $value) {

        $result .= "<br />$key = $value";
    }
    return $result;
}

//Conserver le code ci-dessus, il simplifie l'edition de code pour les exercices et TPs

$o = new Observee;

$o->attach(new Observer1);
$o->attach(new Observer2);

$o->setNom('Alan');

$o = new ErrorHandler;
$db = PDOFactory::getMysqlConnexion();

$o->attach(new MailSender('login@fai.tld'));
$o->attach(new BDDWriter($db));

set_error_handler([$o, 'error']);

5/0;