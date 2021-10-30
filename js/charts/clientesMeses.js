var dadosMarco = document.querySelector('#dadosMarco').innerText;
var dadosAbril = document.querySelector('#dadosAbril').innerText;
var dadosMaio = document.querySelector('#dadosMaio').innerText;
var dadosJunho = document.querySelector('#dadosJunho').innerText;
var dadosJulho = document.querySelector('#dadosJulho').innerText;
var dadosAgosto = document.querySelector('#dadosAgosto').innerText;
var dadosSetembro = document.querySelector('#dadosSetembro').innerText;

console.log(dadosSetembro);

var options = {
          series: [
          {
            name: 'Novos',
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
                y: dadosMaio
              },
              {
                x: 'Junho',
                y: dadosJunho
              },
              {
                x: 'Julho',
                y: dadosJulho
              },
              {
                x: 'Agosto',
                y: dadosAgosto
              },
			  {
                x: 'Setembro',
                y: dadosSetembro
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
        colors: ['#DAA520'],
        dataLabels: {
          enabled: false
        },
        legend: {
          show: true,
          showForSingleSeries: true,
          customLegendItems: ['Novos'],
          markers: {
            fillColors: ['#DAA520']
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#novosClientesChart"), options);
        chart.render();