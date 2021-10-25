<?php
function __autoload($class_name) {
	$filename = strtolower($class_name) . '.php';
	$file = site_path . 'classes' . DIRSEP . $filename;	
	//print_r(realpath(dirname(__FILE__));
	//$file = 'http:'. DIRSEP . DIRSEP .'89cargotaxi.mcdir.ru'. DIRSEP .'classes'. DIRSEP .'registry.php';
	if (file_exists($file) == false) {
			return false;
	}
	include ($file);
}

	
error_reporting (E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// Константы:
define ('DIRSEP', DIRECTORY_SEPARATOR);
// Узнаём путь до файлов сайта
$site_path = realpath(dirname(__FILE__) . DIRSEP . '..' . DIRSEP) . DIRSEP . 'httpdocs' . DIRSEP; //TODO при переезде возможны ошибки с 'www'
//print_r($site_path);
define ('site_path', $site_path);
# Создаём регистратуру
$registry = new Registry;
$registry->set ('site_path', $site_path);
# Соединяемся с БД
$db = new db($registry);
$registry->set ('db', $db);
# Загружаем контроллер таблицы пользователей
$users = new users($registry);
$registry->set ('users', $users);
# Загружаем контроллер таблицы заданий
$tasks = new tasks($registry);
$registry->set ('tasks', $tasks);
# Создаём объект шаблонов
$template = new Template($registry);
$registry->set ('template', $template);
# Загружаем контроллер отправки почты
$email = new email($registry, $registry['admin_mail']);
$registry->set ('email', $email);
//functions
session_start();

if (isset($_POST["reg"])){
	$manage = new Manege ($registry);
	$r = $manage->regUser();
	$manage->redirect($r);
}
elseif (isset($_POST["setup"])){
	$manage = new Manege ($registry);
	$r = $manage->editUser();
	$manage->redirect($r);
}
elseif (isset($_POST["saveTasks"])){
	$manage = new Manege ($registry);
	$r = $manage->saveTasks();
	$manage->redirect($r);
}
elseif (isset($_POST["editUser"])){
	$manage = new Manege ($registry);
	$r = $manage->editUser();
	$manage->redirect($r);
}
elseif (isset($_POST["auth"])){
	$manage = new Manege ($registry);
	$r = $manage->login();
	$manage->redirect($r);
}
elseif (isset($_GET["logout"])){
	$manage = new Manege ($registry);
	$r = $manage->logout();
	$manage->redirect($r);
}
elseif (isset($_GET["deleteUser"])){
	$manage = new Manege ($registry);
	$r = $manage->deleteUser($_GET["deleteUser"]);
	$manage->redirect($r);
}
elseif (isset($_POST["forgetpass"])){
	$manage = new Manege ($registry);
	$r = $manage->forgetpass();
	$manage->redirect($r);
}

# Загружаем router
$router = new Router($registry);
$registry->set ('router', $router);
$router->setPath (site_path . 'controllers');
$router->delegate();
?>