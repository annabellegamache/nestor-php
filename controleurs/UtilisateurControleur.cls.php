<?php
class UtilisateurControleur extends Controleur
{

    public function __construct($modele, $module, $action)
    {
        parent::__construct($modele, $module, $action);
        // S'il y a un utilisateur connecté, diriger vers categorie/tout (ou categorie)
        if(isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('contact');
        }
    }

    /**
     * Méthode invoquée par défaut si aucune action n'est indiquée
     */
    public function index()
    {
        // Il n'y a rien à faire ici pour le moment.
    }

   


    /**
     * Méthode qui ajoute un nouvelle utilisateur à la BD et redirige vers la page d'accueil 
     * (formulaire de connexion)
     */
    public function ajouter()
    {
        $this->modele->ajouter($_POST);
        Utilitaire::nouvelleRoute('utilisateur/index');
    }



    /**
     * Méthode qui tente l'ouverture d'une connexion : si réussi, redirige vers contact/tout  et sinon, réaffiche le formulaire de connexion avec un message d'erreur.
     */
    public function connexion()
    {
        $erreur = false;
        if(isset($_POST['uti_courriel']) && isset($_POST['uti_mdp'])){
            $courriel = $_POST['uti_courriel'];
            $mdp = $_POST['uti_mdp'];
            $utilisateur = $this->modele->un($courriel);
            $utilisateurId = $utilisateur->uti_id;

            if(!$utilisateur || !password_verify($mdp, $utilisateur->uti_mdp)) {
                $erreur = "Mauvaise combinaison courriel/mot de passe";
            }
            else if($utilisateur->uti_confirmation !== '') {
                $erreur = "Ce compte n'est pas encore confirmé : vérifiez le message de confirmation dans vos courriels";
            }

        } else {
            $erreur = "Veuillez saisir votre courriel et votre mot de passe";
        }
        
        
        

        if(!$erreur) {
            $_SESSION['utilisateur'] = $utilisateur;
            $_SESSION['uid'] = $utilisateurId;
            Utilitaire::nouvelleRoute("contact/tout");
        }
        else {
            $this->gabarit->affecter('erreur', $erreur);
            $this->gabarit->affecterActionParDefaut('index');
            $this->index([]);
        }
    }

    /**
     * Déconnecte l'utilisateur connecté et redirige vers la page d'accueil (formulaire de connexion)
     */
    public function deconnexion()
    {
        unset($_SESSION['utilisateur']);
        unset($_SESSION['utilisateurId']);
        Utilitaire::nouvelleRoute("utilisateur/index");
    }


  
}
