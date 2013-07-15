<?php
	$this->load->view('header');
?>
<!-------------- start navigation ---------------->
<!--<div class="navigation">
  <div class="wrapper">
    <ul>
      <a href="javascript:;">
      <li class="first">My Home</li>
      </a> <a href="javascript:;">
      <li>Search </li>
      </a> <a href="javascript:;">
      <li>My Tasks</li>
      </a> <a href="javascript:;">
      <li>My Messages</li>
      </a> <a href="javascript:;">
      <li>Dashboard</li>
      </a>
    </ul>
  </div>
</div>-->
<!-------------- start navigation ---------------->
<div class="content">
<div class="wrapper">
<!-- detail Colum -->
<div class="job-detail">
<div class="box-fold"></div>
<div class="signup-form">
<h1>Search</h1>
<ul class="signup-form_ul">
<li class="signup-form_li">
	<table width="100%">
		<tr>
			<td width="50%">Country</td>
			<td width="50%">State</td>
			
		</tr>
		<tr>
			<td>
			    <input name="country" id="country" class="input qtr" />
				
			</td>
			<td>
			    <input name="state" id="state" class="input qtr" />
				
			</td>
			
		</tr>
		<tr>
		    <td width="50%">City</td>
		    <td width="50%">Zip</td>
		</tr>
		<tr>
		    <td>
			    <input name="city" id="city" class="input qtr" />
				
			</td>
			<td>
			    <input name="zip" id="zip" class="input qtr" />
				
			</td>
		</tr>
		<tr>
			
			<td width="50%">Market Segment</td>
			<td width="50%">Number of Records</td>
		</tr>
		<tr>
			<td>
			    <input name="industry" id="industry" class="input qtr" />
				
			</td>
			<td>
			
				<select name="total" id="total" class="input qtr" style="background:#fff;">
				    <option value="1">1</option>
				    <option value="2">2</option>
				    <option value="3">3</option>
				    <option value="4">4</option>
				    <option value="5">5</option>
				    <option value="6">6</option>
				    <option value="7">7</option>
				    <option value="8">8</option>
				    <option value="9">9</option>
				    <option value="10">10</option>
				</select>
			</td>
		</tr>
		<tr>
		    <td>Keyword</td>
		    <td>Website</td>
		</tr>
		<tr>
		    <td><input name="keyword" id="keyword" type="text" class="input full" /></td>
		    <td>
		        <select name="website" id="website" class="input qtr" style="background:#fff;">
				    <?php
				    foreach($websites as $website)
				    {
				    ?>
				        <option value="<?php echo $website["type_id"].$website['url'];?>"><?php echo $website['name']."&nbsp;&nbsp;&nbsp;     (".$type[$website["type_id"]].")";?></option>
				    <?php
				    }
				    ?>
				</select>
		    </td>
		</tr>
	</table>
</li>

<li class="signup-form_li">&nbsp;</li>
<li class="signup-form_li">
	<input name="button" onclick="get_results();" type="button" class="signup-form-btn" value="Get Results">
</li>
</ul>
</div>

</div>
<!--<div class="detail-colum">-->
<div class="about-profile-people">
        <h1>Results</h1>
		<div id="search_result"></div>
