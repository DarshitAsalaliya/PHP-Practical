<?php session_start(); ?>
<html>

<head>
    <title>Registration</title>

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

        if ($_POST["txtCaptcha"] == $_SESSION["code"]) {
            $sql = "insert into user(username,password,type) values ('" . $_POST["username"] . "','" . $_POST["password"] . "','" . $_POST["type"] . "')";

            if ($conn->query($sql))
                echo "Registration Successfully..";
            else
                echo "Failed..";
        } else {
            echo "Invalid Captcha..";
        }
    }

    ?>

    <h3>Sign Up</h3>

    <form method="post" action="registration.php">
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
                <td>
                    Type
                </td>
                <td>
                    <select name="type">
                        <option>admin</option>
                        <option>user</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Captcha
                </td>
                <td>
                    <img src="captcha.php" /><br />
                    <input type="text" name="txtCaptcha" />
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="submit" /></td>
            </tr>
        </table>
    </form>

    <a href="login.php">Login</a>

</body>

</html>