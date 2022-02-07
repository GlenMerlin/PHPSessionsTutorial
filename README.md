# Setting up PHP Sessions
PHP sessions are something you've probably used frequently without realizing it, PHP sessions are used on many websites for storing variables and managing user sessions. At the end of this tutorial you will be able to use php sessions successfully in your website

# Tools used
- Visual Studio Code
- HTML
- PHP
- PHP Sessions
- Firefox

# First Steps
Lets get started, lets start off with a basic PHP document like this called index.php
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Sessions are Cool!</title>
</head>
<body>
    <h1>Hello World!</h1>
    <p>Welcome</p>
</body>
</html>
```
> if you're thinking "wait, this looks like standard html" you're correct, all valid html is valid php but not vice versa

Lets add some real php code to this page, I'm going to add a form and an external php page to process the data so my index.php file now looks like

```html
<form action="name_process.php" method="post">
    <input type="text" name="name" required/>
    <button class="login-button">Submit</button>
</form>
```
This form in my index.php file should accept the user's input from the textbox, and then pass the data over to name_process.php

lets take a look at name_process.php
```php
<?php 
session_start();

$_SESSION['name'] = $_POST['name'];
header("location: index.php")

?>
```
This code is extremely simple, `$_SESSION['name']` creates a session variable called 'stored-name' and sets it equal to the form information pulled from `$_POST` we want the name field's information so `$_SESSION['name']` gets the information from 
```html
<input type="text" name="name" required/>
```
after that header simply redirects the user back to index.php after that session has been created.

here's what it looks like currently.
![an image of a blank website with an empty form](/images/1.png)

Now we can edit index.php to actually be able to use the session variable that we created
```php
<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
```
`session_start();` will tell the page that there we want to use session variables on this page
> note: `session_start()` ***MUST*** be at the top of the page or the sessions variables will not load properly

Next I'll add some php code to handle editing our welcome message to greet the person

```php
<p>Welcome <?php echo $_SESSION['name']; ?></p>
```
Now when the user enters something into the field the page displays

![an image of our welcome text now displaying welcome John Doe](/images/2.png)

