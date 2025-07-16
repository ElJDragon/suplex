<?php
require './phpjasperxml-master/vendor/autoload.php';
use simitsdk\phpjasperxml\PHPJasperXML;

if (!isset($_GET['cedula'])) {
    die("No se proporcionó la cédula.");
}

$cedula = $_GET['cedula'];
$filename = "EStudianteConCedula1.jrxml";

$config = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'user' => 'root',
    'pass' => '',
    'name' => 'cuarto'
];

$params = ['Cedula' => $cedula];

$report = new PHPJasperXML();
$report->load_xml_file($filename)
       ->setParameter($params)
       ->setDataSource($config)
       ->export('Pdf');

print $report;
