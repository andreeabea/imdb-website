<?php

/**
 * Use an HTML form to edit an entry in the
 * tvseries table.
 *
 */

require "config.php";
require "common.php";

if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $tvshow =[
      "id"        => $_POST['id'],
      "show_name" => $_POST['show_name'],
      "rating"  => $_POST['rating'],
      "ap_year"     => $_POST['ap_year'],
      "duration"       => $_POST['duration'],
      "seasons"  => $_POST['seasons'],
      "ongoing"      => $_POST['ongoing']
    ];

    $sql = "UPDATE tvseries 
            SET id = :id, 
              show_name = :show_name, 
              rating = :rating, 
              ap_year = :ap_year, 
              duration = :duration, 
              seasons = :seasons, 
              ongoing = :ongoing 
            WHERE id = :id";
  
  $statement = $connection->prepare($sql);
  $statement->execute($tvshow);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
  

if (isset($_GET['id'])) {
    try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];

    $sql = "SELECT * FROM tvseries WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $tvshow = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();	
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
	<blockquote><?php echo $_POST['show_name']; ?> successfully updated.</blockquote>
    <a href="update.php">	<input type="submit" name="back" value="Go back"></a>
<?php } ?>

<h2>Edit a TV show</h2>

<form method="post">
  <?php foreach ($tvshow as $key => $value) : ?>
    <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	<input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
  <?php endforeach; ?> 
  <input type="submit" name="submit" value="Submit">
</form>


<br><a href="index.php">Back to home</a></br>

<?php require "templates/footer.php"; ?>