<html>
<head>
    <title>A Yammer App</title>
    <script src="https://assets.yammer.com/platform/yam.js"></script>
    <script>
      yam.config({appId: "9mLJwel3rlJoDdvhM3q63Q"});
    </script>
</head>
<body onload='list_message()'>
	
	
	<input type="text" id="data_post" style="height:'50px'; width:'500px';"><br><br>
    <button  onclick='post()'>Post Yammer!</button>
   
    <p id="demo"><img src="loading.gif"></p>
    
    <script>
    
    function post() {
    yam.getLoginStatus( function(response) {
		var data_post = document.getElementById("data_post").value; //get value from text box using id

        if (response.authResponse) {
            yam.request( { 
              	url: "https://www.yammer.com/api/v1/messages.json"
              , method: "POST"
              , data: { "body" : data_post}
              , success: function (msg) { alert("Post was Successful!: " + msg); }
              , error: function (msg) { alert("Post was Unsuccessful..." + msg); }
            } );
        } else {
            yam.login( function (response) {
              if (!response.authResponse) {
                yam.request( { 
                  	url: "https://www.yammer.com/api/v1/messages.json"
                  , method: "POST"
                  , data: { "body" : data_post}
                  , success: function (msg) { alert("Post was Successful!: " + msg); }
                  , error: function (msg) { alert("Post was Unsuccessful..." + msg); }
                });
              }
            });
        }
        });
    }
    


    function list_message() {
    yam.getLoginStatus( function(response) {
    	
    if (response.authResponse) {	
	    yam.request({ 
			  url: "/api/v1/messages.json"
			, method: "GET"
			, data: "type=following"
			, success: function (msg) { 
				var output = '';
				for (object in msg.messages){
					for(data in msg.messages[object]){
						
						if(data == 'body'){
							for(pbody in msg.messages[object].body){
								if(pbody == 'parsed'){
								  output += msg.messages[object].body[pbody];
								}
							}
						}
						if(data == 'url'){
						  //output += data + ': ' + msg.messages[object].url+'<br>';
						  output += '<button onclick= \'delete_message(\"' + msg.messages[object].url + '\")\'>Delete </button><br>';
						}
					}
				}
				document.getElementById("demo").innerHTML=output;
				console.log("Data:\n" + output); 
			  }
			, error: function (msg) { console.log("Data Not Saved: " + msg); }
		}); //yam.request end
	} else {
		yam.login( function (response){
			if (!response.authResponse){
				yam.request({ 
					  url: "/api/v1/threads"
					, method: "GET"
					//, data: "type=following"
					, success: function (msg) { 
						var output = '';
						for (object in msg.messages){
							for(data in msg.messages[object]){
								if(data == 'body'){
									for(pbody in msg.messages[object].body){
										if(pbody == 'parsed'){
										  output += pbody + ': ' + msg.messages[object].body[pbody]+'<br>';
										}
									}
								}
								if(data == 'url'){
								  //output += data + ': ' + msg.messages[object].url+'<br>';
								  output += '<button onclick= \'delete_message(\"' + msg.messages[object].url + '\")\'>Delete </button>';
								}
							}
						}
						document.getElementById("demo").innerHTML=output;
						console.log("Data:\n" + output); 
					  }
					, error: function (msg) { console.log("Data Not Saved: " + msg); }
				}); //yam.request end
			}
		});
	}
	
	}); //yam.getLoginStatus end
	}



   function delete_message(geturl) {
    	yam.getLoginStatus( function(response) {
	        if (response.authResponse) {
	            yam.request({ 
	              	url: geturl
	              , method: "DELETE"
	              , success: function (msg) { alert("Post was Successfully deleted!: "); }
	              , error: function (msg) { alert("Warning..."); }
	            } );
	        } 
	        else {
	            yam.login( function (response) {
	              if (!response.authResponse) {
	                yam.request( { 
	                  	url: geturl
	                  , method: "DELETE"
	                  , success: function (msg) { alert("Post was Successfully deleted!: "); }
	                  , error: function (msg) { alert("Warning..."); }
	                });
	              }
	            });
	        }
        });
    }

   
   function like_post(geturl) {
    	yam.getLoginStatus( function(response) {
	        if (response.authResponse) {
	            yam.request({ 
	              	url: geturl
	              , method: "DELETE"
	              , success: function (msg) { alert("Post was Successfully deleted!: "); }
	              , error: function (msg) { alert("Warning..."); }
	            } );
	        } 
	        else {
	            yam.login( function (response) {
	              if (!response.authResponse) {
	                yam.request( { 
	                  	url: geturl
	                  , method: "DELETE"
	                  , success: function (msg) { alert("Post was Successfully deleted!: "); }
	                  , error: function (msg) { alert("Warning..."); }
	                });
	              }
	            });
	        }
        });
    }    

    </script>
</body>
</html>
