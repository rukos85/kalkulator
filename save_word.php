<?php
header('Content-Type: text/html; charset= utf-8');
$categories = isset($_POST['category']) ? $_POST['category'] : array();

$word = "<div style=\"font-family: Helvetica, Arial, sans-serif;\"><table cellpadding=\"0\" border=\"1\" cellspacing=\"0\" style=\"width:100%; border-color: #ddd;\">";
$i =1;

foreach($categories as $category) {
	if($category["summa"]!=0)
	{	

		$word .= "<tr><th colspan=\"5\"><div style=\"font-family: Helvetica, Arial, sans-serif; padding:15px; text-align:left; background: #ececec; font-size: 16px;\">$category[name] ($category[summa] руб.)</th></div></tr>";
		$word .= "
		<tr style=\"font-size:13px;\">
				<td><div style=\"padding:5px; font-family: Helvetica, Arial, sans-serif;\"><strong>Наименование работ</strong></div></td>
				<td><div style=\"font-family: Helvetica, Arial, sans-serif; padding:5px; text-align:center\"><strong>Ед. изм.</strong></div></td>
				<td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>Стоимость</strong></div></td>
				<td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>Кол-во</strong></div></td>
				<td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center\"><strong>Сумма</strong></div></td>
				</tr>
		";
		foreach($category["items"] as $items)
		{
			if($items["summa"]!=0)
			{
				$word .="<tr style=\"font-size:12px;\">
				<td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px;\">$items[name]</div></td>
				<td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center;\">$items[ed_izm]</div></td>
				<td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center;\">$items[price]</div></td>
				<td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center;\">$items[kolvo]</div></td>
				<td><div style=\"font-family: Helvetica, Arial, sans-serif;padding:5px; text-align:center;\">$items[summa]</div></td>
				</tr>";
			}
		}
	}
	$i++;
}
$word .="</table>";

$word .="<div style=\"padding:15px; margin-top:30px; font-size:18px; \"><strong>Итого:</strong> ".$_POST['total']." руб.</div></div>";

$d=Date('d.m.Y');
$name_doc = "Ваш прайс-лист ($d)";
//Сгенерировать заголовки, которые упростят браузеру выбор требуемого приложения для визуализации 
header('Content-type: application/msword');
header('Content-disposition: inline; filename='.$name_doc.'.doc'); 

// Открыть файл шаблона 
$filename = 'sample.rtf'; 
$fp = fopen($filename,'r'); 

//прочитать шаблон в перменную 
$output = fread($fp, filesize($filename)); 
fclose($fp); 

//Заменить заполнители в шаблоне требуемыми переменными 
$output = str_replace('<<NAME>>',$word,$output); 
//Отправить сгенерированный документ в браузер 
html_entity_decode(iconv("utf-8", "windows-1251", $output), ENT_QUOTES, "windows-1251");

echo $output;
?>

