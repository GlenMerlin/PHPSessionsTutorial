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
    <h1>Welcome <?php echo $_SESSION['name']?></h1>
    <h3>Tasks</h3>
    <p>Lets add some tasks!</p>
    <form action="add_task.php" method="get">
        <input type="number" name="amount" required/>
        <button class="submit-button">Submit</button>
    </form>
</body>
</html>