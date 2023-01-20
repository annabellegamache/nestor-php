<?php
class UtilisateurModele extends AccesBd
{
    /**
     * Méthode qui retourne un enregistrement de la table utilisateur
     * @return array une ligne d'enregistrement
     */
    public function un($courriel)
    {
        return $this->lireUn("SELECT * FROM utilisateur 
                                WHERE uti_courriel=:courriel"
                        , ['courriel'=>$courriel]);
    }

  
/**
 * Méthode qui ajoute un utilisateur à la table utilisateur
 */
    public function ajouter($utilisateur) 
    {
        extract($utilisateur);
        $cc = uniqid('nestor', true); 
        $this->creer("INSERT INTO utilisateur VALUES (0, :nom, :courriel, :mdp, NOW(),'$cc')",
                    [
                        'nom'  => $uti_nom,
                        'courriel'  => $uti_courriel,
                        'mdp'       => password_hash($uti_mdp, PASSWORD_DEFAULT)
                    ]
        );
    }
}