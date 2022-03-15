/* ----- Employee Dashboard Chart Js For Applications Statistics ----- */
function createConfig() {
    return {
        type: 'line',
        fontFamily: 'iransans-UltraLight',
        data: {
            labels: ['دی', 'بهمن', 'اسفند', 'فروردین', 'اردیبهشت', 'خرداد', 'تیر'],
            datasets: [{
                label: 'مجموعه داده',
                borderColor: window.chartColors.red,
                backgroundColor: window.chartColors.red,
                data: [10, 30, 46, 2, 8, 50, 0],
                fill: false,
                fontFamily: 'iransans-UltraLight',
            }]
        },
        legend:{
            fontFamily: 'iransans-UltraLight',
            
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'نمونه راهنمای ابزار با حاشیه',
                fontFamily: 'iransans-UltraLight',
            },
            axisY:{
                fontFamily: 'iransans-UltraLight',
            },
            axisX:{
                fontFamily: 'iransans-UltraLight',
            },
            tooltips: {
                position: 'nearest',
                mode: 'index',
                intersect: false,
                yPadding: 10,
                xPadding: 10,
                caretSize: 8,
                backgroundColor: 'rgba(72, 241, 12, 1)',
                titleFontColor: window.chartColors.black,
                bodyFontColor: window.chartColors.black,
                borderColor: 'rgba(0,0,0,1)',
                borderWidth: 4,
                fontFamily: 'iransans-UltraLight',
      labelTextAlign: "right",

            },
        }
    };
}
window.onload = function() {
    var c_container = document.querySelector('.c_container');
    var div = document.createElement('div');
    div.classList.add('chart-container');

    var canvas = document.createElement('canvas');
    div.appendChild(canvas);
    c_container.appendChild(div);

    var ctx = canvas.getContext('2d');
    var config = createConfig();
    new Chart(ctx, config);
};


