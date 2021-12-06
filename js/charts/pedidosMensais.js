agostoConcluido = document.querySelector('#agostoConcluido').innerHTML; 
agostoCancelado = document.querySelector('#agostoCancelado').innerHTML;

setembroConcluido = document.querySelector('#setembroConcluido').innerHTML; 
setembroCancelado = document.querySelector('#setembroCancelado').innerHTML;

outubroConcluido = document.querySelector('#outubroConcluido').innerHTML; 
outubroCancelado = document.querySelector('#outubroCancelado').innerHTML;

novembroConcluido = document.querySelector('#novembroConcluido').innerHTML; 
novembroCancelado = document.querySelector('#novembroCancelado').innerHTML;

dezembroConcluido = document.querySelector('#dezembroConcluido').innerHTML; 
dezembroCancelado = document.querySelector('#dezembroCancelado').innerHTML;

var options = {
          series: [{
          name: '',
          data: []
        }, {
          name: 'Pedidos Cancelados',
          data: [agostoConcluido, setembroConcluido, outubroConcluido, novembroConcluido, dezembroConcluido]
        },{
          name: '',
          data: []
        },{
          name: 'Pedidos Cancelados',
          data: [agostoCancelado, setembroCancelado, outubroCancelado, novembroCancelado, dezembroCancelado]
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + " Pedidos"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#pedidosMensais"), options);
        chart.render();