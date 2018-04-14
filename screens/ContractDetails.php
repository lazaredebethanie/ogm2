<!DOCTYPE html>

<?php
include "../actions/FournisseursActions.php";
include "../actions/PurchaseTypeActions.php";
include "../actions/FamillesAchatActions.php";
include "../actions/TypesMaintenanceActions.php";
include "../actions/BusinessUnitsActions.php";
include "../actions/PaidByActions.php";

$config = include ("../db/config.php");
$db = new PDO ( $config ["db"], $config ["username"], $config ["password"] );

$suppliers = new FournisseursActions ( $db );
$suppliers_tab = array ();
$suppliers_tab = $suppliers->getAll ( array (
		"nom_usuel" => "",
		"cofor" => "",
		"groupe_id" => "" 
) );

$purchaseFamily = new FamillesAchatActions ( $db );
$purchase_family_tab = array ();
$purchase_family_tab = $purchaseFamily->getAll ( array (
		"code" => "",
		"designation" => "" 
) );

$purchaseType = new PurchaseTypeActions ( $db );
$purchase_type_tab = array ();
$purchase_type_tab = $purchaseType->getAll ( array (
		"type" => "" 
) );

$maintenanceTypes = new TypesMaintenanceActions ( $db );
$maintenance_type_tab = array ();
$maintenance_type_tab = $maintenanceTypes->getAll ( array (
		"type" => "" 
) );

$bu = new BusinessUnitsActions ( $db );
$bu_tab = array ();
$bu_tab = $bu->getAll ( array (
		"acronym" => "",
		"nameBU" => "" 
) );

