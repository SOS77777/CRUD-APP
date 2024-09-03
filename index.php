<?php
include_once("db.php");
$action = (isset($_GET["action"])) ? $_GET["action"] : false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/toastr.css" rel="stylesheet" />
    <title>Users App</title>
</head>

<body>
    <div class="container">
        <div class="wrapper p-5 m-5">
            <div class="d-flex p-2 justify-content-between mb-2">
                <h2>All users</h2>
                <div><a href="add_user.php"><i data-feather="user-plus"></i></a></div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_user = "SELECT * FROM users";
                    $users = mysqli_query($connection, $get_user);
                    while ($user = $users->fetch_assoc()) { ?>
                        <tr>
                            <td><?= $user['id']; ?></td>
                            <td><?= $user['name']; ?></td>
                            <td><?= $user['email']; ?></td>
                            <td><?= $user['mobile']; ?></td>
                            <td>
                                <div class="icon-container">
                                    <i onclick="del_user(<?php echo $user['id'] ?>);" class="text-danger"
                                        data-feather="trash-2"></i>
                                    <i onclick="modify_user(<?php echo $user['id'] ?>);" class="text-success"
                                        data-feather="edit"></i>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="js/jq.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/icon.js"></script>
    <script src="js/toastr.js"></script>
    <script src="js/main.js"></script>
    <?php
    if ($action != false)
        if ($action == 'add') { ?>
            <script>
                add_user_pop();
            </script>
        <?php } elseif ($action == 'del') { ?>
            <script>
                del_user_pop();
            </script>

            <?php
        } elseif ($action == 'mod') { ?>
            <script>
                mod_user_pop();
            </script>

            <?php
        }
    ?>


    <script>
        feather.replace();
    </script>
</body>

</html>