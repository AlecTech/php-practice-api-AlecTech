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
<form action="index.php" method="GET">
  <label for="limit">Enter the Amount of Movies to reflect:
  <input type="number" id="amount" name="limit" value="20"></label>
  <label for="fields">Enter the Type of Data needed:
    <select id="film" name="fields">
      <option value="">All</option>
      <option value="people">People</option>
      <option value="locations">Location</option>
      <option value="films">Films</option>
      <option value="vehicles">Vehicles</option>
    </select>
  </label>
  <input type="submit" value="Show Data!">
</form>
<?php
if ( isset( $_GET['limit'] ) && isset( $_GET['fields']))
{
    $animeListLimit = file_get_contents(
        "http://ghibliapi.herokuapp.com/films?limit={$_GET['limit']}&fields={$_GET['fields']}");
    // var_dump ($animeListLimit );
    if($animeListLimit)
    {
        $animeList = json_decode($animeListLimit);
        ?>
            <h2> 
                List Of  
                <?php echo $_GET['fields']; ?>
                Data
            </h2>
           
            <?php
            if ($_GET['fields'] =='people'): 
            ?>
            <ol>
                <?php foreach ( $animeList as $fields ) : ?>
                    <?php
                        foreach ($fields->people as $url) : ?>
                        
                    <li>
                        <?php echo $url; ?>
                    </li>
                    <?php endforeach;  ?>
                <?php endforeach;  ?>
            </ol>
            <?php endif; ?>
            
            <?php
            if ($_GET['fields'] =='locations'): 
            ?>
                <ol>
                    <?php foreach ( $animeList as $fields ) : ?>
                        <?php
                            foreach ($fields->locations as $url) : ?>
                            
                        <li>
                            <?php echo $url; ?>
                        </li>
                        <?php endforeach;  ?>
                    <?php endforeach;  ?>
                </ol>
            <?php endif; ?>


            <?php
            if ($_GET['fields'] =='vehicles'): 
            ?>
            <ol>
                <?php foreach ( $animeList as $fields ) : ?>
                    <?php
                        foreach ($fields->vehicles as $url) : ?>
                        
                    <li>
                        <?php echo $url; ?>
                    </li>
                    <?php endforeach;  ?>
                <?php endforeach;  ?>
            </ol>
            <?php endif; ?>

        <?php


    }

    if (isset( $_GET['limit'] ))
    {
        $animeListLimit2 = file_get_contents(
            "http://ghibliapi.herokuapp.com/films?limit={$_GET['limit']}");
            // var_dump ($animeListLimit2 );

            $animeList = json_decode($animeListLimit2);

            if ($_GET['fields'] =='films'): 
            ?>
                <ol>
                    <?php foreach ( $animeList as $films ) : ?>
                    <li>
                        <ul>
                            <?php foreach ($films as $url) : ?>
                                <li><?php 
                                    if (! is_array($url)) {
                                        echo $url; 
                                    }
                                ?></li>
                            <?php endforeach;  ?>
                        </ul>
                    </li>
                    <?php endforeach;  ?>
                </ol>
            <?php endif; ?> 
        <?php
    }
   
    
}


 include './templates/footer.php';