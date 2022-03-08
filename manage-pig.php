<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Manage poultry</title>
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
            <h2>Manage Pigs</h2>
            <a href="add-pig.php" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> Add New Pig</a><br><br>
            <div class="table-responsive">
                <table class="table table-hover table-striped" id="table">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Photo</th>
                        <th>Pig No.</th>
                        <th>Breed</th>
                        <th>Weight</th>
                        <th>Gender</th>
                        <th>Arrived</th>
                        <th>Desc.</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $all_pig = $db->query("SELECT * FROM pigs ORDER BY id DESC");
                    $fetch = $all_pig->fetchAll(PDO::FETCH_OBJ);
                    foreach($fetch as $data){
                        $get_breed = $db->query("SELECT * FROM breed WHERE id = '$data->breed_id'");
                        $breed_result = $get_breed->fetchAll(PDO::FETCH_OBJ);
                        foreach($breed_result as $breed){
                            ?>
                            <tr>
                                <td><?php echo $data->id ?></td>
                                <td>
                                    <img width="70" height="70" src="<?php echo $data->img; ?>" class="img img-responsive thumbnail">
                                </td>
                                <td><?php echo $data->pigno ?></td>
                                <td><?php echo $breed->name ?></td>
                                <td><?php echo $data->weight ?></td>
                                <td><?php echo $data->gender ?></td>
                                <td><?php echo $data->arrived ?></td>
                                <td><?php echo wordwrap($data->remark,300,'<br>'); ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-default dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog"></i> Option
                                            <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="edit-pig.php?id=<?php echo $data->id ?>"><i class="fa fa-edit"></i> Edit</a></li>
                                            <li><a onclick="return confirm('Continue delete pig ?')" href="delete.php?id=<?php echo $data->id ?>"><i class="fa fa-trash"></i> Delete</a></li>
                                            <li><a onclick="return confirm('Continue quarantine pig ?')" href="quarantine.php?id=<?php echo $data->id; ?>"><i class="fa fa-paper-plane"></i> Quarantine Pig</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
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
