'use strict';
document.addEventListener('DOMContentLoaded', function () {
  setTimeout(function () {
    floatchart();
  }, 500);
  new SimpleBar(document.querySelector('.customer-scroll'));
  new SimpleBar(document.querySelector('.customer-scroll1'));
  new SimpleBar(document.querySelector('.customer-scroll2'));
  new SimpleBar(document.querySelector('.customer-scroll3'));

  var lightboxModal = new bootstrap.Modal(document.getElementById('lightboxModal'));
  var elem = document.querySelectorAll('[data-lightbox]');
  for (var j = 0; j < elem.length; j++) {
    elem[j].addEventListener('click', function () {
      var images_path = event.target;
      if (images_path.tagName == 'DIV') {
        images_path = images_path.parentNode;
      }
      if (images_path.tagName == 'I') {
        images_path = images_path.parentNode.parentNode;
      }
      var recipient = images_path.getAttribute('data-lightbox');
      var image = document.querySelector('.modal-image');
      image.setAttribute('src', recipient);
      lightboxModal.show();
    });
  }
  
  function removeClassByPrefix(node, prefix) {
    for (let i = 0; i < node.classList.length; i++) {
      let value = node.classList[i];
      if (value.startsWith(prefix)) {
        node.classList.remove(value);
      }
    }
  }
});

