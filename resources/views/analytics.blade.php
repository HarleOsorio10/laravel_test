<!DOCTYPE html>
<html lang="en">
<head>
  <title>Analytics</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <Script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
  <script src="/js/lodash.js"></script>
</head>
<body onload="load_data()">

<div class="container">
  <h2>Analytics</h2>
  <input type="date" id="datePicker" value="<?= date('Y-m-d', time()); ?>" onChange="load_data()">
  <canvas id="myChart" height="100"></canvas>
  <button type="button" class="btn btn-primary btn-sm" onclick="goback()">go back</button>
</div>

</body>
</html>

<script>
function dynamicColors() {
              var r = Math.floor(Math.random() * 255);
              var g = Math.floor(Math.random() * 255);
              var b = Math.floor(Math.random() * 255);
              const color = 'rgba(' + r + ',' + g + ',' + b + ', 0.8)';
              return color;
          }
async function load_data(){
    const date =document.getElementById('datePicker').value;
    await $.ajax({
        url: "api/get_scores?date="+date.replace("/","-"),
        dataType: "JSON",
        success: (data) => {
          console.log(data.message);
          const formatted = _.groupBy(data.data, "score");
          const customColors = _.map(formatted, r => {return dynamicColors()});
          const occurs = _.map(formatted, r => {return r.length});
          var ctx = document.getElementById('myChart').getContext('2d');
          const labels =  Object.getOwnPropertyNames(formatted);
          var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels,
                  datasets: [{
                      label: 'number of times it was generated',
                      data: occurs,
                      borderWidth: 1,
                      backgroundColor: customColors,
                      borderColor: customColors,
                  }],
              },
              options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1,
                            callback: function(value, index, values) {
                                return value + ' times';
                            }
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Scores generated per day'
                        },
                legend: {
                    display: false,
                }
              }
          });
        },
        error: (err) => {
          console.log(err);
        },
      });
};

function goback(){
  window.location.replace("/");
};
</script>
