<?php session_start(); ?>
<html>

<head>
    <title>Login</title>

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

    <?php

    require_once('conn.php');

    if (isset($_POST["submit"])) {

        $selectquery = "select * from user where username='" . $_POST["username"] . "' and password='" . $_POST["password"] . "'";

        $result = $conn->query($selectquery);

        while ($row = $result->fetch_assoc()) {
            $_SESSION["type"] = $row["type"];

            if ($_SESSION["type"] == "admin")
                header('Location: adminprofile.php');
            else if ($_SESSION["type"] == "user")
                header('Location: userprofile.php');
        }

        echo "Failed..";
    }

    ?>

    <h3>Login</h3>

    <form method="post" action="login.php">
        <table>
            <tr>
                <td>
                    Username
                </td>
                <td>
                    <input type="text" name="username" />

                </td>

            </tr>
            <tr>
                <td>
                    Password
                </td>
                <td>
                    <input type="password" name="password" />
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" /></td>
            </tr>
        </table>
    </form>

    <a href="registration.php">Sign Up</a>

</body>

</html>