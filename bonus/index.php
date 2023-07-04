<?php

include __DIR__."/partials/hotelsList.php";

var_dump(isset($_GET['park']));

// se viene selezione il parcheggio
if (isset($_GET['park']) && $_GET['park'] !== '') {
    $filteredHotels = [];
    if ($_GET['park']) {
        foreach($hotels as $hotel) {
            if ($hotel['parking']) {
                $filteredHotels[] = $hotel;
            }
        }
        $hotels = $filteredHotels;
    } else {
        foreach($hotels as $hotel) {
            if (!$hotel['parking']) {
                $filteredHotels[] = $hotel;
            }
        }
        $hotels = $filteredHotels;
    }
}

// se viene seleziona sia il parcheggio che il voto
if (isset($_GET['minVote']) && $_GET['park'] !== '') {
    if (count($filteredHotels) > 0) {
        foreach ($filteredHotels as $chiave => $valore) {
            if ($valore['vote'] < $_GET['minVote']) {
                unset($filteredHotels[$chiave]);
            };
        }
        $hotels = $filteredHotels;
    }
}

// se viene selezionato solo il voto
if (isset($_GET['minVote']) && $_GET['park'] == '') {
    $filteredHotels = [];
        foreach ($hotels as $hotel) {
            if ($hotel['vote'] >= $_GET['minVote']) {
                $filteredHotels[] = $hotel;
            };
        }
        $hotels = $filteredHotels;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <main>
        <div class="container">
            <!-- form per il filtraggio degli hotel -->
            <form class="my-3" action="index.php" method="GET">
                <label class="form-label">Parcheggio</label>
                <select class="rounded" name="park">
                    <option value="" selected>Tutti</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
                <label class="form-label">Voto</label>
                <select class="rounded" name="minVote">
                    <option selected></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <button class="btn btn-success" type="submit">Filtra</button>
            </form>
            <!-- tabella -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Parcheggio</th>
                        <th scope="col">Voto</th>
                        <th scope="col">Distanza dal centro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($hotels as $hotel) { ?>
                        <tr>
                            <th><?php echo $hotel['name']; ?></th>
                            <td><?php echo $hotel['description']; ?></td>
                            <td><?php if($hotel['parking']) { echo '&#10003';} ?></td>
                            <td><?php echo $hotel['vote']; ?></td>
                            <td><?php echo $hotel['distance_to_center'].' Km'; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>