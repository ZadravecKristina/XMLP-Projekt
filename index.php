<!DOCTYPE html>
<html lang="en">

<head>

    <title>Pokédex</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

</head>
<body>

    <div class="container mt-4">

        <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Pok%C3%A9_Ball_icon.svg" class="icon" alt="" />
        <h1>Pokédex</h1><br/>

        <form method="post">
            <label for="search">Search for Pokémon by <b>type</b>:</label><br/>
            <input type="text" id="search" name="search" placeholder="Enter a type (e.g. &bdquo;grass&rdquo;)">
            <input type="submit" value="Search">
        </form>


        <?php

            $xml = simplexml_load_file("pokedex.xml");

            if (isset($_POST['search'])) {

                // Dohvaća tekst iz "search", pretvara ga u sva mala slova s prvim velikim, da se može naći u xml datoteci

                $search = $_POST['search'];
                $search = strtolower($search);
                $search = ucfirst($search);

                $query = "//pokemon[contains(type, '$search')]";
                $result = $xml->xpath($query);

                echo "<table class=\"table table-striped align-middle mt-4\">";
                echo "<thead class=\"table-dark text-uppercase\"><tr><th class=\"txt-center\">Ndex</th><th class=\"txt-center\">Sprite</th><th>Name</th><th>Category</th><th>Type</th><th>Ability</th><th class=\"txt-center\">Gen</th></tr></thead>";

                foreach ($result as $pokemon) {
                    echo "<tr><td class=\"txt-center\">#" . $pokemon['id'] . "</td><td><img src=\"" . $pokemon->sprite . "\"></td><td>" . $pokemon->name . "</td><td>" . $pokemon->category . "</td><td>" . $pokemon->type . "</td><td>" . $pokemon->ability . "</td><td class=\"txt-center\">" . $pokemon->generation . "</td></tr>";
                }
                
                echo "</table>";

            } else {

                echo "<table class=\"table table-striped align-middle mt-4\">";
                echo "<thead class=\"table-dark text-uppercase\"><tr><th class=\"txt-center\">Ndex</th><th class=\"txt-center\">Sprite</th><th>Name</th><th>Category</th><th>Type</th><th>Ability</th><th class=\"txt-center\">Gen</th></tr></thead>";

                foreach ($xml->pokemon as $pokemon) {
                    echo "<tr><td class=\"txt-center\">#" . $pokemon['id'] . "</td><td><img src=\"" . $pokemon->sprite . "\"></td><td>" . $pokemon->name . "</td><td>" . $pokemon->category . "</td><td>" . $pokemon->type . "</td><td>" . $pokemon->ability . "</td><td class=\"txt-center\">" . $pokemon->generation . "</td></tr>";
                }

                echo "</table>";

            }

        ?>

    </div>

</body>
</html>