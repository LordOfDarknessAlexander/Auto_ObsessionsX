P.A.S.(php, ajax, sql) folder exclusively contains
PHP scripts which preform SQL queries, which are called
from javascript using jQuery Ajax($.ajax). These scripts
echo properly formatted JSON object strings, which are converted
by jQuery into Javascript objects upon executing the Ajax call's .done() method