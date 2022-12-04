$(function () {
//---------------------
//- STACKED BAR CHART -
//---------------------

    let base_url = $("#stackedBarChart").data('url');
    let label = [];
    let dataset = [];
    let teamId = $("#teams").val();
    console.log(teamId);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: base_url+'/taskStackBar',
        data: {'team_id':teamId},
        dataType: 'json',
        async: false,
        type: 'get',
        success: function (response) {
            console.log(response);
            let keys = Object.keys(response);
            let labels = keys[0];
            let datasets = keys[1];
            label = response[labels];
            dataset = response[datasets];
            // console.log(dataset);
        },
        error: function (errors) {
            console.log("errors"+errors);

        }
    });
    var stackedBarChartDatas = {
        labels: label,
        datasets: dataset
    };

    let stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d');
    let stackedBarChartData = jQuery.extend(true, {}, stackedBarChartDatas);

    let stackedBarChartOptions = {
        responsive: true,

        legend: {
            display: true
        },
        maintainAspectRatio: false,
        scales: {
            xAxes: [{
                stacked: true,
            }],
            yAxes: [{
                stacked: true
            }]
        }
    };

    let stackedBarChart = new Chart(stackedBarChartCanvas, {
        type: 'bar',
        data: stackedBarChartData,
        options: stackedBarChartOptions
    });




    /*
* DONUT CHART
* -----------
*/

    var donutData = [
        {
            label: 'Series2',
            data : 30,
            color: '#3c8dbc'
        },
        {
            label: 'Series3',
            data : 20,
            color: '#0073b7'
        },
        {
            label: 'Series4',
            data : 50,
            color: '#00c0ef'
        }
    ];

    // $.ajax({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     url: '/projectOverview',
    //     dataType: 'json',
    //     async : false,
    //     type: 'get',
    //     success: function (response) {
    //
    //         response.forEach(function(item){
    //             var keys = Object.keys(item);
    //             let name = keys[0];
    //             // console.log(item[name]);
    //             if(item[name].length > 0){
    //
    //
    //                 // $.plot('#'+name, item[name], {
    //                 //     series: {
    //                 //         pie: {
    //                 //             show       : true,
    //                 //             radius     : 1,
    //                 //             innerRadius: 0.5,
    //                 //             label      : {
    //                 //                 show     : true,
    //                 //                 radius   : 2 / 3,
    //                 //                 formatter: labelFormatter,
    //                 //                 threshold: 0.1
    //                 //             }
    //                 //
    //                 //         }
    //                 //     },
    //                 //     legend: {
    //                 //         show: false
    //                 //     }
    //                 // });
    //             }
    //
    //         });
    //     },
    //     error: function (errors) {
    //
    //     }
    // });

    /*
     * END DONUT CHART
     */

    /*
* Custom Label formatter
* ----------------------
*/
    function labelFormatter(label, series) {
        return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
            + label
            + '<br>'
            + Math.round(series.percent) + '%</div>'
    }

});
