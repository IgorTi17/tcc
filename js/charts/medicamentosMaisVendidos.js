var options = {
          series: [{
          data: [50, 80, 30, 20, 35]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            horizontal: true,
          }
        },
        dataLabels: {
          enabled: false
        },
        xaxis: {
          categories: ['Dipirona', 'Cimegripe', 'Torsilax', 'Colidis', 'Advil'
          ],
        }
        };

        var chart = new ApexCharts(document.querySelector("#medicamentosMaisVendidoschart"), options);
        chart.render();