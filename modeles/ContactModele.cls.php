<?php
class ContactModele extends AccesBd
{
   
    /**
     * Récupère tous les enregistrements 'contacts' de la BD
     * @return la requete sql
     */
    public function tout($utiId)
    {
       
       return  $this->lireTout("SELECT *
                                FROM contact 
                                LEFT JOIN telephone
                                ON ctc_id=tel_ctc_id_ce
                                WHERE ctc_uti_id_ce=:ctc_uti_id_ce	
                                ORDER BY ctc_id ASC",
                               ['ctc_uti_id_ce' => $utiId]);
        }


  
    
    /**
     * Ajoute un contact dans la table 'contact'
     */
    public function ajouter($contact) 
    {  
        extract($contact);
        $id = $this->creer(
                "INSERT INTO contact 
                VALUES (0, :ctc_prenom, :ctc_nom, :ctc_categorie, :ctc_uti_id_ce)", 
                ["ctc_prenom"=> $ctc_prenom, "ctc_nom"=> $ctc_nom, "ctc_categorie"=> $ctc_categorie, "ctc_uti_id_ce"=> $ctc_uti_id_ce]);
        
   

        //boucle dans le tableau numero pour ajouter tous les numéros             
        for ($i=0; $i < count( $tel_numero) ; $i++) { 
            $this->creer(
                "INSERT INTO telephone 
                VALUES (0, :tel_numero, :tel_type, :tel_poste, :tel_ctc_id_ce)", 
                ["tel_numero"=> $tel_numero[$i], "tel_type"=> $tel_type[$i], "tel_poste"=> $tel_poste[$i], "tel_ctc_id_ce"=> $id]);
        }
    

    }


    /**
     * Supprime un contact dans la BD
     */
    public function retirer($ctc_id)
    {
        
        $this->supprimer("DELETE FROM contact WHERE ctc_id=:ctc_id"
                , ['ctc_id' => $ctc_id]);
    }

    /**
     * Modifie un contact dans la BD
     */
    public function changer($contact)
    {
        extract($contact);
        $this->modifier("UPDATE contact
                        SET ctc_prenom=:ctc_prenom, ctc_nom=:ctc_nom, ctc_categorie=:ctc_categorie, ctc_uti_id_ce=:ctc_uti_id_ce
                        WHERE ctc_id=:ctc_id"
                , ["ctc_id"=> $ctc_id,"ctc_prenom"=> $ctc_prenom, "ctc_nom"=> $ctc_nom, "ctc_categorie"=> $ctc_categorie, "ctc_uti_id_ce"=> $ctc_uti_id_ce]);


        //boucle dans le tableau numero pour ajouter tous les numéros             
        for ($i=0; $i < count( $tel_numero) ; $i++) { 
            $this->modifier("   UPDATE telephone
                                SET tel_numero=:tel_numero, tel_type=:tel_type, tel_poste=:tel_poste, tel_ctc_id_ce=:tel_ctc_id_ce
                                WHERE tel_ctc_id_ce=:ctc_id"
                    , [ "tel_numero"=> $tel_numero[$i],
                        "tel_type"=> $tel_type[$i], 
                        "tel_poste"=> $tel_poste[$i], 
                        "tel_ctc_id_ce"=> $tel_ctc_id_ce]);
        }
    }
}