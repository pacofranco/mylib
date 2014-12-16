<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">

	function myAjax() {
	  if(window.XMLHttpRequest) {
	    return new XMLHttpRequest();
	  }
	  else if(window.ActiveXObject) {
	    return new ActiveXObject("Microsoft.XMLHTTP");
	  }
	}
	
	function infile() {

				var my_http_p;
				my_http_p = myAjax();
				    // Preparar la funcion de respuesta
  				my_http_p.onreadystatechange = myreply;


  				  // Realizar peticion HTTP
			  	my_http_p.open('GET', 'info.php', true);
			 	my_http_p.send(null);

			  function myreply() {
			    if(my_http_p.readyState == 4) { // server response
			      if(my_http_p.status == 200) { // ok status
			        document.getElementById('myid').innerHTML = my_http_p.responseText;

			        
			      }
			    }
			  }


	}

	function mypost() {
	var xmlhttp;
	xmlhttp = myAjax();
	xmlhttp.open("POST","mypost.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send("name=Henry&age=35");

		xmlhttp.onreadystatechange = function() {
	  	if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
		    document.getElementById("mypost").innerHTML=xmlhttp.responseText;
		    }
	  	}		

	
	}




// JQuery

	$(document).ready(function(){
		var myfont = 12;
		$("#myajax").click(function(){
			var myfirstname = document.getElementById("myfirstname").value;

			$.get("myajax.php", {name : myfirstname }, function(respuesta){
			// alert(respuesta);
			$("#myresponse").html(myfirstname + respuesta);
			});
	
		});



		  	$("#myh").click(function(evento){
		   		myfont++; 		
	   		$("#capa").css("font-size", myfont + "px");
	  			$("#capa").hide('slow');
	  		});	

	  		$("#btn1").click(function(){
	  			$("#box").animate({height:"300px"})
	  			$("#mylist").fadeOut();
	  		});

	  		$("#btn2").click(function(){
	  			$("#box").animate({height:"100px"}, 2500)
	  			$("#mylist").fadeIn();
	  		});


	   		$("#myl").click(function(evento){
	   			myfont--;
		   		$("#capa").css("font-size", myfont + "px");
		   		$("#capa").show(3000);
		   		$("#myinfo").load("ajax.php");
	   		});

		   	$("#capa").mouseenter(function(evento){
		   		$("#mensaje").css("display", "block");
			});
				$("#capa").mouseleave(function(evento){
			   	$("#mensaje").css("display", "none");
			});

	});

	
	
	
	   /* Get the current time and render it in the specific div
	*
	*@param {String} mydiv, location to be displayed
	*@return the format time in html to be printed
	*/
	function getmytime(time, mydiv) {
		var mytime = time
		document.getElementById(mydiv).innerHTML = ('Hora ' + mytime);
	}

   
   /* Reset the div text to '-'
	*
	*@param {String} mydiv, location to be displayed
	*
	*@return the format text '-'
	*/	
	function getmyinit(mydiv) {
		document.getElementById(mydiv).innerHTML = ('-');

	}


   /* Hide the div in the miliseconds assigned
	*
	*@param {String} mydiv, location to be displayed
	*@param {int} temp, time of the effect in miliseconds
	*
	*@return rendering of the hide div
	*/
	function hidemydiv(mydiv, temp) {
		if (!temp) { temp = 700 ;}
	$(mydiv).hide(temp);
	$("#mytext").css("display", "block");

	}



	$(document).ready(function(){

		$("#mybajax").click(function() {
		$("#myinfo").load("login.php .myright" );
		});

		$("#mypostb").click(function() {
			$.post("mypost.php",{
									name : "FFP",
									   n : 5  } ,
									function(data,status) {
									var mydata = "Data: " + data + "\nStatus: " + status;
							 		alert(mydata);
							 		$("#ajaxreponse").html(mydata)			
								});
			
		});


	});

		function getpost2(mytext){
		 var text = 'Info text ' + mytext;
			alert(text);
		}


</script>	