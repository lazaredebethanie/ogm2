$(document).ready(function() {

        $("#jsGrid").jsGrid({
            height: "auto",
            width: "100%",
            filtering: true,
            inserting: true,
            editing: true,
            sorting: true,
            paging: true,
            autoload: true,
            deleteConfirm: "Want you to really delete this Business Unit ?",
            controller: {
                loadData: function(filter) {
                    return $.ajax({
                        type: "GET",
                        url: "../calls/businessUnitsIndex.php",
                        data: filter
                    });
                },
                insertItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "../calls/businessUnitsIndex.php",
                        data: item
                    });
                },
                updateItem: function(item) {
                    return $.ajax({
                        type: "PUT",
                        url: "../calls/businessUnitsIndex.php",
                        data: item
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: "DELETE",
                        url: "../calls/businessUnitsIndex.php",
                        data: item
                    });
                }
            },
            
            rowClick: function (args) {
                //window.location = "/Reservations/Edit/" + args.item.id + args.item.acronym;
                window.open ("../basic.html"+args.item.id,"popup name","menubar=no, scrollbars=no, top=100, left=100, width=1000, height=600");
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
                { name: "acronym", title: "Acronym", type: "text",width: 70},
                { name: "nameBU", title: "Business Unit", type: "text", width: 200 },
                { type: "control" }
            ]
        });

});

