<?php
class Autoloader
{
    public static function register()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    public static function autoload($class)
    {
        // On crée une liste des dossiers où chercher
        $sources = [
            'app/controllers/',
            'app/models/',
            'config/'
        ];

        // On boucle sur chaque dossier
        foreach ($sources as $source) {
            $file = $source . $class . '.php';
            if (file_exists($file)) {
                require_once $file;
                return; // On a trouvé le fichier, on arrête de chercher !
            }
        }
    }
}
