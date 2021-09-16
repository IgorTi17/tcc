var dadosMarco = document.querySelector('#dadosMarco').innerText;
var dadosAbril = document.querySelector('#dadosAbril').innerText;
var dadosMaio = document.querySelector('#dadosMaio').innerText;
var dadosJunho = document.querySelector('#dadosJunho').innerText;
var dadosJulho = document.querySelector('#dadosJulho').innerText;
var dadosAgosto = document.querySelector('#dadosAgosto').innerText;
var dadosSetembro = document.querySelector('#dadosSetembro').innerText;

var options = {
          series: [
          {
            name: 'Atual',
            data: [
              {
                x: 'Março',
                y: dadosMarco
              },
              {
                x: 'Abril',
                y: dadosAbril
              },
              {
                x: 'Maio',
                y: dadosMaio,
                goals: [
                  {
                    name: 'Expectativa',
                    value: 3,
                    strokeWidth: 5,
                    strokeColor: '#775DD0'
                  }
                ]
              },
              {
                x: 'Junho',
                y: dadosJunho,
                goals: [
                  {
                    name: 'Expectativa',
                    value: 3,
                    strokeWidth: 5,
                    strokeColor: '#775DD0'
                  }
                ]
              },
              {
                x: 'Julho',
                y: dadosJulho,
                goals: [
                  {
                    name: 'Expectativa',
                    value: 3,
                    strokeWidth: 5,
                    strokeColor: '#775DD0'
                  }
                ]
              },
              {
                x: 'Agosto',
                y: dadosAgosto,
                goals: [
                  {
                    name: 'Expectativa',
                    value: 3,
                    strokeWidth: 5,
                    strokeColor: '#775DD0'
                  }
                ]
              },
			  {
                x: 'Setembro',
                y: dadosSetembro,
                goals: [
                  {
                    name: 'Expectativa',
                    value: 3,
                    strokeWidth: 5,
                    strokeColor: '#775DD0'
                  }
                ]
              }
            ]
          }
        ],
          chart: {
          height: 350,
          type: 'bar'
        },
        plotOptions: {
          bar: {
            columnWidth: '60%'
          }
        },
        colors: ['#00E396'],
        dataLabels: {
          enabled: false
        },
        legend: {
          show: true,
          showForSingleSeries: true,
          customLegendItems: ['Atual', 'Expectativa'],
          markers: {
            fillColors: ['#00E396', '#775DD0']
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#novosClientesChart"), options);
        chart.render();