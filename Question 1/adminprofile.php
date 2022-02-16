<?php 
require_once('checkSession.php');
?>
<html>

<head>
    <title>Admin Profile</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            text-align: -webkit-center;
        }

        table {
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px solid gray;
            padding: 10px;
        }
    </style>

</head>


<body>
    <h3>Hii Admin</h3>
    <a href="manageCategory.php">Manage Category</a><br />
    <a href="manageProduct.php">Manage Product</a><br />
    <a href="logout.php">Logout</a>

</body>

</html>