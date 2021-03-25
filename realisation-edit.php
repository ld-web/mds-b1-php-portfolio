<?php
require_once 'layout/header.php';

if (!isset($_GET['id'])) {
  require_once "templates/error.php";
  exit;
}

$id = $_GET['id'];

require_once 'db.php';

if (!empty($_POST)) {
  // Update
  $query = "UPDATE realisations SET name = :name, description = :description, year = :year, image = :image WHERE id = :id";

  $name = $_POST['name'];
  $description = $_POST['description'];
  $year = $_POST['year'];
  $image = $_POST['image'];

  $stmt = $pdo->prepare($query);
  $res = $stmt->execute([
    'name' => $name,
    'year' => $year,
    'image' => $image,
    'description' => $description,
    'id' => $id
  ]);

  if ($res) { ?>
    <div class="alert alert-success">
      La réalisation a bien été enregistrée
    </div>
<?php }
}

$query = "SELECT * FROM realisations WHERE id = :id";

$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $id]);
$realisation = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<div class="container">
  <h1>Editer une réalisation</h1>

  <form method="POST">
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="name" name="name" placeholder="Ma réalisation" value="<?php echo $realisation['name']; ?>" />
      <label for="name">Nom</label>
    </div>
    <div class="form-floating mb-3">
      <textarea class="form-control" id="description" name="description" placeholder="Une description" style="height: 100px"><?php echo $realisation['description']; ?></textarea>
      <label for="description">Description</label>
    </div>
    <div class="form-floating mb-3">
      <input type="number" class="form-control" id="year" name="year" placeholder="2021" value="<?php echo $realisation['year']; ?>" />
      <label for="year">Année</label>
    </div>
    <div class="form-floating mb-3">
      <input type="text" class="form-control" id="image" name="image" placeholder="Image" value="<?php echo $realisation['image']; ?>" />
      <label for="image">Image</label>
    </div>
    <div class="mb-3">
      <img src="<?php echo $realisation['image']; ?>" alt="<?php echo $realisation['name']; ?>" style="max-width: 400px;" />
    </div>
    <div>
      <button type="submit" class="btn btn-success">Enregistrer</button>
    </div>
  </form>
</div>

<?php
require_once 'layout/footer.php';
