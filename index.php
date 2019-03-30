<?php include("connectdb.php");?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Калькулятор услуг</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
   
		<div class="container">
			<form method='post' action='save_word.php' >
			 <h1>Калькулятор ремонта</h1>
			 <?php 
				$res_category = mysql_query("SELECT *FROM price_cat ORDER BY sort");
				if(mysql_num_rows($res_category)>0)
				{
					?>
					<div class="panel-group" id="accordion">
					<?
					$category = mysql_fetch_array($res_category);
					$i=1;
					do
					{
					?>
					<div class="panel panel-default category">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" class="open_category" aria-expanded="false" data-parent="#accordion" href="#price_cat<?php echo $i;?>"><i class="fa fa-angle-down"></i> <?php echo $category["name"];?> <span class="summa_category"></span></a>
								<input type="hidden" name="category[<?=$i;?>][name]" value="<?php echo $category["name"];?>" />
								<input type="hidden" name="category[<?=$i;?>][summa]" value="" class="summa_category_input" />
							</h4>
						</div>
						<div id="price_cat<?php echo $i;?>" class="panel-collapse collapse">
							<div class="">
								<?php 
									$res_item = mysql_query("SELECT *FROM price_item WHERE catid = '$category[id]'");
									if(mysql_num_rows($res_item)>0)
									{
										?>
										<div class="teble-responsive">
										<table class="table table-striped">
										<th>Наименование работ</th>
										<th style="text-align:center;">Ед. изм.</th>
										<th style="text-align:center;">Стоимость</th>
										<th style="text-align:center;">Кол-во</th>
										<th style="text-align:center;">Сумма</th>
										<?
										$item = mysql_fetch_array($res_item);
										$k=1;
										do
										{
											$price = number_format($item["cost"], 0, '', ' ');
										?>
											<tr>
												<td>
													<span class=""><?php echo $item["name"];?></span>
													<input type="hidden" name="category[<?=$i;?>][items][<?=$k;?>][name]" value="<?php echo $item["name"];?>" />
												</td>
												<td style="text-align:center;">
													<span class=""><?php echo $item["shortdesc"];?></span>
													<input type="hidden" name="category[<?=$i;?>][items][<?=$k;?>][ed_izm]" value="<?php echo $item["shortdesc"];?>" />
												</td>
												<td style="text-align:center;">
													<span class=""><?php echo $price;?></span>
													<input type="hidden" name="category[<?=$i;?>][items][<?=$k;?>][price]" value="<?php echo $item["cost"];?>" />
												</td>
												<td><input type="number" step="0.1" min="0" class="form-control calc" name="category[<?=$i;?>][items][<?=$k;?>][kolvo]" value="" style="width:70px; margin:0 auto;"></td>
												<td><input type="text" readonly="readonly" class="form-control item_summa" name="category[<?=$i;?>][items][<?=$k;?>][summa]" value="" style="width:80px; margin:0 auto; text-align:center;"></td>
											</tr>
										<?	
										$k++;
										}
										while($item = mysql_fetch_array($res_item));
										?>
										</table>
										</div>
										<?
									}
								?>
							</div>
						</div>
						<div class="panel-body" style="border-top:1px solid #ddd;">
							<div class="pull-right">
								<div><strong>Итого:</strong> <big class="summa_category">0</big> руб.</div>
							</div>
						</div>
					</div>
					<?
					$i++;
					}
					while($category = mysql_fetch_array($res_category));
					?>
					</div>
					<?
				}
			 ?>
			
			<div class="panel-body well well-sm">
				<div class="row">
					<div class="col-xs-12 col-md-6 "><button class="btn btn-primary btn-sm" name="save_word">Сохранить в WORD документ</button></div>
					<div class="col-xs-12 col-md-6">
						<div class=" pull-right" style="font-size:20px;">
							<strong>Итого:</strong> <span class="total">0</span> руб.
							<input type="hidden" name="total" class="total_input" value="" />
						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
		
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/calculator.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>