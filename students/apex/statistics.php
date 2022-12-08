<script>
        
        var options = {
          series: [
        //   {
        //     name: "High - 2013",
        //     data: [0, 0, 0, 200, 0, 0, 0]
        //   },
        //   {
        //     name: "Low - 2013",
        //     data: [12, 11, 14, 18, 17, 13, 13]
        //   },
        //   {
        //     name: "Low - 2013",
        //     data: [12, 11, 14, 18, 17, 13, 13]
        //   },
        //   {
        //     name: "Low - 2013",
        //     data: [12, 11, 14, 18, 17, 13, 13]
        //   }
        ],
          chart: {
          height: 350,
          type: 'line',
          dropShadow: {
            enabled: true,
            color: '#000',
            top: 18,
            left: 7,
            blur: 10,
            opacity: 0.2
          },
          toolbar: {
            show: false
          }
        },
        colors: ['#ffa600', '#58508d' , '#bc5090', '#003f5c'],
        dataLabels: {
          enabled: true,
        },
        stroke: {
          curve: 'smooth'
        },
        title: {
          text: 'Engagement Chart',
          align: 'left'
        },
        grid: {
          borderColor: '#e7e7e7',
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        markers: {
          size: 1
        },
        xaxis: {
          title: {
            text: 'Engagement'
          }
        },
        yaxis: {
          title: {
            text: 'Engagement Chart'
          },
        },
        legend: {
          position: 'top',
          horizontalAlign: 'right',
          floating: true,
          offsetY: -25,
          offsetX: -5
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
</script>