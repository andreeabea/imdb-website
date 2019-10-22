<?php

/**
 * Use an HTML form to edit an entry in the
 * actors table.
 *
 */

require "config.php";
require "common.php";

if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $actor =[
      "id"        => $_POST['id'],
      "actor_name" => $_POST['actor_name'],
	  "birthdate"  => $_POST['birthdate'],
	  "birthplace"     => $_POST['birthplace'],
	  "gender"       => $_POST['gender']
    ];

    $sql = "UPDATE actors 
            SET id = :id, 
              actor_name = :actor_name, 
              birthdate = :birthdate, 
              birthplace = :birthplace, 
              gender = :gender 
            WHERE id = :id";
  
  $statement = $connection->prepare($sql);
  $statement->execute($actor);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
  

if (isset($_GET['id'])) {
    try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];

    $sql = "SELECT * FROM actors WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $actor = $statement->fetch(PDO::FETCH_ASSOC);
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
	<blockquote><?php echo $_POST['actor_name']; ?> successfully updated.</blockquote>
    <a href="update-actor.php">	<input type="submit" name="back" value="Go back"></a>
<?php } ?>

<h2>Edit an actor</h2>

<form method="post">
   <?php foreach ($actor as $key => $value) : ?>
    <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
	<input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
  <?php endforeach; ?> 
  <input type="submit" name="submit" value="Submit">
</form>


<br><a href="index.php">Back to home</a></br>

<?php require "templates/footer.php"; ?>