<?php
    include_once('../model/crud.php');
    include_once('../model/localData.php');

/*
        Alljärgnev läheb tegelikult eraldi faili, mis 
        suhtleb andmebaasiga ja sisestab ridu tabelitesse
*/

if (isset($_GET['view'])) 
{
    $view = $_GET['view'];
    include("../view/kava/admin/$view.php");
}
$crud = new Crud;
if (isset($_GET['data']))
{
    $crud->select($_GET['data']);
}
?>