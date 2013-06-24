<?php
	$this->load->view('header');
	//$this->load->view('admin/leftbar');
?>
    <div class="grid_12">
            <div class="box round first fullpage">
                <h2>Search</h2>
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
					<br>
					
					<h3>Results</h3>
					<div id="search_result"></div>
					
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
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
		html += "<p>";
        html += '<h5 style="padding-left:10px;">';
		html += '<a href="'+item.formattedUrl+'">'+item.htmlTitle+'</a>';
		html += '</h5>';
		html += '<div style="padding-left:10px;">';
		html += '<cite>'+item.htmlFormattedUrl+'</cite>';
		html += '</div>';
		html += '<div style="padding-left:10px;">';
		html += '<span class="st">'+item.htmlSnippet+'</span>';
		html += '</div>';
		html += '</p>';
		// in production code, item.htmlTitle should have the HTML entities escaped.
        document.getElementById("search_result").innerHTML += html;
      }
    }
    </script>
    <!--<script src="https://www.googleapis.com/customsearch/v1?key=AIzaSyA4iMwtbw8lVVClDBge1hKLqSC8j_sI-rU&cx=008099485685892913783:gukgeeg2dvq&q=cars&callback=hndlr">
    </script>-->    
<?php
	$this->load->view('admin/footer');
?>