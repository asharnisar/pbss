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
				    <?php
				    for($i=1;$i<=20;$i++)
				    {
				    ?>
				    <option value="<?php echo ($i*5);?>"><?php echo ($i*5);?></option>
				    <?php
				    }
				    ?>
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
		        <!--<select name="website" id="website" class="input qtr" style="background:#fff;">-->
		        <select multiple style="width:544px;" name="website[]" id="website" data-placeholder="Choose Website(s)">
                <option value=""></option>
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

<div id="tabs">
   <ul>
     <li><a href="#tab-1"><b>Searches</b></a></li>
     <li><a href="#tab-2"><b>Results</b></a></li>
   </ul>
   <div id="tab-1" style="border: 2px solid #e6e6e6;clear: both; padding-bottom:20px;">
     <div id="search_result_scrapping">
		    <table cellpadding="0" cellspacing="0" border="0" class="display" id="gridme" width="100%">
	            <thead>
		            <tr>
		                <th align="center" width="25%"><b>Website</b></th>
		                <th align="center" width="25%"><b>Criteria</b></th>
		                <th align="center"><b>Start Time</b></th>
		                <th align="center"><b>End Time</b></th>
		                <th width="25%" align="center"><b>Status</b></th>
		                <th align="center"><b>Action</b></th>
		            </tr>
	            </thead>
	            <tbody>
		            <!--<tr class="gradeC odd">
			            <td>Trident</td>
			            <td>Internet
				             Explorer 4.0</td>
			            <td>Win 95+</td>
			            <td class="center"> 4</td>
			            <td class="center">X</td>
			            <td class="center">X</td>
		            </tr>
		            <tr class="gradeC even">
			            <td>Trident</td>
			            <td>Internet
				             Explorer 5.0</td>
			            <td>Win 95+</td>
			            <td class="center">5</td>
			            <td class="center">C</td>
			            <td class="center">X</td>
		            </tr>
		            <tr class="gradeC odd">
			            <td>Trident</td>
			            <td>Internet
				             Explorer 5.5</td>
			            <td>Win 95+</td>
			            <td class="center">5.5</td>
			            <td class="center">A</td>
			            <td class="center">X</td>
		            </tr>
		            <tr class="gradeC even">
			            <td>Trident</td>
			            <td>Internet
				             Explorer 6</td>
			            <td>Win 98+</td>
			            <td class="center">6</td>
			            <td class="center">A</td>
			            <td class="center">X</td>
		            </tr>-->
                </tbody>
            </table>
		</div>
   </div>
   <div id="tab-2"  style="border: 2px solid #e6e6e6;clear: both;">
     <div id="search_result"></div>
   </div>
   
 </div>

        
</div>

<style type="text/css">
* {
	margin: 0;
	padding: 0;
}
#tabs {
	font-size: 90%;
	/*margin: 20px 0;*/
}
#tabs ul {
	float: left;
	background: #fff;
	width: 500px;
	padding-top: 4px;
}
#tabs li {
	margin-left: 8px;
	list-style: none;
}
* html #tabs li {
	display: inline;
}
#tabs li, #tabs li a {
	float: left;
	font-size:15px;
}
#tabs ul li.active {
	/*border-top:2px #FFFF66 solid;*/
	background: #e6e6e6;
	
}
#tabs ul li.active a {
	color: #333333;
}
#tabs div {
	/*background: #e6e6e6;*/
	/*border: 2px solid #e6e6e6;
	clear: both;*/
	padding: 5px;
	/*min-height: 200px;*/
}
#tabs div h3 {
	margin-bottom: 12px;
}
#tabs div p {
	line-height: 150%;
}
#tabs ul li a {
	text-decoration: none;
	padding: 8px;
	color: #000;
	font-weight: bold;
}
.thumbs {
	float:left;
	border:#000 solid 1px;
	margin-bottom:20px;
	margin-right:20px;
}
-->
</style>
<script>
	$(document).ready(function(){
        //$('#tabs div').hide();
        $('#tab-1').hide();
        $('#tab-2').hide();
        $('#tabs div:first').show();
        $('#tabs ul li:first').addClass('active');
         
        $('#tabs ul li a').click(function(){
        $('#tabs ul li').removeClass('active');
        $(this).parent().addClass('active');
        var currentTab = $(this).attr('href');
        //$('#tabs div').hide();
        $('#tab-1').hide();
        $('#tab-2').hide();
        $(currentTab).show();
        return false;
        });
        
        
        
        $("#gridme").dataTable();
        
    });


var countries = [];
var industries = [];

var countries_json = $.parseJSON('<?php echo $countries;?>');
var industries_json = $.parseJSON('<?php echo $industries;?>');

industries = fill_industries(industries_json);

countries = fill_countries(countries_json);

show_countries_tags(countries);
  
show_states_tags("<?php echo base_url();?>ajax/get_states");
             
show_cities_tags("<?php echo base_url();?>ajax/get_cities");  
        
show_zip_tags("<?php echo base_url();?>ajax/get_zips");        
                  
show_industries_tags(industries);                  
  
show_websites_tags();  
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
