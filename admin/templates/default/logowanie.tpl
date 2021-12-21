{*
Copyright 2012 by WAWRUS Agencja Interaktywna
www.wawrus.pl
tel. 91 562 42 66
*}
{include file="html_header_login.tpl"}
<div id="login-wrapper" class="png_bg">
			<div id="login-top">
			
				<h1>WAWRUS CMS</h1>
				<img id="logo" src="{$domain}admin/templates/default/images/logo-3d-cms.png" alt="WAWRUS CMS Logo" />
			</div> <!-- End #logn-top -->
			
			<div id="login-content">
				
				<form action="{$action}" method="post" name="login">
				
						{if $komunikat <> ""}
							<div class="notification {$komunikat.1} png_bg"><a href="javascript:void(0)" class="close"><img src="{$domain}admin/templates/default/images/icons/cross_grey_small.png" title="{$lang.close_notification}" alt="{$lang.close_notification}" /></a><div>{$komunikat.0}</div></div>
						{/if}
					
					<p>
						<label for="username">{$lang.username}</label>
						<input class="text-input" type="text" name="username" id="username" />
					</p>
					<div class="clear"></div>
					<p>
						<label for="password">{$lang.password}</label>
						<input class="text-input" type="password" name="password" id="password" />
					</p>
					<div class="clear"></div>
					<p>
						<input class="button" type="submit" value="{$lang.login}" name="submit" />
					</p>
					
				</form>
			</div> <!-- End #login-content -->
			
		</div>

<script type="text/javascript">
window.onload=document.login.username.focus();
</script>
{include file="html_footer.tpl"}