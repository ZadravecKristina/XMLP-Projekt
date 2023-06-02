<!DOCTYPE html>
<html lang="en">

<head>

    <title>Pokédex</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <style>

        .txt-center {
            text-align: center;
        }

        img.icon {
            width: 50px;
            float: left;
        }

        table img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        input[type="text"], select {
            margin-right: 10px;
        }

        input[type="submit"], .refresh {
            padding-left: 20px;
            padding-right: 20px;
        }

    </style>

</head>
<body>

    <div class="container mt-4">

        <img src="https://upload.wikimedia.org/wikipedia/commons/5/53/Pok%C3%A9_Ball_icon.svg" class="icon" alt="" />
        <h1>Pokédex</h1><br/>

        <p>You can search for a specific Pokémon, or a group of Pokémon, either by their <b>name</b>, <b>type</b> or <b>generation</b>.</p>


        <div class="row mb-5">

            <div class="col-8">

                <form method="post" class="d-flex">

                    <select name="searchMethod" id="searchMethod" class="form-select w-25">
                        <option value="1">Name</option>
                        <option value="2">Type</option>
                        <option value="3">Generation</option>
                    </select>

                    <input type="text" id="search" name="search" placeholder="Enter a name, type or generation number" class="form-control w-50">
                    <input type="submit" value="Search" class="btn btn-outline-success">

                </form>  

            </div>

            <div class="col-4 d-flex justify-content-end">

                <button class="btn btn-outline-secondary refresh" onClick="window.location.href=window.location.href;">Show all</button>

            </div>

        </div>


        <?php

            $xml = simplexml_load_file("pokedex.xml");

            if ((isset($_POST['search'])) && ($_POST['searchMethod'] == '1')) {

                // Dohvaća tekst iz "search", pretvara ga u sva mala slova s prvim velikim, da se može naći u xml datoteci
                // Metoda 1: Search by name

                $search = $_POST['search'];
                $search = strtolower($search);
                $search = ucfirst($search);

                $query = "//pokemon[contains(name, '$search')]";
                $result = $xml->xpath($query);

                echo "<table class=\"table table-striped align-middle mt-4\">";
                echo "<thead class=\"table-dark text-uppercase\"><tr><th class=\"txt-center\">Ndex</th><th class=\"txt-center\">Sprite</th><th>Name</th><th>Category</th><th>Type</th><th>Ability</th><th class=\"txt-center\">Gen</th></tr></thead>";

                foreach ($result as $pokemon) {
                    echo "<tr><td class=\"txt-center\">#" . $pokemon['ndex'] . "</td><td><img src=\"" . $pokemon->sprite . "\"></td><td>" . $pokemon->name . "</td><td>" . $pokemon->category . "</td><td>" . $pokemon->type . "</td><td>" . $pokemon->ability . "</td><td class=\"txt-center\">" . $pokemon->generation . "</td></tr>";
                }
                
                echo "</table>";

            } elseif ((isset($_POST['search'])) && ($_POST['searchMethod'] == '2')) {

                // Metoda 2: Search by type

                $search = $_POST['search'];
                $search = strtolower($search);
                $search = ucfirst($search);

                $query = "//pokemon[contains(type, '$search')]";
                $result = $xml->xpath($query);

                echo "<table class=\"table table-striped align-middle mt-4\">";
                echo "<thead class=\"table-dark text-uppercase\"><tr><th class=\"txt-center\">Ndex</th><th class=\"txt-center\">Sprite</th><th>Name</th><th>Category</th><th>Type</th><th>Ability</th><th class=\"txt-center\">Gen</th></tr></thead>";

                foreach ($result as $pokemon) {
                    echo "<tr><td class=\"txt-center\">#" . $pokemon['ndex'] . "</td><td><img src=\"" . $pokemon->sprite . "\"></td><td>" . $pokemon->name . "</td><td>" . $pokemon->category . "</td><td>" . $pokemon->type . "</td><td>" . $pokemon->ability . "</td><td class=\"txt-center\">" . $pokemon->generation . "</td></tr>";
                }
                
                echo "</table>";
            
            } elseif ((isset($_POST['search'])) && ($_POST['searchMethod'] == '3')) {

                // Metoda 3: Search by generation

                $search = $_POST['search'];
                $query = "//pokemon[contains(generation, '$search')]";
                $result = $xml->xpath($query);

                echo "<table class=\"table table-striped align-middle mt-4\">";
                echo "<thead class=\"table-dark text-uppercase\"><tr><th class=\"txt-center\">Ndex</th><th class=\"txt-center\">Sprite</th><th>Name</th><th>Category</th><th>Type</th><th>Ability</th><th class=\"txt-center\">Gen</th></tr></thead>";

                foreach ($result as $pokemon) {
                    echo "<tr><td class=\"txt-center\">#" . $pokemon['ndex'] . "</td><td><img src=\"" . $pokemon->sprite . "\"></td><td>" . $pokemon->name . "</td><td>" . $pokemon->category . "</td><td>" . $pokemon->type . "</td><td>" . $pokemon->ability . "</td><td class=\"txt-center\">" . $pokemon->generation . "</td></tr>";
                }
                
                echo "</table>";
            
            } else {

                echo "<table class=\"table table-striped align-middle mt-4\">";
                echo "<thead class=\"table-dark text-uppercase\"><tr><th class=\"txt-center\">Ndex</th><th class=\"txt-center\">Sprite</th><th>Name</th><th>Category</th><th>Type</th><th>Ability</th><th class=\"txt-center\">Gen</th></tr></thead>";

                foreach ($xml->pokemon as $pokemon) {
                    echo "<tr><td class=\"txt-center\">#" . $pokemon['ndex'] . "</td><td><img src=\"" . $pokemon->sprite . "\"></td><td>" . $pokemon->name . "</td><td>" . $pokemon->category . "</td><td>" . $pokemon->type . "</td><td>" . $pokemon->ability . "</td><td class=\"txt-center\">" . $pokemon->generation . "</td></tr>";
                }

                echo "</table>";

            }

        ?>

    </div>

</body>
</html>