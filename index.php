<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>SerwisACO</title>
  <meta name="description" content="SerwisACO">
  <meta name="author" content="Unnamed Group of Deers">

  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/bulma.css">
  <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

</head>

<body id="body">
  

<?php
session_start();

include('layout.php');

if(!(isset($_SESSION['logged']) || ($_SESSION['logged']==true)))
{
    include('login.php');
}
else include('pages/home.php');

include('footer.php')
?>
</body>
</html>