<?php

function getSource()
{
    $source = file_get_contents('teosed.json');

    return json_decode($source);
}

function workList()
{
    $data = [];
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
            }

            $d->authors .= implode(', ', $composer);
            if (isset($work->tekstiautor)) {
                $d->authors .= ', tekst: ';
                foreach ($work->tekstiautor as $l) {
                    $lyricist[] = $l->nimi;
                }
                $d->authors .= implode($lyricist);
            }
            if (isset($work->tolkija)) {
                $d->authors .= ', tõlge: ';
                foreach ($work->tolkija as $t) {
                    $transator[] = $t->nimi;
                }
                $d->authors .= implode($transator);
            }
            if (isset($work->seadja)) {
                $d->authors .= ', seadnud ';
                foreach ($work->seadja as $arr) {
                    $arranger[] = $arr->nimi;
                }
                $d->authors .= implode($arranger);
            }
            $data[] = '<tr><td>' . $d->title . ' </td><td> ' . $d->authors . '</td></tr>';
        }
    }
    return $data;
}

//echo '<pre>';
//echo json_encode(getSource()->teosed[0]->versioonid[0]->helilooja[0]->nimi);
//echo json_encode(workList());

//print_r(getSource());
//echo '</pre>';

echo '<table>';
foreach (workList() as $work) {
    echo $work;
}
echo '</table>';