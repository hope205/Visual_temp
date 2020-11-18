/*
Author: Ogidan hope


Resources: 
https://www.chartjs.org
https://www.w3schools.com
*/








var temperature  =  [];
var humidity =  [];
var time = [];


/*The set interval function sends a request to SQL DB every 1 sec and udates the graph with the new value*/
setInterval( function(){
	$(document).ready(function(){
		/*Send request to SQL DB using Ajax call*/
		$.ajax({
			/*url: "http://localhost/AP/chartjs/read_1_data.php", // Input IP address to broadcast */
			url: "read_1_data.php",
			
			method: "GET",
			success: function(data) { //if successful, the result of the query is passed to the array, data[]
				

				//parse the json data
				var text = JSON.parse(data);

				//push the new values into the array
				temperature.push(parseInt(text.temperature));
				humidity.push(parseInt(text.humidity));
				time.push(text.Time);

				
				console.log(temperature);
				console.log(time);
	
					var chartdata = {
						labels: time,
						datasets : [
			
							{	
								data: temperature,
								label: 'Temperature(T) ',
								borderColor: '#3e95cd',
								fill: false,
								
							},

							{
								label: 'Humidity(H) ',
								// backgroundColor: 'rgba(100, 0, 255, 0.9)',
								borderColor: "#c45850",								
								fill:false, 
								data: humidity,
							},
							
						]
					};
	
					var ctx = $("#mycanvas");
	
					var mycanvas = new Chart(ctx, {
						type: 'line',
						data: chartdata,
						options: { 
							
							animation:false,
							title: {
							display : true,
							text : 'readings'
							}
						
						}
						
					});
				
				},
				error: function(data) {
					console.log(data);
				}
			
		});
	});
},1000);




// }
