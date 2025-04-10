
$(document).ready(function () {
    chercher();
   
    
    $(".btnSoumettre").click(function (e) {
        e.preventDefault(); // Empêche le rechargement de la page
        var formData = {
            produit: $("#produit").val(),
            unite: $("#unite").val(),
            quantite: $("#quantite").val()
        };
        if ($( "#unite").val() == "" &&  $("#quantite").val()!== "") {
            alert("❌ " + "Veuillez définir l'unité");
            return; // Prevent further execution if "unite" is empty
        }
        $.ajax({
            type: "POST",
            url: "../ajax/insert_demande_produit.ajax.php",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    alert("✅ " + response.message);
                    //  location.reload();  Rafraîchir la page après l'insertion
                     // Reset the form fields
                    chercher();
                     $("#produit").val('');
                     $("#unite").val('');
                     $("#quantite").val('');
                  
                } else {
                    alert("❌ " + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.log("Erreur AJAX:", xhr.responseText);
            }
        });
    });
});
function chercher(){
    id=$("#idbesoin").val();
    
    $("#lesdonnees").empty().append('<tr><td colspan="9" align="center"><img src="../images/ajax.loader.gif" align="absmiddle" > Chargement</td></tr>').hide().fadeTo(700,1);
    $.post("../ajax/list_details.ajax.php",
    { idBesoin :id},
    function(data){
        //alert(data.lignes);
        $("#lesdonnees").empty().append(data.lignes).hide().fadeIn('slow');
    },"json");
}

    
   