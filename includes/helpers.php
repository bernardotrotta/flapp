<?php
function include_template($template)
{
    $path = __DIR__ . '/../templates/' . $template . '.php';
    if (file_exists($path)) {
        include $path;
    } else {
        echo "Errore: il template '$template' non esiste.";
    }
}
