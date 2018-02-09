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
                        url: "../screens/groupesFournisseursIndex.php",
                        data: filter
                    });
                },
                insertItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "../screens/groupesFournisseursIndex.php",
                        data: item
                    });
                },
                updateItem: function(item) {
                    return $.ajax({
                        type: "PUT",
                        url: "../screens/groupesFournisseursIndex.php",
                        data: item
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: "DELETE",
                        url: "../screens/groupesFournisseursIndex.php",
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

