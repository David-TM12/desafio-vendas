@extends('adminlte::page')

@section('title', 'Gráficos')

@section('content_header')
    <h1>Gráficos</h1>
@stop

@section('content')

    <div class="card card-primary">
        <div class="card-body">

            <div id="container"></div>

        </div>
    </div>
    
@stop


@section('css')

@stop
@section('js')
    

<script type="text/javascript">
    const userData = <?php echo json_encode($userDatas ?? '')?>;

    // Radialize the colors
Highcharts.setOptions({
    lang: {
        decimalPoint: ',',
        thousandsSep: '.'
    },
    colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
        return {
            radialGradient: {
                cx: 0.5,
                cy: 0.3,
                r: 0.7
            },
            stops: [
                [0, color],
                [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
            ]
        };
    })
});

// Build the chart
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Quantidade de compra por cliente'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.y:.1f}</b>'

    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: 'Cliente: {point.name} <br>Qtde Compras: <b>{point.y:.1f}</b>', 
                connectorColor: 'silver'
            }
        }
    },
    series: [{
        name: 'Quant. Compras',
        data: userData
    }]
});

</script>
@endsection