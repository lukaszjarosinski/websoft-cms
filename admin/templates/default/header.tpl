{*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*}
<div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
		
		<div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
			
			<h1 id="sidebar-title"><a href="#">WAWRUS CMS</a></h1>
			<p style="margin:0;padding:0;text-align:right"><img id="logo" src="{$domain}admin/templates/default/images/logo-3d-cms.png" alt="WAWRUS CMS Logo" /></p>
		  
			<!-- Logo (221px wide) -->
		  
			<!-- Sidebar Profile links -->
			<div id="profile-links">
				{if $zalogowano}{$lang.hello} <a href="user.php?action=edit&amp;id={$auth_class->showUserId()}">{$username}</a><br />
				<br />
				<a href="../" target="_blank">{$lang.view_the_site}</a> | <a href="?subaction=logout" title="{$lang.logout}">{$lang.logout}</a>{/if}
			</div>   
