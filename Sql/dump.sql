<!DOCTYPE html>
<html lang="en" dir="ltr">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta name="robots" content="noindex">
<meta name="referrer" content="origin-when-crossorigin">
<title>Export: continutcms - Adminer</title>
<link rel="stylesheet" type="text/css" href="?file=default.css&amp;version=4.2.5&amp;driver=mysql">
<script type="text/javascript" src="?file=functions.js&amp;version=4.2.5&amp;driver=mysql"></script>
<link rel="shortcut icon" type="image/x-icon" href="?file=favicon.ico&amp;version=4.2.5&amp;driver=mysql">
<link rel="apple-touch-icon" href="?file=favicon.ico&amp;version=4.2.5&amp;driver=mysql">

<body class="ltr nojs" onkeydown="bodyKeydown(event);" onclick="bodyClick(event);">
<script type="text/javascript">
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = 'You are offline.';
</script>

<div id="help" class="jush-sql jsonly hidden" onmouseover="helpOpen = 1;" onmouseout="helpMouseout(this, event);"></div>

<div id="content">
<p id="breadcrumb"><a href=".">MySQL</a> &raquo; <a href='?username=vagrant' accesskey='1' title='Alt+Shift+1'>Server</a> &raquo; <a href="?username=vagrant&amp;db=continutcms">continutcms</a> &raquo; Export
<h2>Export: continutcms</h2>
<div id='ajaxstatus' class='jsonly hidden'></div>

<form action="" method="post">
<table cellspacing="0">
<tr><th>Output<td><label><input type='radio' name='output' value='text' checked>open</label><label><input type='radio' name='output' value='file'>save</label><label><input type='radio' name='output' value='gz'>gzip</label>
<tr><th>Format<td><label><input type='radio' name='format' value='sql' checked>SQL</label><label><input type='radio' name='format' value='csv'>CSV,</label><label><input type='radio' name='format' value='csv;'>CSV;</label><label><input type='radio' name='format' value='tsv'>TSV</label>
<tr><th>Database<td><select name='db_style'><option selected><option>USE<option>DROP+CREATE<option>CREATE</select><label><input type='checkbox' name='routines' value='1' checked>Routines</label><label><input type='checkbox' name='events' value='1' checked>Events</label><tr><th>Tables<td><select name='table_style'><option><option selected>DROP+CREATE<option>CREATE</select><label><input type='checkbox' name='auto_increment' value='1'>Auto Increment</label><label><input type='checkbox' name='triggers' value='1' checked>Triggers</label><tr><th>Data<td><select name='data_style'><option><option>TRUNCATE+INSERT<option selected>INSERT<option>INSERT+UPDATE</select></table>
<p><input type="submit" value="Export">
<input type="hidden" name="token" value="98172:19863">

