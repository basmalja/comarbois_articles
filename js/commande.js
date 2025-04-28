$(document).ready(function () {
    chercher();
        // Gestion du clic sur le bouton Exporter
        $("#Exporter").click(function(e) {
            e.preventDefault();
            
            // Récupération des données
            const commandeData = {
                idBesoin : $("#idBesoin").val(),
                idDemande: $("#idDemande").val(),
                date: $("#date").val(),
                origine: $("#origine").val(),
                client: $("#client").val(),
                produits: []
            };
    
            // Validation
            if (!commandeData.idDemande || !commandeData.date || !commandeData.origine) {
                alert("❌ Tous les champs obligatoires doivent être remplis");
                return;
            }
    
            // Récupération des produits
            $("#lesdonnees tr").each(function() {
                const cells = $(this).find("td");
                if (cells.length >= 4) {
                    commandeData.produits.push({
                        produit: cells.eq(1).text().trim(),
                        unite: cells.eq(2).text().trim(),
                        quantite: cells.eq(3).text().trim(),
                        prix: cells.length > 4 ? cells.eq(4).text().trim() : "0"
                    });
                }
            });
    
            if (commandeData.produits.length === 0) {
                alert("❌ Aucun produit à exporter");
                return;
            }
    
            // Envoi des données
            $.ajax({
                type: "POST",
                url: "../ajax/save_commande.php",
                data: { data: JSON.stringify(commandeData) },
                success: function(response) {
                    if (response.success) {
                        // Génération du PDF
                        window.open(`../pdf/generate_pdf.php?id=${response.id}`, '_blank');
                    } else {
                        alert("❌ Erreur: " + response.message);
                    }
                },
                error: function(xhr) {
                    alert("❌ Erreur serveur: " + xhr.responseText);
                }
            });
        });
    });

function chercher() {
    id = $("#idDemande").val();

    $("#lesdonnees").empty().append('<tr><td colspan="9" align="center"><img src="../images/ajax.loader.gif" align="absmiddle" > Chargement</td></tr>').hide().fadeTo(700, 1);
    $.post("../ajax/commande.ajax.php",
        { idDemande: id },
        function (data) {
            //alert(data.lignes);
            $("#lesdonnees").empty().append(data.lignes).hide().fadeIn('slow');
        }, "json");
}
