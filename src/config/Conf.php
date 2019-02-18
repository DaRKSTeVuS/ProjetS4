<?php
	class Conf {

		static private $databases = array(
			// Le nom d'hote est webinfo a l'IUT
			// ou localhost sur votre machine
			'hostname' => 'webinfo',

			// A l'IUT, vous avez une BDD nommee comme votre login
			// Sur votre machine, vous devrez creer une BDD
			'database' => 'alarconj',

			// A l'IUT, c'est votre login
			// Sur votre machine, vous avez surement un compte 'root'
			'login' => 'alarconj',
			
			// A l'IUT, c'est votre mdp (INE par defaut)
			// Sur votre machine personelle, vous avez creez ce mdp a l'installation
			'password' => '0808048000U'
		);

		// la variable debug est un boolean
		static private $debug = True; 

		static public function getLogin() {
			return self::$databases['login'];
		}

		static public function getHostname(){
			return self::$databases['hostname'];
		}

		static public function getDatabase(){
			return self::$databases['database'];
		}

		static public function getpassword(){
			return self::$databases['password'];
		}

		static public function getDebug() {
			return self::$debug;
		}
	}
?>