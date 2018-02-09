$(function() {
   
	$.ajax({
        type: "GET",
        url: "../select/groupesFournisseursSelect.php"
    }).done(function(groupesFournisseurs) {

    	groupesFournisseurs.unshift({ id: "", groupe: "" });
    	
        $("#jsGrid").jsGrid({
            height: "auto",
            width: "100%",
            filtering: true,
            inserting: true,
            editing: true,
            sorting: true,
            paging: true,
            autoload: true,
            deleteConfirm: "Voulez-vous vraiment supprimer ce fournisseur ?",
            controller: {
                loadData: function(filter) {
                    return $.ajax({
                        type: "GET",
                        url: "../screens/fournisseursIndex.php",
                        data: filter
                    });
                },
                insertItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "../screens/fournisseursIndex.php",
                        data: item
                    });
                },
                updateItem: function(item) {
                    return $.ajax({
                        type: "PUT",
                        url: "../screens/fournisseursIndex.php",
                        data: item
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: "DELETE",
                        url: "../screens/fournisseursIndex.php",
                        data: item
                    });
                }
            },
            pageSize: 10,
            pageButtonCount: 5,
            pageIndex: 1,

            noDataContent: "No Record Found",
            loadIndication: true,
            loadIndicationDelay: 500,
            loadMessage: "Please, wait...",
            loadShading: true,
            fields: [
                { name: "nom_usuel", title: "Nom de l'entreprise", type: "text", width: 150 },
                { name: "cofor", title: "Code fournisseur", type: "text", width: 200 },
                { name: "groupe_id", title: "Groupe fournisseur", type: "select", width: 100, items: groupesFournisseurs, valueField: "id", textField: "groupe" },
                /*{ name: "groupe_id", title: "Groupe ID", type: "text", width: 20 },*/
                { type: "control" }
            ]
        });

    })    
        
});

