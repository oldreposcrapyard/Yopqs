<?php
require '../inc/alibaba.class.php';
require '../inc/allfunctions.inc.php';
require "../lang/{$CONF['lang']}.lang.php";
require '../inc/template_tbs.php';
require '../inc/tbs_plugin_html.php';

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
?>
