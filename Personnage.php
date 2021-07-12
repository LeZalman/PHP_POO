<?php
abstract class Personnage
{
    protected $atout;
    protected $degats;
    protected $id;
    protected $nom;
    protected $timeEndormi = 0;
    protected $type;
    protected $forcePerso = 1;
    protected $experience = 0;
    protected $niveau = 1;

    const CEST_MOI = 1;
    const PERSONNAGE_TUE = 2;
    const PERSONNAGE_FRAPPE = 3;
    const PERSONNAGE_ENSORCELE = 4;
    const PAS_DE_MAGIE = 5;
    const PERSO_ENDORMI = 6;
    const LEVEL_UP = 7;

    //Constructeur

    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
        $this->type = strtolower(static::class);
    }

    // Liste des Actions

    public function estEndormi()
    {
        return $this->timeEndormi > time();
    }

    public function frapper(Personnage $perso)
    {
        if ($perso->id() == $this->id()) {
            return self::CEST_MOI;
        }

        if ($this->estEndormi()) {
            return self::PERSO_ENDORMI;
        }

        return $perso->recevoirDegats();
    }


    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set' . ucfirst($key);

            // Si le setter correspondant existe.
            if (method_exists($this, $method)) {
                // On appelle le setter.
                $this->$method($value);
            }
        }
    }

    public function nomValide()
    {
        return !empty($this->nom);
    }

    public function recevoirDegats()
    {
        $this->degats += 5;

        if ($this->degats >= 100) {
            return self::PERSONNAGE_TUE;
        }

        return self::PERSONNAGE_FRAPPE;
    }

    public function reveil()
    {
        $secondes = $this->timeEndormi;
        $secondes -= time();

        $heures = floor($secondes / 3600);
        $secondes -= $heures * 3600;
        $minutes = floor($secondes / 60);
        $secondes -= $minutes * 60;
        $heures .= $heures <= 1 ? ' heure' : ' heures';
        $minutes .= $minutes <= 1 ? ' minute' : ' minutes';
        $secondes .= $secondes <= 1 ? ' seconde' : ' secondes';

        return $heures . ', ' . $minutes . ' et ' . $secondes;
    }

    // Liste des getters

    public function id()
    {
        return $this->id;
    }

    public function nom()
    {
        return $this->nom;
    }

    public function degats()
    {
        return $this->degats;
    }

    public function niveau()
    {
        return $this->niveau;
    }

    public function experience()
    {
        return $this->experience;
    }

    public function forcePerso()
    {
        return $this->forcePerso;
    }

    public function atout()
    {
        return $this->atout;
    }

    public function timeEndormi()
    {
        return $this->timeEndormi;
    }

    public function type()
    {
        return $this->type;
    }

    // Liste des setters

    public function setId($id)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int) $id;

        // On vérifie ensuite si ce nombre est bien nul ou positif.
        if ($id >= 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->id = $id;
        }
    }

    public function setNom($nom)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($nom)) {
            $this->nom = $nom;
        }
    }


    public function setDegats($degats)
    {
        $degats = (int) $degats;

        if ($degats >= 0 && $degats <= 100) {
            $this->degats += $degats;
        }
    }

    public function setForcePerso($forcePerso)
    {
        $forcePerso = (int) $forcePerso;

        if ($forcePerso >= 1 && $forcePerso <= 100) {
            $this->forcePerso = $forcePerso;
        }
    }

    public function setNiveau($niveau)
    {
        $niveau = (int) $niveau;

        if ($niveau >= 1 && $niveau <= 100) {
            $this->niveau = $niveau;
        }
    }

    public function setExperience($experience)
    {
        $experience = (int) $experience;

        if ($experience >= 0 && $experience <= 100) {
            if ($this->experience + $experience < 100) {
                $this->experience += $experience;
            } else {
                $reste = $this->experience + $experience - 100;
                $this->experience = $reste;
                $this->setNiveau($this->niveau + 1);
                $this->setForcePerso($this->forcePerso + 3);
                return self::LEVEL_UP;
            }
        }
    }

    public function setAtout($atout)
    {
        $atout = (int) $atout;

        if ($atout >= 0 && $atout <= 100) {
            $this->atout = $atout;
        }
    }

    public function setTimeEndormi($time)
    {
        $this->timeEndormi = (int) $time;
    }
}
