{*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*}
{include file="html_header.tpl"}
{include file="header.tpl"}
{include file="menu.tpl"}
<div id="main-content"> <!-- Main Content Section with everything -->
{if $komunikat <> ""}
<p class="komunikat">{$komunikat}</p>
{/if}
			<noscript> <!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
						{$lang.javascript_disabled}
					</div>
				</div>
			</noscript>
<h2>{$lang.hello} <a href="user.php?action=edit&id={$id}">{$username}</a></h2>
			
			<ul class="shortcut-buttons-set"> <!-- Replace the icons URL's with your own -->
				
				<li><a class="shortcut-button" href="{$domain}admin/page.php?action=add"><span>
					<img src="{$domain}admin/templates/default/images/icons/new-page-icon.png" alt="" /><br />
					{$lang.create_new_page}
				</span></a></li>
				
				<li><a class="shortcut-button" href="{$domain}admin/user.php"><span>
					<img src="{$domain}admin/templates/default/images/icons/User-Clients-icon.png" alt="" /><br />
					{$lang.manage_users}
				</span></a></li>
				
				<li><a class="shortcut-button" href="{$domain}admin/link.php?action=add"><span>
					<img src="{$domain}admin/templates/default/images/icons/Actions-insert-link-icon.png" alt="" /><br />
					{$lang.create_new_link}
				</span></a></li>
				
				<li><a class="shortcut-button" href="{$domain}admin/page.php"><span>
					<img src="{$domain}admin/templates/default/images/icons/page-edit-icon.png" alt="" /><br />
					{$lang.manage_pages}
				</span></a></li>
				
			</ul><!-- End .shortcut-buttons-set -->
			
			<div class="clear"></div>
			
			<div class="content-box">
				<div class="content-box-header">
					<h3>{$lang.author_name}</h3>
				</div>
				<div class="content-box-content">
					{$lang.author_info}
				</div>
			</div>
			
			<div class="clear"></div> <!-- End .clear -->
{include file="footer.tpl"}
{include file="html_footer.tpl"}