<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>add</title>
</head>
<body>
<?php include 'setting/db.php'; ?>
<?php include 'setting/system.php'; ?>
<?php include 'theme/head.php'; ?>
<?php include 'theme/sidebar.php'; ?>
<?php include 'session.php'; ?>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

    <!-- Header -->
    <header class="w3-container" style="padding-top:22px">
        <h5><b><i class="fa fa-dashboard"></i> Poultry Management > Add</b></h5>
    </header>

    <?php include 'inc/data.php'; ?>


    <div class="w3-container" style="padding-top:22px">
        <div class="w3-row">
            <h2>Add New Poultry</h2>

            <div class="col-md-6">

                <?php
                if(isset($_POST['submit']))
                {
                    if(isset($_FILES['pigphoto']['tmp_name'])){

                        $n_pigno = $_POST['pigno'];
                        $n_weight = $_POST['weight'];
                        $n_arrived = $_POST['arrived'];
                        $n_breed = $_POST['breed'];
                        $n_remark = $_POST['remark'];
                        $n_status = $_POST['status'];
                        $n_gender = $_POST['gender'];


                        $res1_name = basename($_FILES['pigphoto']['name']);
                        $tmp_name = $_FILES['pigphoto']['tmp_name'];
                        $type = $_FILES['pigphoto']['type'];
                        $max_size = 2097152;
                        $size = $_FILES['pigphoto']['size'];

                        if (isset($res1_name)) {
                            $location = 'uploadfolder/';
                            $move = move_uploaded_file($tmp_name, $location.$res1_name);
                            $path1 = $location.$res1_name;


                            if (!$move) {
                                $fileerror = $_FILES['pigphoto']['error'];
                                $message = $upload_errors[$fileerror];

                            }
                        }
                    }






                    $insert = $db->query("INSERT INTO pigs(pigno,weight,arrived,breed_id,remark,health_status,img,gender) VALUES('$n_pigno','$n_weight','$n_arrived','$n_breed','$n_remark','$n_status','$path1','$n_gender') ");

                    if($insert){?>
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Pig successfully created <i class="fa fa-check"></i></strong>
                        </div>
                        <?php
                    }else{ ?>
                        <div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Error creatiing pig data. Please try again <i class="fa fa-times"></i></strong>
                        </div>
                        <?php
                    }

                }

                ?>




                <form method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label">Pig No.</label>
                        <input type="text" name="pigno" class="form-control" value="pig-fms-<?php echo mt_rand(0000,9999); ?>" readonly="on" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Pig Weight</label>
                        <input type="text" name="weight" class="form-control" required>
                    </div>

                    <div class="form-group date" data-provide="datepicker">
                        <label class="control-label">Arrival date</label>
                        <input type="text" name="arrived" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Health Status</label>
                        <select name="status" class="form-control" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="on treatment">On treatment</option>
                            <option value="sick">Sick</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Breed</label>
                        <select name="breed" class="form-control" required>
                            <option value=""></option>
                            <?php
                            $getBreed = $db->query("SELECT * FROM breed");
                            $res = $getBreed->fetchAll(PDO::FETCH_OBJ);
                            foreach($res as $r){ ?>
                                <option value="<?php echo $r->id; ?>"><?php echo $r->name; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Description</label>
                        <textarea class="form-control" name="remark" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Pig photo</label>
                        <input type="file" name="pigphoto" class="form-control" required>
                    </div>

                    <button name="submit" type="submit" name="submit" class="btn btn-sn btn-default">Update</button>
                </form>
            </div>
        </div>
    </div>

</div>
<?php include 'theme/foot.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>