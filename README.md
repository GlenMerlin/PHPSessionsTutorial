# Setting up PHP Sessions
PHP sessions are something you've probably used frequently without realizing it, PHP sessions are used on many websites for storing variables and managing user sessions. At the end of this tutorial you will be able to use php sessions successfully in your website

# Tools used
- Visual Studio Code
- HTML
- PHP
- PHP Sessions
- Your Browser of Choice

# First Steps
To get started with sessions we first need to create a php file. If you have an existing website you can simply change the file extension from .html to .php. I'm going to start off by creating a basic PHP document called index.php. Inside this php document I'll put some placeholder HTML like so:
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
This gives me a pretty blank page with just a header of "Hello World!" and a pargraph that just says "Welcome".

Lets add some real php code to this page, I'm going to add a form and an external php page to process the data so my index.php file now looks like

```html
<form action="name_process.php" method="get">
    <input type="text" name="name" required/>
    <button class="login-button">Submit</button>
</form>
```
This form in my index.php file should accept the user's input from the textbox, and then pass the data over to name_process.php

How do we do this you might ask? It's pretty easy, we just need to use HTTP requests. HTTP (hyper text transfer protocol) has two main functions we'll use. First is a GET request, then I'll show you how to do the same thing with a POST request.

You've likely seen a GET request before without realizing what it is. For example Google Search.

![google search for "what is the weather"](/images/googleSearch.png)

This is a GET request to google. It's composed of
The site we want to visit: https://www.google.com/
The page we're on: /search
Then the information we typed into our search bar: ?q=what+is+the+weather+today

GET information is shown as a `?` then a variable that stores the user information (in this case Google uses q for query), then `=the information we want to pass`

lets take a look at name_process.php
```php
<?php 
session_start();

$_SESSION['name'] = $_GET['name'];
header("location: index.php")

?>
```
This code is extremely simple, `$_SESSION['name']` creates a session variable called 'stored-name' and sets it equal to the form information pulled from `$_GET` we want the name field's information so `$_SESSION['name']` gets the information from 
```html
<input type="text" name="name" required/>
```
after that header simply redirects the user back to index.php after that session has been created.

here's what the page looks like currently.
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

--- 

Now a question you might have is: "if we have GET requests why do we need POST? Are they any different?"

They are different in a small but significant way. The main difference is that because GET requests are put inside the address bar, they can be bookmarked in your browser. However POST requests send the information without showing it in the address bar. This is extremely useful if you want to pass data to the server without the user able to see it or bookmark it.

If you were passing a username and password to the server you wouldn't want that to show up in the address bar where it could be seen in the browser history and couldn't be bookmarked.

---
So lets play around with Sessions a bit more. Lets make a new page called `tasks.php`.
```php
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
```
and a script page called add_task.php
```php
<?php
session_start();
$_SESSION['tasks'] += $_GET['amount'];
header('location: tasks.php');
?>
```
This should produce a new site that has the name of the person at the top along with a form they can fill out. 