</div>
<script>
	function clean(string)
	{
		if(string == '[]')
		{
			return "";
		}
		else
		{
			string = string.substring(1);
			string = string.slice(0,-1);
			return string;
		}
	}

      function get_results()
	  {
	    var website = $("#website option:selected").val();
	    var website_type = website.charAt(0);    
	    website = website.slice(1);
	    if(parseInt(website_type) == 1)
	    {
		    var state = $("[name='state']").val();
		    var county = $("[name='country']").val();
	        var city = $("[name='city']").val();
		    var zip = $("[name='zip']").val();
		    var industry = $("[name='industry']").val();
		    var keyword = $('#keyword').val();
		    var num = $("#total option:selected").val();
		    
		    var search = state+" "+county+" "+city+" "+zip+" "+industry+" "+keyword;
		    search = search.replace(/"/g, "");
		    var url = "https://www.googleapis.com/customsearch/v1?key=AIzaSyA4iMwtbw8lVVClDBge1hKLqSC8j_sI-rU&cx=008099485685892913783:gukgeeg2dvq&q="+search+"&gl=usarhan&googlehost=google.com&siteSearch="+website+"&siteSearchFilter=i&num="+num; 
		    
		    
		    $.ajax({
		      url: url,
		      context: document.body
		    }).done(function(result) {
		      
		      hndlr(result);
		
		    });
	    }
	    else
	    {
	        // scrapping code goes here
	        alert("Scrapping work is in progress");
	    }
	  
	  }
	  
	  function hndlr(response) {
	  document.getElementById("search_result").innerHTML = '';
      for (var i = 0; i < response.items.length; i++) {
        var item = response.items[i];
		
		var html = "";
		html += "<div class='review-inner'>";
        html += '<h2><a href="'+item.formattedUrl+'">'+item.htmlTitle+'</a></h2>';
		html += '<p>';
		html += '<strong>'+item.htmlFormattedUrl+'</strong><br>';
		html += item.htmlSnippet;
		html += '</p>';
		html += '</div>';
		
		// in production code, item.htmlTitle should have the HTML entities escaped.
        document.getElementById("search_result").innerHTML += html;
		
      }
	
	/*var pagination = '<div class="pagination"><ul><li><</li><li>1</li><li>2</li><li class="selected">3</li><li>4</li><li>5</li><li>6</li><li>7</li><li>></li></ul></div>';
	$(pagination).insertAfter("#search_result");*/
    
	}
    </script>

<script>
var sampleTags = ['c++', 'java', 'php', 'coldfusion', 'javascript', 'asp', 'ruby', 'python', 'c', 'scala', 'groovy', 'haskell', 'perl', 'erlang', 'apl', 'cobol', 'go', 'lua'];

var countries = [];
var industries = [];

var countries_json = $.parseJSON('<?php echo $countries;?>');
var industries_json = $.parseJSON('<?php echo $industries;?>');
if(industries_json.length)
{
    for(var i=0;i<industries_json.length;i++)
    {
        industries.push(industries_json[i].name);
    }
}

if(countries_json.length)
{
    for(var i=0;i<countries_json.length;i++)
    {
        countries.push(countries_json[i].country_name);
    }
}

  $('#country').tagit({
                allowSpaces: true,
                allowDuplicates: false,
                availableTags: countries
            });                
  
  
  $('#state').tagit({
                allowSpaces: true,
                allowDuplicates: false,
                tagSource: function(request, response) 
                {
                    var selected_countries = $("#country").tagit("assignedTags");
                    if(selected_countries.length > 0)
                    {
                        $.ajax({
                            type: "POST",
                            url:        "<?php echo base_url();?>ajax/get_states",
                            dataType:   "json",
                            data: {countries:selected_countries},
                            success:    function(data) 
                            {
                                //return data;
                                response( $.map( data, function( item ) {
                                return {
                                    label: item.state_name,
                                    value: item.state_name
                                    
                                }
                            }));
                            }

                        });
                    }
                }
            });     
             
  
        
  $('#city').tagit({
                allowSpaces: true,
                allowDuplicates: false,
                tagSource: function(request, response) 
                {
                    var selected_states = $("#state").tagit("assignedTags");
                    if(selected_states.length > 0)
                    {
                        $.ajax({
                            type: "POST",
                            url:        "<?php echo base_url();?>ajax/get_cities",
                            dataType:   "json",
                            data: {states:selected_states},
                            success:    function(data) 
                            {
                                //return data;
                                response( $.map( data, function( item ) {
                                return {
                                    label: item.city_name,
                                    value: item.city_name
                                    
                                }
                            }));
                            }

                        });
                    }
                }
            });      
                  
  $('#zip').tagit({
                allowSpaces: true,
                allowDuplicates: false,
                tagSource: function(request, response) 
                {
                    var selected_cities = $("#city").tagit("assignedTags");
                    if(selected_cities.length > 0)
                    {
                        $.ajax({
                            type: "POST",
                            url:        "<?php echo base_url();?>ajax/get_zips",
                            dataType:   "json",
                            data: {cities:selected_cities},
                            success:    function(data) 
                            {
                                //return data;
                                response( $.map( data, function( item ) {
                                return {
                                    label: item.zip,
                                    value: item.zip
                                    
                                }
                            }));
                            }

                        });
                    }

                }
            });                
  
  $('#industry').tagit({
                availableTags: industries
            });                
</script>
<!--</div>-->

<!-- detail Colum -->
<!-- Right Colum -->
<!-- Right Colum -->

</div>
</div>

<?php
	$this->load->view('footer');
?>
