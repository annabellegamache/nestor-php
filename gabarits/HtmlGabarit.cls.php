<?php
use \Twig\Environment;
use \Twig\Loader\FilesystemLoader;

class HtmlGabarit 
{
    protected $variables = array();
    protected $module;
    protected $action;
    private $twig;

    function __construct($module, $action)
    {
        $this->module = $module;
        $this->action = $action;

        $this->twig = new Environment(new FilesystemLoader(['vues/']), []);
        $this->twig->addGlobal('session', $_SESSION);
    }

    /**
     * Méthode qui affecte en tableau avec valeur indexer 
    */
    public function affecter($nom, $valeur)
    {
        $this->variables[$nom] = $valeur;
    }

    /**
     * Mthode pour gerer methode /tout /i
     */
    public function affecterActionParDefaut($nomAction) {
        $this->action = $nomAction;
    }
 
    /**
     * Mthode qui génère les différente vues
     */
    public function genererVue() 
    {
        $this->twig->display("$this->module.$this->action.twig.html", $this->variables);
    }
}