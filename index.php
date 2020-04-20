<html>
	<head>
		<title>API of Country, State and Cities | CodeIgniter|php</title>
		<meta type="description" content="API of Country, State and Cities | CodeIgniter|php">
		<meta type="keyword" content="API of Country, State and Cities | CodeIgniter|php">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		
	</head>
	<body>
		<div class="container">
			<h1>API of Country, State and Cities | CodeIgniter|php</h1>
				<form>	
					<div class="form-group">
    					<label for="country">Countries</label>				
						<select class="form-control" name="country" id="country">
							<option value="">--Select Country--</option>
							<?php 
								$data = file_get_contents('http://cms.filliptechnologies.com/api/api/countries');							
								$json_data = json_decode($data,true);
								if($json_data['response_code'] == '200' && $json_data['response_msg']='success'){
								for ($i=0; $i < sizeof($json_data['countries']); $i++) { 
							?>
							<option value="<?= @$json_data['countries'][$i]['id'] ?>"><?= ucfirst(@$json_data['countries'][$i]['name']) ?></option>
							<?php } }  ?>
						</select>
					</div>
					<div class="form-group">
    					<label for="state">States</label>	
						<select class="form-control text-capitalize" name="state" id="state">
						</select>
					</div>
					<div class="form-group">
    					<label for="city">Cities</label>	
						<select class="form-control text-capitalize" name="city" id="city">
						</select>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
<script type="text/javascript">
	$("#country").change(function()
	    {
	        var country_id =$(this).val().toString();
	        $.ajax({
			    url:"http://cms.filliptechnologies.com/api/api/states/"+country_id,
			    type:"GET",			   				    
			    success: function(data){
			    	var state_list = '';
			    	state_list ="<option value=''>--Select State--</option>";
			        for (var i = 0; i < data['states'].length; i++){
			    		state_list += "<option value="+data['states'][i]['id']+">"+data['states'][i]['name']+"</option>";
			    	}	
			  		$('#state').html(state_list);		      
			    },
			    error:function(data){
			        alert("error");
			    }
			});
	    });
	$("#state").change(function()
	    {
	        var state =$(this).val().toString();
	        $.ajax({
			    url:"http://cms.filliptechnologies.com/api/api/cities/"+state,	   
			    type:"GET",
			    success: function(data){
			    	//alert(data['city']);
			    	var city_lists = '';
			    	city_lists ="<option value=''>--Select City--</option>";
			        for (var i = 0; i < data['city'].length; i++){
			    		city_lists += "<option value="+data['city'][i]['id']+">"+data['city'][i]['name']+"</option>";
			    	}	
			  		$('#city').html(city_lists);		      
			    },
			    error:function(data){
			        alert("error");
			    }
			});
	    });
</script>



