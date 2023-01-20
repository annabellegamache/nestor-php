
(function () {

   
    let bntAjouter = document.querySelector('.ajout_numero');
    let divNum = document.querySelector('.add-info2');
    let inputsForm = document.querySelectorAll('form.contact > * > *:not(.action)');
    
    
    /**
     * Gestion évènement clique sur le bouton ajouter un numéro
     */
    bntAjouter.addEventListener('click', function(e) {
        e.preventDefault();  
    
        let domAjoutNum = ` <span class="numero-group">
                            <label for="tel_numero">Numéro
                                <input type="text" name="tel_numero[]" value="" placeholder="Numéro">
                            </label>

                            <label for="tel_poste">Poste
                                <input type="text" name="tel_poste[]" value="" placeholder="Poste">
                            </label>

                            <label for="tel_select">Type
                                <select class="tel_select" name="tel_type[]">
                                    <option value="Bureau" selected>Bureau</option>
                                    <option value="Cellulaire" >Cellulaire</option>
                                    <option value="Domicile" >Domicile</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </label>
                        </span> `;
       
        divNum.insertAdjacentHTML('beforeend', domAjoutNum);
    
    });

    /**
     * Gestion évènement change sur element du formulaire contact
     */
    for (let i = 0; i < inputsForm.length; i++) {
        inputsForm[i].addEventListener('change', function(){
            let elParent = inputsForm[i].parentElement.parentElement;
            let btnChange = elParent.querySelector('span.action button.update');
            btnChange.classList.add('goUpdate')
        });
        
    }
})();
    
       
    