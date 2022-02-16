<?php
require_once('checkSession.php');

require_once('conn.php');
?>
<html>

<head>
    <title>User Profile</title>

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

    <h3>Hii User</h3>

    <table>
        <tr>
            <td>
                Category List<br />
                -------------<br />
                <?php



                $selectcategory = "select * from category order by categoryid";

                $result = $conn->query($selectcategory);

                while ($row = $result->fetch_assoc()) {
                ?>
                    <a href="userprofile.php?cid=<?php echo $row["categoryid"]; ?>"><?php echo $row["categoryname"] ?></a><br />
                <?php
                }
                ?>
            </td>
            <td>
                Product List<br />
                -------------<br />

                <table>
                    <?php

                    if (isset($_GET["cid"])) {
                        $selectproduct = "select * from product where categoryid=".$_GET["cid"]."";
                    } else {
                        $selectproduct = "select * from product";
                    }

                    $result = $conn->query($selectproduct);

                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><img src="images/<?php echo $row["productimage"]; ?>" style="height:50px;width:50px;" /></td>
                            <td>Product : <?php echo $row["productname"] ?></td>
                            <td>Price : <?php echo $row["productprice"] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </td>
        </tr>
    </table>



    <br />
    <a href="logout.php">Logout</a>

</body>

</html>