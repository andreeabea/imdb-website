<?php

/**
 * List all tv shows with a link to edit
 */

try {
  require "config.php";
  require "common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM tvseries ORDER BY show_name";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();

} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "templates/header.php"; ?>

<h2>Update TV shows</h2>

		<table>
			<thead>
				<tr>
					<th>id</th>
					<th>Show Name</th>
					<th>Rating</th>
					<th>Apparition Year</th>
					<th>Duration</th>
					<th>Seasons</th>
					<th>Ongoing</th>
					<th>Edit</th>
				</tr>
			</thead>
			<tbody>
		<?php foreach ($result as $row) : ?>
		<tr>
				<td><?php echo escape($row["id"]); ?></td>
				<td><?php echo escape($row["show_name"]); ?></td>
				<td><?php echo escape($row["rating"]); ?></td>
				<td><?php echo escape($row["ap_year"]); ?></td>
				<td><?php echo escape($row["duration"]); ?></td>
				<td><?php echo escape($row["seasons"]); ?></td>
				<td><?php if (escape($row["ongoing"])=="FALSE") echo "no"; else echo "yes"; ?> </td>
				<td><a href="update-tvshow.php?id=<?php echo escape($row["id"]); ?>">Edit</a></td>
			</tr>
		<?php endforeach;?> 
			</tbody>
	</table>
	<br><a href="index.php">Back to home</a></br>
	<?php include "templates/footer.php"; ?>