<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css"/>
    <title>Pokedex</title>

</head>
<body>
<main>
    <?php
    $url_pokemon = "https://pokeapi.co/api/v2/pokemon/";
    $id_pokemon = trim($_POST["poke-id"]);
    $response_data = file_get_contents($url_pokemon . $id_pokemon . "/");
    $one_pokemon_data_array = json_decode($response_data, true);
    $url_species = "https://pokeapi.co/api/v2/pokemon-species/";
    $evolution_data = file_get_contents($url_species . $id_pokemon . "/");
    $species_array = json_decode($evolution_data, true);
    $link = $species_array["evolution_chain"];
   // $evolution_info = file_get_contents($link["url"]);
    echo ($link["url"]);
   // $evolution_array = json_decode($evolution_info, true);
    // $evolution_name = file_get_contents($url_pokemon . getEvolName($evolution_info));
//  $evolution_one_pokemon = json_decode($evolution_name);
//    var_dump($evolution_one_pokemon);


    function ImgSrc ($image) {
    return ($image)["sprites"]["front_default"];
    }
    function GetName ($name) {
        return ($name)["name"];
    }
    function GetId ($id) {
        return ($id)["id"];
    }
    function GetMoves ($moves) {
        $allMoves = $moves["moves"];
        if (count($allMoves) < 4) {
        $possibleMoves = $allMoves;
        }
        else  {
        $possibleMoves = array_slice($allMoves, 0, 4);
        }
        $moveNames = [];
        foreach ($possibleMoves as $move) {
            array_push($moveNames, $move['move']['name']);
        }
        return $moveNames;
    }
    function getEvolName ($data) {
        return ($data)["chain"]["species"]["name"];
    }
    ?>
    <form action="" method="post" class="search">
        <label for="poke-id">Type ID or name of pokemon</label>
        <input type="text" name="poke-id" id="poke-id" value=" "/>
        <br/>
        <input type="submit" name="submit" value="Search"/>
    </form>
    <br/>
    <section class="output">
        <div class="datas">
            <img src="<?php echo ImgSrc($one_pokemon_data_array)?>" alt=" " width="100px">
            <h1><?php echo GetID($one_pokemon_data_array)?></h1>
            <h2 id="name"><?php echo GetName($one_pokemon_data_array)?></h2>
            <p>Moves:
                <?php
                   foreach ((GetMoves($one_pokemon_data_array)) as $value) {
                    echo "$value <br>";
                }
                ?>
            </p>
            </div>
            <div class="evolution">
                <img src="<?php /* echo imgSrc($evolution_one_pokemon)*/?>" alt="pokemon"/>
                <h3><?php /*echo getEvolName($evolution_array)*/?></h3>
            </div>
    </section>
    <button type="button" class="reset">RESET</button>

</main>

</body>
</html>