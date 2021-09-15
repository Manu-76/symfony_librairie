// On vérifie s'il y a des boutons d'ajout en favoris dans le DOM
if($(".bt-favori").length >0){
    // On leur ajoute un écouteur d'évènement sur le click à l'aide de la méthode JQuery on(évènement, callback)
    $(".bt-favori").on("click", function(event){
        event.preventDefault();
        event.stopPropagation();
        var bt = $(this);
        var livreId = $(this).attr("data-livreid"); // $(this) fait référence au bouton ayant déclencher l'évènement
        // console.log("livreid ?", livreId); // attr est la récupération de l'attribut
        $.ajax({
            url: '/profile/addfavori',
            type: 'post',
            data: "id="+livreId 
        }).done(function(response){
                $(bt).hide();
        }).fail(function(error){
            console.log("ajax error :", error);
        })
    });
}