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

        <span><img src="./images/nurmoja_net_ee.png" alt=""></span>
        <span>Kontserdid ja nende kavad</span>
    </header>
    <div id="page" class="container-fluid">
        <form method="post" name="kava" id="kava">
            <div id="concert-title" class="row row-cols-5">
                <div class="col col-form-label-md-3">Nimi</div>
                <div class="col form-control-lg-8"><input type="text" class=" form-text" name="title"></div>
            </div>
            <div id="concert-description" class="row row-cols-5">
                <div class="col col-form-label-md-3">Tutvustus</div>
                <div class="col form-control-lg-8"><textarea name="description" class="form-plaintext"></textarea></div>
            </div>
            <div id="concert-description" class="row row-cols-5">
                <div class="col col-form-label-md-3">Sündmuse aeg ja koht</div>
                <div class="col form-control-lg-8">
                    <select class="form-select-sm name=" event">
                        <option>Vali sündmus</option>
                        <option value="1">Sündmus, millega kava ühendame</option>
                        <option value="2">Teine sündmus, millega me ei tegele</option>
                    </select>
                    <input id="concert_date" name="concert_date" type="date"> <input id="start_time" name="start_time"
                        type="time">
                </div>
            </div>
            <div id="concert-duration" class="row row-cols-5">
                <div class="col col-form-label-md-3">Kavandatav kestvus</div>
                <div class="form-control-lg-8"><input id="duration" name="duration" type="text"
                        pattern="[0-9]{2}:[0-9]{2}:[0-9]{2}"></div>
                <div class="col col-form-label-md-3">Arvutatud kestvus</div>
                <div class="form-control-lg-8"><input id="calc_duration" name="calc_duration" type="text"
                        pattern="[0-9]{2}:[0-9]{2}:[0-9]{2}" class="bg-warning"></div>
            </div>

            <div class="repeat">
                <div class="wrapper" width="100%">

                    <div class="row row-cols-6">
                        <div><span class="add btn btn-success" id="add1">Add</span>
                        </div>
                        <div class="col">Teos</div>
                        <div class="col">Esitajad</div>
                        <div class="col">Kestvus</div>
                        <div class="col">Kirjeldus</div>
                        <div class="col">Eemalda</div>
                    </div>
                    <div id="esitus" class="rows">
                        <div class="template row row-cols-6" id="esitus[{{row-count-placeholder}}]">
                            <div class="col">
                                <span class="move btn btn-sm btn-info">Move ↕</span>
                                <input type="hidden" id="esitus[{{row-count-placeholder}}][kava_id]"
                                    name="esitus[{{row-count-placeholder}}][kava_id]" />
                                <input type="hidden" id="esitus[{{row-count-placeholder}}][movesteps]"
                                    class="move-steps" value="1" />
                                <input type="hidden" id="esitus[{{row-count-placeholder}}][jrk]"
                                    name="esitus[{{row-count-placeholder}}][jrk]" value="{{row-count-placeholder}}" />
                            </div>

                            <div class="col">
                                <select id="esitus[{{row-count-placeholder}}][teosopts]"
                                    name="esitus[{{row-count-placeholder}}][teos]"
                                    class="teosed {{row-count-placeholder}}" onchange="teosVals(workDetails(
                                        this.value), 
                                        'esitus['+this.classList[1]+'][teos]',
                                        'esitus['+this.classList[1]+'][teos_info_txt]',
                                        'esitus['+this.classList[1]+'][teose_kestvus]',
                                        'esitus['+this.classList[1]+'][lisakestvus]',
                                        'esitus['+this.classList[1]+'][esituse_kestvus]',
                                        this.classList[1]
                                        );">
                                </select>
                                <div id="esitus[{{row-count-placeholder}}][teos]">
                                </div>
                                <textarea id="esitus[{{row-count-placeholder}}][teos_info_txt]"
                                    name="esitus[{{row-count-placeholder}}][teos_info_txt]" readonly>
                                </textarea>
                                <script type="text/javascript">
                                function teosVals(v, teosId, teosInfo, kestvusId, lisaId, kokkuId, count) {
                                    console.log(teosId, kestvusId);
                                    document.getElementById(teosId).innerHTML =
                                        "<h5>" + v.pealkiri + "</h5>" +
                                        v.autorid;
                                    document.getElementById(teosInfo).innerHTML =
                                        JSON.stringify(v);
                                    document.getElementById(kestvusId).value =
                                        v.kestvus;
                                    sec(kestvusId, lisaId, kokkuId, count);
                                }
                                </script>
                            </div>
                            <div class="col">
                                <div class="repeat">
                                    <div class="wrapper">
                                        <div class="row">
                                            <div><span class="add btn btn-sm btn-success"
                                                    onclick="document.getElementById('esitus[{{row-count-placeholder}}][esitajad]').click()">Add</span>
                                            </div>
                                        </div>
                                        <div id="esitajad-public" class="rows">
                                            <div class="template row">
                                                <div class="col">
                                                    <input type="hidden"
                                                        id="esitus[{{row-count-placeholder}}][esitajad][{{row-count-placeholder}}]['id']" />
                                                    <input type="hidden"
                                                        id="esitus[{{row-count-placeholder}}][esitajad][{{row-count-placeholder}}]['esitus_id']" />
                                                    <input type="hidden"
                                                        id="esitus[{{row-count-placeholder}}][esitajad][{{row-count-placeholder}}]['ext_id']" />
                                                    <input type="text"
                                                        id="esitus[{{row-count-placeholder}}][esitajad][{{row-count-placeholder}}]['nimi']"
                                                        onchange="document.getElementsByName(this.id)[0].value=this.value" />
                                                </div>
                                                <div class="col"><span class="remove btn btn-sm btn-danger"
                                                        onclick="document.getElementById('esitus[{{row-count-placeholder}}][esitajad][{{row-count-placeholder}}]').click()">Remove</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col {{row-count-placeholder}}" onload="calcTime(this.childNodes)">
                                <input type="text" class="{{row-count-placeholder}}"
                                    id="esitus[{{row-count-placeholder}}][teose_kestvus]"
                                    name="esitus[{{row-count-placeholder}}][teose_kestvus]" value="00:00:00"
                                    pattern="[0-9]{2}:[0-9]{2}:[0-9]{2}" />
                                <input type="text" class="{{row-count-placeholder}}"
                                    id="esitus[{{row-count-placeholder}}][lisakestvus]"
                                    name="esitus[{{row-count-placeholder}}][lisakestvus]" value="00:00:00"
                                    pattern="[0-9]{2}:[0-9]{2}:[0-9]{2}" onchange="sec(
                                        'esitus['+this.className+'][teose_kestvus]', 
                                        this.id, 
                                        'esitus['+this.className+'][esituse_kestvus]', this.className)" />
                                <input type="text" id="esitus[{{row-count-placeholder}}][esituse_kestvus]"
                                    name="esitus[{{row-count-placeholder}}][esituse_kestvus]" value="00:00:00"
                                    pattern="[0-9]{2}:[0-9]{2}:[0-9]{2}" />
                                <script type="text/javascript">
                                function sec(tId, addId, resultId, count) {
                                    let t = document.getElementById(tId).value;
                                    let add = document.getElementById(addId).value;
                                    let subTotalSeconds = timeToSec(t) + timeToSec(add);
                                    totaltotal[count] = subTotalSeconds;
                                    console.log('totot', totaltotal[parseInt(count)]);
                                    let result = secToTime(subTotalSeconds);
                                    document.getElementById(resultId).value = result;
                                    calcAll(totaltotal, count);
                                }
                                </script>
                            </div>
                            <div class="col" style="height:auto">
                                <textarea style="height:auto" name="esitus[{{row-count-placeholder}}][perfdesc]"
                                    placeholder="Vabas vormis tekst"></textarea>
                            </div>
                            <div class="col"><span class="remove btn btn-sm btn-danger">Remove</span></div>
                            <div style="visibility:hidden;width:1px;height:1px">
                                <div class="repeat">
                                    <div class="wrapper">
                                        <div class="row">
                                            <div><span class="add btn btn-sm btn-success"
                                                    id="esitus[{{row-count-placeholder}}][esitajad]">Add</span></div>
                                        </div>
                                        <div id="esitajad" class="rows">
                                            <div class="template row">
                                                <div class="col">
                                                    <input type="hidden"
                                                        name="esitus[{{row-count-placeholder}}][esitajad][{{row-count-placeholder}}]['id']" />
                                                    <input type="hidden"
                                                        name="esitus[{{row-count-placeholder}}][esitajad][{{row-count-placeholder}}]['esitus_id']"
                                                        value="{parent_id}" />
                                                    <input type="hidden"
                                                        name="esitus[{{row-count-placeholder}}][esitajad][{{row-count-placeholder}}]['ext_id']" />
                                                    <input type="hidden"
                                                        name="esitus[{{row-count-placeholder}}][esitajad][{{row-count-placeholder}}]['nimi']" />
                                                </div>
                                                <div class="col"><span class="remove btn btn-sm btn-danger"
                                                        id="esitus[{{row-count-placeholder}}][esitajad][{{row-count-placeholder}}]">Remove</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" value="Submit">
        </form>

        <script type="text/javascript">
        jQuery(function() {
            jQuery('.repeat').each(function() {
                jQuery(this).repeatable_fields({});
            });
        });
        </script>
        <script type="text/javascript">
        console.log('totaltotal', totaltotal);

        function workDetails(v) {

            let s = v.split("-");
            let data;
            let vers = [];
            let autorid = "";
            let json;
            let result = {};

            for (let o in teosteList) {
                if (teosteList[o].id == s[0]) {
                    vers = teosteList[o].versioonid;
                    for (let k in vers) {
                        if (vers[k].id == s[1]) {
                            vers[k].main = teosteList[o].id;
                            data = vers[k];
                            data.helilooja.forEach(f);
                            if (typeof data.tekstiautor !== 'undefined') {
                                autorid += ", tekst: ";
                                data.tekstiautor.forEach(f);
                            }
                            if (typeof data.tolkija !== 'undefined') {
                                autorid += ", tõlkija: ";
                                data.tolkija.forEach(f);
                            }
                            if (typeof data.seadja !== 'undefined') {
                                autorid += ", seadnud ";
                                data.seadja.forEach(f);
                            }

                            function f(autor, index) {
                                if (index > 0) autorid += " / ";
                                autorid += autor.nimi;
                            }
                            json = JSON.stringify(data);
                            result.pealkiri = data.pealkiri;
                            result.kestvus = data.kestvus;
                        }
                    }
                }

            }
            //
            result.autorid = autorid;
            result.json = json;
            console.log(result);

            return result;
        }


        let totalSeconds = 0;

        function calcAll(total, count) {
            totalSeconds = total.reduce(function(a, b) {
                return a + b;
            }, 0);
            document.getElementById("calc_duration").value = secToTime(totalSeconds);
        }
        </script>
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