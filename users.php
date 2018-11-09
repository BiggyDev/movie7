<?php include('inc/pdo.php');
include('inc/functions.php');

$sql = "SELECT * FROM m7_users_website";
$query = $pdo -> prepare($sql);
$query -> execute();
$users = $query -> fetchAll();

$title = 'Utilisateurs'; ?>
<?php include('inc/headerb.php'); ?>

<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $title; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Utilisateurs
                        </div>
                        <!-- /.panel-heading -->
                        <!-- <div class="col-lg-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Basic Table
                                </div> -->
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Pseudo</th>
                                                    <th>Email</th>
                                                    <th>Created_at</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($users as $user) { ?>
                                                  <tr>
                                                    <td><?php echo $user['id']; ?></td>
                                                    <td><?php echo $user['pseudo']; ?></td>
                                                    <td><?php echo $user['email']; ?></td>
                                                    <td><?php echo $user['created_at']; ?></td>
                                                  </tr>
                                                <?php  } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                  </div>
              </div>
        </div>
        <!-- /#page-wrapper -->

<?php include('inc/footerb.php');
