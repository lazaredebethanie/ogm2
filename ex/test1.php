<?php
include('/fonction.php');
con_bd();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
#apDiv1 {
position:absolute;
width:607px;
height:426px;
z-index:1;
left: 199px;
top: 19px;
}
#apDiv2 {
position:absolute;
width:607px;
height:177px;
z-index:2;
left: 203px;
top: 475px;
}
-->
</style>
<script language='javascript'>
function gopage(page) 
{
document.frm_indv.action=page;
document.frm_indv.submit();
}
</script>
</head>
<body>
<form  name="frm_indv" method="post" action="requete/req_insert_individu.php">
<div id="apDiv1">
  <table width="609" height="181" border="1">
    <tr>
      <td width="242" height="45" bgcolor="#669966"><div align="center">NOM</div></td>
      <td width="523"><label>
        <div align="center">
          <input type="text" name="txt_lbl_nom" id="textfield" align="center" />
        </div>
      </label></td>
    </tr>
    <tr>
      <td width="242" height="45" bgcolor="#669966"><div align="center">PRèNOM</div></td>
      <td width="523"><label>
        <div align="center">
          <input type="text" name="txt_lbl_prenm" id="textfield" align="center" />
        </div>
      </label></td>
    </tr>
    <tr>
      <td width="242" height="45" bgcolor="#669966"><div align="center">TEL</div></td>
      <td width="523"><label>
        <div align="center">
          <input type="text" name="txt_lbl_tel" id="textfield" align="center" />
        </div>
      </label></td>
    </tr>
    <tr>
      <td width="242" height="45" bgcolor="#669966"><div align="center">CIN</div></td>
      <td width="523"><label>
        <div align="center">
          <input type="text" name="txt_lbl_cin" id="textfield" align="center" />
        </div>
      </label></td>
    </tr>
    <tr>
      <th width="193" height="57" bordercolor="#669900" bgcolor="#0099FF" scope="col">QUALITE INDIVIDU :</th>
      <th width="400"><select name="v_id_qlt_indv"  style="width:180px" onchange="gopage('individu.php')">
        <option value="">---Sélectionner QUALITE INDIVIDU---</option>
        <?php
$req="select * from qualite_individu";
$resultat=mysql_query($req);
         //traverser et recuperer de la linge
         while ($ligne=mysql_fetch_array($resultat))
         //affichage de id est cachee et libelle
                {//selection de id et libelle
      if($_POST['v_id_qlt_indv']==$ligne['id_qlte'])
      {
        $sauvegarder_id='selected';
      }
      else
      {
        $sauvegarder_id='';
      }
   echo '<option value='.$ligne['id_qlte'].'  '.$sauvegarder_id.'>  '.$ligne['libelle_qlte'].'   </option>';  
           }
?>
      </select></th>
    </tr>
    <tr>
      <th height="57" bordercolor="#669900" bgcolor="#339999" scope="col">SERVICE :</th>
      <th scope="col"> <select name="v_id_serv"  style="width:180px" onchange="gopage('individu.php')">
          <option value="">---Sélectionner SERVICE---</option>
         <?php
$req="select * from service";
$resultat=mysql_query($req);
         //traverser et recuperer de la linge
         while ($ligne=mysql_fetch_array($resultat))
         //affichage de id est cachee et libelle
                {//selection de id et libelle
      if($_POST['v_id_serv']==$ligne['id_serv'])
      {
        $sauvegarder_id='selected';
      }
      else
      {
        $sauvegarder_id='';
      }
   echo '<option value='.$ligne['id_serv'].'  '.$sauvegarder_id.'>  '.$ligne['lbl_serv'].'   </option>';  
           }
        ?>
        </select>      </th>
    </tr>
    <tr>
      <th width="193" height="57" bordercolor="#669900" bgcolor="#669933" scope="col"> MODELE :</th>
      <th width="400">
       <select name="v_id_mod"  style="width:180px" onchange="gopage('individu.php')">
         <option value="">---Sélectionner MODELE---</option>
         <?php
