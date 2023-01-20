<?php
class ContactControleur extends Controleur
{

    public function __construct($modele, $module, $action)
    {
        parent::__construct($modele, $module, $action);
        if(!isset($_SESSION['utilisateur'])) {
            Utilitaire::nouvelleRoute('utilisateur/index');
        }
    }

    /**
     * Méthode invoquée par défaut si aucune action n'est indiquée
     */
    public function index()
    {
        // Par défaut on affiche les contacts
        $this->gabarit->affecterActionParDefaut('tout');
        $this->tout();
    }

   
    /**
     * Méthode qui affiche tous les contacts de l'utilisateur connecté
     */
    public function tout()
    {  
        $contactsTelsGroupes = $this->modele->tout($_SESSION['uid']);
        $this->gabarit->affecter('contacts', $contactsTelsGroupes);

    }

    
    /**
     * Méthode qui ajoute un contact et réaffiche les contacts de l'utilisateur connecté
     */
    public function ajouter() 
    {   

        //print_r($_POST);
        $this->modele->ajouter($_POST);
        Utilitaire::nouvelleRoute('contact/tout'); 
    }

    /**
     * Méthode qui supprime un contact et réaffiche les contacts de l'utilisateur connecté
     */
    public function retirer()
    {
        //envoyer seulement les id 
        $this->modele->retirer($_POST['ctc_id']);
        Utilitaire::nouvelleRoute('contact/tout');
    }

    /**
     * Méthode qui modifie un contact et réaffiche les contacts de l'utilisateur connecté
     */
    public function changer()
    {
        $this->modele->changer($_POST);
        Utilitaire::nouvelleRoute('contact/tout');
    }
    
}
