function toogle_div()
{
	if(document.getElementById('branches').style.display == 'none')
	{
	    //alert('here');
	    $("#up").show();
	    $("#down").hide();
	
	    $("#branches").fadeIn(500);
	}
	else
	{
	    $("#up").hide();
	    $("#down").show();
	    $("#branches").fadeOut(500);
		//	$("#branches").hide("fade", {}, 1000);

	}

}

function show_websites_tags()
{
    $("#website").chosen({});
    $('.chzn-results li').css('width','525');
    $('#website_chzn').css('width','420');
    $('.chzn-drop ul').css('width','419');
    $('.chzn-choices').css('border-radius','5px').css('border','#d6d6d6 1px solid').css('padding','2px 5px');
}

function show_countries_tags(countries)
{
    $('#country').tagit({
                allowSpaces: true,
                allowDuplicates: false,
                availableTags: countries
            });                
}

function show_states_tags(url)
{
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
                            url:        url,
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
}

function fill_industries(industries_json)
{
    var temp = [];
    
    if(industries_json.length)
    {
        for(var i=0;i<industries_json.length;i++)
        {
            temp.push(industries_json[i].name);
        }
    }
    
    return temp;
}

function fill_countries(countries_json)
{
    var temp = [];
    
    if(countries_json.length)
    {
        for(var i=0;i<countries_json.length;i++)
        {
            temp.push(countries_json[i].country_name);
        }
    }
    
    return temp;

}

function show_cities_tags(url)
{
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
                            url:        url,
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
}

function show_zip_tags(url)
{
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
                            url:        url,
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
}

function show_industries_tags(industries)
{
    $('#industry').tagit({
                availableTags: industries
            });                
}

function add_tr(website,criteria)
{
    criteria = criteria.replace("&",'\r\n');
    var time = new Date();
    var current_time = time.getHours() + ":"+ time.getMinutes() + ":"+ time.getSeconds();
    
    $('#gridme').dataTable().fnAddData( [website,criteria,current_time,"","Working","" ] );
    /*var html = "";
    html += '<tr>';
    html +='<td>'+website+'</td>';
    html +='<td>'+criteria+'</td>';
    html +='<td>'+current_time+'</td>';
    html +='<td></td>';
    html +='<td></td>';
    html +='<td></td>';
    html += '</tr>';
    
    $('#search_result_scrapping table').append(html);*/
}
	  
function hndlr(response) 
{
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

}

function hndlr_scrap(response) 
{
    document.getElementById("search_result").innerHTML = '';
    for (var i = 0; i < response.length; i++) 
	{
		var item = response[i];

		var html = "";
		html += "<div class='review-inner'>";
		//html += '<h2><a href="'+item.formattedUrl+'">'+item.htmlTitle+'</a></h2>';
		html += '<p>';
		//html += '<strong>'+item.htmlFormattedUrl+'</strong><br>';
		html += item;
		html += '</p>';
		html += '</div>';

		// in production code, item.htmlTitle should have the HTML entities escaped.
		document.getElementById("search_result").innerHTML += html;

	}	  
}

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

    var state = $("[name='state']").val();
    var country = $("[name='country']").val();
    var city = $("[name='city']").val();
    var zip = $("[name='zip']").val();
    var industry = $("[name='industry']").val();
    var keyword = $('#keyword').val();
    var num = $("#total option:selected").val();


    if(parseInt(website_type) == 1)
    {
        //$("#search_result_scrapping").hide();
        //$("#search_result").html('');
        //$("#search_result").show();
        
        var search = country+" "+state+" "+city+" "+zip+" "+industry+" "+keyword;
        search = search.replace(/"/g, "");
        var url = "https://www.googleapis.com/customsearch/v1?key=AIzaSyA4iMwtbw8lVVClDBge1hKLqSC8j_sI-rU&cx=008099485685892913783:gukgeeg2dvq&q="+search+"&gl=usarhan&googlehost=google.com&siteSearch="+website+"&siteSearchFilter=i&num="+num; 
        
        //return;
        
        $.ajax({
          url: url,
          context: document.body
        }).done(function(result) {
          show_result_tab();            
          hndlr(result);

        });
    }
    else
    {
        // scrapping code goes here
        var criteria = "country="+country+"&state="+state+"&city="+city+"&zip="+zip+"&market segment="+industry+"&search term="+keyword;
        criteria = criteria.replace(/"/g, "");
        show_search_tab();
        add_tr(website,criteria);
        
		$('#loading').show();
		$.ajax({
          url: 'ajax/scrap',
		  dataType: "json",
		  data:{keyword:keyword},
          context: document.body
        }).done(function(result) {
          $('#loading').hide();
		  if(typeof result === 'object')
		  {
			  show_result_tab();
			  hndlr_scrap(result);
		  }	
		
        });
		
		/*$.ajax({
          url: url,
          context: document.body
        }).done(function(result) {
          show_result_tab();            
          hndlr(result);

        });*/
    }

}


function show_result_tab()
{
    $('#tabs ul li').removeClass('active');
        $("#tabs ul li:last-child").addClass('active');
        
        $('#tab-1').hide();
        $("#tab-2").show();
        return false;
}

function show_search_tab()
{
    $('#tabs ul li').removeClass('active');
        $("#tabs ul li:first-child").addClass('active');
        
        $('#tab-1').show();
        $("#tab-2").hide();
        return false;
}
