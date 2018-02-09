$(function() {

    $.ajax({
        type: "GET",
        url: "../select/fournisseursSelect.php"
    }).done(function(fournisseurs) {

        fournisseurs.unshift({ id: "", nom_usuel: "" , cofor: "", groupe_id: ""});

        $.ajax({
            type: "GET",
            url: "../select/purchaseTypeSelect.php"
        }).done(function(purchaseType) {

            purchaseType.unshift({ id: "", type: ""});

            $.ajax({
                type: "GET",
                url: "../select/maintenanceTypeSelect.php"
            }).done(function(maintenanceType) {

                maintenanceType.unshift({ id: "", type: ""});

                $.ajax({
                    type: "GET",
                    url: "../select/businessUnitsSelect.php"
                }).done(function(businessUnits) {

                    businessUnits.unshift({ id: "", acronym: "", nameBU: ""});

                   $.ajax({
                        type: "GET",
                        url: "../select/paidBySelect.php"
                    }).done(function(paidBy) {

                        paidBy.unshift({ id: "", paidByEntity: "", longName: ""});

                        $("#jsGrid").jsGrid({
                            height: "auto",
                            width: "100%",
                            filtering: true,
                            inserting: true,
                            editing: true,
                            sorting: true,
                            paging: true,
                            autoload: true,
                            deleteConfirm: "Want you to really delete this contract form ?",
                            controller: {
                                loadData: function(filter) {
                                    return $.ajax({
                                        type: "GET",
                                        url: "../screens/contractsIndex.php",
                                        data: filter
                                    });
                                },
                                insertItem: function(item) {
                                    return $.ajax({
                                        type: "POST",
                                        url: "../screens/contractsIndex.php",
                                        data: item
                                    });
                                },
                                updateItem: function(item) {
                                    return $.ajax({
                                        type: "PUT",
                                        url: "../screens/contractsIndex.php",
                                        data: item
                                    });
                                },
                                deleteItem: function(item) {
                                    return $.ajax({
                                        type: "DELETE",
                                        url: "../screens/contractsIndex.php",
                                        data: item
                                    });
                                }
                            },

                            rowClick: function (args) {
                                //window.location = "/Reservations/Edit/" + args.item.id + args.item.acronym;
                                window.open ("../basic.html&id="+args.item.id,"popup name","menubar=no, scrollbars=no, top=100, left=100, width=1000, height=600");
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
                                { name: "name_contract", title: "Name of contract", type: "text",width: 150},
                                { name: "reference", title: "Reference", type: "text", width: 30 },
                                //{ name: "supplier_id", title: "Supplier", type: "text", width: 70 },
                                { name: "supplier_id", title: "Supplier", type: "select", width: 100, items: fournisseurs, valueField: "id", textField: "nom_usuel" },
                                //{ name: "purchase_type_id", title: "Purchase Type", type: "text", width: 50 },
                                { name: "purchase_type_id", title: "Purchase Type", type: "select", width: 50, items: purchaseType, valueField: "id", textField: "type" },
                                //{ name: "maintenance_type_id", title: "Maintenance Type", type: "text", width: 50 },
                                { name: "maintenance_type_id", title: "Maintenance Type", type: "select", width: 60, items: maintenanceType, valueField: "id", textField: "type" },
                                { name: "purchase_date", title: "Purchase Date", type: "text", width: 50 },
                                { name: "renewal_date", title: "Renewal Date", type: "text", width: 50 },
                                //{ name: "business_unit_id", title: "B.U.", type: "text", width: 20},
                                { name: "business_unit_id", title: "B.U.", type: "select", width: 30, items: businessUnits, valueField: "id", textField: "acronym" },
                                //{ name: "paid_by_id", title: "Paid by...", type: "text", width: 30 },
                                { name: "paid_by_id", title: "Paid by...", type: "select", width: 30, items: paidBy, valueField: "id", textField: "paidByEntity" },
                                { name: "comments", title: "Comments", type: "text", width: 100 },


                                { type: "control" }
                                ]
                        });

                    })    

                })

            })
        })

    })

});

