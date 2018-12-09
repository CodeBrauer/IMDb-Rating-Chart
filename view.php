<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IMDb Rating Chart (by Episode)</title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/app.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/heatmap.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
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
                <input type="search" name="s" id="s" placeholder="Your TV series like Game of Thrones, Scrubs…"  class="form-control">
                <input type="submit" value="Search" class="btn btn-primary">
                <small>If the search does not work, you can also try the <a href="https://imdb.com" target="_blank">IMDb</a> ID (like "tt6468322")</small>
            </form>
        </div>
        <br>
        <div id="chart" style="height: 800px; min-width: 510px; max-width: 1000px; margin: 0 auto"></div>
    </div>
    <footer class="text-center">
        <div class="container">
            <small>Author: <a href="https://github.com/CodeBrauer/">CodeBrauer</a> | Data provided by <a href="http://www.omdbapi.com/">www.omdbapi.com</a></small>
        </div>
    </footer>

    <script type="text/javascript">
        var data         = <?php echo json_encode($data); ?>;
        var series_title = '@todo';
    </script>
    <script src="assets/app.js"></script>
</body>
</html>