<table cellspacing="0">
<thead><tr><th style='text-align: left;'><label class='block'><input type='checkbox' id='check-tables' onclick='formCheck(this, /^tables\[/);'>Tables</label><th style='text-align: right;'><label class='block'>Data<input type='checkbox' id='check-data' onclick='formCheck(this, /^data\[/);'></label></thead>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='ext_news' onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">ext_news</label><td align='right'><label class='block'><span id='Rows-ext_news'></span><input type='checkbox' name='data[]' value='ext_news' onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sys_backend_usergroups' onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sys_backend_usergroups</label><td align='right'><label class='block'><span id='Rows-sys_backend_usergroups'></span><input type='checkbox' name='data[]' value='sys_backend_usergroups' onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sys_backend_users' onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sys_backend_users</label><td align='right'><label class='block'><span id='Rows-sys_backend_users'></span><input type='checkbox' name='data[]' value='sys_backend_users' onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sys_cache' onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sys_cache</label><td align='right'><label class='block'><span id='Rows-sys_cache'></span><input type='checkbox' name='data[]' value='sys_cache' onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sys_categories' onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sys_categories</label><td align='right'><label class='block'><span id='Rows-sys_categories'></span><input type='checkbox' name='data[]' value='sys_categories' onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sys_categories_relations' onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sys_categories_relations</label><td align='right'><label class='block'><span id='Rows-sys_categories_relations'></span><input type='checkbox' name='data[]' value='sys_categories_relations' onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sys_configuration' onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sys_configuration</label><td align='right'><label class='block'><span id='Rows-sys_configuration'></span><input type='checkbox' name='data[]' value='sys_configuration' onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sys_content' onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sys_content</label><td align='right'><label class='block'><span id='Rows-sys_content'></span><input type='checkbox' name='data[]' value='sys_content' onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sys_domains' onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sys_domains</label><td align='right'><label class='block'><span id='Rows-sys_domains'></span><input type='checkbox' name='data[]' value='sys_domains' onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sys_domain_urls' checked onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sys_domain_urls</label><td align='right'><label class='block'><span id='Rows-sys_domain_urls'></span><input type='checkbox' name='data[]' value='sys_domain_urls' checked onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sys_files' onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sys_files</label><td align='right'><label class='block'><span id='Rows-sys_files'></span><input type='checkbox' name='data[]' value='sys_files' onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sys_file_mounts' onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sys_file_mounts</label><td align='right'><label class='block'><span id='Rows-sys_file_mounts'></span><input type='checkbox' name='data[]' value='sys_file_mounts' onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sys_file_references' onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sys_file_references</label><td align='right'><label class='block'><span id='Rows-sys_file_references'></span><input type='checkbox' name='data[]' value='sys_file_references' onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sys_frontend_usergroups' onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sys_frontend_usergroups</label><td align='right'><label class='block'><span id='Rows-sys_frontend_usergroups'></span><input type='checkbox' name='data[]' value='sys_frontend_usergroups' onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sys_frontend_users' onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sys_frontend_users</label><td align='right'><label class='block'><span id='Rows-sys_frontend_users'></span><input type='checkbox' name='data[]' value='sys_frontend_users' onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sys_languages' onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sys_languages</label><td align='right'><label class='block'><span id='Rows-sys_languages'></span><input type='checkbox' name='data[]' value='sys_languages' onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sys_pages' onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sys_pages</label><td align='right'><label class='block'><span id='Rows-sys_pages'></span><input type='checkbox' name='data[]' value='sys_pages' onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sys_registry' onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sys_registry</label><td align='right'><label class='block'><span id='Rows-sys_registry'></span><input type='checkbox' name='data[]' value='sys_registry' onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sys_routes' onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sys_routes</label><td align='right'><label class='block'><span id='Rows-sys_routes'></span><input type='checkbox' name='data[]' value='sys_routes' onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<tr><td><label class='block'><input type='checkbox' name='tables[]' value='sys_user_sessions' onclick="checkboxClick(event, this); formUncheck(&#039;check-tables&#039;);">sys_user_sessions</label><td align='right'><label class='block'><span id='Rows-sys_user_sessions'></span><input type='checkbox' name='data[]' value='sys_user_sessions' onclick="checkboxClick(event, this); formUncheck(&#039;check-data&#039;);"></label>
<script type='text/javascript'>ajaxSetHtml('?username=vagrant&db=continutcms&script=db');</script>
</table>
</form>
<p><a href='?username=vagrant&amp;db=continutcms&amp;dump=sys%25'>sys</a></div>

<form action="" method="post">
<p class="logout">
<input type="submit" name="logout" value="Logout" id="logout">
<input type="hidden" name="token" value="98172:19863">
</p>
</form>
<div id="menu">
<h1>
<a href='https://www.adminer.org/' target='_blank' id='h1'>Adminer</a> <span class="version">4.2.5</span>
<a href="https://www.adminer.org/#download" target="_blank" id="version"></a>
</h1>
<script type="text/javascript" src="?file=jush.js&amp;version=4.2.5&amp;driver=mysql"></script>
<script type="text/javascript">
var jushLinks = { sql: [ '?username=vagrant&db=continutcms&table=$&', /\b(ext_news|sys_backend_usergroups|sys_backend_users|sys_cache|sys_categories|sys_categories_relations|sys_configuration|sys_content|sys_domains|sys_domain_urls|sys_files|sys_file_mounts|sys_file_references|sys_frontend_usergroups|sys_frontend_users|sys_languages|sys_pages|sys_registry|sys_routes|sys_user_sessions)\b/g ] };
jushLinks.bac = jushLinks.sql;
jushLinks.bra = jushLinks.sql;
jushLinks.sqlite_quo = jushLinks.sql;
jushLinks.mssql_bra = jushLinks.sql;
bodyLoad('5.6');
</script>
<form action="">
<p id="dbs">
<input type="hidden" name="username" value="vagrant"><span title='database'>DB</span>: <select name='db' onmousedown='dbMouseDown(event, this);' onchange='dbChange(this);'><option value=""><option>information_schema<option selected>continutcms<option>example_database<option>firmenich21<option>lausashop<option>magentoqual<option>mysql<option>performance_schema</select><input type='submit' value='Use' class='hidden'>
<input type="hidden" name="dump" value=""></p></form>
<p class='links'><a href='?username=vagrant&amp;db=continutcms&amp;sql='>SQL command</a>
<a href='?username=vagrant&amp;db=continutcms&amp;import='>Import</a>
<a href='?username=vagrant&amp;db=continutcms&amp;dump=' id='dump' class='active '>Export</a>
<a href="?username=vagrant&amp;db=continutcms&amp;create=">Create table</a>
<p id='tables' onmouseover='menuOver(this, event);' onmouseout='menuOut(this);'>
<a href="?username=vagrant&amp;db=continutcms&amp;select=ext_news" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=ext_news" title='Show structure'>ext_news</a><br>
<a href="?username=vagrant&amp;db=continutcms&amp;select=sys_backend_usergroups" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=sys_backend_usergroups" title='Show structure'>sys_backend_usergroups</a><br>
<a href="?username=vagrant&amp;db=continutcms&amp;select=sys_backend_users" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=sys_backend_users" title='Show structure'>sys_backend_users</a><br>
<a href="?username=vagrant&amp;db=continutcms&amp;select=sys_cache" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=sys_cache" title='Show structure'>sys_cache</a><br>
<a href="?username=vagrant&amp;db=continutcms&amp;select=sys_categories" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=sys_categories" title='Show structure'>sys_categories</a><br>
<a href="?username=vagrant&amp;db=continutcms&amp;select=sys_categories_relations" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=sys_categories_relations" title='Show structure'>sys_categories_relations</a><br>
<a href="?username=vagrant&amp;db=continutcms&amp;select=sys_configuration" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=sys_configuration" title='Show structure'>sys_configuration</a><br>
<a href="?username=vagrant&amp;db=continutcms&amp;select=sys_content" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=sys_content" title='Show structure'>sys_content</a><br>
<a href="?username=vagrant&amp;db=continutcms&amp;select=sys_domains" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=sys_domains" title='Show structure'>sys_domains</a><br>
<a href="?username=vagrant&amp;db=continutcms&amp;select=sys_domain_urls" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=sys_domain_urls" title='Show structure'>sys_domain_urls</a><br>
<a href="?username=vagrant&amp;db=continutcms&amp;select=sys_files" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=sys_files" title='Show structure'>sys_files</a><br>
<a href="?username=vagrant&amp;db=continutcms&amp;select=sys_file_mounts" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=sys_file_mounts" title='Show structure'>sys_file_mounts</a><br>
<a href="?username=vagrant&amp;db=continutcms&amp;select=sys_file_references" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=sys_file_references" title='Show structure'>sys_file_references</a><br>
<a href="?username=vagrant&amp;db=continutcms&amp;select=sys_frontend_usergroups" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=sys_frontend_usergroups" title='Show structure'>sys_frontend_usergroups</a><br>
<a href="?username=vagrant&amp;db=continutcms&amp;select=sys_frontend_users" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=sys_frontend_users" title='Show structure'>sys_frontend_users</a><br>
<a href="?username=vagrant&amp;db=continutcms&amp;select=sys_languages" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=sys_languages" title='Show structure'>sys_languages</a><br>
<a href="?username=vagrant&amp;db=continutcms&amp;select=sys_pages" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=sys_pages" title='Show structure'>sys_pages</a><br>
<a href="?username=vagrant&amp;db=continutcms&amp;select=sys_registry" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=sys_registry" title='Show structure'>sys_registry</a><br>
<a href="?username=vagrant&amp;db=continutcms&amp;select=sys_routes" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=sys_routes" title='Show structure'>sys_routes</a><br>
<a href="?username=vagrant&amp;db=continutcms&amp;select=sys_user_sessions" class='select'>select</a> <a href="?username=vagrant&amp;db=continutcms&amp;table=sys_user_sessions" title='Show structure'>sys_user_sessions</a><br>
</div>
<script type="text/javascript">setupSubmitHighlight(document);</script>
