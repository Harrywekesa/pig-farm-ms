<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Dashboard</title>
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
        <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
    </header>

    <?php include 'inc/data.php'; ?>
    <div class="w3-container" style="padding-top:22px">
        <div class="w3-row">
            <h2>Recent Pigs</h2>
            <div class="table-responsive">
                <table class="table table-hover" id="table">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Pig No.</th>
                        <th>Breed</th>
                        <th>Weight</th>
                        <th>Gender</th>
                        <th>Arrived</th>
                        <th>Desc.</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $qpi = $db->query("SELECT * FROM pigs ORDER BY id");
                    $result = $qpi->fetchAll(PDO::FETCH_OBJ);
                    $c = $qpi->rowCount();

                    foreach ($result as $j) {
                        $pigname = $j->pigno;
                        $b_id = $j->breed_id;
                        $weight = $j->weight;
                        $gender = $j->gender;
                        $remark = $j->remark;
                        $arr = $j->arrived;

                        $k = $db->query("SELECT * FROM breed WHERE id = '$b_id' ");
                        $ks = $k->fetchAll(PDO::FETCH_OBJ);
                        foreach ($ks as $r) {
                            $bname = $r->name;
                            ?>
                            <tr>
                                <td>
                                    <?php for ($i=1; $i <= $c ; $i++) {
                                        echo $i;
                                    } ?>
                                </td>
                                <td><?php echo $pigname; ?></td>
                                <td><?php echo $bname; ?></td>
                                <td><?php echo $weight; ?></td>
                                <td><?php echo $gender; ?></td>
                                <td><?php echo $arr; ?></td>
                                <td><?php echo $remark; ?></td>
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