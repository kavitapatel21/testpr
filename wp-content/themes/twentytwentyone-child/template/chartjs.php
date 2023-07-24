<?php
/*
 * Template Name: Chartjs graph & chart
 * description: >-
  Page template without sidebar
 */
?>

<!DOCTYPE html>
<html>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>-->
<script src="https://cdn.jsdelivr.net/npm/chart.js@^3"></script>
<body>
<h1> Scatter Plots</h1>
<canvas id="scatterPlots" style="width:100%;max-width:700px"></canvas>
<h1> Line Graphs</h1>
<canvas id="lineGraphs" style="width:100%;max-width:700px"></canvas>
<h1>Multiple Lines</h1>
<canvas id="multipleLines" style="width:100%;max-width:700px"></canvas>
<h1>Bar Graphs</h1>
<canvas id="barGraphs" style="width:100%;max-width:600px"></canvas>
<h1>Pie Chart</h1>
<canvas id="pieChart" style="width:100%;max-width:600px"></canvas>

<script>
//Scatter Plots Graph START
var xyValues = [
  {x:50, y:7},
  {x:60, y:8},
  {x:70, y:8},
  {x:80, y:9},
  {x:90, y:9},
  {x:100, y:9},
  {x:110, y:10},
  {x:120, y:11},
  {x:130, y:14},
  {x:140, y:14},
  {x:150, y:15}
];

new Chart("scatterPlots", {
  type: "scatter",
  data: {
    datasets: [{
      pointRadius: 4,
      pointBackgroundColor: "rgb(0,0,255)",
      data: xyValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      x: [{ticks: {min: 40, max:160}}],
      y: [{ticks: {min: 6, max:16}}],
    }
  }
});
//Scatter Plots Graph END

//Line Graphs START
const xValues = [50,60,70,80,90,100,110,120,130,140,150];
const yValues = [7,8,8,9,9,9,10,11,14,14,15];

new Chart("lineGraphs", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      fill: true,//To fill background color in graph which area covered by line in graph
      lineTension: 0,
      backgroundColor: "rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    scales: {
      y: [{ticks: {min: 6, max:16}}],
    }
  }
});
//Line Graphs END

//Multiple Lines START
const xxValues = [100,200,300,400,500,600,700,800,900,1000];

new Chart("multipleLines", {
  type: "line",
  data: {
    labels: xxValues,
    datasets: [{
      data: [860,1140,1060,1060,1070,1110,1330,2210,7830,2478],
      borderColor: "red",
      fill: false
    },{
      data: [1600,1700,1700,1900,2000,2700,4000,5000,6000,7000],
      borderColor: "green",
      fill: false
    },{
      data: [300,700,2000,5000,6000,4000,2000,1000,200,100],
      borderColor: "blue",
      fill: false
    }]
  },
  options: {
    legend: {display: false}
  }
});
//Multiple Lines END

//Bar Graph START
var xValue = ["Italy", "France", "Spain", "USA", "Argentina"];
var yValue = [55, 49, 44, 24, 15];
var barColors = ["red", "green","blue","orange","brown"];

/**new Chart("barGraphs", {
  type: "bar",
  data: {
    labels: xValue,
    datasets: [{
      backgroundColor: barColors,
      data: yValue
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "World Wine Production 2018"
    }
  }
});**/

new Chart("barGraphs", {
  type: "bar",
  data: {
    labels: ['2022-08-17', '2022-08-18', '2022-08-19'],
    datasets: [
                        {
                            label: 'Seller 1',
                            //barThickness: 16,
                            //barPercentage: 0.7,
                            //categoryPercentage: 1.0,
                            borderWidth: 2,
                            borderRadius: 5, // This will round the corners
                            //borderSkipped: false, // To make all side rounded
                            backgroundColor: 'red',
                            data: [5.30,5.99,5.70],
                        },
                        {
                            label: 'Seller 2',
                            //barThickness: 16,
                            //barPercentage: 0.7,
                            borderWidth: 2,
                            borderRadius: 5, // This will round the corners
                            //borderSkipped: false, // To make all side rounded
                            //categoryPercentage: 1.0,
                            backgroundColor: 'blue',
                            data: [5.30,5.89,6.00],
                        },
                        {
                            label: 'Seller 3',
                           // barThickness: 16,
                            //barPercentage: 0.7,
                            borderWidth: 2,
                            borderRadius: 5, // This will round the corners
                            //borderSkipped: false, // To make all side rounded
                            backgroundColor: 'green',
                            data: [5.45,5.85,6.20],
                        },
                ],
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "World Wine Production 2018"
    }
  }
}
});

/**
   * For Single label on x-axis START
   * 
var mybarChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Votes'],
    datasets: [{
      label: '# of Votes',
      backgroundColor: "#000080",
      data: [80]
    }, {
      label: '# of Votes2',
      backgroundColor: "#d3d3d3",
      data: [90]
    }, {
      label: '# of Votes3',
      backgroundColor: "#add8e6",
      data: [45]
    }]
  },
    options: {
    legend: {
      display: true,
      position: 'bottom',
      labels: {
        fontColor: "#000080",
      }
    },
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
});
* For Single label on x-axis END
**/
//Bar Graph END

//Piechart START
var xVal = ["Italy", "France", "Spain", "USA", "Argentina"];
var yVal = [55, 49, 44, 24, 15];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];

new Chart("pieChart", {
  type: "pie",
  data: {
    labels: xVal,
    datasets: [{
      backgroundColor: barColors,
      data: yVal
    }]
  },
  options: {
    title: {
      display: true,
      text: "World Wide Wine Production 2018"
    }
  }
});
//Piechart END
</script>

</body>
</html>