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

    $categoryid = "";
    $categorname = "";

    if (isset($_POST["btnAdd"])) {

        $sql = "insert into category(categoryname) values ('" . $_POST["txtCategory"] . "')";

        if ($conn->query($sql))
            echo "Inerted..";
        else
            echo "Failed..";
    }

    if (isset($_POST["btnUpdate"])) {

        $sql = "update category set categoryname='" . $_POST["txtCategory"] . "' where categoryid=" . $_POST["txtCategoryId"] . "";

        if ($conn->query($sql))
            echo "Updated..";
        else
            echo "Failed..";
    }

    if (isset($_GET['op']) && $_GET['op'] == 'd') {
        $sql = "delete from category where categoryid='" . $_GET["id"] . "'";

        if ($conn->query($sql))
            echo "Deleted..";
        else
            echo "Failed..";
    }

    if (isset($_GET['op']) && $_GET['op'] == 'u') {

        $selectquery = "select * from category where categoryid=" . $_GET["id"] . "";

        $result = $conn->query($selectquery);

        while ($row = $result->fetch_assoc()) {
            $categoryid = $row["categoryid"];
            $categorname = $row["categoryname"];
        }
    }

    ?>

    <h3>Manage Category</h3>

    <form method="post" action="manageCategory.php">
        <table>
            <tr>
                <td>
                    Category Name
                </td>
                <td>
                    <input type="text" name="txtCategory" value="<?php echo $categorname; ?>" />
                    <input type="hidden" name="txtCategoryId" value="<?php echo $categoryid; ?>" />
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

    $selectquery = "select * from category order by categoryid";

    $result = $conn->query($selectquery);

    ?>

    <table>
        <tr>
            <th>
                Category Id
            </th>
            <th>
                Category Name
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
                    <?php echo $row["categoryid"]; ?>
                </td>
                <td>
                    <?php echo $row["categoryname"]; ?>
                </td>
                <td>
                    <a href="manageCategory.php?op=u&id=<?php echo $row["categoryid"]; ?>">Update</a>
                </td>
                <td>
                    <a href="manageCategory.php?op=d&id=<?php echo $row["categoryid"]; ?>">Delete</a>
                </td>
            </tr>
        <?php
        }
        ?>



    </table>

</body>

</html>