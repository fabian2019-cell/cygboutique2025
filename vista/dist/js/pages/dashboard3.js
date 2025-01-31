$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true

  var $salesChart = $('#sales-chart')
  var $visitorsChart = $('#visitors-chart')

  // Función para actualizar gráficos con datos
  function updateCharts(data) {
    var salesData = data.sales;
    var visitorsData = data.visitors;

    var salesLabels = salesData.map(item => item.month);
    var salesValues = salesData.map(item => item.sales);

    var visitorsLabels = visitorsData.map(item => item.visitors);
    var visitorsValues = visitorsData.map(item => item.date);

    // Actualizar gráfico de ventas
    var salesChart = new Chart($salesChart, {
      type: 'bar',
      data: {
        labels: salesLabels,
        datasets: [{
          backgroundColor: '#007bff',
          borderColor    : '#007bff',
          data           : salesValues
        }]
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          mode: mode,
          intersect: intersect
        },
        hover: {
          mode: mode,
          intersect: intersect
        },
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            gridLines: {
              display: true,
              lineWidth: '4px',
              color: 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks: $.extend({
              beginAtZero: true,
              callback: function (value, index, values) {
                if (value >= 1000) {
                  value /= 1000
                  value += 'k'
                }
                return '$' + value
              }
            }, ticksStyle)
          }],
          xAxes: [{
            display: true,
            gridLines: {
              display: false
            },
            ticks: ticksStyle
          }]
        }
      }
    });

    // Actualizar gráfico de visitantes
    var visitorsChart = new Chart($visitorsChart, {
      type: 'line',
      data: {
        labels: visitorsLabels,
        datasets: [{
          data: visitorsValues,
          backgroundColor: 'transparent',
          borderColor: '#007bff',
          pointBorderColor: '#007bff',
          pointBackgroundColor: '#007bff',
          fill: false
        }]
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          mode: mode,
          intersect: intersect
        },
        hover: {
          mode: mode,
          intersect: intersect
        },
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            gridLines: {
              display: true,
              lineWidth: '4px',
              color: 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks: $.extend({
              beginAtZero: true,
              suggestedMax: 200
            }, ticksStyle)
          }],
          xAxes: [{
            display: true,
            gridLines: {
              display: false
            },
            ticks: ticksStyle
          }]
        }
      }
    });
  }

  // Cargar datos y actualizar gráficos
  $.ajax({
    url: 'data.php',
    method: 'GET',
    dataType: 'json',
    success: function(data) {
      updateCharts(data);
    },
    error: function() {
      console.error('Error al cargar los datos.');
    }
  });
});
