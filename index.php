<?php

function chargerClasse($classe)
{
    require $classe . '.php';
}

spl_autoload_register('chargerClasse');
require('traits.php');

$connexion = new Connexion('localhost', 'root', '', 'PHP_POO');

$_SESSION['connexion'] = serialize($connexion);

$classeMagicien = new ReflectionClass('Magicien');
$magicien = new Magicien(['nom' => 'vyk12', 'type' => 'magicien']);

foreach ($classeMagicien->getProperties() as $attribut) {
    $attribut->setAccessible(true);
    echo $attribut->getName(), ' => ', $attribut->getValue($magicien);
}
