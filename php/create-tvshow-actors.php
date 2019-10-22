<?php 
require "C:/Users/elfy_/Desktop/faculta/Databases/projects/php/config.php";
    require "common.php";
if (isset($_POST['submit'])) {
	
	try {
		$connection = new PDO($dsn, $username, $password, $options);
		// insert new user code will go here
		
		$sqlshow = "SELECT id
				FROM tvseries
				WHERE show_name = :show_name";
		$show_name = $_POST['show_name'];

$statement = $connection->prepare($sqlshow);
$statement->bindParam(':show_name', $show_name, PDO::PARAM_STR);
$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row) {
            $showID = $row['id'];
        }

$sqlactor = "SELECT id
				FROM actors
				WHERE actor_name = :actor_name";
		$actor_name = $_POST['actor_name'];

$statement = $connection->prepare($sqlactor);
$statement->bindParam(':actor_name', $actor_name, PDO::PARAM_STR);
$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row) {
            $actorID = $row['id'];
        }

		$new_tvshow = array(
	"showID" => $showID,
	"actorID"  => $actorID
);


$sql = sprintf(
		"INSERT INTO %s (%s) values (%s)",
		"cast",
		implode(", ", array_keys($new_tvshow)),
		":" . implode(", :", array_keys($new_tvshow))
);

$statement = $connection->prepare($sql);
$statement->execute($new_tvshow);

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
	$sql3 = "SELECT actor_name
                FROM actors";
        $statement3 = $connection->prepare($sql3);
        $statement3->execute();
        $result3 = $statement3->fetchAll();

	
}catch(PDOException $error) {
echo $sql . "<br>" . $error->getMessage();}
 ?>


<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
	<blockquote><?php echo $_POST['actor_name']; ?> successfully added to <?php echo $_POST['show_name']; ?>'s cast.</blockquote>
<?php } ?>

<h2>Add a TV show</h2>

<form method="post">
	<label for="show_name">Show Name</label>
	
	<select name="show_name" id="show_name">
	<option value = ""></option>
	<?php foreach ($result2 as $row): ?>
		<option><?=$row["show_name"]?></option>
	<?php endforeach ?>
    </select>
	
	<label for="actor_name">Actor Name</label>
	
	<select name="actor_name" id="actor_name">
	<option value = ""></option>
	<?php foreach ($result3 as $row): ?>
		<option><?=$row["actor_name"]?></option>
	<?php endforeach ?>
    </select>
	
	<input type="submit" name="submit" value="Submit">
</form>

<br><a href="index.php">Back to home</a></br>

<?php include "templates/footer.php"; ?>