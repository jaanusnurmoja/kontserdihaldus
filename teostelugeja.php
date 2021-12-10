<?php

function getSource()
{
    $source = file_get_contents('teosed.json');

    return json_decode($source);
}

function workList()
{
    $data = new stdClass;
    $data->teosed = [];
    $data->inimorg = [];
    $personorg = [];

    foreach (getSource()->teosed as $workMain) {
        foreach ($workMain->versioonid as $work) {
            $d = new stdClass;
            $d->title = $work->pealkiri;
            $d->authors = '';
            $composer = [];
            $lyricist = [];
            $transator = [];
            $arranger = [];

            foreach ($work->helilooja as $c) {
                $composer[] = $c->nimi;
                $personorg[$c->id] = $c;
            }

            $d->authors .= implode(', ', $composer);
            if (isset($work->tekstiautor)) {
                $d->authors .= ', tekst: ';
                foreach ($work->tekstiautor as $l) {
                    $lyricist[] = $l->nimi;
                    $personorg[$l->id] = $l;
                }
                $d->authors .= implode($lyricist);
            }
            if (isset($work->tolkija)) {
                $d->authors .= ', tõlge: ';
                foreach ($work->tolkija as $t) {
                    $transator[] = $t->nimi;
                    $personorg[$t->id] = $t;
                }
                $d->authors .= implode($transator);
            }
            if (isset($work->seadja)) {
                $d->authors .= ', seadnud ';
                foreach ($work->seadja as $arr) {
                    $arranger[] = $arr->nimi;
                    $personorg[$arr->id] = $arr;
                }
                $d->authors .= implode($arranger);
            }
            $data->teosed[] = '<tr><td>' . $d->title . ' </td><td> ' . $d->authors . '</td></tr>';
            if (isset($work->esitaja)) {
                foreach ($work->esitaja as $perf) {
                    $personorg[$perf->id] = $perf;
                }
            }
            if (isset($work->esmaettekanne->esitaja)) {
                foreach ($work->esmaettekanne->esitaja as $perf) {
                    $personorg[$perf->id] = $perf;
                }
            }
        }
    }
    $data->inimorg = $personorg;
    return $data;
}

function inimOrg()
{
    return workList()->inimorg;
}

//echo '<pre>';
//echo json_encode(getSource()->teosed[0]->versioonid[0]->helilooja[0]->nimi);
//echo json_encode(workList());

//print_r(getSource());
//echo '</pre>';

echo '<table>';
foreach (workList()->teosed as $work) {
    echo $work;
}
echo '</table>';
echo '<pre>';
/* foreach (inimOrg() as $k => $io) {
    echo '<li>' . $io . '</li>';
} */
print_r(inimOrg());
echo '</pre>';