$paidBy = new PaidByActions ( $db );
$paid_by_tab = array ();
$paid_by_tab = $paidBy->getAll ( array (
		"paidByEntity" => "",
		"longName" => "" 
) );
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Contract Details...</title>
<meta charset="UTF-8">
<link type="text/css" rel="stylesheet" media="all" title="CSS" href="../css/ogm.css" />
<link type="text/css" rel="stylesheet" media="all" title="CSS" href="../css/onglets2.css" />
</head>
<body>
    <div class="onglets_html">
        <DIV class="tabs_panels">
            <DIV class="onglets">
                <DIV class="onglet_y onglet">
                    <a href="../screens/contractDetails.php">Contract Details</a>
                </DIV>
                <DIV class="onglet_n onglet">
                    <a href="../screens/maintenance_lines.html">Maintenance Lines</a>
                </DIV>
            </DIV>
            <DIV class="contenu">
                <H1 id="titlePage"></H1>
                <form id="contractDetails" name="Contract Details" action="contractDetails.php" method="POST" autocomplete="on">
                    <INPUT id="method" name="method" type="hidden"> <INPUT id="id" name="id" type="hidden">
                    <TABLE><TBODY id="body">
                        <TR>
                            <TD>Contract Name</TD>
                            <TD colspan="3"><input id="nameContract" name="name_contract" type="text" size="60"></TD>
                        </TR>
                        <TR>
                            <TD>Reference</TD>
                            <TD><input id="reference name=" reference" type="text"></TD>
                        </TR>
                        <TR>
                            <TD>Supplier</TD>
                            <TD><SELECT id="spplierId" name="supplier_id" size="1" onChange="changeVal(event)">
                                    <OPTION value="0|">
                                        <?php
                                        foreach ( $suppliers_tab as $row ) {
											echo "              <OPTION  value=\"" . $row->id . "|" . $row->cofor . "\">" . $row->nom_usuel . " \n";
										}
										?>
                            </SELECT></TD>
                            <TD>Supplier Code</TD>
                            <TD><input id="supplierCode" name="supplier_code" type="text" disabled></TD>
                        </TR>
                        <TR>
                            <TD>Purchase Family</TD>
                            <TD colspan="3"><SELECT id="purchaseFamilyId name=" purchase_family_id" size="1">
                                    <OPTION value="0"> 
                                        <?php
																foreach ( $purchase_family_tab as $row ) {
																	echo "              <OPTION value=\"" . $row->id . "\">" . $row->code . " - " . $row->designation . " \n";
																}
																?>
                
                            
                            </SELECT></TD>
                        </TR>
                        <TR>
                            <TD>Purchase Type</TD>
                            <TD><SELECT id="purchaseTypeId" name="purchase_type_id" size="1">
                                    <OPTION value="0">
                <?php
																foreach ( $purchase_type_tab as $row ) {
																	echo "				<OPTION  value=\"" . $row->id . "\">" . $row->type . " \n";
																}
																?>
                
                            
                            </SELECT></TD>
                            <TD>Purchase Date</TD>
                            <TD><input id="purchaseDate" name="purchase_date" type="text"></TD>
                        </TR>
                        <TR>
                            <TD>&nbsp;</TD>
                        </TR>
                        <TR>
                            <TD>Maintenance Type</TD>
                            <TD><SELECT id="maintenanceTypeId" name="maintenance_type_id" size="1">
                                    <OPTION value="0"> 
                <?php
																foreach ( $maintenance_type_tab as $row ) {
																	echo "              <OPTION value=\"" . $row->id . "\">" . $row->type . " \n";
																}
																?>
                
                            
                            </SELECT></TD>
                            <TD>Amount</TD>
                            <TD><input id="totalAmount" name="total_amount" type="text" value="0"></TD>
                        </TR>
                        <TR>
                            <TD>Renewal Date</TD>
                            <TD><input id="renewalDate" name="renewal_date" type="text"></TD>
                            <TD>End Date</TD>
                            <TD><input id="endDate" name="end_date" type="text"></TD>
                        </TR>
                        <TR>
                        </TR>
                        <TR>
                            <TD>&nbsp;</TD>
                        </TR>
                        <TR>
                            <TD>Business Unit</TD>
                            <TD><SELECT id="BusinessUnitId" name="business_unit_id" size="1">
                                    <OPTION value="0">
                                        <?php
                                        foreach ($bu_tab as $row) {
                                        	echo "				<OPTION value=\"" . $row->id . "\">" . $row->acronym . " \n";
                                        }
                                        
                                        ?>                          
                            </SELECT></TD>
                            <TD>Paid by</TD>
                            <TD><SELECT id="paidById" name="paid_by_id" size="1">
                                    <OPTION value="0">
                                        <?php
                                        foreach ($paid_by_tab as $row) {
                                        	echo "				<OPTION value=\"" . $row->id . "\">" . $row->paidByEntity . " \n";
                                        }
                                        
                                        ?>
                            </SELECT></TD>
                        </TR>
                        <TR>
                            <TD>Comment</TD>
                            <TD colspan="3"><TEXTAREA id="comments" name="comments" maxlength="255" rows="5" cols="60"></TEXTAREA></TD>
                        </TR>

                    </TBODY></TABLE>
                    <br>
                    <br>
                    <!--  <button id="submit" type="submit">Save</button> -->
                    &nbsp;&nbsp;
                    <button id="reset" type="reset" value="Reset">Reset</button>
                    &nbsp;&nbsp;
                    <button id="close" type="reset" onClick="window.close()">Close</button>
                    <button id="submit2" type="submit">test</button>
                    <DIV id="retour"></div>
                </form>
            </DIV>
            <script >
                function changeVal(event) {
                    var elem=event.target.value.split('|');
                        document.forms[0].supplier_code.value=elem[1];
                }
            </script>
            
            <script src="../jsgrid/jquery-3.2.1.min.js"></script>
            <script type="text/javascript">
            $(document).ready(function(){
                $("#submit2").click(function() {
                    alert("ok");
                    $.ajax({
                        url: "../screens/contractsIndex.php",
                        type: "GET",
                        cache:false,
                        success:function(retour) {
                            alert("retour success !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!");
                        },
                        error:function(XMLHttpRequest,textStatus, errorThrown) {
                            alert("erreur : " + textStatus);
                            
                        }    
                     });

                    alert("fin");
                 });
            });
                    
            </script>
        

</body>
</html>

