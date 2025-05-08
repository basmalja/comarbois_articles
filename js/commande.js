$(document).ready(function () {
    chercher();

    $("#btnEnregistrer").click(function (e) {
        e.preventDefault();

        // Get form values
        const id = $("#idDemande").val();
        const idBesoin = $("#idBesoin").val();
        const quantite = $("#quantite").val();
        const produit = $("#produit").val();
        const unite = $("#unite").val();
        const prix_unitaire = $("#prix_unitaire").val();

        console.log(id + idBesoin + produit + unite + quantite + prix_unitaire);

   

        // Check if any products are selected
        if ($("input[name='produits-checked']:checked").length === 0) {
            alert("Veuillez sélectionner au moins un produit");
            return;
        }

        // Validate quantities and mark rows
        let erreur = null;
        $("input[name='produits-checked']:checked").each(function(index, element) {
            $(this).parents('tr').css('background', '#FFFFFF'); // reset background
            let qte = parseFloat($(this).parents('tr').find('td#tdQte input#Uquantite').val());
            let prix = parseFloat($(this).parents('tr').find('td#tdPrix input#Uprix').val());
            if (qte === 0 || isNaN(qte)) {
                $(this).parents('tr').css('background', '#F7C5C5');
                erreur = this;
                return false; // break loop
            }
        });

        // If there was an error, stop the process
        if (erreur) {
            alert("Veuillez corriger les quantités (aucune ne doit être vide ou zéro)");
            return;
        }

        // Process each product individually
        produitsChecked.forEach(function(productId, index) {
            // Prepare data for this specific product
            const postData = {
                idDemande: id,
                idBesoin: idBesoin,
                quantite: quantite,
                produit: produit,
                unite: unite,
                produitsChecked: productId,
                prix_unitaire: prix_unitaire
            };

            console.log("Processing product:", productId);

            $.ajax({
                type: "POST",
                url: "../ajax/insert_commande.ajax.php",
                data: postData,
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        console.log("✅ Product " + productId + " processed: " + response.message);

                        // If this is the last product, show final message and refresh
                        if (index === produitsChecked.length - 1) {
                            alert("Tous les produits ont été traités avec succès");
                            chercher();
                        }
                    } else {
                        console.log("❌ Error with product " + productId + ": " + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.log("Erreur AJAX pour le produit " + productId + ":", xhr.responseText);
                }
            });
        });
    });

    function chercher() {
        const id = $("#idDemande").val();

        $("#lesdonnees")
            .empty()
            .append('<tr><td colspan="9" align="center"><img src="../images/ajax.loader.gif" align="absmiddle"> Chargement</td></tr>')
            .hide()
            .fadeTo(700, 1);

        $.post("../ajax/commande.ajax.php",
            { idDemande: id },
            function(data) {
                $("#lesdonnees").empty().append(data.lignes).hide().fadeIn('slow');
            },
            "json"
        );
    }
});
