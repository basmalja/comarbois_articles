
$(document).on("click", ".delete-btn", function (e) {
    e.preventDefault();
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
            url: "../ajax/delete_details.ajax.php", // Fichier PHP de suppression
            type: "POST",
           
            data: { id_detail: id },
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

