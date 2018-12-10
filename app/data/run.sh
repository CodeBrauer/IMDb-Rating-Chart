#!/bin/bash
# https://www.imdb.com/conditions

echo -ne 'Downloading files...\n'

wget https://datasets.imdbws.com/title.akas.tsv.gz
wget https://datasets.imdbws.com/title.episode.tsv.gz
wget https://datasets.imdbws.com/title.ratings.tsv.gz

echo -ne 'Decompressing files...\n'

gzip -d title.akas.tsv.gz
gzip -d title.episode.tsv.gz
gzip -d title.ratings.tsv.gz

echo -ne 'Done!\n'