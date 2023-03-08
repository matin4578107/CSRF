<?php
    require_once "./vendor/autoload.php";

    use SRC\CSRF;

    $path_of_forms_page = "index.php";
    $csrf = new CSRF();
    $csrf->setCSRF($path_of_forms_page);
    $csrf->generate();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>
    <form method="post">
        <input type="text" name="name">
        <button type="submit">Submit</button>
    </form>

    <form method="post">
        <input type="text" name="username">
        <input type="password" name="password">
        <button type="submit">Submit</button>
    </form>
</body>
</html>