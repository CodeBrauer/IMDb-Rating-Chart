<?php
define('OMDBAPI_API_KEY', 'b6775c8');

function curl_get_contents($url) {
    if (!function_exists('curl_init')) { return file_get_contents($url); } // fallback
    $ch = curl_init();
    $options = array(
        CURLOPT_CONNECTTIMEOUT => 1,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HEADER         => false,
        CURLOPT_URL            => $url,
    );
    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

function get_episodes_by_season($search, $season = 1) {
    $url = 'http://www.omdbapi.com/?t='.urlencode($search).'&r=json&Season='.$season.'&apikey='.OMDBAPI_API_KEY.'&type=episode';
    return curl_get_contents($url);
}
$season = 1;
$last_season = 100;
$data = [];

if (isset($_GET['s'])) {
    while ($season <= $last_season) {
        $row = get_episodes_by_season($_GET['s'], $season);
        $last_season = (int)$row['totalSeasons'];
        foreach ($row['Episodes'] as $episode) {
            if ($episode['imdbRating'] == 0) {
                continue;
            }
            $data[] = [(int)$season, (int)$episode['Episode'], (float)$episode['imdbRating'], $episode['Title']];
        }
        $season++;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDb Rating Chart (by Episode)</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/heatmap.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <style type="text/css">
    input#s {
        min-width: 80%;
        margin-right: 10px;
    }
    body {
        margin-bottom: 60px;
    }
    .wrap {
        max-width: 600px;
        margin: auto;
    }
    footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        height: 60px;
        line-height: 60px;
        background-color: #f5f5f5;
    }
</style>
</head>
<body>
    <div class="container">
        <div class="wrap">
            <header>
                <h1 class="mt-5">IMDb Rating Chart (by Episode)</h1>
                <p class="lead">
                    Visualize IMDb ratings from all seasons of each episode of your favourite tv series. Find the best and the worst season/episode in seconds!
                </p>
            </header>
            <form action="/" method="get" class="form-inline">
                <input type="search" name="s" id="s" placeholder="Your TV series like Game of Thrones, Scubs…"  class="form-control">
                <input type="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
        <br>
        <div id="chart" style="height: 800px; min-width: 510px; max-width: 1000px; margin: 0 auto"></div>
        <script type="text/javascript">
            var data = <?php echo json_encode($data); ?>;
            var chart = Highcharts.chart('chart', {
                chart: {
                    type: 'heatmap',
                    marginTop: 40,
                    marginBottom: 80,
                    plotBorderWidth: 1
                },
                title: { text: '<?= $_GET['s'] ?> - IMDb rating per season/episode' },
                xAxis: {
                    title: {text: 'Season'},
                    tickInterval: 1,
                },
                yAxis: {
                    title: {text: 'Episode'},
                    tickInterval: 1,
                    reversed: true,
                },
                colorAxis: {
                    stops: [
                    [0, '#df0000'],
                    [0.5, '#dfdf00'],
                    [1, '#00df00'],
                    ]
                },
                legend: {
                    align: 'right',
                    layout: 'vertical',
                    margin: 0,
                    verticalAlign: 'top',
                    y: 25,
                    symbolHeight: 280,
                },
                tooltip: {
                    formatter: function () {
                        return '<b>S' + this.point.x + 'E' + this.point.y +
                        '</b>: '+data[this.point.index][3]+'<br>Rating: ' + this.point.value;
                    }
                },
                series: [{
                    name: 'IMDb Rating',
                    borderWidth: 1,
                    data: data,
                    dataLabels: {
                        enabled: true,
                        color: '#000000'
                    }
                }]

            });
        </script>
    </div>
    <footer class="text-center">
        <div class="container">
            <small>Author: <a href="https://github.com/CodeBrauer/">CodeBrauer</a> | Data provided by <a href="http://www.omdbapi.com/">www.omdbapi.com</a></small>
        </div>
    </footer>
</body>
</html>
