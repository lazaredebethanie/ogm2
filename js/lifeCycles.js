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
            deleteConfirm: "Want you to really delete this life cycle ?",
            controller: {
                loadData: function(filter) {
                    return $.ajax({
                        type: "GET",
                        url: "../calls/lifeCyclesIndex.php",
                        data: filter
                    });
                },
                insertItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "../calls/lifeCyclesIndex.php",
                        data: item
                    });
                },
                updateItem: function(item) {
                    return $.ajax({
                        type: "PUT",
                        url: "../calls/lifeCyclesIndex.php",
                        data: item
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: "DELETE",
                        url: "../calls/lifeCyclesIndex.php",
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
                { name: "state", title: "State", type: "text", width: 150 },
                { name: "rank", title: "Rank", type: "number", width: 20 },
                { type: "control" }
            ]
        });

});

