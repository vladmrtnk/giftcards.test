Instruction to use the application:

1. Pull the repository
2. `composer dump-autoload` - to generate autoload files
3. You have to **json_encode** your testing array with data, and copy the file with json to the project like: _test.json_
4. Then you can run the application using `php index.php` and paste path to the file like: _test.json_
    
The application is small, and I didn't use any router. In first entry point creates an object of CliController and execute exec method.
