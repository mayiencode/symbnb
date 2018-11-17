$('#add-image').click(function(){

    // Je récupère le numéro des futurs champs que je vais créer
    // le + permet de transformer en nombre le résultat
    const index = +$('#widgets-counter').val();
    
    // Je récupère le prototype des entrées
    const tmpl = $('#ad_images').data('prototype').replace(/__name__/g, index);
    
    
    // J'injecte ce code au sein de la DIV
    $('#ad_images').append(tmpl);
    
    // ajoute un +1 à chaque ajout de champ de formulaire d'ajout d'image
    $('#widgets-counter').val(index + 1);

    handleDeleteButtons();
    
    
    });
    
    // function qui permet de gérer la suppression de l'image
    function handleDeleteButtons() {
    
        $('button[data-action="delete"]').click(function(){
            const target = this.dataset.target;
            $(target).remove();
        });
    }
    
    function updateCounter() {
    
        const count = +$('#ad_images div.form-group').length;
        $('#widgets-counter').val(count);
    
    }
    
    // gestion du button "delete
        handleDeleteButtons();
    // gestion du compteur en cas de modification d'annonce
        updateCounter();