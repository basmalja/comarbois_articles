
$(document).ready(function () {
    chercher();
    if ($("#idbesoin").val() !== "") {

        $("#btnEnregistrer").attr("hidden", true);
    }
    $(".concat").change(function () {
        fournisseur = $("#fournisseur").val()
        categorie = $("#categorie").val(),
            sous_categorie = $("#sous_categorie").val(),
            qualite = $("#qualite").val(),
            largeur = $("#largeur").val(),
            longueur = $("#longueur").val(),
            epaisseur = $("#epaisseur").val(),
            $("#designation").val(fournisseur + " " + categorie + " " + sous_categorie + " " + qualite + " " + largeur + " x " + longueur + " x " + epaisseur)
    })


    $(".btnSoumettre").click(function (e) {
        e.preventDefault(); // Empêche le rechargement de la page
        var formData = {
            idbesoin: $("#idbesoin").val(),
            designation: $("#designation").val(),
            fournisseur: $("#fournisseur").val(),
            categorie: $("#categorie").val(),
            sous_categorie: $("#sous_categorie").val(),
            qualite: $("#qualite").val(),
            largeur: $("#largeur").val(),
            longueur: $("#longueur").val(),
            epaisseur: $("#epaisseur").val(),
            unite: $("#unite").val(),
            quantite: $("#quantite").val()
        };
        if ($("#unite").val() == "" && $("#quantite").val() !== "") {
            alert("❌ " + "Veuillez définir l'unité");
            return; // Prevent further execution if "unite" is empty
        }
        $.ajax({
            type: "POST",
            url: "../ajax/insert_details.ajax.php",
            data: formData,
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    alert("✅ " + response.message);
                    //  location.reload();  Rafraîchir la page après l'insertion
                    // Reset the form fields
                    chercher();
                    $("#fournisseur").val('');
                    $("#categorie").val('');
                    $("#sous_categorie").val('');
                    $("#qualite").val('');
                    $("#largeur").val('');
                    $("#longueur").val('');
                    $("#epaisseur").val('');
                    $("#unite").val('');
                    $("#quantite").val('');
                    $("#designation").val('');
                } else {
                    alert("❌ " + response.message);
                }
            },
            error: function (xhr, status, error) {
                console.log("Erreur AJAX:", xhr.responseText);
            }
        });
    });
    $("#btnTransformer").click(function (e) {
        e.preventDefault();
    
        const idbesoin = $("#idbesoin").val();
    
        if ($("input[name='produits-checked']:checked").length === 0) {
            alert("❌ Veuillez sélectionner au moins une ligne.");
            return;
        }
    
        let besoin_details = [];
    
        $("input[name='produits-checked']:checked").each(function () {
            besoin_details.push($(this).val());
        });
    
        $.post(
            "../ajax/transform_besoin.ajax.php",
            { idbesoin: idbesoin, besoin_details: besoin_details },
            function (response) {
                // ✅ Show success message
                alert("✅ Transformation effectuée avec succès !");
                chercher(); // Refresh the table
                window.location.href = "demande_list.php";
            }
        ).fail(function (xhr, status, error) {
            // ❌ Optional: alert in case of error
            alert("❌ Une erreur s'est produite lors de la transformation.");
            console.log(xhr.responseText);
        });
    });
    

function chercher() {
    id = $("#idbesoin").val();

    $("#lesdonnees").empty().append('<tr><td colspan="9" align="center"><img src="../images/ajax.loader.gif" align="absmiddle" > Chargement</td></tr>').hide().fadeTo(700, 1);
    $.post("../ajax/list_details.ajax.php",
        { idBesoin: id },
        function (data) {
            //alert(data.lignes);
            $("#lesdonnees").empty().append(data.lignes).hide().fadeIn('slow');
        }, "json");
}

})