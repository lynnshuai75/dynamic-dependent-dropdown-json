<!-- 
== name == JSON - Dynamic Dependent Dropdown List using Jquery and Ajax
== source website == https://www.webslesson.info/2017/05/json-dynamic-dependent-select-box-using-jquery-and-ajax.html
== source youtube == https://www.youtube.com/watch?v=1ebJyK6tocI
-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Webslesson Tutorial | JSON - Dynamic Dependent Dropdown List using Jquery and Ajax</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<br /> <br />
    <div class="container" style="width:600px;">
    <h2 align="center"> JSON - Dynamic Dependent Dropdown List using Jquery and Ajax</h2> <br /> <br />

        <select name="country" id="country" class="form-control input-lg">
            <option value=""> Select Country</option>
        
        </select> <br />

        <select name="state" id="state" class="form-control input-lg">
            <option value="">Select State</option>
        
        </select> <br />

        <select name="city" id="city" class="form-control input-lg">
            <option value=""> Select City</option>
        
        </select>
   
    </div>
</body>
</html> 

<script>
$(document).ready(function(){
    load_json_data('country');

    function load_json_data(id, parent_id)
    {
        var html_code = '';
        $.getJSON('country_state_city.json', function(data){
            html_code  +='<option value="">Select '+id+ ' </option>';
            $.each(data, function(key, value){
                if(id == 'country')
                {
                    if(value.parent_id == '0')
                    {
                        html_code  +='<option value="'+value.id+ '">'+value.name+ ' </option>';
                    }
                }
                else
                {
                    if(value.parent_id == parent_id)
                    {
                        html_code  +='<option value="'+value.id+'">' +value.name+'</option>';
                    }
                }
            });
            $('#'+id).html(html_code);

        });
    }

    $(document).on('change', '#country', function(){
        var country_id = $(this).val();
        if(country_id  != '')
        {
            load_json_data('state', country_id);

        }
        else
        {
            $('#state').html('<option value=""> Select State</option>');
            $('#city').html('<option value=""> Select City</option>');
        }
    });
 

 $(document).on('change', '#state', function(){
  var state_id = $(this).val();
  if(state_id != '')
  {
   load_json_data('city', state_id);
  }
  else
  {
   $('#city').html('<option value="">Select City</option>');
  }
 });

});

</script>