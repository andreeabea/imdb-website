<!doctype html>
<?php include "templates/header.php"; ?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  display: block;
  margin: 70px 0;
  height: 100%;
  width: 700px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 160px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>

<div class="sidenav">

    <a href="create.php"><strong>Create</strong> - add a TV show</a>
	<a href="create-actor.php"><strong>Create</strong> - add an actor</a>
	<a href="create-tvshow-actors.php"><strong>Create</strong> - add actors to a TV show</a>
	<a href="read-tvshow.php"><strong>Read</strong> - find a TV show</a>
	<a href="read-tvshow-year.php"><strong>Read</strong> - find a TV show by apparition year</a>
	<a href="read-tvshow-genre.php"><strong>Read</strong> - find a TV show by genre</a>
	<a href="read-tvshow-actors.php"><strong>Read</strong> - find actors that starred in a TV show</a>
	<a href="update.php"><strong>Update</strong> - edit a TV show's information</a>
	<a href="update-actor.php"><strong>Update</strong> - edit an actor</a>
    <a href="delete.php"><strong>Delete</strong> - delete a TV show</a>
	<a href="delete-actor.php"><strong>Delete</strong> - delete an actor</a>

<?php include "templates/footer.php"; ?>