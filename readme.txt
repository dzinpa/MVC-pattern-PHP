MVC pattern 
		
1. Fail .htacces ->contains the redirection path commands and file name (index.php)
! The server must have the rewrite module function enabled

2. Fail index.php -> FrontController (general settings, connecting system files and calling the class Router)

3. Folder config
		Fail routes.php -> stores routes as an array used in the Router class
		Fail db_params.php -> stores an array with database parameters used in class Db

4. Folder components
		Fail (Class) Db.php -> Connecting to the database
		Fail (Class) Router.php -> takes control from FrontControllera -> uses routes.php to determine: which controller and which action processes the request and calls the desired method from the file controllers

5. Folder controllers
		Contains files with a class whose methods receive data from models and pass the result to the desired file from the folder view

 6. Folder models
		Contains files with a class whose methods implement the request to the database and return either an array or a string with the result that is passed to the class of controllers
 
 7. Folder view
		Contains files with html code
 