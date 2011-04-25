<?php
//****************************************
//  Yopqs - Config file
//****************************************
// Copyright (C) 2010 - 2011 by Marcin Lawniczak <marcin.safmb@wp.pl> | <www.stw.net23.net>

// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 3
// of the License, or (at your option) any later version.

// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.

// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

$CONF = array();

//Język
//Language

$CONF['lang']          = 'pl';

//Name of the quiz
//Nazwa quizu

$CONF['quiz_name']     = 'example';

//Skórka
//Template

$CONF['template']      = 'standard';

//What will appear on start page
//Co się wyświetli na stronie głównej

$CONF['start_content'] = '
Zasady są proste
1. Jest 15 pytań
2. Odpowiedź na każde pytanie można znaleźć w [b]Wikipedii[/b], wolnej encyklopedii i jej projektach siostrzanych lub szukając w [b]Google[/b].
3. Staraj się pisać poprawnie. Jeżeli jesteś pewien odpowiedzi a skrypt podaje że jest błędna, spróbuj napisać ją inaczej (z ogonkami, z dużej litery).';

//linki na stronie głównej (muszą być z http)
//links on start page (must be with http!!)

//link1
$CONF['link1']      = 'http://www.example.com';
$CONF['link1_name'] = 'example1';

//link 2
$CONF['link2']      = 'http://www.example.net'; //page name
$CONF['link2_name'] = 'example2';

//what will appear on "you have won" page
//co się pojawi na stronie "wygrałeś"
$CONF['won_page_content'] = 'you have won';

//should the script measure solving time
$CONF['measure_time'] = 'TRUE';
?>
