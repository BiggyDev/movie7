<?php include('inc/pdo.php');
include('inc/functions.php');

$sql = "SELECT * FROM movies_full LIMIT 50";
$query = $pdo -> prepare($sql);
$query -> execute();
$movies = $query -> fetchAll();

//pagination

require('vendor/autoload.php');

use JasonGrimes\Paginator;

$totalItems = 5800; //Nombre total d'articles
$itemsPerPage = 25; // Nombre d'articles par page
$currentPage = 1; // Page par défaut
$offset = 0; // offset par défaut
$urlPattern = '?page=(:num)';

//écrasée par celui de l'URL si get['page'] n'est pas vide
if (!empty($_GET['page']) && is_numeric($_GET['page'])){
  $currentPage = $_GET['page'];
  $offset = $currentPage * $itemsPerPage - $itemsPerPage;
}

//récupère nos données, pour affichage plus bas
//inclus les paramètres d'offset pour la pagination
$sql = "SELECT * FROM movies_full
        ORDER BY title ASC
        LIMIT $offset,$itemsPerPage";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$movies = $stmt->fetchAll();

//requête pour compter le nombre de lignes dans la table
$sql = "SELECT COUNT(*) FROM movies_full";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$totalItems = $stmt->fetchColumn();


$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

$title = 'Bibliothèque'; ?>
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
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Titre</th>
                                                    <th>Année</th>
                                                    <th>Note</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($movies as $movie) { ?>
                                                  <tr>
                                                    <td><?php echo $movie['id']; ?></td>
                                                    <td><?php echo $movie['title']; ?></td>
                                                    <td><?php echo $movie['year']; ?></td>
                                                    <td><?php echo $movie['rating']; ?></td>
                                                    <td>
                                                      <i class="fa fa-user fa-2x"></i>
                                                      <a href="details.php"><i class="fa fa-check fa-2x"></i></a>
                                                      <i class="fa fa-times fa-2x"></i>
                                                    </td>
                                                  </tr>
                                                <?php  } ?>
                                            </tbody>
                                        </table>
                                        <?php echo $paginator; ?>
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
