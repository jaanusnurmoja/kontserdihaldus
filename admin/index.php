<!DOCTYPE html>
<html lang="et">
<?php
    include_once('../model/crud.php');
    include_once('../model/localData.php');

?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kontserdihaldussüsteem</title>
    <link rel="stylesheet" href="../css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap-theme.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="../js/libs/jquery/dist/jquery.min.js" crossorigin="anonymous"></script>
    <script src="../js/libs/jquery/external/sizzle/dist/sizzle.min.js" crossorigin="anonymous"></script>
    <script src="../js/libs/jquery-ui/jquery-ui.min.js" crossorigin="anonymous"></script>
    <script src="../js/repeatable-fields/repeatable-fields.js"></script>
    <script src="../js/timeconvert.js"></script>
    <script type="text/javascript">
    let list;
    let xmlhttp = new XMLHttpRequest();
    let teosteList;
    let totaltotal = [];


    function workData(d) {
        return d.teosed;
    }

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let i;
            let n;
            let versioonid;
            teosteList = workData(JSON.parse(this.responseText));
            list = "<option value=''>Vali teos</option>";
            for (i = 0; i < teosteList.length; i++) {
                versioonid = teosteList[i]["versioonid"];
                for (n = 0; n < versioonid.length; n++) {
                    list += "<option value='" + teosteList[i].id +
                        "-" + versioonid[n].id + "'> " +
                        versioonid[n].pealkiri +
                        " (" + versioonid[n].aasta + ")" +
                        "</option>"

                }

            }
            let selectTeosed = document.getElementsByClassName("teosed");
            for (k in selectTeosed) {
                selectTeosed[k].innerHTML = list;
            }
        }
    };
    xmlhttp.open("GET", "../teosed.json", true);
    xmlhttp.send();
    </script>
</head>

<body>
    <header id="header">

        <span><img src="../images/nurmoja_net_ee.png" alt=""></span>
        <span>Kontserdid ja nende kavad</span>
    </header>
    <div id="page" class="container-fluid">
        <?php 
/*
        Alljärgnev läheb tegelikult eraldi faili, mis 
        suhtleb andmebaasiga ja sisestab ridu tabelitesse
*/
        var_dump($_GET);
        $crud = new Crud;
        if (!empty($_GET))
        {
            if (isset($_GET['data'])) 
            {
                $table = $_GET['data'];
            }
            else
            {
                $table = 'kava';
            }
            $what = isset($_GET['what']) ? $_GET['what'] : '*';

            $w = [];
            $i = 0;
            foreach ($_GET as $k => $g)
            {
                if ($k != 'data' && $k != 'what')
                {
                    $w[$i] = $k . '=' . $g;
                    $i++;
                }
            }
            $where = implode(' AND ',$w);
            $crud->select($table, $what, $where);
        }

        ?>

    </div>
</body>

</html>