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
                            //inserting: true,
                            editing: true,
                            sorting: true,
                            paging: true,
                            autoload: true,
                            deleteConfirm: "Want you to really delete this contract form ?",
                            controller: {
                                loadData: function(filter) {
                                    return $.ajax({
                                        type: "GET",
                                        url: "../calls/contractsIndex.php",
                                        data: filter
                                    });
                                },
                                insertItem: function(item) {
                                    return $.ajax({
                                        type: "POST",
                                        url: "../calls/contractsIndex.php",
                                        data: item
                                    });
                                },
                                updateItem: function(item) {
                                    return $.ajax({
                                        type: "PUT",
                                        url: "../calls/contractsIndex.php",
                                        data: item
                                    });
                                },
                                deleteItem: function(item) {
                                    return $.ajax({
                                        type: "DELETE",
                                        url: "../calls/contractsIndex.php",
                                        data: item
                                    });
                                }
                            },

                            rowClick: function (args) {
                                //window.location = "/Reservations/Edit/" + args.item.id + args.item.acronym;
                                var w=900;
                                var h=500;
                                var urlDet="contractDetails.html?id="+args.item.id
                                var title="Contract Details";
                                var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
                                var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

                                var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
                                var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

                                var left = ((width / 2) - (w / 2)) + dualScreenLeft;
                                var top = ((height / 2) - (h / 2)) + dualScreenTop;
                                var newWindow = window.open(urlDet, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
                                /*if (window.focus) {
                                    newWindow.focus();*/
                            

                                //window.open ("contractDetails.html?id="+args.item.id,"popup name","menubar=no, scrollbars=no, top=100, left=100, width=1000, height=600");

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
                                { name: "supplier_id", title: "Supplier", type: "select", width: 100, items: fournisseurs, valueField: "id", textField: "nom_usuel" },
                                { name: "purchase_type_id", title: "Purchase Type", type: "select", width: 50, items: purchaseType, valueField: "id", textField: "type" },
                                { name: "maintenance_type_id", title: "Maintenance Type", type: "select", width: 60, items: maintenanceType, valueField: "id", textField: "type" },
                                { name: "renewal_date", title: "Next Renewal Date", type: "text", width: 50 },
                                { name: "total_amount", title: "Total Amount", type: "text", width: 70, align: "right"},
                                { name: "business_unit_id", title: "B.U.", type: "select", width: 30, items: businessUnits, valueField: "id", textField: "acronym" },
                                { name: "paid_by_id", title: "Paid by...", type: "select", width: 30, items: paidBy, valueField: "id", textField: "paidByEntity" },


                                { type: "control",
                                    modeSwitchButton: false,
                                    editButton: false,
                                    headerTemplate: function() {
                                        return $("<button>").attr("type", "button").text("Add")
                                            .on("click", function () {
                                                showDetailsDialog("Add", {});
                                            });
                                    }
                                }                             
                            ]
                        }); // end of $("#jsGrid").jsGrid({
                        
                        
                        
                        

                    }) // end of (function(paidBy) {   

                }) // end of (function(businessUnits) {

            })// end of (function(maintenanceType) {

        })// end of (function(purchaseType) {

    }) // end of (function(fournisseurs) {

    $("#detailsDialog").dialog({
        autoOpen: false,
        width: 500,
        close: function() {
            $("#detailsForm").validate().resetForm();
            $("#detailsForm").find(".error").removeClass("error");
        }
    });

    $("#detailsForm").validate({
        rules: {
            name_contract: "required",
            //reference: "required",
            supplier_id: "required",
            purchase_type_id: "required",
            maintenance_type_id: "required",
            renewal_date: "required",
            business_unit_id: "required",
            paid_by_id: "required"
        },
        messages: {
            name_contract: "Please enter a name",
            //reference: "Please enter a reference",
            supplier_id: "Please select supplier",
            purchase_type_id: "Please select a purchase type",
            maintenance_type_id: "Please select a maintenance type",
            renewal_date: "Please select a renewal date",
            //business_unit_id: "Please select a B.U.",
            //paid_by_id: "Please select the entity who pay this maintenance"
        },
        submitHandler: function() {
            formSubmitHandler();
        }
    });

    var formSubmitHandler = $.noop;

    var showDetailsDialog = function(dialogType, contract) {
        $("#name_contract").val(contract.name_contract);
        $("#reference").val(contract.reference);
        $("#supplier_id").val(contract.supplier_id);
        $("#purchase_type_id").val(contract.purchase_type_id);
        $("#maintenance_type_id").val(contract.maintenance_type_id);
        $("#renewal_date").val(contract.renewal_date);
        $("#total_amount").val(contract.renewal_date);
        $("#business_unit_id").val(contract.total_amount);
        $("#paid_by_id").val(contract.paid_by_id);
        $("#comments").val(contract.comments);

        formSubmitHandler = function() {
            saveContract(contract, dialogType === "Add");
        };

        $("#detailsDialog").dialog("option", "title", dialogType + " Contract")
            .dialog("open");
    };

    var saveContract = function(contract, isNew) {
        $.extend(contract, {
            name_contract: $("#name_contract").val(),
            reference: $("#reference").val(),
            supplier_id: $("#supplier_id").val(),
            purchase_type_id: $("#purchase_type_id").val(),
            maintenance_type_id: $("#maintenance_type_id").val(),
            renewal_date: $("#renewal_date").val(),
            total_amount: $("#total_amount").val(),
            business_unit_id: $("#business_unit_id").val(),
            paid_by_id: $("#paid_by_id").val(),
            comments: $("#comments").val()
        });

        $("#jsGrid").jsGrid(isNew ? "insertItem" : "updateItem", contract);

        $("#detailsDialog").dialog("close");
    };

});

