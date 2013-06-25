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
<div class="signup-form">
<h1>Search</h1>
<ul>
<li>
	<table width="100%">
		<tr>
			<td width="33%">City</td>
			<td width="33%">Zip</td>
			<td width="33%">Market Segment</td>
		</tr>
		<tr>
			<td>
				<textarea name="city" id="city" class="input qtr" rows="1"></textarea>
			</td>
			<td>
				<textarea name="zip" id="zip" class="input qtr" rows="1"></textarea>
			</td>
			<td>
				<textarea name="industry" id="industry" class="input qtr" rows="1"></textarea>
			</td>
		</tr>
	</table>
</li>
<li>Keyword</li>
<li><input name="keyword" id="keyword" type="text" class="input full" /></li>

<li>&nbsp;</li>
<li>
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
	    var city = clean($("[name='city']").val());
		var zip = clean($("[name='zip']").val());
		var industry = clean($("[name='industry']").val());
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
	
	var pagination = '<div class="pagination"><ul><li><</li><li>1</li><li>2</li><li class="selected">3</li><li>4</li><li>5</li><li>6</li><li>7</li><li>></li></ul></div>';
	$(pagination).insertAfter("#search_result");
    
	}
    </script>
	<script src="<?php echo asset_js('tag.js');?>"></script>
<script>

    $('#zip')
        .textext({
            plugins : 'tags autocomplete'
        })
        .bind('getSuggestions', function(e, data)
        {
        	var list = [
                    '10001',
                    '10002',
                    '10003',
                    '10004',
                    '10005'
                ],
                textext = $(e.target).textext()[0],
                query = (data ? data.query : '') || ''
                ;

            $(this).trigger(
                'setSuggestions',
                { result : textext.itemManager().filter(list, query) }
            );
        })
        ;
		
		$('#city')
        .textext({
            plugins : 'tags autocomplete'
        })
        .bind('getSuggestions', function(e, data)
        {
           
			var list = [
                    'New york'
                ],
                textext = $(e.target).textext()[0],
                query = (data ? data.query : '') || ''
                ;

            $(this).trigger(
                'setSuggestions',
                { result : textext.itemManager().filter(list, query) }
            );
        })
        ;
		
		$('#industry')
        .textext({
            plugins : 'tags autocomplete'
        })
        .bind('getSuggestions', function(e, data)
        {
          
					
			var list = [
                    'Resturants',
					'Hospitality',
					'General Contractors',
					'Handy Men',
					'Photography',
					'Artists',
					'Musicians',
					'Towing',
					'Flat beds',
					'Body shops',
					'Talent Agencies',
					'Security'
                ],
                textext = $(e.target).textext()[0],
                query = (data ? data.query : '') || ''
                ;

            $(this).trigger(
                'setSuggestions',
                { result : textext.itemManager().filter(list, query) }
            );
        })
        ;
        
        
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