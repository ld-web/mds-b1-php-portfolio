<?php
require_once 'layout/header.php';
require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM realisations");

$realisations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
  <h1>Administration des réalisations</h1>

  <?php if (empty($realisations)) { ?>
    <div class="alert alert-danger" role="alert">
      Aucune réalisation enregistrée
    </div>
  <?php } else { ?>
    <div class="realisations-container">
      <?php foreach ($realisations as $realisation) { ?>
        <div class="realisation mb-4">
          <a href="realisation-edit.php?id=<?php echo $realisation['id']; ?>" class="btn btn-warning">Modifier</a>
          <?php echo $realisation['name']; ?>
          <a href="realisation-delete.php?id=<?php echo $realisation['id']; ?>" class="btn btn-danger">Supprimer</a>
        </div>
      <?php } ?>
    </div>
  <?php } ?>

  <a href="realisation-create.php" class="btn btn-primary">Ajouter une réalisation</a>
</div>

<?php
require_once 'layout/footer.php';
