<?php
require "../lang/{$CONF['lang']}.lang.php";

header('Content-Type: text/html; charset=utf-8');

Alibaba::forceAuthentication();

if(isset($_GET['action']))
{
    switch($_GET['action'])
    {
        /* possible actions for module */

        case 'add':
            /* code to add*/
        break;

        case 'edit':
            /* code to edit*/
        break;

        case 'del':
            /* code to delete*/
        break;

        default:
            die('Invalid Command GO to index');
            
        break;
}
}
?>
