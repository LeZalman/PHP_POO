<?php

class Writer
{
    use HTMLFormater, TextFormater{
        HTMLFormater::format insteadOf TextFormater;
    }

    public function write($text)
    {
        file_put_contents('fichier.txt',$this->format($text));
    }
}
