

$(document).ready(function () {
    chercher();
    
    if ($("#idDemande").val() !== "") {
        $(".add_demande").attr("hidden", true);
    }
    $(".add_demande").click(function (e) {
        e.preventDefault();
        chercher();
        // hide the button after click
        $("#add_demande").attr("hidden", true);
        const formData = {
            idDemande: $('#idDemande').val(),
            idBesoin :$('#idBesoin').val(),
            date: $('#date').val().trim(),
            origine: $('#origine').val().trim(),
            client: $('#client').val().trim(),
        };

        // Check if all three fields are empty
        if (!formData.date || !formData.origine) {
            alert("❌ Please fill in all fields.");
            return; // Stop execution if validation fails

        }
        if (formData.origine === "vente" && !formData.client) {
            alert("❌ Veuillez définir le client");
            return; // Prevent further execution if "client" is empty
        }

        $.ajax({
            type: "POST",
            url: "../ajax/insert_demande.ajax.php",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    alert("✅ " + response.message);
                    $("#idDemande").val(response.idDemande);
                    chercher();
                } else {
                    alert("❌ " + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.log("Erreur AJAX:", xhr.responseText);
            }
        });
    });

    $(".add_produit").click(function (e) {
        e.preventDefault(); // Empêche le rechargement de la page
        var formData = {
            idDemande: $("#idDemande").val(),
          
            produit: $("#produit").val(),
            unite: $("#unite").val(),
            quantite: $("#quantite").val()
        };
        // Check if all three fields are empty
        if (!formData.produit || !formData.unite || !formData.quantite) {
            alert("❌ Veuillez remplir tous les champs.");
            return; // Stop execution if validation fails
        }
        if ($("#unite").val() == "" && $("#quantite").val() !== "") {
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
function chercher() {
    id = $("#idDemande").val();

    $("#lesdonnees").empty().append('<tr><td colspan="9" align="center"><img src="../images/ajax.loader.gif" align="absmiddle" > Chargement</td></tr>').hide().fadeTo(700, 1);
    $.post("../ajax/list_demande_produit.ajax.php",
        { idDemande: id },
        function (data) {
            //alert(data.lignes);
            $("#lesdonnees").empty().append(data.lignes).hide().fadeIn('slow');
        }, "json");
}

