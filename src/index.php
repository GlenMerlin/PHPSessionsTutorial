<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Sessions are Cool!</title>
</head>
<body>
    <h1>Hello World!</h1>
    <p>Welcome <?php echo $_SESSION['name']; ?></p>
    <form action="name_process.php" method="post">
        <input type="text" name="name" required/>
        <button class="login-button">Submit</button>
    </form>
</body>
</html>