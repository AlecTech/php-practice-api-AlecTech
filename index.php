<?php
$GLOBALS['pageTitle'] = 'ANIME Gimbli';
include './templates/header.php'; 

// Retrieve data from API endpoint.
// @link https://alexwohlbruck.github.io/cat-facts/docs/
// https://ghibliapi.herokuapp.com/#
$dailyAnimeResponse = file_get_contents('http://ghibliapi.herokuapp.com/films');
// var_dump($dailyAnimeResponse);

if($dailyAnimeResponse)
{
    $dailyAnimeFilm = json_decode($dailyAnimeResponse);
    ?>
    
    <h2> Gimbli Anime MOVIES Response </h2>
    
    <p> <?php echo $dailyAnimeFilm[0]->title; ?> </p>
    <?php 
}

?>
<form action="index.php" method="POST">
  <label for="limit">Enter the Amount of Movies to reflect:
  <input type="number" id="amount" name="limit" value="20"></label>
  <label for="fields">Enter the Type of Data needed:
    <select id="film" name="fields">
      <option value="">All</option>
      <option value="people">People</option>
      <option value="location">Location</option>
      <option value="films">Films</option>
      <option value="vehicles">Vehicles</option>
    </select>
  </label>
  <input type="submit" value="Show Data!">
</form>
<?php
if ( isset( $_POST['limit'] ) && isset( $_POST['fields']))
{
$animeListLimit = file_get_contents(
    "http://ghibliapi.herokuapp.com/films?limit={$_POST['limit']}&fields={$_POST['fields']}");
var_dump ($animeListLimit );
}



include './templates/footer.php';