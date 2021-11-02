<?php
// импорт файла
 include_once 'includes/functions.php';

/*Запрос к базе данных на получение всех пользователей
 	// $statement = $db->query("SELECT * FROM `users`;");
   //все пользователи размещаются в массиве
	// $users=$statement->fetchAll();''
	$users=db_query("SELECT * FROM `users`;")->fetchAll();

// //запрос к базе данных на получение количества пользователей
// 	$statement = $db->query("SELECT COUNT(id) FROM `users`;");
//  //все пользователи размещаются в массиве,просто количество 
	// $users_count=$statement->fetchColumn();

	//запрос к базе данных на получение количества переходов по ссылкам
// 	$statement = $db->query("SELECT SUM(`views`) FROM `links`;");
//  //все переходы по ссылкам размещаются в массиве,просто количество 
// 	$views_count=$statement->fetchColumn();


	// //запрос к базе данных на получение количества ссылок в системе
	// $statement = $db->query("SELECT COUNT(id) FROM `links`;");
	// //все пользователи размещаются в массиве,просто их количество 
	// $links_count=$statement->fetchColumn();



	// if(isset($_GET['url'])){
	// 	echo $_GET['url'];
	// }else{
	// 	echo ("keine url vorhanden");
	// } */

	// передача целой ссылки ''''
	$users_count=get_user_count();
	$links_count = get_links_count();
	$views_count = get_views_count();

 ?>

<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
				content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
	<title><?php echo SITE_NAME;?> - 404 Not found</title>
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
				<a class="navbar-brand" href="<?php echo get_url(); ?>"><?php echo SITE_NAME;?></a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="<?php echo get_url()?>">Главная</a>
						</li>
					</ul>
					<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a href="<?php echo get_url('login.php')?>" class="btn btn-primary">Войти</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
 <!-- <?php var_dump($users);?> -->