// === 1. EDIT MODE ===
$(document).on("click", ".edit-btn", function (e) {
    e.preventDefault();
    

    const row = $(this).closest("tr");
    const id = $(this).data("id");

    if (!id) {
        alert("❌ ID invalide ou manquant");
        return;
    }
    var produit = row.find("td:eq(1) select option:selected").text();
    var unite = row.find("td:eq(2) select option:selected").text();
    var quantite =  row.find("td:eq(3) input[type='number']").val();
    // Remplir le formulaire
   /*
    $("#id_demande_produit").val(id);
    $("#produit").val(row.find("td:eq(0)").text());
    $("#unite").val(row.find("td:eq(1)").text());
    $("#quantite").val(row.find("td:eq(2)").text());
   

    // Afficher le bouton de sauvegarde, masquer le bouton de soumission
    $(".btnSave").removeAttr("hidden");
    $(".add_produit").attr("hidden", true);*/
   

    $.post(
        "../ajax/edit_demande_produit.ajax.php",
        {id: id, produit: produit,unite:unite, quantite: quantite},
        function (response) {
            // ✅ Show success message
            console.log(JSON.parse(response));
            alert(JSON.parse(response).message);
            chercher(); // Refresh the table
           
        }
    );
    
});


