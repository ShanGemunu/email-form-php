<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="script.php">
      <label for="name">Name</label>
      <input id="name" name="name" type="text"><br>
      <label for="email">Email</label>
      <input id="email" name="email" type="email"><br>
      <label for="subject">Subject</label>
      <input id="subject" name="subject" type="text"><br>
      <label for="message">Message</label>
      <input id="message" name="message" type="text"><br>
      <button type="submit" name="submit-button">Send Mail</button>
    </form>
</body>
</html>