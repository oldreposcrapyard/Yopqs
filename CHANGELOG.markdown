#CHANGELOG


###1.3 Beta

****
[ENHANCEMENT]Now using PDO instead of mysql_* functions  
[ENHANCEMENT]Used CSS minify and code cleaner
###1.2 Beta

****
[FEATURE]Admin panel with login (Just login without functionality yet)  
[FEATURE]More I18N in all files (Almost no polish out there)  
[FIX]Updated BBcode parser (commit "0792554b0ac6f1490919" at github.com/wookieb/bbcode)
###1.1 Beta

****
[FIX]Code optimization THANKS TO: @fifi209
###1.0 Beta

****
[FEATURE]Start content in index.php is now parsed against BBcode  
[ENHANCEMENT]Index.php is now using template system  
[MINOR][FIX]When user inserts spaces in the answer field in quiz.php,
a "no answer" error is returned instead of "answer wrong"  
[BUGFIX]When user opens the quiz page again after solving it and seeing the result
the resut page is displayed again instead of last level  
[MINOR][FIX]Icons are now displaying properly in quiz.php  
[FEATURE]Script now doesn't care about case of the answer input, answer JoHNNy is now equal to johnny  
###0.9 Beta

****
[BUGFIX]Fixed the "solve time on refresh changes" bug  
[FEATURE] Displaying measure time nicely  
[SECURITY]Secured config file with ob_start and ob_end_flush  
[SECURITY]Secured some files with .htaccess  
[FEATURE]BBcode parsing  
[FEATURE]Measuring time  
[BUGFIX]Last level didn't work  
###0.8 Beta

****
[ENHANCEMENT]Index code cleaned and reorganized  
[BUGFIX]Database encoding  
###0.7 Beta

****
[BUGFIX]Errors in file paths THANKS TO: forum.php.pl  
[FEATURE]Multiple language support  
[ENHANCEMENT]Optimized code a bit  
[ENHANCEMENT]Optimized config file  
