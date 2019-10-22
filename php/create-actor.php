<?php if (isset($_POST['submit'])) {
	require "C:/Users/elfy_/Desktop/faculta/Databases/projects/php/config.php";
    require "common.php";
	
	try {
		$connection = new PDO($dsn, $username, $password, $options);
		// insert new user code will go here
		$new_actor = array(
	"actor_name" => $_POST['actor_name'],
	"birthdate"  => $_POST['birthdate'],
	"birthplace"     => $_POST['birthplace'],
	"gender"       => $_POST['gender'],
);

$sql = sprintf(
		"INSERT INTO %s (%s) values (%s)",
		"actors",
		implode(", ", array_keys($new_actor)),
		":" . implode(", :", array_keys($new_actor))
);

$statement = $connection->prepare($sql);
$statement->execute($new_actor);

	} catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
	
} ?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
	<blockquote><?php echo $_POST['actor_name']; ?> successfully added.</blockquote>
<?php } ?>

<h2>Add a new actor</h2>

<form method="post">
	<label for="actor_name">Name</label>
	<input type="text" name="actor_name" id="actor_name">
	<label for="birthdate">Birthdate</label>
	<input type="text" name="birthdate" id="birthdate" placeholder="yyyy-mm-dd" required 
pattern="(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))" 
title="Enter a birthdate in this format YYYY-MM-DD"> 
	<label for="birthplace">Birthplace</label>
	<input type="text" name="birthplace" id="birthplace">
	<label for="gender">Gender</label>
<select name="gender" id="gender">
    <option value="1">male</option>
    <option value="2">female</option>
</select>
	<input type="submit" name="submit" value="Submit">
</form>

<br><a href="index.php">Back to home</a></br>

<?php include "templates/footer.php"; ?>