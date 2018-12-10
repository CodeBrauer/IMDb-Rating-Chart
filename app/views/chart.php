<?php require __DIR__ . DIRECTORY_SEPARATOR . 'header.php'; ?>
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
<?php require __DIR__ . DIRECTORY_SEPARATOR . 'footer.php'; ?>