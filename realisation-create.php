<?php
require_once 'layout/header.php';

if (!empty($_POST)) {
  require_once 'db.php';

  $query = "INSERT INTO realisations (name, description, year, image) VALUES (:name, :description, :year, :image)";

  $name = $_POST['name'];
  $description = $_POST['description'];
  $year = $_POST['year'];
  $image = $_POST['image'];

  $stmt = $pdo->prepare($query);
  $res = $stmt->execute([
    'name' => $name,
    'year' => $year,
    'image' => $image,
    'description' => $description
  ]);

  if ($res) { ?>
    <div class="alert alert-success">
      La réalisation a bien été enregistrée
    </div>
<?php }
}
?>

<div class="container">
  <h1>Nouvelle réalisation</h1>

  <form method="POST">
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="name" name="name" placeholder="Ma réalisation" />
      <label for="name">Nom</label>
    </div>
    <div class="form-floating mb-3">
      <textarea class="form-control" id="description" name="description" placeholder="Une description" style="height: 100px"></textarea>
      <label for="description">Description</label>
    </div>
    <div class="form-floating mb-3">
      <input type="number" class="form-control" id="year" name="year" placeholder="2021" />
      <label for="year">Année</label>
    </div>
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="image" name="image" placeholder="Image" />
      <label for="image">Image</label>
    </div>
    <div>
      <button type="submit" class="btn btn-success">Enregistrer</button>
    </div>
  </form>
</div>

<?php
require_once 'layout/footer.php';
