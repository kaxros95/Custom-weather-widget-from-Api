//create a shortcode for the weather widget to display -> optional
function weather_Widget()
{ ?>
	<div id="weather-widget">
		<div id="weather-data"></div>
		<div id="weather-date"></div>
	</div>
	<style>
		#weather-widget {
			display: flex;
		}

		#weather-widget p {
			border: 2px solid #3e50b6;
			margin: 3px;
			border-radius: 5px;
			padding: 5px;
		}

		@media screen and (max-width:600px) {
			#weather-widget {
				display: flex;
				flex-direction: column;
				align-items: center;
			}
			#weather-widget p {
				width: 300px !important;
			}
		}
	</style>
	<script>
		jQuery(document).ready(function($) {

			const weatherWidget = $("#weather-widget");
			const weatherData = $("#weather-data");
			const weatherDate = $("#weather-date");
			const localStorage = window.localStorage;
			const currentTimestamp = Date.now();

			let temps = [];
			let dates = [];
			let srcs = [];
			let date = [];
			let years = [];
			let months_arr = [];
			var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
			let new_date = [];
			let days = [];

			var settings = {
				"url": "https://api.openweathermap.org/data/2.5/forecast?lat=37.0389&lon=22.1142&units=metric&appid=c5a115861af25d3d9755f61de489e9de",
				"method": "GET",
				"timeout": 0,
				"data": {
					"action": "openweathermap_api",
				}
			};

			$.ajax(settings).done(function(response) {
				for (var i = 0; i < response.list.length; i++) {
					temps.push(response.list[i].main.temp); //the temperatures 
					dates.push(response.list[i].dt * 1000); //the dates in milliseconds
					date[i] = new Date(dates[i]);
					// new_date[i] = date[i].slice(0, 15);
					days[i] = date[i].getDate();
					years[i] = date[i].getFullYear();
					months_arr[i] = months[date[i].getMonth()];
					//month
					console.log(typeof(date[i]));
					srcs.push(`https://openweathermap.org/img/wn/${response.list[i].weather[0].icon}@2x.png`); //srcs of icons
				}
				console.log(srcs);
				console.log(years);
				console.log(months_arr);
				console.log(days);
				console.log(new_date);
				console.log(temps);
				console.log(response);

				for (var j = response.list.length; j >= 0; j--) {
					if (days[j] != days[j + 1]) {
						let output = `<p>` + days[j] + ` ` + months_arr[j] + ` ` + years[j] + `<img loading='lazy' src="` + srcs[j] + `">` + temps[j] + ` °C</p>`;
						$(weatherData).after(output);

					}
				}

			});

		});
	</script>

<?php }
add_shortcode('weatherWidget', 'weather_Widget');
