<?php
require_once('checkSession.php');
?>
<html>

<head>
    <title>Manage Category</title>

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

    $pid = "";
    $productname = "";
    $productprice = "";
    $productimage = "";

    if (isset($_POST["btnAdd"])) {

        move_uploaded_file($_FILES["productImage"]["tmp_name"], 'images/' . $_FILES["productImage"]["name"]);
        $sql = "insert into product(productname,productprice,productimage,categoryid) values ('" . $_POST["txtProductName"] . "'," . $_POST["txtProductPrice"] . ",'" . $_FILES["productImage"]["name"] . "',1)";

        if ($conn->query($sql))
            echo "Inerted..";
        else
            echo "Failed..";
    }

    if (isset($_GET['op']) && $_GET['op'] == 'd') {
        $sql = "delete from product where pid='" . $_GET["id"] . "'";

        if ($conn->query($sql))
            echo "Deleted..";
        else
            echo "Failed..";
    }

    if (isset($_GET['op']) && $_GET['op'] == 'u') {

        $selectquery = "select * from product where pid=" . $_GET["id"] . "";

        $result = $conn->query($selectquery);

        while ($row = $result->fetch_assoc()) {
            $pid = $row["pid"];
            $productname = $row["productname"];
            $productprice = $row["categoryid"];
            $productimage = $row["categoryid"];
        }
    }

    $selectcategory = "select * from category order by categoryid";

    ?>

    <h3>Manage Product</h3>

    <form method="post" action="manageProduct.php" enctype="multipart/form-data">
        <table>
            <tr>
                <td>
                    Product Image
                </td>
                <td>
                    <input type="file" name="productImage" />
                </td>
            </tr>
            <tr>
                <td>
                    Product Name
                </td>
                <td>
                    <input type="text" name="txtProductName" value="<?php echo $productname; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    Product Price
                </td>
                <td>
                    <input type="number" name="txtProductPrice" value="<?php echo $productprice; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    Product Category
                </td>
                <td>
                    <select name="txtCategoryId">
                        <?php
                        $result = $conn->query($selectcategory);

                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $row["categoryid"]; ?>"><?php echo $row["categoryname"] ?></option>
                        <?php
                        }
                        ?>
                    </select>

                </td>
            </tr>
            <tr>
                <td colspan="2"><?php if (isset($_GET['op']) && $_GET['op'] == 'u') {
                                ?><input type="submit" name="btnUpdate" /><?php

                                                                        } else {
                                                                            ?><input type="submit" name="btnAdd" /><?php
                                                                                                                } ?></td>
            </tr>
        </table>
    </form>

    <?php

    $selectquery = "select * from product order by pid";

    $result = $conn->query($selectquery);

    ?>

    <table>
        <tr>
            <th>
                Product Id
            </th>
            <th>
                Image
            </th>
            <th>
                Product Name
            </th>
            <th>
                Product Price
            </th>
            <th>
                Update
            </th>
            <th>
                Delete
            </th>
        </tr>

        <?php

        while ($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td>
                    <?php echo $row["pid"]; ?>
                </td>
                <td>
                    <img src="images/<?php echo $row["productimage"]; ?>" style="height:50px;width:50px;" />
                </td>
                <td>
                    <?php echo $row["productname"]; ?>
                </td>
                <td>
                    <?php echo $row["productprice"]; ?>
                </td>
                <td>
                    <a href="manageProduct.php?op=u&id=<?php echo $row["pid"]; ?>">Update</a>
                </td>
                <td>
                    <a href="manageProduct.php?op=d&id=<?php echo $row["pid"]; ?>">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>



    </table>

</body>

</html>