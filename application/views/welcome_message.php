<?php
	$this->load->view('admin/header');
	//$this->load->view('admin/leftbar');
?>
    <div class="grid_12">
            <div class="box round first fullpage">
                <h2>Search</h2>
                <div class="block ">
                    <p>City: 
						<select name="city" id="city">
							<option>New York</option>
							<option>Greenville</option>
							<option>Franklin</option>
							<option>Madison</option>
							<option>Washington</option>
						</select>
						 Zip: 
						<select name="zip" id="zip">
							<option>07069</option>
							<option>07069</option>
							<option>07069</option>
							<option>07069</option>
							<option>07069</option>
						</select>
						 Industry: 
						<select name="industry" id="industry">
							<option>SPA</option>
							<option>Hotel</option>
						</select>
						Keyword: 
						<input name="keyword" id="keyword" type="text" />
						<input type="submit" name="submit" id="submit" value="Get Results" />
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
      function hndlr(response) {
      for (var i = 0; i < response.items.length; i++) {
        var item = response.items[i];
		console.log(item);
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
    <script src="https://www.googleapis.com/customsearch/v1?key=AIzaSyA4iMwtbw8lVVClDBge1hKLqSC8j_sI-rU&cx=008099485685892913783:gukgeeg2dvq&q=cars&callback=hndlr">
    </script>    
<?php
	$this->load->view('admin/footer');
?>