$req="select * from modele";
$resultat=mysql_query($req);
         //traverser et recuperer de la linge
         while ($ligne=mysql_fetch_array($resultat))
         //affichage de id est cachee et libelle
                {//selection de id et libelle
      if($_POST['v_id_mod']==$ligne['id_mod'])
      {
        $sauvegarder_id='selected';
      }
      else
      {
        $sauvegarder_id='';
      }
   echo '<option value='.$ligne['id_mod'].'  '.$sauvegarder_id.'>  '.$ligne['libelle_mod'].'   </option>';  
           }
        ?>
        </select>      </th>
    </tr>
  </table>
  <table width="188" height="49" border="1" align="center" bgcolor="#669966">
    <tr>
      <th width="81" scope="col"><input type="submit" name="btn_ajt_indiv"  value="Ajouter"/></th>
      <th width="91" scope="col"><a href="index.php">
        <input type="button" name="btn_retour"  value="Retour"/>
      </a></th>
    </tr>
  </table>
</div>
<div id="apDiv2">
<?php
//------------------------------affichage dans une liste---------------------------------------------------------
//On selectionnes les variables
if (!empty($_POST['txt_lbl_nom']) and !empty($_POST['txt_lbl_prenm']) and !empty($_POST['txt_lbl_tel']) and !empty($_POST['txt_lbl_cin']) and !empty($_POST['v_id_qlt_indv']) and !empty($_POST['v_id_serv']) and !empty($_POST['v_id_mod']))
{
$v_id_indv=$_POST['id_indv'];
$req='SELECT id_indv,libelle_qlte,lbl_serv,libelle_mod as lbl_m
                FROM individu i,qualite_individu q_i,servise s,modele m
WHERE q_i.id_qlte=i.id_qlte
AND s.id_serv=i.id_serv
AND m.id_mod=i.id_mod
AND  i.id_indiv='.$v_id_indv.'';//La laision entre les trois tables
//appel mysql pour execute la requete
$resultat=mysql_query($req) or die("erreur dans la requête $req");
//Création des titres
  echo' <table width="630" border  align=center cellspacing="1" bordercolor="#FF0000" margin=auto>
          <tr text-align="center" bgcolor="#669933" >
   <td align=center>NOM </td>
   <td align=center>PRENOM </td>
   <td align=center>TEL </td>
   <td align=center>CIN </td>
   <td align=center>QUALITè INDIVIDU </td>
   <td align=center>SERVICE</td>
   <td align=center>Modèle</td>
   <td align=center>INDIVIDU</td>
   <td align=center>Les Modifications</td>
   <td align=center>Les Suppritions</td>
  </tr>';
while($ligne=mysql_fetch_array($resultat))
   {
      $v_id_idv=$ligne['id_indv'];
  $v_id_qlt=$ligne['id_qlte'];
  $v_id_ser=$ligne['id_serv'];
      $v_id_m=$ligne['id_mod'];
  $m=$ligne['nom'];
  $p=$ligne['prenom'];
  $t=$ligne['tel'];
  $c=$ligne['cin'];
      $lbl_qlt=$ligne['libelle_qlte'];
  $lbl_ser=$ligne['lbl_serv'];
  $lbl_m=$ligne['libelle_mod'];    
    //affichage
echo'<tr>
       <td>'.$m.'</td>
       <td>'.$p.'</td>
       <td>'.$t.'</td>
   <td>'.$c.'</td>
   <td>'.$lbl_qlt.'</td>
   <td>'.$lbl_ser.'</td>
   <td>'.$lbl_m.'</td>
<td> <a href="modif_individu.php?v_id_ind_get='.$v_id_idv.' "><input type="button"  value="Modifier"  name="btn_modifier_mod"/></a></td>
<td><a href="requete/req_delete_individu.php?v_id_indiv_get='.$v_id_idv.' "><input type="button"  value="Effacer"  name="btn_sup_indv"/></a></td>
 </tr>';
       }//fin While
}//fin if
    else
{
  echo"Merci de choisir la catégorie modèle"; 
     }
   echo'</table>';
?>
</div>
</form>
</body>
</html>