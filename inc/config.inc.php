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

//What will appear on start page
//Co się wyświetli na stronie głównej

$CONF['start_content'] = '
Zasady są proste
1. Jest 15 pytań
2. Odpowied&#378; na ka&#380;de pytanie mo&#380;na znale&#378;&#263; w <a href="http://www.pl.wikipedia.org/">Wikipedii, wolnej encyklopedii i <a href="http://pl.wikipedia.org/wiki/Szablon:Siostrzane">jej projektach siostrzanych</a> lub szukaj&#261;c w Google.
3. Staraj si&#281; pisa&#263; poprawnie. Je&#380;eli jeste&#347; pewien odpowiedzi a skrypt podaje &#380;e jest b&#322;&#281;dna, spr&#243;buj napisa&#263; odpowied&#378; inaczej (z ogonkami, z du&#380;ej litery).';

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
