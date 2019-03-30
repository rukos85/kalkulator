$(function(){
	// смена стрелочки у категории
	$(".open_category").click(function(){
		var status = $(this).attr("aria-expanded")
		if(status=="false")
		{
			$(this).find("i").attr("class","fa fa-angle-up");
		}
		else
		{
			$(this).find("i").attr("class","fa fa-angle-down");
		}
	})
	
	
	// событие при наборе кол-ва в калькуляторе
	$(".calc").on("change keyup", function(){
		var value = $(this).val();
		var price = $(this).parent().prev().find("input").val();
		price = price.replace(/\s/g, ''); // удаляем пробелы
		var item_summa = value*price;
		item_summa = item_summa.Crop(2); // 2 знаka после запятой
		$(this).parent().next().find("input").val(item_summa);
		
		
		var summa_category = 0; // сюда будем загонять сумму в каждоый категории
		var total_summa = 0; // сюда будем загонять итоговую сумму
		var item_summa_category = $(this).parents("table").find("input.item_summa");
		
		$(item_summa_category).each(function(){
			var k = parseFloat($(this).val());
			if(!k || k==0){k=0;}
			summa_category += k;
			console.log(k);
		})
		
		$(this).parents(".category").find(".summa_category").text(summa_category);
		$(this).parents(".category").find(".summa_category_input").val(summa_category);
		
		$("big.summa_category").each(function(){
			var t = parseFloat($(this).text());
			if(!t || t==0){t=0;}
			total_summa += t;
			
		})
		
		$(".total").text(total_summa);
		$(".total_input").val(total_summa);
		
	})
	
})

Number.prototype.Crop = function (x){
	var s = this+'', a = s.split('.');
	a[1]=a[1]||'';      
	return parseFloat(a[0]+'.'+a[1].substring(0,x));
}