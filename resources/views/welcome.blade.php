<form method="get">
    <input type="text" name="album"/>
    <input type="submit"/>
</form>

<?php
$session = new \SpotifyWebAPI\Session(
    'a1d51956f44447dc96448437bb1eae66',
    'd9a5d28f4e3a4668970b2f8105aaa9e1',
);
$session->requestCredentialsToken();
$accessToken = $session->getAccessToken();

$api = new SpotifyWebAPI\SpotifyWebAPI();
$api->setAccessToken($accessToken);
if (isset($_GET['album'])) {
    $album = $api->getAlbum($_GET['album']);
    echo "<h1>{$album->artists[0]->name}</h1>";
    echo "<h2>{$album->name}</h2>";
    echo "<img style='width: 150px' src='{$album->images[0]->url}' alt='$album->name'/></br></br>";

    $tracks = $api->getAlbumTracks($_GET['album']);
    $i = 1;
    foreach ($tracks->items as $track) {
        echo "<b>$i. $track->name</b></br>";
        $i++;
    }
}
