<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>PFMS</title>
</head>
<body>
<?php include 'db.php'; ?>
<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>

<?php
try {
	$db = new PDO('mysql:host=localhost;dbname=pig','root','');
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	die('<h4 style="color:red">Incorrect Connection Details</h4>');
}?>

<div class="container">
    <div class="row" style="margin-top: 5%">
        <h1 class="text-center"><?php echo "Pig Farm Management System"; ?></h1><br>
        <div class="col col-md-offset-2">
            <img src="p.jpg" class="img img-responsive">
        </div>
        <div class="col">
            <form method="POST">
                <div class="form-group">
                    <label class="control-label">Admin user</label>
                    <input type="text" name="username" class="form-control input-sm" required>
                </div>
<br>
                <div class="form-group">
                    <label class="control-label">Admin Password</label>
                    <input type="password" name="password" class="form-control input-sm" required>
                </div>
<br>
                <button name="submit" type="submit" class="btn btn-md btn-dark">Log in</button>
            </form>

            <?php
            if (isset($_POST['submit'])) {
                $username = trim($_POST['username']);
                $password = $_POST['password'];

                $hash = sha1($password);

                $q = $db->query("SELECT * FROM admin WHERE username = '$username' AND password = '$hash' LIMIT 1 ");

                $count = $q->rowCount();
                $rows = $q->fetchAll(PDO::FETCH_OBJ);

                if($count > 0){
                    foreach($rows as $row){
                        $user_id = $row->id;
                        $user = $row->username;

                        $_SESSION['id'] = $user_id;
                        $_SESSION['user'] = $user;

                        header('location: dashboard.php');
                    }
                }else{
                    $error = 'incorrect login details';
                }

            }
            if(isset($error)){ ?>
                <br><br>
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong><?php echo $error; ?>.</strong>
                </div>
            <?php }
            ?>


        </div>
    </div>
</div>
<?php include 'theme/foot.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

