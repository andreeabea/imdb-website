<?php

/**
 * List all tv shows with a link to edit
 */

try {
  require "config.php";
  require "common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM actors ORDER BY actor_name";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();

} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "templates/header.php"; ?>

<h2>Edit actors</h2>

		<table>
			<thead>
				<tr>
					<th>id</th>
					<th>Name</th>
					<th>Birthdate</th>
					<th>Birthplace</th>
					<th>Gender</th>
					<th>Edit</th>
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
				<td><a href="update-actor1.php?id=<?php echo escape($row["id"]); ?>">Edit</a></td>
			</tr>
		<?php endforeach;?> 
			</tbody>
	</table>
	<br><a href="index.php">Back to home</a></br>
	<?php include "templates/footer.php"; ?>