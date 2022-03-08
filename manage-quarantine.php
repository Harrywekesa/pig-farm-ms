<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Manage Quarantine</title>
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
            <h2>Quarantine List</h2>
            <div class="col-md-12">
                <a title="Check to delete from list" data-toggle="modal" data-target="#_remove" id="delete"  class="btn btn-danger"><i class="fa fa-trash"></i>
                </a>
                <form method="post" action="remove_quarantine.php">
                    <table class="table table-hover" id="table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Pig No</th>
                            <th>Date quarantined</th>
                            <th>Breed</th>
                            <th>Reason</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $get = $db->query("SELECT * FROM quarantine");
                        $res = $get->fetchAll(PDO::FETCH_OBJ);
                        foreach($res as $n){ ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="selector[]" value="<?php echo $n->id ?>">
                                </td>
                                <td> <?php echo $n->pig_no; ?> </td>
                                <td>  <?php echo $n->date_q; ?> </td>
                                <td><?php echo $n->breed; ?> </td>
                                <td> <?php echo $n->reason; ?> </td>
                            </tr>
                        <?php }

                        ?>
                        </tbody>
                    </table>

                    <?php include('inc/modal-delete.php'); ?>
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
</body>
</html>


