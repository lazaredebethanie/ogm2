$(function() {

        $("#jsGrid").jsGrid({
            height: "auto",
            width: "100%",
            filtering: true,
            inserting: true,
            editing: true,
            sorting: true,
            paging: true,
            autoload: true,
            deleteConfirm: "Voulez-vous vraiment supprimer ce groupe de fournisseurs ?",
            controller: {
                loadData: function(filter) {
                    return $.ajax({
                        type: "GET",
                        url: "../acces/groupesFournisseursIndex.php",
                        data: filter
                    });
                },
                insertItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "../acces/groupesFournisseursIndex.php",
                        data: item
                    });
                },
                updateItem: function(item) {
                    return $.ajax({
                        type: "PUT",
                        url: "../acces/groupesFournisseursIndex.php",
                        data: item
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: "DELETE",
                        url: "../acces/groupesFournisseursIndex.php",
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
                { name: "groupe", title: "Groupes de fournisseurs", type: "text", width: 150 },
                { type: "control" }
            ]
        });

});

