<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Смарт 1С</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<?
require_once('PHPClasses/TEmail.php');
function output_err($err) {

}
if (isset($_POST["submit"])) {

        $_POST['usermail'] =  substr(htmlspecialchars(trim($_POST['usermail'])), 0, 50);
        $_POST['username'] =  substr(htmlspecialchars(trim($_POST['username'])), 0, 30); 
        $_POST['usertel'] =  substr(htmlspecialchars(trim($_POST['usertel'])), 0, 30); 
        $error = false;
        // если не заполнено поле "Имя" - показываем ошибку 0 
        if (empty($_POST['username'])) 
        {
              $error = true; 
             output_err(0); 
        }  
        // если неправильно заполнено поле email - показываем ошибку 1 
        if(!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $_POST['usermail']))
        {
              $error = true; 
             output_err(1); 
        }  
      // если не заполнено поле "Телефон" - показываем ошибку 2 
        if(empty($_POST['usertel'])) 
        {
              $error = true; 
             output_err(2); 
        }  
        if (!$error)
        {        
          $email=new TEmail;
          $email->from_email='webmaster@smart1c.net';
          $email->from_name="constanta.dn.ua";
          $email->to_email='info@constanta.dn.ua';
          $email->to_name='Константа 1С';
          $email->subject='Клиент';
          $email->body="Клиент ".$_POST["username"]."\r\nEmail: ".$_POST["usermail"]."\r\nТелефон: ".$_POST["usertel"]."\r\n";
          if ($email->send())
          {
	      header("Location: http://".$_SERVER["SERVER_NAME"]."/?ver=OK");
	  } else {
		 output_err(3);
	  }
        }
}
?>
	<div class="header">
		<div class="company-logo">
			<div class="contacts">
				<div class="sign-request">Звоните нам Пн-Пт с 9.00 до 18.00:</div>
				<div class="phone-logo"></div>
				<div class="phone"><b>+38 (062) 200 10 70</b></div>
				<div class="phone"><b>+38 (050) 754 77 66</b></div>
				<!--div class="phone"><b>+38 (093) 708 00 13</b></div-->
			</div>
			<img width="300" src="images/logo.jpg" alt="" class="logo">
			<!--div class="logo"></div>
			<div class="name">Константа</div-->
		</div>
		<div class="wrapper">
			<div class="title">
				<h3>сдача отчетности в электронном виде</h3>
				<h5>Без походов! Без очередей! В удобное для Вас время!</h5>
				<div class="line"></div>
				<form action="index.php" class="request" method="POST">
					
					<div class="sign-request">Оставьте свои контактные данные, и наши менеджеры с Вами свяжутся:</div>
					<div class="form-data">
						<input type="text" placeholder="Ваше имя" name="username" required>
						<input type="tel" placeholder="Ваш телефон" name="usertel" required>
						<input type="email" placeholder="Ваша почта" name="usermail" required>
						<input type="submit" name="submit" value="ОТПРАВИТЬ КОНТАКТЫ">
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="content">
		<h2 class="h2">Отчеты и релизы:</h2>
		<table border="0" cellspacing="0" class="releases">
			<tr>
				<th>Дата</th>
				<th>Название</th>
				<th>Номер релиза</th>
			</tr>
			<tr>
				<td>01.12.2015</td>
				<td>Отчет по <b>НДФЛ / 1ДФ</b></td>
				<td>5.0.0</td>
			</tr>
			<tr>
				<td>01.12.2015</td>
				<td>Отчет по <b>ЕСВ</b></td>
				<td>5.0.0</td>
			</tr>
			<tr>
				<td>01.12.2015</td>
				<td>Декларация по <b>прибыли</b></td>
				<td>5.0.0</td>
			</tr>
		</table>

		<div class="prices">Цены доступны для скачивания по <a href="http://constanta.dn.ua/Constanta_prices.xlsx">ссылке</a></div>
	</div>	
	<div class="footer">
		<div class="wrapper">
			<div class="contacts">
				<span>Наш адрес: </span>
				<div class="address">г. Донецк, ул. Артема, 41, 2й этаж</div>
				<a href="ymaps.html" target="_blank">
					<img src="https://api-maps.yandex.ru/services/constructor/1.0/static/?sid=bb3hTP9VUy7C9wgcKgzAPw1G9TMzZxIP&width=320&height=240&lang=ru_UA&sourceType=constructor" alt=""/>
				</a>
			</div>
			<div class="phones">
				<span>Наши контакты:</span><br /><br />
				<span class="phone-number">
					+38 (062) 381 31 31<br />
					+38 (062) 200 10 70<br />
					+38 (093) 708 00 13<br />
					+38 (050) 754 77 66
				</span><br /><br />
				<a href="mailto:info@constanta.dn.ua"><span>info@constanta.dn.ua</span></a>
				<br />
				<br />
				<span>Режим работы:</span><br />
				<span>Пн - Пт - 9:00 -18:00</span><br />
				<span>Сб, Вс - выходные</span><br />
				
			</div>
		</div>
	</div>
</body>
</html>