function floatchart() {
  // [ Statistics-chart ] start
  (function () {
    var options = {
      chart: {
        height: 230,
        type: 'line',
        toolbar: {
          show: false,
        },
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        width: 2,
        curve: 'smooth'
      },
      series: [{
        name: 'Arts',
        data: [20, 50, 30, 60, 30, 50]
      }, {
        name: 'Commerce',
        data: [60, 30, 65, 45, 67, 35]
      }],
      legend: {
        position: 'top',
      },
      xaxis: {
        type: 'datetime',
        categories: ['1/11/2000', '2/11/2000', '3/11/2000', '4/11/2000', '5/11/2000', '6/11/2000'],
        axisBorder: {
          show: false,
        },
        label: {
          style: {
            color: '#ccc'
          }
        },
      },
      yaxis: {
        show: true,
        min: 10,
        max: 70,
        labels: {
          style: {
            color: '#ccc'
          }
        }
      },
      colors: ['#73b4ff', '#59e0c5'],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'light',
          gradientToColors: ['#4099ff', '#2ed8b6'],
          shadeIntensity: 0.5,
          type: 'horizontal',
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 100]
        },
      },
      markers: {
        size: 5,
        colors: ['#4099ff', '#2ed8b6'],
        opacity: 0.9,
        strokeWidth: 2,
        hover: {
          size: 7,
        }
      },
      grid: {
        borderColor: '#cccccc3b',
      }
    }
    new ApexCharts(document.querySelector("#Statistics-chart"), options).render();
  })();
  // [ Statistics-chart ] end
  // [ customer-chart ] start
  (function () {
    var options = {
      chart: {
        height: 150,
        type: 'donut',
      },
      dataLabels: {
        enabled: false
      },
      plotOptions: {
        pie: {
          donut: {
            size: '75%'
          }
        }
      },
      labels: ['New', 'Return'],
      series: [39, 10],
      legend: {
        show: false
      },
      tooltip: {
        theme: 'dark',
        fillSeriesColor: false
      },
      grid: {
        padding: {
          top: 20,
          right: 0,
          bottom: 0,
          left: 0
        },
      },
      colors: ["#4680ff", "#2ed8b6"],
      fill: {
        opacity: [1, 1]
      },
      stroke: {
        width: 0,
      }
    }
    var chart = new ApexCharts(document.querySelector("#customer-chart"), options);
    chart.render();
    var options1 = {
      chart: {
        height: 150,
        type: 'donut',
      },
      dataLabels: {
        enabled: false
      },
      plotOptions: {
        pie: {
          donut: {
            size: '75%'
          }
        }
      },
      labels: ['New', 'Return'],
      series: [20, 15],
      legend: {
        show: false
      },
      tooltip: {
        theme: 'dark',
        fillSeriesColor: false
      },
      grid: {
        padding: {
          top: 20,
          right: 0,
          bottom: 0,
          left: 0
        },
      },
      colors: ["#fff", "#2ed8b6"],
      fill: {
        opacity: [1, 1]
      },
      stroke: {
        width: 0,
      }
    }
    var chart = new ApexCharts(document.querySelector("#customer-chart1"), options1);
    chart.render();
  })();
  // [ customer-chart ] end
  // [ seo-card1 ] start
  (function () {
    var options1 = {
      chart: {
        type: 'area',
        height: 145,
        sparkline: {
          enabled: true
        }
      },
      dataLabels: {
        enabled: false
      },
      colors: ["#ff5370"],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          gradientToColors: ['#ff869a'],
          shadeIntensity: 1,
          type: 'horizontal',
          opacityFrom: 1,
          opacityTo: 0.8,
          stops: [0, 100, 100, 100]
        },
      },
      stroke: {
        curve: 'smooth',
        width: 2,
      },
      series: [{
        data: [45, 35, 60, 50, 85, 70]
      }],
      yaxis: {
        min: 5,
        max: 90,
      },
      tooltip: {
        fixed: {
          enabled: false
        },
        x: {
          show: false
        },
        y: {
          title: {
            formatter: function (seriesName) {
              return 'Ticket '
            }
          }
        },
        marker: {
          show: false
        }
      }
    }
    new ApexCharts(document.querySelector("#seo-card1"), options1).render();
  })();
  // [ seo-card1 ] end
  // [ coversions-chart ] start
  (function () {
    var options1 = {
      chart: {
        type: 'bar',
        height: 65,
        sparkline: {
          enabled: true
        }
      },
      dataLabels: {
        enabled: false
      },
      colors: ["#73b4ff"],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'light',
          type: "vertical",
          shadeIntensity: 0,
          gradientToColors: ["#4099ff"],
          inverseColors: true,
          opacityFrom: 0.99,
          opacityTo: 0.99,
          stops: [0, 100]
        },
      },
      plotOptions: {
        bar: {
          columnWidth: '80%'
        }
      },
      series: [{
        data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54, 25, 66, 41, 89, 63, 54, 25, 66, 41, 85, 63, 25, 44, 12, 36, 9, 54, 25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 25, 44, 12, 36, 9, 54]
      }],
      xaxis: {
        crosshairs: {
          width: 1
        },
      },
      tooltip: {
        fixed: {
          enabled: false
        },
        x: {
          show: false
        },
        y: {
          title: {
            formatter: function (seriesName) {
              return ''
            }
          }
        },
        marker: {
          show: false
        }
      }
    }
    new ApexCharts(document.querySelector("#coversions-chart1"), options1).render();
    var options2 = {
      chart: {
        type: 'bar',
        height: 65,
        sparkline: {
          enabled: true
        }
      },
      dataLabels: {
        enabled: false
      },
      colors: ["#59e0c5"],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'light',
          type: "vertical",
          shadeIntensity: 0,
          gradientToColors: ["#2ed8b6"],
          inverseColors: true,
          opacityFrom: 0.99,
          opacityTo: 0.99,
          stops: [0, 100]
        },
      },
      plotOptions: {
        bar: {
          columnWidth: '80%'
        }
      },
      series: [{
        data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54, 25, 66, 41, 89, 63, 54, 25, 66, 41, 85, 63, 25, 44, 12, 36, 9, 54, 25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 25, 44, 12, 36, 9, 54]
      }],
      xaxis: {
        crosshairs: {
          width: 1
        },
      },
      tooltip: {
        fixed: {
          enabled: false
        },
        x: {
          show: false
        },
        y: {
          title: {
            formatter: function (seriesName) {
              return ''
            }
          }
        },
        marker: {
          show: false
        }
      }
    }
    new ApexCharts(document.querySelector("#coversions-chart2"), options2).render();
    var options4 = {
      chart: {
        type: 'bar',
        height: 65,
        sparkline: {
          enabled: true
        }
      },
      dataLabels: {
        enabled: false
      },
      colors: ["#ff869a"],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'light',
          type: "vertical",
          shadeIntensity: 0,
          gradientToColors: ["#ff5370"],
          inverseColors: true,
          opacityFrom: 0.99,
          opacityTo: 0.99,
          stops: [0, 100]
        },
      },
      plotOptions: {
        bar: {
          columnWidth: '80%'
        }
      },
      series: [{
        data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54, 25, 66, 41, 89, 63, 54, 25, 66, 41, 85, 63, 25, 44, 12, 36, 9, 54, 25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 25, 44, 12, 36, 9, 54]
      }],
      xaxis: {
        crosshairs: {
          width: 1
        },
      },
      tooltip: {
        fixed: {
          enabled: false
        },
        x: {
          show: false
        },
        y: {
          title: {
            formatter: function (seriesName) {
              return ''
            }
          }
        },
        marker: {
          show: false
        }
      }
    }
    new ApexCharts(document.querySelector("#coversions-chart4"), options4).render();
  })();
  // [ coversions-chart ] end
}

