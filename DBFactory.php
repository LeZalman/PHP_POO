<?php

class DBFactory
{
    public static function load($sgdbr)
    {
        $classe = 'SGBDR_' . $sgdbr;

        if (file_exists($chemin = $classe . '.class.php')) {
            require $chemin;
            return new $classe;
        }else {
            throw new RuntimeException('La classe <strong>' . $classe . '</strong> n\'a pu être trouvée !');
        }
    }
}
