<!-- resources/views/chart.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-Time Chart</title>
    <style>
        /* Flex container styling */
        .chart-container {
            display: flex;
            justify-content: space-between; /* Adjust as needed */
            transform: scale(0.5);
        }
        .text-container {
            display: flex;
            justify-content: space-between; /* Adjust as needed */
            transform: scale(0.5);
        }

        /* Individual chart styling */
        .chart {
            flex: 1; /* Distribute available space equally between charts */
            margin: 10px; /* Add margin for spacing */
        }

        #rcorners1{
            border-radius: 5px;
            background: #55E2E9;
            padding: 5px;
            width: 300px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        *{
            box-sizing: border-box;
        }

        .menu {
        float: left;
        width: 20%;
        text-align: center;
        }

        .menu a {
        background-color: #e5e5e5;
        padding: 8px;
        margin-top: 7px;
        display: block;
        width: 100%;
        color: black;
        }

        .main {
        float: left;
        width: 10%;
        padding: 0 20px;
        }

        .right {
        background-color: #e5e5e5;
        float: left;
        width: 40%;
        padding: 15px;
        margin-top: 7px;
        text-align: center;
        }

        @media only screen and (max-width: 620px) {
        /* For mobile phones: */
        .menu, .main, .right {
            width: 100%;
        }
        }


    </style>
</head>
<body style="font-family:Verdana;color:#aaaaaa;">
    <div style="background-color:#e5e5e5;padding:15px;text-align:center;">
    <h1>Student Database</h1>
    </div>

    <div class = "main">
        <h3>Table Structure:</h3>
        <p>
            Name <br>
            Email <br>
            Class <br>
            Score <br>
            Age <br>
            id(primary key) <br>
            created at <br>
            updated at
        </p>
    </div>
    <div style="overflow:auto">
  <div class="menu">
    <a href="#">Total Students:</a>
    <a herf="#" id = "totalStudent">0</a>
    <a href="#">Updated at:</a>
    <a herf="#" id = "updateTime">0</a>
  </div>

  <div class="right">
    <canvas id="age" width="50" height="50"></canvas>
  </div>

  <div class="right">
    <canvas id="class" width="100" height="100"></canvas>
  </div>
</div>
<div style="background-color:#e5e5e5;text-align:center;padding:10px;margin-top:7px;">Md. Maksudul Hasan</div>
    <!-- Your JavaScript code here -->

   <!-- Include jQuery and Chart.js -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- <div class = "chart-container">
   
        <canvas id="age" width="50" height="50"></canvas>
        <canvas id="class" width="100" height="100"></canvas>
    </div> -->
    <!-- JavaScript to fetch data and update the chart -->
    <script>
        $(document).ready(function () {
            var ctx = document.getElementById('age').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [], // Your x-axis labels
                    datasets: [{
                        label: 'Number of Students',
                        data: [],
                        borderWidth: 1,
                    }]
                }
            });
            var pieCtx = document.getElementById('class').getContext('2d');
            var pieChart = new Chart(pieCtx, {
                type: 'pie',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Students Scores',
                        data: [],
                        backgroundColor: [
                            'rgba(0, 128, 0, 0.7)',
                            'rgba(54, 128, 10, 0.7)',
                            'rgba(255, 206, 86, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(153, 102, 255, 0.7)',
                            'rgba(200, 206, 86, 0.7)',
                            'rgba(175, 192, 190, 0.7)',
                            'rgba(255, 0, 0, 0.7)',
                        ],
                        borderWidth: 1,
                    }]
                },
                options: {
                        layout: {
                            padding: {
                                left: 10,
                                right: 10,
                                top: 10,
                                bottom: 10
                            }
                        },
                        maintainAspectRatio: true,
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: 'Scores of Students'
                            }
                        }
                }
            });
            
        
        
            function updateChart() {
                $.ajax({
                    url: '{{ route('chart-data') }}',
                    method: 'GET',
                    success: function (data) {
                        function calculateGrade(score) {
                            if (score >= 80) return 0;
                            else if (score >= 70) return 1;
                            else if (score >= 60) return 2;
                            else if (score >= 50) return 3;
                            else if (score >= 40) return 4;
                            else if (score >= 35) return 5;
                            else if (score >= 30) return 6;
                            else return 7;
                        }



                        var num = new Array(10).fill(0);
                        var index = new Array(10);
                        var i = 0;
                        var score = new Array(8).fill(0);

                        for(id = 0; id < data.length; id++){
                            num[data[id]['class'] - 1]++;
                            score[calculateGrade(data[id]['score'])]++;

                        }
                        for(i = 1; i <= 10; i++){
                            index[i - 1] = '' + i;
                            index[i - 1] = 'Class ' + index[i - 1];
                        }
                        
                      
                        // Update chart data
                        myChart.data.labels =  index;
                        myChart.data.datasets[0].data = num;

                        myChart.update();


                        //update pie chart
                        var gradeArray = ['A+', 'A', 'B+', 'B', 'C+', 'C', 'D', 'Fail'];
                        pieChart.data.labels =  gradeArray;
                        pieChart.data.datasets[0].data = score;

                        pieChart.update();
                        document.getElementById("totalStudent").innerHTML = data.length;
                        var currentDate = new Date();

                        // Get individual components
                        var year = currentDate.getFullYear();
                        var month = currentDate.getMonth() + 1; // Month is zero-based, so add 1
                        var day = currentDate.getDate();
                        var hours = currentDate.getHours();
                        var minutes = currentDate.getMinutes();
                        var seconds = currentDate.getSeconds();
                        var timeanddate =  year + "-" + month + "-" + day + " | " + hours + ":" + minutes + ":" + seconds;
                        document.getElementById("updateTime").innerHTML = timeanddate;
                    }
                });
            }

            // // Update chart every 5 seconds (adjust as needed)
            // // updateChart();
            setInterval(updateChart, 5000);
        });
    </script>
</body>
</html>
