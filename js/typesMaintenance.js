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
            deleteConfirm: "Voulez-vous vraiment supprimer ce type de maintenance ?",
            controller: {
                loadData: function(filter) {
                    return $.ajax({
                        type: "GET",
                        url: "../screens/typesMaintenanceIndex.php",
                        data: filter
                    });
                },
                insertItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "../screens/typesMaintenanceIndex.php",
                        data: item
                    });
                },
                updateItem: function(item) {
                    return $.ajax({
                        type: "PUT",
                        url: "../screens/typesMaintenanceIndex.php",
                        data: item
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: "DELETE",
                        url: "../screens/typesMaintenanceIndex.php",
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
                { name: "type", title: "Type de maintenance", type: "text", width: 150 },
                { type: "control" }
            ]
        });

});

