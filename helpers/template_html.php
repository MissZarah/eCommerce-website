<?php

function template_html($title, $tabs, $active_tab, $content)
{ ?>
    <html lang="en" class="webshop">

    <head>
        <meta charset="UTF-8">
        <title>Webshop</title>
        <link href="https://fonts.googleapis.com/css2?family=Amatic+SC&display=swap" rel="stylesheet">
        <link rel='stylesheet prefetch' href='https://cdn.jsdelivr.net/foundation/5.0.2/css/foundation.css'>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
    <div id="container">

        <header>
            <h1><?= $title ?></h1>
            <div id="underLine">
                <div></div>
            </div>
        </header>
        <nav id="navbar">
            <ul>
                <?php
                foreach ($tabs as $link) {
                    $name = $link[0];
                    $url = $link[1];
                    $class = ($name === $active_tab) ? 'active' : '';
                    ?>
                    <li><a href="<?= $url ?>" class="<?= $class ?>"><?= $name ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </nav>

        <main>
            <?php $content(); ?>
        </main>
    </div>
    <div id="underLine">
        <div></div>
    </div>
    <footer>
        <p>&copy; Group 6</p>
    </footer>
    </body>

    </html>
    <?php
}