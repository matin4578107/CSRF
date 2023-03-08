Add automaticaly CSRF checker to your project.

Steps to use:

Windows:
1- start "run server.bat" file
2- run example file on berowser
3- CSRF library automaticaly rewrite example file and add CSRF on it


Syntax you must add to your project:
    require_once "./vendor/autoload.php";

    use SRC\CSRF;

    $path_of_forms_page = "example.php";
    $path_of_CSRF_cheker_page = "example.php";
    $length_of_imported_CSRF = 32;
    $csrf = new CSRF();
    $csrf->setCSRF($path_of_forms_page, $path_of_CSRF_cheker_page, );
    $csrf->generate($length_of_imported_CSRF);


