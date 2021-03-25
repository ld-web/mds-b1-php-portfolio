<?php
require_once 'layout/header.php';

if (!isset($_GET['id'])) {
  require_once "templates/error.php";
  exit;
}

$id = $_GET['id'];

require_once 'db.php';

if (isset($_GET['confirm']) && $_GET['confirm'] == 1) {
  $stmt = $pdo->prepare('DELETE FROM realisations WHERE id = :id');
  $stmt->execute(['id' => $id]);

  header('Location: admin.php');
  exit;
}

?>

<div class="container">
  <div class="alert alert-danger">
    Voulez-vous vraiment supprimer cette réalisation ?
  </div>

  <div class="btn-group" role="group">
    <a href="admin.php" class="btn btn-danger">Non</a>
    <a href="realisation-delete.php?id=<?php echo $id; ?>&confirm=1" class="btn btn-primary">Oui</a>
  </div>
</div>

<?php
require_once 'layout/footer.php';
