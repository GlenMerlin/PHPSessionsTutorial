# Setting up PHP Sessions
PHP is a very common programming language, PHP stands for "Personal Home Page" but because it has expanded to power huge sites like Wikipedia and Facebook many refer to it as "Hypertext PreProcessor". PHP sessions are something you've probably used frequently without realizing it, PHP sessions are used on many websites for storing variables and managing user sessions. At the end of this tutorial you will be able to use PHP sessions successfully in your website

# Table of Contents
Know what you're looking for? Use the links below to jump to a specific topic!

<a href="#first-steps">Creating Sessions</a>

<a href="#using-session-variables">Using Session Variables</a>

<a href="#get-vs-post-requests">GET vs. POST requests</a>

<a href="#deleting-php-sessions">Deleting Sessions</a>

<a href="#additional-resources">Additional Resources</a>


# Tools Used
- Visual Studio Code
- HTML
- PHP
- PHP Sessions
- Your Browser of Choice

# First Steps
To get started with sessions, we first need to create a PHP file. If you have an existing website, you can simply change the file extension from .html to .php. This tells the website server that there is code it needs to run inside this file before sending it too the user. I'm going to start off by creating a basic PHP document called `index.php`. Inside this PHP document I'll put some placeholder HTML like so:
```html
<!-- index.php -->
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
This gives me a pretty blank page with just a header of "Hello World!" and a paragraph that just says "Welcome".

Let's add some real PHP code to this page. I'm going to add a form under the "Welcome" paragraph and an external PHP page to process the data so my index.php file now looks like:

```html
<!-- index.php -->
<form action="name_process.php" method="get">
    <input type="text" name="name" required/>
    <button class="login-button">Submit</button>
</form>
```
This form in my index.php file should accept the user's input from the textbox, and then pass the data over to name_process.php
# Using Session Variables:
How do we do this you might ask? It's pretty easy, we just need to use HTTP requests. HTTP (hypertext transfer protocol) has two main functions we'll use. First is a GET request, then I'll show you how to do the same thing with a POST request.

You've likely seen a GET request before without realizing what it is. For example Google Search:

![google search for "what is the weather"](/images/googleSearch.png)

This is a GET request to Google. It's composed of:

The site we want to visit: https://www.google.com/

The page we're on: /search

Then the information we typed into our search bar: ?q=what+is+the+weather+today

GET information is formatted with a `?` then a variable that stores the user information (in this case Google uses q for query), then `=the information we want to pass`

let's take a look at `name_process.php`:
```php
// name_process.php
<?php 
session_start();

$_SESSION['name'] = $_GET['name'];
header("location: index.php")

?>
```
This code is extremely simple. `$_SESSION['name']` creates a session variable called 'stored-name' and sets it equal to the form information pulled from `$_GET` we want the name field's information so `$_SESSION['name']` gets the information from 
```html
<!-- index.php -->
<input type="text" name="name" required/>
```
On the next line, `header` simply redirects the user back to `index.php` after that session has been created.

Here's what the page looks like currently:
![an image of a blank website with an empty form](/images/1.png)

Now we can edit `index.php` to actually be able to use the session variable that we created:
```php
// index.php
<?php 
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
```
`session_start();` will tell the page that there we want to use session variables on this page
> note: `session_start()` ***MUST*** be at the top of the page or the sessions variables will not load properly

Next I'll add some PHP code to handle editing our welcome message to greet the person:

```php
// index.php
<p>Welcome <?php echo $_SESSION['name']; ?></p>
```
Now when the user enters something into the field the page displays:

![an image of our welcome text now displaying welcome John Doe](/images/2.png)


# GET vs. POST requests:
Now a question you might ask is: "if we have GET requests why do we need POST? Are they any different?"

They are different in a small but significant way. The main difference is that because GET requests are put inside the address bar, they can be bookmarked in your browser. However POST requests send the information without showing it in the address bar. This is extremely useful if you want to pass data to the server without the user able to see it or bookmark it.

If you were passing a username and password to the server you wouldn't want that to show up in the address bar where it could be seen in the browser history and couldn't be bookmarked.

---
So let's play around with sessions a bit more. Let's make a new page called `tasks.php`:
```php
// tasks.php
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
And a script page called `add_task.php`:
```php
// add_task.php
<?php
session_start();
$_SESSION['tasks'] += $_GET['amount'];
header('location: tasks.php');
?>
```
This should produce a new site that has the name of the person at the top along with a form the user can fill out. The form contains a number selector and then uses a GET request to send the information to our add_task.php file. The add_task.php file goes through and adds the new amount to the tasks session variable.

Let's add some code to our `index.php` to make it display a message and make this useful:

```php
// index.php
<p>Welcome 
    <?php 
        echo $_SESSION['name']; 
        if ($_SESSION['tasks']){
            echo " you have {$_SESSION['tasks']} tasks!"; 
        }
    ?>
</p>
```
This checks if there is anything in the tasks variable inside the PHP session. If there are, it adds "you have `x` amount of tasks". For example, if John Doe enters his name, and then adds 100 tasks using our forms, the `index.php` page will read:

"Welcome John Doe, you have 100 tasks."

As you can probably see, sessions apply to your entire website and can be accessed on any page. So what is our next logical step? Let's see how we can remove a session variable or simply delete everything.

# Deleting PHP Sessions:
First thing you need to know about PHP sessions is that they have a default TTL (Time to Live) of 30 Minutes [citation needed]. So if you don't want the user to be able to do something to destroy their session you can just have their session expire naturally.

With that out of the way lets get started on the last file we need to complete this tutorial.

Lets set up a page where our user can ask to be forgotten. Let's make a page called `forget_me.php`:

```html
<!-- forget_me.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>

<form action="forget_process.php" method="post">
    <button class="forget-button">Forget Me!</button>
</form>
</body>
```
And the final page we need to make is `forget_process.php`:
```php
//forget_process.php
<?php 
session_start();

unset($_SESSION['tasks']);
header('location: index.php');
?>
```
Now the user should be able to click the "forget me!" button and have all their tasks erased. This doesn't delete everything though so lets do that. To accomplish this we just need to change `unset($_SESSION['tasks']);` to `session_destroy();`

```php
// forget_process.php
<?php
session_start();

session_destroy();
header('location: index.php');
?>
```
Now clicking the button should take the user back to index.php and return the site to it's default state.

Congrats on making it to the end of the tutorial! If you want to learn more about PHP and PHP sessions here are some additional resources that can help!

# Additional Resources:

<a href="https://www.youtube.com/watch?v=a7_WFUlFS94">PHP in 100 Seconds - Fireship (YouTube)</a>

<a href="https://www.codeleaks.io/increase-session-timeout-in-php/"> How to increase session timeout in php - Codeleaks.io </a>


