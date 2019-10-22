<?php
require "config.php";
		require "common.php"; 
if (isset($_POST['submit'])) {
	try {

		$connection = new PDO($dsn, $username, $password, $options);
        // fetch data code will go here
		$sql = "SELECT id, show_name, rating, ap_year, duration, seasons, ongoing
				FROM tvseries
				JOIN show_genres ON showID=id
				JOIN genres ON genreID=gID
				WHERE genre_name = :genre_name";

$genre_name = $_POST['genre_name'];

$statement = $connection->prepare($sql);
$statement->bindParam(':genre_name', $genre_name, PDO::PARAM_STR);
$statement->execute();

$result = $statement->fetchAll();
	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}

try{
$connection = new PDO($dsn, $username, $password, $options);
	
	$sql2 = "SELECT genre_name
                FROM genres";
        $statement2 = $connection->prepare($sql2);
        $statement2->execute();
        $result2 = $statement2->fetchAll();

	
}catch(PDOException $error) {
echo $sql2 . "<br>" . $error->getMessage();}

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
				<td><?php if (escape($row["ongoing"])=="FALSE") echo "no"; else echo "yes"; ?> </td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No <?php echo escape($_POST['genre_name']); ?> TV shows found.</blockquote>
	<?php } 
} ?> 

<h2>Find TV show</h2>

<form method="post">
	<label for="genre_name">Genre</label>

	<select name="genre_name" id="genre_name">
	<option value = ""></option>
	<?php foreach ($result2 as $row): ?>
		<option><?=$row["genre_name"]?></option>
	<?php endforeach ?>
    </select>
	<input type="submit" name="submit" value="View Results">
</form>

<br><a href="index.php">Back to home</a></br>

<?php include "templates/footer.php"; ?>
		
