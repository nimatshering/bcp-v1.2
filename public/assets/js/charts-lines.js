const lineConfig = {
  type: 'line',
  data: {
    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
    datasets: [
      {
        label: 'Temprature',
        backgroundColor: '#0694a2',
        borderColor: '#0694a2',
        data: [43, 48, 40, 54, 67, 73, 70],
        fill: false,
      },
      {
        label: 'Rainfall',
        fill: false,
        backgroundColor: '#7e3af2',
        borderColor: '#7e3af2',
        data: [24, 50, 64, 74, 52, 51, 65],
      },
    ],
  },
  options: {
    responsive: true,
    legend: {
      display: false,
    },
    tooltips: {
      mode: 'index',
      intersect: false,
    },
    hover: {
      mode: 'nearest',
      intersect: true,
    },
    scales: {
      x: {
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Month',
        },
      },
      y: {
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Value',
        },
      },
    },
  },
}
const lineCtx = document.getElementById('line')
window.myLine = new Chart(lineCtx, lineConfig);


/* line chart 2 */
const lineConfig1 = {
  type: 'line',
  data: {
    labels: ['1990', '2000', '2005', '2010', '2015', '2020'],
    datasets: [
      {
        label: 'Transport',
        backgroundColor: '#FFC107',
        borderColor: '#FFC107',
        data: [23, 18, 30, 34, 67, 53, 60],
        fill: false,
      },
      {
        label: 'Industry',
        backgroundColor: '#0694a2',
        borderColor: '#0694a2',
        data: [43, 68, 40, 54, 27, 73, 70],
        fill: false,
      },
      {
        label: 'Forestry',
        fill: false,
        backgroundColor: '#7e3af2',
        borderColor: '#7e3af2',
        data: [-24, -50, -64, -74, -52, -51, -65],
      },
    ],
  },
  options: {
    responsive: true,
    legend: {
      display: false,
    },
    tooltips: {
      mode: 'index',
      intersect: false,
    },
    hover: {
      mode: 'nearest',
      intersect: true,
    },
    scales: {
      x: {
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Month',
        },
      },
      y: {
        display: true,
        scaleLabel: {
          display: true,
          labelString: 'Value',
        },
      },
    },
  },
}
const lineCtx1 = document.getElementById('line1')
window.myLine = new Chart(lineCtx1, lineConfig1);