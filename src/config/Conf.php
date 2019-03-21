<?php

class Conf
{

    private static $databases = array(
        // Le nom d'hote est webinfo a l'IUT
        // ou localhost sur votre machine
        'hostname' => 'webinfo.iutmontp.univ-montp2.fr',
        //'hostname' => 'localhost',

        // A l'IUT, vous avez une BDD nommee comme votre login
        // Sur votre machine, vous devrez creer une BDD
        'database' => 'alarconj',

        // A l'IUT, c'est votre login
        // Sur votre machine, vous avez surement un compte 'root'
        'login' => 'alarconj',

        // A l'IUT, c'est votre mdp (INE par defaut)
        // Sur votre machine personelle, vous avez creez ce mdp a l'installation
        'password' => '0808048000U',
    );

    // la variable debug est un boolean
    private static $debug = true;

    public static function getLogin()
    {
        return self::$databases['login'];
    }

    public static function getHostname()
    {
        return self::$databases['hostname'];
    }

    public static function getDatabase()
    {
        return self::$databases['database'];
    }

    public static function getpassword()
    {
        return self::$databases['password'];
    }

    public static function getDebug()
    {
        return self::$debug;
    }
}
?>