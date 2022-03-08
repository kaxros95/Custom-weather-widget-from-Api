<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>
  <body>
    <h1 style="text-align: center"> The weather in the city we want..</h1>
    <div id="weather-widget">
      <div id="weather-data"></div>
      <div id="weather-date"></div>
    </div>
  </body>
</html>

<style>
  #weather-widget {
    display: grid;
    justify-content: center;
    font-size: 22px;
  }

  #weather-widget p {
    border: 2px solid #3e50b6;
    margin: 3px;
    border-radius: 5px;
    padding: 5px;
  }

  @media screen and (max-width: 600px) {
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
  jQuery(document).ready(function ($) {
    const weatherWidget = $("#weather-widget");
    const weatherData = $("#weather-data");
    const weatherDate = $("#weather-date");
    const localStorage = window.localStorage;
    const currentTimestamp = Date.now();

    let temps = [];
    let dates = [];
    let srcs = [];
    let wres = [];
    let date = [];
    let years = [];
    let months_arr = [];
    var months = [
      "Ιαν",
      "Φεβ",
      "Μαρ",
      "Απρ",
      "Μαι",
      "Ιουν",
      "Ιουλ",
      "Αυγ",
      "Σεπ",
      "Οκτ",
      "Νοε",
      "Δεκ",
    ];
    let new_date = [];
    let days = [];

    var settings = {
      url: "https://api.openweathermap.org/data/2.5/forecast?lat=38.8532&lon=20.9826&units=metric&appid=c5a115861af25d3d9755f61de489e9de",
      method: "GET",
      timeout: 0,
      data: {
        action: "openweathermap_api",
      },
    };

    $.ajax(settings).done(function (response) {
      for (var i = 0; i < response.list.length; i++) {
        temps.push(response.list[i].main.temp); 
        dates.push(response.list[i].dt * 1000); 
        wres.push(response.list[i].dt_txt.slice(10));
        date[i] = new Date(dates[i]);
        days[i] = date[i].getDate();
        years[i] = date[i].getFullYear();
        months_arr[i] = months[date[i].getMonth()];
        srcs.push(
          `https://openweathermap.org/img/wn/${response.list[i].weather[0].icon}@2x.png`
        ); 
      }

      for (var j = response.list.length - 1; j >= 0; j--) {
        
          let output =
           `<p>` + wres[j] + `<br>` +
            days[j] +
            ` ` +
            months_arr[j] +
            ` ` +
            years[j] +
            `<img loading='lazy' src="` +
            srcs[j] +
            `">` +
            temps[j] +
            ` °C</p>`;
          $(weatherData).after(output);
        
      }
    });
  });
</script>
