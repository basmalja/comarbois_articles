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
   
    $("#id_demande_produit").val(id);
    $("#produit").val(row.find("td:eq(0)").text());
    $("#unite").val(row.find("td:eq(1)").text());
    $("#quantite").val(row.find("td:eq(2)").text());
   

    // Afficher le bouton de sauvegarde, masquer le bouton de soumission
    $(".btnSave").removeAttr("hidden");
    $(".add_produit").attr("hidden", true);
   

   
});


// === 2. SAVE MODE ===
$(document).on("click", ".btnSave", function (e) {
    e.preventDefault();

    const id = $("#id_demande_produit").val();

    if (!id) {
        alert("❌ ID manquant pour la mise à jour");
        return;
    }

    const formData = {
        id_demande_produit: id,
        produit: $("#produit").val(),
        unite: $("#unite").val(),
        quantite: $("#quantite").val(),
    };

    $.ajax({
        type: "POST",
        url: "../ajax/edit_demande_produit.ajax.php",
        data: formData,
        dataType: "json",
        success: function (response) {
            if (response.success === true) {
                alert("✅ " + response.message);
                chercher(); // recharge les données
                resetForm(); // Réinitialiser les champs
                $(".btnSave").attr("hidden", true);
                $(".add_produit").removeAttr("hidden");
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
    $("#id_demande_produit").val('');
    $("#produit, #unite, #quantite").val('');
}
