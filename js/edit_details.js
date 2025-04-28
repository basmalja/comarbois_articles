
// === 1. EDIT MODE ===
$(document).on("click", ".edit-btn", function (e) {
    e.preventDefault();

    const row = $(this).closest("tr");
    const id = $(this).data("id");

    if (!id) {
        alert("❌ ID invalide ou manquant");
        return;
    }

    // Remplir le formulaire
    $("#id_detail").val(id);
    $("#fournisseur").val(row.find("td:eq(0)").text());
    $("#categorie").val(row.find("td:eq(1)").text());
    $("#sous_categorie").val(row.find("td:eq(2)").text());
    $("#qualite").val(row.find("td:eq(3)").text());
    $("#longueur").val(row.find("td:eq(4)").text());
    $("#largeur").val(row.find("td:eq(5)").text());
    $("#epaisseur").val(row.find("td:eq(6)").text());
    $("#unite").val(row.find("td:eq(7)").text());
    $("#quantite").val(row.find("td:eq(8)").text());
    $("#designation").val(row.find("td:eq(9)").text());

    // Afficher le bouton de sauvegarde, masquer le bouton de soumission
    $(".btnSave").removeAttr("hidden");
    $(".btnSoumettre").attr("hidden", true);
  

   
});


// === 2. SAVE MODE ===
$(document).on("click", ".btnSave", function (e) {
    e.preventDefault();

    const id = $("#id_detail").val();

    if (!id) {
        alert("❌ ID manquant pour la mise à jour");
        return;
    }

    const formData = {
        id_detail: id,
        fournisseur: $("#fournisseur").val(),
        categorie: $("#categorie").val(),
        sous_categorie: $("#sous_categorie").val(),
        qualite: $("#qualite").val(),
        largeur: $("#largeur").val(),
        longueur: $("#longueur").val(),
        epaisseur: $("#epaisseur").val(),
        unite: $("#unite").val(),
        quantite: $("#quantite").val(),
        designation: $("#designation").val()
    };

    $.ajax({
        type: "POST",
        url: "../ajax/edit_details.ajax.php",
        data: formData,
        dataType: "json",
        success: function (response) {
            if (response.success === true) {
                alert("✅ " + response.message);
                chercher(); // recharge les données
                resetForm(); // Réinitialiser les champs
                $(".btnSave").attr("hidden", true);
                $(".btnSoumettre").removeAttr("hidden");
            } else {
                alert(response.message);
            }
        },
        error: function (xhr) {
            console.error("Erreur AJAX:", xhr.responseText);
        }
    });
});


// === 3. RESET FONCTION ===
function resetForm() {
    $("#id_detail").val('');
    $("#fournisseur, #categorie, #sous_categorie, #qualite, #largeur, #longueur, #epaisseur, #unite, #quantite, #designation").val('');
}
