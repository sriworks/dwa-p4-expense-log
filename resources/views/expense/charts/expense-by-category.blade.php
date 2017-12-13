<canvas id="myChart" width="400" height="250"></canvas>
<script>

    var data = {
    datasets: [{
        data: [10, 20, 30],
        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f"]
    }],
    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
        'Auto',
        'Entertainment',
        'Mortgage/Rent'
    ]
    };
    var ctx = document.getElementById("myChart");
    
    var myPieChart = new Chart(ctx,{
        type: 'pie',
        data: data,
        options: {
          title: {
            display: true,
            text: 'Expense by Category'
          }
        }
    });
    
</script>