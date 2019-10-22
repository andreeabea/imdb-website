<?php
require "config.php";
		require "common.php"; 
if (isset($_POST['submit'])) {
	try {

		$connection = new PDO($dsn, $username, $password, $options);
        // fetch data code will go here
		$sql = "SELECT actors.id, actor_name, birthdate, birthplace, gender
				FROM tvseries
				JOIN cast ON showID=tvseries.id
				JOIN actors ON actorID=actors.id
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

try{
$connection = new PDO($dsn, $username, $password, $options);
	
	$sql2 = "SELECT show_name
                FROM tvseries";
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
					<th>Name</th>
					<th>Birthdate</th>
					<th>Birthplace</th>
					<th>Gender</th>
				</tr>
			</thead>
			<tbody>
		<?php foreach ($result as $row) 
		{?>
		<tr>
				<td><?php echo escape($row["id"]); ?></td>
				<td><?php echo escape($row["actor_name"]); ?></td>
				<td><?php echo escape($row["birthdate"]); ?></td>
				<td><?php echo escape($row["birthplace"]); ?></td>
				<td><?php if (escape($row["gender"])==1) echo "male"; else echo "female"; ?> </td>
			</tr>
		<?php } ?> 
			</tbody>
	</table>
	<?php } else { ?>
		<blockquote>No actors for <?php echo escape($_POST['show_name']); ?> found.</blockquote>
	<?php } 
} ?> 

<h2>Find actors that starred in a TV show</h2>

<form method="post">
	<label for="show_name">Show name</label>

	<select name="show_name" id="show_name">
	<option value = ""></option>
	<?php foreach ($result2 as $row): ?>
		<option><?=$row["show_name"]?></option>
	<?php endforeach ?>
    </select>
	<input type="submit" name="submit" value="View Results">
</form>

<br><a href="index.php">Back to home</a></br>

<?php include "templates/footer.php"; ?>
		
