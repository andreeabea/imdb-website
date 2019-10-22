<?php

/**
 * Delete TV shows
 */

require "config.php";
require "common.php";

if (isset($_GET["id"])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
  
    $id = $_GET["id"];

    $sql = "DELETE FROM actors WHERE id = :id";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $success = "Actor successfully deleted";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM actors";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "templates/header.php"; ?>

<h2>Delete actors</h2>

<?php if ($success) echo $success; ?>

		<table>
			<thead>
				<tr>
					<th>id</th>
					<th>Name</th>
					<th>Birthdate</th>
					<th>Birthplace</th>
					<th>Gender</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
		<?php foreach ($result as $row) : ?>
		<tr>
				<td><?php echo escape($row["id"]); ?></td>
				<td><?php echo escape($row["actor_name"]); ?></td>
				<td><?php echo escape($row["birthdate"]); ?></td>
				<td><?php echo escape($row["birthplace"]); ?></td>
				<td><?php if (escape($row["gender"])==1) echo "male"; else echo "female"; ?> </td>
				<td><a href="delete-actor.php?id=<?php echo escape($row["id"]); ?>">Delete</a></td>
			</tr>
		<?php endforeach;?> 
			</tbody>
	</table>
	<br><a href="index.php">Back to home</a></br>
	<?php include "templates/footer.php"; ?>