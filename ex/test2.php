<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
<form method="post" action="test2.php">
    <input type="text" name="exemple" value="<?php if (isset($_POST['exemple'])){echo $_POST['exemple'];} ?>" />   
    <input type="submit" value="envoyer" />
</form>

</body>
</html>