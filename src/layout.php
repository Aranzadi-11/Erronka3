<!DOCTYPE HTML>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php

    $config=simplexml_load_file('../public/koloreAldaketa.xml');
    $headerColor = $config->headerColor;
    $footerColor = $config->footerColor;

    ?>
    <style>
        :root {
            --headerColor: <?= $headerColor ?>;
            --footerColor: <?= $footerColor ?>;
        }

    </style>
    <!-- Internal -->
    <link href="../public/styles.css" rel="stylesheet">


</head>

<body class="">