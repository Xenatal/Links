<?php 
require_once 'includes/header.php';
// если переменная установлена и не пустая, то есть передана, то 
if (isset($_GET['url']) && !empty($_GET['url'])) 
{
	//проверка на корркетность: пропись и убрать лишние пробелы
	$url = strtolower(trim($_GET['url']));
   // $sql_link = db_query("SELECT * FROM `links` WHERE `short_link`='$url';")->fetch();
		// ToDo экранирование 


	 $sql_link = get_link_info($url);

	// переадресация. проверка когда ничего не найдено
	if(empty($sql_link)) {
		//echo "Der Link wurde nicht gefunden";
		header('Location:404.php');
		die;
	}	

	update_views($url);
	echo ('counter');
	header('Location:' . $sql_link['long_link']);
	die;
}
	//добавление к количеству просмотров
	// db_query("UPDATE `links` SET `views` = `views`+ 1 WHERE `short_link` = '$url';", true);
	// получение ссылки
	//echo $sql_link['long_link'];
// 	// переадресация на сайт по короткой ссылке
// 	header('Location: ' . $sql_link['long_link']);
// 	die;
// 	// var_dump($sql_link['long_link']);

//  else {
// 	 // заходим в базу данных
// 	 //echo 'url ist vorhanden aber leer';
//  }
include 'includes/header.php';
echo $_SESSION['error'];
?>

<main class="container">
	<div class="row mt-5">
		<div class="col">
			<h2 class="text-center">Необходимо <a href="<?php echo get_url('register.php')?>">зарегистрироваться</a> или <a href="<?php echo get_url('login.php')?>">войти</a> под своей учетной записью</h2>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col">
			<h2 class="text-center">Пользователей в системе: <?php echo $users_count; ?></h2>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col">
			<h2 class="text-center">Ссылок в системе: <?php echo $links_count; ?></h2>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col">
			<h2 class="text-center">Всего переходов по ссылкам: <?php echo $views_count; ?></h2>
		</div>
	</div>

</main>
	<?php include 'includes/footer.php';?> 

