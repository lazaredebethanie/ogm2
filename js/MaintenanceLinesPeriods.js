$.ajax({
    type : "GET",
    url : "../select/lifeCyclesSelect.php"
}).done(function(lifeCycles) {

    lifeCycles.unshift({
        id : "",
        state : "",
        rank : ""
    });

    $("#jsGridExistingPeriod").jsGrid({
        height : "auto",
        width : "100%",
        filtering : true,
        inserting : false,
        editing : false,
        sorting : true,
        paging : true,
        autoload : true,
        deleteConfirm : "Voulez-vous vraiment supprimer ce fournisseur ?",
        controller : {
            loadData : function(filter) {
                return $.ajax({
                    type : "GET",
                    url : "../calls/MaintenanceLinesPeriodsIndex.php",
                    data : argSec[0] + "&" + filter // <<<<<<<<<<<<<<<<<<<<<<<<<
                                                    // A MODIFIER
                                                    // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
                });
            },
        /*
         * insertItem: function(item) { return $.ajax({ type: "POST", url:
         * "../calls/fournisseursIndex.php", data: item }); }, updateItem:
         * function(item) { return $.ajax({ type: "PUT", url:
         * "../calls/fournisseursIndex.php", data: item }); }, deleteItem:
         * function(item) { return $.ajax({ type: "DELETE", url:
         * "../calls/fournisseursIndex.php", data: item }); }
         */
        },
        pageSize : 10,
        pageButtonCount : 5,
        pageIndex : 1,

        noDataContent : "No Record Found...",
        loadIndication : true,
        loadIndicationDelay : 500,
        loadMessage : "Please, wait...",
        loadShading : true,
        fields : [ {
            name : "description",
            title : "Description",
            type : "text",
            width : 100
        }, {
            name : "begin",
            title : "Begin",
            type : "text",
            width : 40
        }, {
            name : "end",
            title : "End",
            type : "text",
            width : 40
        }, {
            name : "total_amount",
            title : "Total Amount",
            type : "number",
            width : 40
        }, {
            name : "multi_years",
            title : "Nb yrs",
            type : "number",
            width : 10
        }, {
            name : "life_cycle_state_id",
            title : "State",
            type : "select",
            width : 40,
            items: lifeCycles, 
            valueField: "id", 
            textField: "state" 
        }, {
            name : "comments",
            title : "Comments",
            type : "textarea",
            width : 60
        } /*
             * , { type: "control" }
             */
        ]
    });
});
        

