function selectedLineGrid(period_id, total_amount) {

        $("#jsGridSelectedLine").jsGrid({
            height: "auto",
            width: "30%",
            filtering: false,
            inserting: true,
            editing: true,
            sorting: true,
            paging: true,
            autoload: true,
            //deleteConfirm: "Want you to really delete this Business Unit ?",
            controller: {
                loadData: function() {
                    return $.ajax({
                        type: "GET",
                        url: "../calls/budgetYearsIndex.php",
                        data: "period_id="+period_id
                    });
                },
                insertItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "../calls/budgetYearsIndex.php",
                        data: item
                    });
                },
                updateItem: function(item) {
                    return $.ajax({
                        type: "PUT",
                        url: "../calls/budgetYearsIndex.php",
                        data: item
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: "DELETE",
                        url: "../calls/budgetYearsIndex.php",
                        data: item
                    });
                }
            },
            
            onDataLoaded: function (args) {
              var total_distribution=0;
               //alert(args.data[0].amount);
               for (var row in args.data) {
                   total_distribution=total_distribution+parseFloat(args.data[row].amount)
               }
               //alert(total_amount);
               if (total_distribution != total_amount) {
                   //alert("The total amount of the budget distribution is different from the total amount recorded for this line. ");
                   $("#amount_distribution").val(total_distribution);
                   $("#amountDialog").dialog("open");
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
                { name: "year", title: "Year", type: "text",width: 50},
                { name: "amount", title: "Amount", type: "number", width: 100 },
                { type: "control" }
            ]
        });

};

