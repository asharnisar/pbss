<html>
  <head>
    <title>JSON/Atom Custom Search API Example</title>
  </head>
  <body>
    <div id="content"></div>
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
  </body>
</html>