<?php

class MonException extends ErrorException
{
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }

    public function __toString()
    {
        switch ($this->severity) {
            case E_USER_ERROR:
                $type = 'Erreur fatale';
                break;
            case E_WARNING:
            case E_USER_WARNING:
                $type = "Attention";
                break;
            case E_NOTICE:
            case E_USER_NOTICE:
                $type = "Note";
                break;
            default:
                $type = "Erreur inconnue";
                break;
        }
        return '<strong>' . $type . '</strong> : [' . $this->code . '] ' . $this->message . '<br /><strong>' . $this->file . '</strong> à la ligne <strong>' . $this->line . '</strong>';
    }
}
