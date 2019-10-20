<!doctype html>
<html lang="en">

<head>
    <title>Transports DAP</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/ff33530a83.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- <div class="jumbotron">
        <div class="navbrand"><img src="./images/me.png"></div>
        <h1 class="text-uppercase text-center">Test d'entrées</h1>
    </div> -->
        <div class="card bg-dark text-white">
        <img class="card-img" src="https://picsum.photos/id/844/2000/250?blur=2" alt="Card image">
        <div class="card-img-overlay">
            <h5 class="card-title">XXXX</h5>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste, nobis ipsa.</p>
            </div>
    </div>
    <?php require_once 'process.php'; ?>

    <?php

    if (isset($_SESSION['message'])) : ?>

        <div class="alert alert-<?= $_SESSION['msg_type'] ?>">

            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);

                ?>
        </div>
    <?php endif ?>
    <div class="container">
        <?php

        $mysqli = new mysqli('localhost', 'root', '', 'dapphp') or die(mysqli($mysqli));
        $result = $mysqli->query("SELECT * FROM destinataires") or die(mysqli($mysqli));
        //debug
        // pre_r($result);
        ?>

        <div class="row justify-content-center">
            <h2>Destinataires</h2>
            <table class="table table-striped table-hover table-sm" id="maTable">
                <thead class="thead-light">
                    <tr>
                        <th id="sort" onclick="sortTable(0)">Code Destinaire <i class="fas fa-sort"></i></th>
                        <th id="sort" onclick="sortTable(0)">Raison Sociale <i class="fas fa-sort"></i></th>
                        <th id="sort" onclick="sortTable(1)">Id Client <i class="fas fa-sort"></i></th>

                        <th colspan"2">Action</th>
                    </tr>
                </thead>

                <?php
                while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row['codeDestinataire']; ?></td>
                        <td><?php echo $row['raisonSociale']; ?></td>
                        <td><?php echo $row['idClient']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['idClient']; ?>" class="btn btn-info">Editer</a>
                            <a href="process.php?delete=<?php echo $row['idClient']; ?>" class="btn btn-danger">effacer</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>

        </div>
        <?php
        function pre_r($array)
        {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }

        ?>

        <form action="process.php" method="POST">
            <div class="row">
                <input type="hidden" name="idClient" value="<?php echo $idClient; ?>">
                <div class="form-group col-4">
                    <label class="font-weight-bold">Code Destinataire</label>
                    <input type="text" name="codeDestinataire" class="form-control" value="<?php echo $codeDestinataire; ?>" placeholder="Code Destinataire">
                </div>
                <div class="form-group col-4">
                    <label class="font-weight-bold">Raison Sociale</label>
                    <input type="text" name="raisonSociale" class="form-control" value="<?php echo $raisonSociale; ?>" placeholder="Raison Sociale">
                </div>
                <div class="form-group col-2">
                    <label class="font-weight-bold">Id Client</label>
                    <input type="number" name="idClient" class="form-control" value="<?php echo $idClient; ?>" placeholder="Id Client" disabled="disabled">
                </div>
            </div>
            <div class="form-group text-right col-10">
                <?php
                if ($update == true) :
                    ?>
                    <button type="submit" class="btn btn-info" name="modifier">Modifier</button>
                    <!-- button reset ne marche pas -->
                    <!-- <input name='reset' type="reset" value='Reset' class="btn btn-primary" /> -->

                    <?php else : ?>
                    <button type="submit" class="btn btn-primary" name="sauvegarder">Ajouter</button>
                    <?php endif; ?>
                </div>
                
        </form>
    </div>
    </div>
    <footer class="fixed-bottom">
        Copyright 2019 | <a href="http://Xxxxx.fr" target="_blank" class="btn">Xxxxx</a>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
<script>
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("maTable");
        switching = true;
        // Tri en ascendant
        dir = "asc";
        /* fait une boucle jusqu'à la fin du processus */
        while (switching) {
            // Commence à : pas de tri fait:
            switching = false;
            rows = table.rows;
            /* boucle jusqu'à la fin */
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                /* Compare les éléments entre eux,
                celle en court et la suivante */
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                /* Vérifie si les deux lignes doivent s'inverser */
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        // Si ok, inverse et fini la boucle:
                        shouldSwitch = true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        // Si ok, inverse et fini la boucle:
                        shouldSwitch = true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /* Si l'inversion est faite and le note comme fait*/
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                // à chaque fois qu'une inversion est fait ajoute 1:
                switchcount++;
            } else {
                /* Si aucune inversion n'est faite et la direction est "asc" met la direction en "desc et relance la boucle while*/
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>

</html>