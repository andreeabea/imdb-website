<?php if (isset($_POST['submit'])) {
	try {
		require "config.php";
		require "common.php";

		$connection = new PDO($dsn, $username, $password, $options);
        // fetch data code will go here
		$sql = "SELECT * 
				FROM tvseries
				WHERE show_name = :show_name";

$show_name = $_POST['show_name'];

$statement = $connection->prepare($sql);
$statement->bindParam(':show_name', $show_name, PDO::PARAM_STR);
$statement->execute();

$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>

<?php include "templates/header.php"; ?>

<?php 
if(isset($_POST['submit']))
{
	if($result && $statement->rowCount()>0)
	{ ?>
		<h2>Results</h2>

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
				</tr>
			</thead>
			<tbody>
		<?php foreach ($result as $row) 
		{?>
		<tr>
				<td><?php echo escape($row["id"]); ?></td>
				<td><?php echo escape($row["show_name"]); ?></td>
				<td><?php echo escape($row["rating"]); ?></td>
				<td><?php echo escape($row["ap_year"]); ?></td>
				<td><?php echo escape($row["duration"]); ?></td>
				<td><?php echo escape($row["seasons"]); ?></td>
				<td><?php if (escape($row["ongoing"])=="FALSE") echo "no" else echo "yes"; ?> </td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No results found for <?php echo escape($_POST['show_name']); ?>.</blockquote>
	<?php } 
} ?> 

<h2>Find TV show</h2>

<form method="post">
	<label for="location">Name</label>
	<input type="text" id="show_name" name="show_name">
	<input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>