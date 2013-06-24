<?php
	$this->load->view('header');
?>
<!-------------- start navigation ---------------->
<div class="navigation">
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
</div>
<!-------------- start navigation ---------------->
<div class="content">
<div class="wrapper">
<!-- detail Colum -->
<div class="job-detail">
<div class="box-fold"></div>
<h1>Search</h1>
<div class="block ">
                    <p>City: 
						<select name="city" id="city">
							<option>New York</option>
						</select>
						 Zip: 
						<select name="zip" id="zip">
							<option>10001</option>
							<option>10002</option>
							<option>10003</option>
							<option>10004</option>
							<option>10005</option>
						</select>
						 Industry: 
						<select name="industry" id="industry">
							<option>Resturants</option>
							<option>Hospitality</option>
							<option>General Contractors</option>
							<option>Handy Men</option>
							<option>Photography</option>
							<option>Artists</option>
							<option>Musicians</option>
							<option>Towing</option>
							<option>Flat beds</option>
							<option>Body shops</option>
							<option>Talent Agencies</option>
							<option>Security</option>
						</select>
						Keyword: 
						<input name="keyword" id="keyword" type="text" />
						<input type="button" onclick="get_results();" name="submit" id="submit" value="Get Results" />
					</p>
										
                </div>
</div>
<!--<div class="detail-colum">-->
<div class="about-profile-people">
        <h1>Results</h1>
		<div id="search_result"></div>
        
		
        
        <div class="pagination">
        <ul>
        <li><</li>
        <li>1</li>
        <li>2</li>
        <li class="selected">3</li>
        <li>4</li>
        <li>5</li>
        <li>6</li>
        <li>7</li>
        <li>></li>
        </ul>
        </div>

</div>
<script>
      function get_results()
	  {
	    var city = $('#city option:selected').text();
		var zip = $('#zip option:selected').text();
		var industry = $('#industry option:selected').text();
		var keyword = $('#keyword').val();
		var search = city+" "+zip+" "+industry+" "+keyword;
		
		$.ajax({
		  url: "https://www.googleapis.com/customsearch/v1?key=AIzaSyA4iMwtbw8lVVClDBge1hKLqSC8j_sI-rU&cx=008099485685892913783:gukgeeg2dvq&q="+search+"&gl=usarhan&googlehost=google.com",
		  context: document.body
		}).done(function(result) {
		  
		  hndlr(result);
		
		});
	  }
	  
	  function hndlr(response) {
	  document.getElementById("search_result").innerHTML = '';
      for (var i = 0; i < response.items.length; i++) {
        var item = response.items[i];
		
		var html = "";
		/*html += "<p>";
        html += '<h5 style="padding-left:10px;">';
		html += '<a href="'+item.formattedUrl+'">'+item.htmlTitle+'</a>';
		html += '</h5>';
		html += '<div style="padding-left:10px;">';
		html += '<cite>'+item.htmlFormattedUrl+'</cite>';
		html += '</div>';
		html += '<div style="padding-left:10px;">';
		html += '<span class="st">'+item.htmlSnippet+'</span>';
		html += '</div>';
		html += '</p>';*/
		html += "<div class='review-inner'>";
        html += '<h2><a href="'+item.formattedUrl+'">'+item.htmlTitle+'</a></h2>';
		html += '<p>';
		html += '<strong>'+item.htmlFormattedUrl+'</strong><br>';
		html += item.htmlSnippet;
		html += '</p>';
		html += '</div>';
		
		  
		  /*<div class="review-inner">
		  <h2>Need Technicians Urgently</h2>
		  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam lobortis tempor euismod.<br>
			Skills: <i>Constant Contact, Social Media Marketing, Adobe Photoshop, English...</i><br>
			<strong>Post date: Apr 16, 2013 19:15 ET </strong> </p>
		</div>*/
		
		// in production code, item.htmlTitle should have the HTML entities escaped.
        document.getElementById("search_result").innerHTML += html;
      }
    }
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