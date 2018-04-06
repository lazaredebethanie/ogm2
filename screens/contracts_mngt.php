<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    
    <link href="../jsgrid/css/jsgrid-theme.min.css" rel="stylesheet" />
    <link href="../jsgrid/css/jsgrid.min.css" rel="stylesheet" /> <!-- -->
    
    <link href="../css/style.css" rel="stylesheet" /> <!-- -->
    
     
    <title>Maintenance Contracts management - Gestion des Contrats de Maintenance</title>

    <style>
        .ui-widget *, .ui-widget input, .ui-widget select, .ui-widget button {
            font-family: 'Helvetica Neue Light', 'Open Sans', Helvetica;
            font-size: 14px;
            font-weight: 300 !important;
        }

        .details-form-field input,
        .details-form-field select {
            width: 250px;
            float: right;
        }

        .details-form-field {
            margin: 20px 0;
        }

        .details-form-field:first-child {
            margin-top: 8px;
        }

        .details-form-field:last-child {
            margin-bottom: 8px;
        }

        .details-form-field button {
            display: block;
            width: 100px;
            margin: 0 auto;
        }

        input.error, select.error {
            border: 1px solid #ff9999;
            background: #ffeeee;
        }

        label.error {
            float: right;
            margin-left: 100px;
            font-size: .8em;
            color: #ff6666;
        }
    </style>
</head>
<body>
<header>
    <h1>Maintenance Contracts management - Gestion des Contrats de Maintenance</h1>
</header>

<div id="jsGrid"></div>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.2/themes/cupertino/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <script src="../jsgrid/src/jsgrid.core.js"></script>
    <script src="../jsgrid/src/jsgrid.load-indicator.js"></script>
    <script src="../jsgrid/src/jsgrid.load-strategies.js"></script>
    <script src="../jsgrid/src/jsgrid.sort-strategies.js"></script>
    <script src="../jsgrid/src/jsgrid.field.js"></script>
    <script src="../jsgrid/src/fields/jsgrid.field.text.js"></script>
    <script src="../jsgrid/src/fields/jsgrid.field.number.js"></script>
    <script src="../jsgrid/src/fields/jsgrid.field.select.js"></script>
    <script src="../jsgrid/src/fields/jsgrid.field.checkbox.js"></script>
    <script src="../jsgrid/src/fields/jsgrid.field.control.js"></script>





<!--   <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script> 
<script src="../jsgrid/jquery-3.2.1.min.js"></script>
<script src="../jsgrid/jsgrid.min.js"></script> -->

    <div id="detailsDialog">
        <form id="detailsForm">
            <div class="details-form-field">
                <label for="name_contract">Name :</label>
                <input id="name_contract" name="name_contract" type="text" />
            </div>
            <div class="details-form-field">
                <label for="reference">Reference:</label>
                <input id="reference" name="reference" type="text" value='sans'/>
            </div>
            <?php include('../select/fournisseursFormSelect.php'); ?>
            <?php include('../select/purchaseTypeFormSelect.php'); ?>
            <?php include('../select/maintenanceTypeFormSelect.php'); ?>
            <div class="details-form-field">
                <label for="renewal_date">Renewal Date :</label>
                <input id="renewal_date" name="renewal_date" type="date" />
            </div>
            <div class="details-form-field">
                <label for="total_amount">Total Amount :</label>
                <input id="total_amount" name="total_amount" type="number" />
            </div>
            <?php include('../select/businessUnitsFormSelect.php'); ?>
            <?php include('../select/paidbyFormSelect.php'); ?>
            <div class="details-form-field">
                <button type="submit" id="save">Save</button>
            </div>
        </form>
    </div>

<script src="../js/contracts.js"></script>
</body>
</html>