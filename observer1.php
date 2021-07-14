<?php

class Observer1 implements SplObserver
{
    public function update(SplSubject $obj)
    {
        echo 'Observer1 à été notifié ! Nouvelle valeur de l\'attribut <strong>nom</strong> : ' . $obj->getNom() . '<br />';
    }
}

class Observer2 implements SplObserver
{
    public function update(SplSubject $obj)
    {
        echo 'Observer2 à été notifié ! Nouvelle valeur de l\'attribut <strong>nom</strong> : ' . $obj->getNom();
    }
}
