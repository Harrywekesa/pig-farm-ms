<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<?php include 'setting/system.php'; ?>
<?php include 'setting/db.php'; ?>
<?php include 'theme/head.php'; ?>
<?php include 'theme/sidebar.php'; ?>
<?php include 'session.php'; ?>



<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

    <!-- Header -->
    <header class="w3-container" style="padding-top:22px">
        <h5><b><i class="fa fa-dashboard"></i> Pig Management</b></h5>
    </header>

    <?php include 'inc/data.php'; ?>


    <div class="w3-container" style="padding-top:22px">
        <div class="w3-row">
            <h2>Pig Breeds</h2>
            <div class="col-md-6">
                <a title="Check to delete from list" data-toggle="modal" data-target="#_removed" id="delete"  class="btn btn-danger"><i class="fa fa-trash"></i>
                </a>
                <form method="post" action="delete_breed.php">
                    <table class="table table-hover table-bordered" id="table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $get = $db->query("SELECT * FROM breed");
                        $res = $get->fetchAll(PDO::FETCH_OBJ);
                        foreach($res as $n){ ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="selector[]" value="<?php echo $n->id ?>">
                                </td>
                                <td> <?php echo $n->id; ?> </td>
                                <td>  <?php echo $n->name; ?> </td>
                            </tr>
                        <?php }

                        ?>
                        </tbody>
                    </table>

                    <?php include('inc/modal-delete.php'); ?>
                </form>
            </div>

            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">Add New Breed</div>
                    <div class="panel-body">
                        <form method="post">
                            <div class="form-group">
                                <label class="control-label">Breed Name</label>
                                <input type="text" name="breed" class="form-control" placeholder="Enter breed name">
                            </div>

                            <button class="btn btn-sm btn-default" type="submit" name="submit">Add</button>

                            <?php
                            if(isset($_POST['submit'])){
                                $name = $_POST['breed'];

                                $query = $db->query("INSERT INTO breed(name)VALUES('$name')");

                                if($query){ ?>
                                    <script>alert('Breed Added. Click OK to close dialogue.')</script>
                                    <?php
                                    header('refresh: 3');
                                }
                            }
                            ?>
                        </form>
                    </div>
                </div>
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