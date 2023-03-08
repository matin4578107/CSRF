<?php
    require_once "./vendor/autoload.php";

    use SRC\CSRF;

    $path_of_forms_page = "index.php";
    $csrf = new CSRF();
    // $csrf->setCSRF($path_of_forms_page);
    if(isset($_POST["CSRF"])) {
	    if($_POST["CSRF"] == $_SESSION["CSRF"]) {
		    /*Write code here*/
	    } else {
		    echo("CSRF Token not valid!!!");
	    }
    }
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
    
	    <input type="text" name="CSRF" value="<?php echo($_SESSION["CSRF"]); ?>" hidden>
    </form>

    <form method="post">
        <input type="text" name="username">
        <input type="password" name="password">
        <button type="submit">Submit</button>
    
	    <input type="text" name="CSRF" value="<?php echo($_SESSION["CSRF"]); ?>" hidden>
    </form>

    <form method="post">
	    <input type="text" name="CSRF" value="<?php echo($_SESSION["CSRF"]); ?>" hidden>
    </form>
</body>
</html>