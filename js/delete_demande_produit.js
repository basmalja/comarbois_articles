
$(document).on("click", ".delete-btn", function (e) {
    e.preventDefault();
    chercher();

    console.log("test")
    var row = $(this).closest("tr");
    var id = $(this).data("id");
    console.log(id)
    if (!id) {
        alert("ID non trouvé !");
        return;
    }

    if (confirm("Voulez-vous vraiment supprimer cette ligne !!!?")) {
        $.ajax({
            url: "../ajax/delete_demande_produit.ajax.php", // Fichier PHP de suppression
            type: "POST",
           
            data: { id_demande_produit: id },
             dataType: "json",
            success: function (response) {
                if (response.success === true) {
                    alert("✅ " + response.message);
                    chercher(); // recharge les données
                 
                   
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr) {
                console.error("Erreur AJAX:", xhr.responseText);
            }
        });
    }
});
function chercher(){
    id=$("#idDemande").val();
    
    $("#lesdonnees").empty().append('<tr><td colspan="9" align="center"><img src="../images/ajax.loader.gif" align="absmiddle" > Chargement</td></tr>').hide().fadeTo(700,1);
    $.post("../ajax/list_demande_produit.ajax.php",
    { idDemande :id},
    function(data){
        //alert(data.lignes);
        $("#lesdonnees").empty().append(data.lignes).hide().fadeIn('slow');
    },"json");
}

