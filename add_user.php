<?php
include_once("db.php");

$action = isset($_GET['action']) ? $_GET['action'] : 'add';
$userId = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (isset($_POST["save"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    if ($action == 'modify') {
        $query = "UPDATE `users` SET `name`='$name', `email`='$email', `mobile`='$mobile', `password`='$password' WHERE `id`=$userId";
    } else {
        $query = "INSERT INTO `users`(`name`, `email`, `password`, `mobile`) VALUES ('$name','$email','$password','$mobile')";
    }

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("" . mysqli_error($connection));
    } else {
        $action = $action == 'modify' ? 'mod' : 'add';
        header("Location: index.php?action=$action");
        exit();
    }
}

if ($action == 'modify' && $userId) {
    $query = "SELECT * FROM `users` WHERE `id`=$userId";
    $result = mysqli_query($connection, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $current_user = mysqli_fetch_assoc($result);
        $name = $current_user['name'];
        $email = $current_user['email'];
        $mobile = $current_user['mobile'];
        $password = $current_user['password'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title><?php echo $action == 'modify' ? 'Modify User' : 'Add User'; ?></title>
</head>

<body>
    <div class="container">
        <div class="wrapper p-5 m-5">
            <div class="d-flex p-2 justify-content-between mb-2">
                <h2><?php echo $action == 'modify' ? 'Modify User' : 'Add User'; ?></h2>
                <div><a href="display_users.php"><i data-feather="corner-down-left"></i></a></div>
            </div>
            <form action="add_user.php?action=<?php echo $action; ?>&id=<?php echo $userId; ?>" method="post">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" placeholder="Enter your name" name="name" required
                        value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" placeholder="Enter your email" name="email" required
                        value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Mobile</label>
                    <input type="tel" class="form-control" placeholder="Enter your phone number" name="mobile" required
                        value="<?php echo isset($mobile) ? htmlspecialchars($mobile) : ''; ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password" <?php echo $action == 'modify' ? '' : 'required'; ?>>
                </div>
                <input type="submit" class="btn btn-primary" value="Save" name="save">
            </form>
        </div>
    </div>
    <script src="js/jq.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>