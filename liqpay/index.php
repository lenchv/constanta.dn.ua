<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>liqpay</title>
</head>
<body>
<?
require_once("LiqPay.php");
$public_key = "i25631454158";
$private_key = 'dhUqpFZPAE50mqm8qx8CNjOd6FuJsbPROx6uTumS';
if (isset($_POST['PAY']))
{
	require_once("LiqPay.php");
	$order_id = date("d/m/Y-H:i:s");

	echo "<pre>";
	print_r(array(
		'version'	=>	'3',
		'amount'	=>	'1',
		'currency'	=>	'UAH',
		'description'	=>	'test',
		'sandbox'	=>	'1',
		'ip'	=> $_SERVER["REMOTE_ADDR"],
		'card'		=>	$_POST['card'],
		'card_exp_month'	=>	$_POST['card_exp_month'],
		'card_exp_year'	=>	$_POST['card_exp_year'],
		'card_cvv'	=>	$_POST['card_cvv'],
		'order_id'	=>	$order_id,
		'phone'	=>	$_POST['phone']
	));
	echo "</pre>";

	$liqpay = new LiqPay($public_key, $private_key);
	/*$res = $liqpay->api("payment/pay", array(
		'version'	=>	'3',
		'amount'	=>	'1',
		'currency'	=>	'UAH',
		'description'	=>	'test description',
		'sandbox'	=>	'1',
		'ip'	=> $_SERVER["REMOTE_ADDR"],
		'order_id'	=>	$order_id,

		'card'		=>	$_POST['card'],
		'card_exp_month'	=>	$_POST['card_exp_month'],
		'card_exp_year'	=>	$_POST['card_exp_year'],
		'card_cvv'	=>	$_POST['card_cvv'],
		'phone'	=>	$_POST['phone']
	));*/
	$res = $liqpay->api("payment/pay", array(
	    'version'        => 3,
	    'phone'          => '380999088149',
	    'amount'         => '1.0',
	    'currency'       => 'UAH',
	    'description'    => 'description text',
	    'order_id'       => date("Y-m-d H:i:s"),
	    'card'           => '6762466002262184',
	    'card_exp_month' => '07',
	    'card_exp_year'  => '20',
	    'card_cvv'       => '577',
	    'public_key'	 =>	$public_key,
	    'type'			 =>	'buy',
	    'sandbox'		 =>	'1',

	    'prepare'	=> '1',
	    'ip'	=> $_SERVER["REMOTE_ADDR"],
	    'product_url' => 'http://site4/',
	    'server_url'	=> 'http://site4/',
	    'result_url'	=> 'http://site4/',
	    'sender_first_name' => 'vladimir',
	    'sender_last_name'	=> 'lench',
	    'sender_country_code' => '804',
	    'sender_city' => 'Donetsk',
	    'sender_address' => 'addr',
	    'sender_postal_code' => '83146'

	  ));


/*
product_url	no	String		Адрес страницы с товаром
server_url	no	String		URL API в Вашем магазине для уведомлений о изменении статуса платежа (сервер->сервер). Максимальная длина 510 символов. Подробнее
result_url	no	String		URL в Вашем магазине на который покупатель будет переадресован после завершения покупки. Максимальная длина 510 символов.
sender_first_name	no	String		Имя отправителя
sender_last_name	no	String		Фамилия отправителя
sender_country_code	no	String		Страна отправителя. Цифровой ISO 3166-1 код
sender_city	no	String		Город отправителя
sender_address	no	String		Адрес отправителя
sender_postal_code	no

*/

	echo "<pre>";
	print_r($res);
	echo "</pre>";
	if ($res->status == "otp_verify")
	{
		/*$token = $res["token"];
		$res = $liqpay->api("payment/api", array(
			'version'	=>	'3',
			'token'		=>	$token,

			'otp'
		));*/
	} 
	else if ($res->status == 'error')
	{
		/*$res = $liqpay->api("reports/json", array(
		'version'   => '3',
		'date_from' => (time()-60*60*3)*1000,
		'date_to'   => time()*1000
		));
		echo "<pre>";
		print_r($res);
		echo "</pre>";*/
	} 
} else {
?>
	<form action="" method="POST">
		<label for="card">№ карты</label><input type="text" name="card"><br />
		<label for="card_cvv">CVV</label><input type="text" name="card_cvv"><br />
		<label for="phone">Phone</label><input type="text" name="phone"><br />
		<label for="card_exp_month">Месяц срока действия карты</label>
		<select name="card_exp_month">
			<option value="01">1</option>
			<option value="02">2</option>
			<option value="03">3</option>
			<option value="04">4</option>
			<option value="05">5</option>
			<option value="06">6</option>
			<option value="07">7</option>
			<option value="08">8</option>
			<option value="09">9</option>
			<option value="10">10</option>
			<option value="11">11</option>
			<option value="12">12</option>
		</select>
		<label for="card_exp_year">Год срока действия карты</label>
		<select name="card_exp_year">
			<option value="2015">2015</option>
			<option value="2016">2016</option>
			<option value="2017">2017</option>
			<option value="2018">2018</option>
			<option value="2019">2019</option>
			<option value="2020">2020</option>
			<option value="2021">2021</option>
			<option value="2022">2022</option>
			<option value="2023">2023</option>
		</select>
		<input type="submit" name="PAY" value="pay">
	</form>
	<!--form method="POST" action="https://www.liqpay.com/api/checkout">
		<input type="hidden" name="data" value="<?=$data?>">
		<input type="hidden" name="signature" value="<?=$signature?>">
		<input type="submit" value="Ok">
	</form-->
	<?$liqpay = new LiqPay($public_key, $private_key);
		$html = $liqpay->cnb_form(array(
			'version'        => '3',
			'amount'         => '1',
			'currency'       => 'UAH',
			'description'    => 'description text',
			'order_id'       => date("Y-m-d H:i:s"),
			'sandbox'	=>	'1'
		));
		echo $html;

		$html = $liqpay->cnb_form(array(
		  'version'		   => '3',
	      'action'         => 'pay',
	      'amount'         => '1',
	      'currency'       => 'UAH',
	      'description'    => 'description text',
	      'order_id'       => date("Y-m-d H:i:s"),
	      'sandbox'		   => '1'
	    ));

	    echo $html;
	?>
<?}?>
</body>
</html>