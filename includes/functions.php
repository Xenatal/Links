<?php include_once 'includes/config.php';?>
<?php
function get_url($page='') {
   return HOST . " /$page";
}

    //подключение к БД
function db(){
try {
return new PDO ("mysql:host=" . DB_HOST . ";
 dbname=".DB_NAME . ";
charset=utf8",
DB_USER,
DB_PASS, [
PDO::ATTR_EMULATE_PREPARES => false,
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO:: FETCH_ASSOC
]);
} catch (PDOEXCEPTION $e){
   die($e->getMessage());
}
}

   //запрос к базе данных на получение данных
function db_query($sql='', $exec = false){
   // empty- пустой
   if (empty($sql)) return false;
    if ($exec) 
    {
      return db()->exec($sql);
    }
    else 
    // SELECT - всегда query
      return db()->query($sql);

    //$statement = db()->query(sql);
   // $users=$statement;
}

	// запрос, обновляющий количество просмотров в бд
   // function db_exec($sql='') {
   //    if (empty($sql)) return false;
   //    return db()->exec($sql);
   
   // }
// UPDATE `links` SET `views` = `views`+ 1 WHERE `short_link` = 'asd' 

function get_user_count(){
   return db_query("SELECT COUNT(id) FROM `users`;")->fetchColumn();
}

function get_views_count(){
 return db_query("SELECT SUM(`views`) FROM `links`;")->fetchColumn();
}

function get_links_count() {
 return db_query("SELECT COUNT(id) FROM `links`;")->fetchColumn();
}

// проверка на наличие такой ссылки в системе
function get_link_info($url) {
     // если передан пустой url, то сразу выходим пустрой массив:
   if (empty($url)) return [];
 // иначе * (long link)
   return db_query ("SELECT * FROM `links` WHERE `short_link` = '$url';")->fetch(); 
}

// проверка на ниличие пользователя в системе
function get_user_info($login) {
   // если передан пустой url, то сразу выходим пустой массив:
 if (empty($login)) return [];
// иначе
 return db_query ("SELECT * FROM `users` WHERE `login` = '$login';")->fetch(); 
}


function update_views($url){
   // если передан пустой url, то сразу выходим:
  if (empty($url)) return false;

  return db_query("UPDATE `links` SET `views` = `views`+ 1 WHERE `short_link` = '$url';", true);
}

function add_user ($login,$psw){
   // для select не указываем true--в остальных надо 
  // $login,$psw это параметры функции, локальные переменные, видны только внутри функции 
   // echo md5($psw);
   $psw = password_hash($psw, PASSWORD_DEFAULT);
   echo $psw;
   die;

   return db_query("INSERT INTO `users` (`id`, `login`, `psw`) VALUES (NULL, '$login', '$psw');", true);
}

function register_user($auth_data)
{
   //если поле пользователя пустое или логин не установлен или он пустой. Или пароли также не установлены (!empty..)
   if (empty($auth_data) || !isset($auth_data['login']) || empty($auth_data['login']) || !isset($auth_data['pass']) || !isset($auth_data['pass2'])) return false; 

   $user = get_user_info($auth_data['login']);
   //если переменная $user не пустая, то обновляем страницу и выводим в первоначальное состояние форму 
      if(!empty($user)){
      $_SESSION['error']="Пользователь '".$auth_data['login'] ."'уже существует";
      header('Location:register.php');
      die;
   }

   // если пароли не совпадают, то выдаем сообшение об ошибке
   //Здесь параметры приходят к нам из form и поля д.б.соответствующе названы required name="";
   if ($auth_data['pass']!== $auth_data['pass2']){
      $_SESSION['error']="Пароли не совпадают";
      header('Location:register.php');
      die;
   }

   //ToDo логин не должен быть пустым

   //добавление пользователя.сначала в бд
//  вызов фунции add_user(). Конкретные значения, не сами переменные!!!-аргументы $auth_data['login'], $auth_data['pass'], которые передаются в функцию
  add_user($auth_data['login'], $auth_data['pass']);
//   echo 'probe';
   return true;
   }



