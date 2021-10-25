	<script type="text/javascript" src="jquery-1.12.1.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script type="text/javascript">
$(function(){
    $('input[name="weight"]').on("keyup", function(event){
		if(event.which) {
			ShowCalc($('select[name="city"]').val(), $('select[name="city2"]').val(), $('input[name="weight"]').val());
		}
	})
});

	
	function selectRegion(){
        var id_country = $('select[name="country"]').val();
        if(!id_country){
                $('select[name="region"]').html('');
                $('select[name="city"]').html('');
        }else{
                $.ajax({
                        type: "POST",
                        url: "classes/ajax.php",
                        data: { action: 'showRegionForInsert', id_country: id_country },
                        cache: false,
                        success: function(responce){ $('select[name="region"]').html(responce); $('select[name="city"]').html("<option label='Выберите регион' selected='true' disabled value=''>"); }
                });
        };
};

	function dublicateInfo(){
		if ($('input[name="dublicate"]').is(':checked')){
			var email = $('input[name="email"]').val();
			var FIO = $('input[name="FIO"]').val();
			var phone = $('input[name="phone"]').val();
			var second_phone = $('input[name="second_phone"]').val();
			var organization = $('input[name="organization"]').val();
			$('input[name="email2"]').attr('value', email); $('input[name="email2"]').attr('readonly', 'readonly');
			$('input[name="FIO2"]').attr('value', FIO); $('input[name="FIO2"]').attr('readonly', 'readonly');
			$('input[name="phone2"]').attr('value', phone); $('input[name="phone2"]').attr('readonly', 'readonly');
			$('input[name="second_phone2"]').attr('value', second_phone); $('input[name="second_phone2"]').attr('readonly', 'readonly');
			$('input[name="organization2"]').attr('value', organization); $('input[name="organization2"]').attr('readonly', 'readonly');
		}
		else{
			$('input[name="email2"]').attr('value', ''); $('input[name="email2"]').removeAttr('readonly');
			$('input[name="FIO2"]').attr('value', ''); $('input[name="FIO2"]').removeAttr('readonly');
			$('input[name="phone2"]').attr('value', ''); $('input[name="phone2"]').removeAttr('readonly');
			$('input[name="second_phone2"]').attr('value', ''); $('input[name="second_phone2"]').removeAttr('readonly');
			$('input[name="organization2"]').attr('value', ''); $('input[name="organization2"]').removeAttr('readonly');
		}
};
	function selectCity(){
        var id_region = $('select[name="region"]').val();
        $.ajax({
                type: "POST",
                url: "classes/ajax.php",
                data: { action: 'showCityForInsert', id_region: id_region },
                cache: false,
                success: function(responce){ $('select[name="city"]').html(responce); }
        });
};
	function getIndex(){
        var id_city = $('select[name="city"]').val();
		ShowCalc($('select[name="city"]').val(), $('select[name="city2"]').val(), $('input[name="weight"]').val());
        $.ajax({
                type: "POST",
                url: "classes/ajax.php",
                data: { action: 'getIndex', id_city: id_city },
                cache: false,
                success: function(responce){ $('input[name="index"]').val(responce); }
        }); 
};

	function selectRegion2(){
        var id_country = $('select[name="country2"]').val();
        if(!id_country){
                $('select[name="region2"]').html('');
                $('select[name="city2"]').html('');
        }else{
                $.ajax({
                        type: "POST",
                        url: "classes/ajax.php",
                        data: { action: 'showRegionForInsert', id_country: id_country },
                        cache: false,
                        success: function(responce){ $('select[name="region2"]').html(responce); $('select[name="city2"]').html("<option label='Выберите регион' selected='true' disabled value=''>");}
                });
        };
};
	
	function selectCity2(){
        var id_region = $('select[name="region2"]').val();
        $.ajax({
                type: "POST",
                url: "classes/ajax.php",
                data: { action: 'showCityForInsert', id_region: id_region },
                cache: false,
                success: function(responce){ $('select[name="city2"]').html(responce); }
        });
};
	function getIndex2(){
        var id_city = $('select[name="city2"]').val();
		ShowCalc($('select[name="city"]').val(), $('select[name="city2"]').val(), $('input[name="weight"]').val());
        $.ajax({
                type: "POST",
                url: "classes/ajax.php",
                data: { action: 'getIndex', id_city: id_city },
                cache: false,
                success: function(responce){ $('input[name="index2"]').val(responce); }
        }); 
};

	function inputWeight(){
		ShowCalc($('select[name="city"]').val(), $('select[name="city2"]').val(), $('input[name="weight"]').val());
	}
	
	function ShowCalc(city1, city2, weight){
		if ((city1>0) & (city2>0) & (weight!='')){
			$.ajax({
					type: "POST",
					url: "classes/ajax.php",
					data: { action: 'showCalc', city1: city1, city2: city2, weight: weight},
					cache: false,
					success: function(responce){ $('div[name="calc"]').html(responce); }
					});
		}
	};

	function selectStatus(id){
        var data = $('select[name="status"][id="'+id+'"]').val();
        $.ajax({
                type: "POST",
                url: "classes/ajax.php",
                data: { action: 'selectStatus', status: data, id: id },
                cache: false
        });
};
		
	function selectCourier(id){
        var data = $('select[name="courier"][id="'+id+'"]').val();
        $.ajax({
                type: "POST",
                url: "classes/ajax.php",
                data: { action: 'selectCourier', courier: data, id: id },
                cache: false
        });
};

	function selectPowerGroup(id){
        var data = $('select[id="'+id+'"]').val();
        $.ajax({
                type: "POST",
                url: "classes/ajax.php",
                data: { action: 'selectPowerGroup', PowerGroup: data, id: id },
                cache: false,
                success: function(responce){ $('input[name="index2"]').val(responce); }
        });
};

	function selectCallbackStatus(id){
        var data = $('select[id="'+id+'"]').val();
        $.ajax({
                type: "POST",
                url: "classes/ajax.php",
                data: { action: 'selectCallbackStatus', Status: data, id: id },
                cache: false,
                success: function(responce){ $('input[name="index2"]').val(responce); }
        });
};

	function inputPrice(id){
        var price = $('input[id="'+id+'"]').val();
        $.ajax({
                type: "POST",
                url: "classes/ajax.php",
                data: { action: 'inputPrice', price: price, id: id  },
                cache: false,
        });
};
</script>