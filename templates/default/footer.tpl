{*
Copyright 2012 by Łukasz Jarosiński
www.lukaszjarosinski.com
tel. 508 052 990
*}
	<div id="footer">
		<p>Copyright &copy; 2012 <a href="http://www.lukaszjarosinski.com">Łukasz Jarosiński</a>. All rights reserved. Design by <a href="http://www.freecsstemplates.org">FCT</a>. Photos by <a href="http://fotogrph.com/">fotogrph</a>.</p>
		{links->getLinks}
	</div>
<!-- end #footer -->
<script type="text/javascript">
{assign var=js_dir value=$config.js_dir|replace:$config.base_dir:$config.domain}
{literal}
$(function() {
	$('a.lightbox').lightBox({
		overlayBgColor: '#000000',
	overlayOpacity: 0.95,
	imageLoading: '{/literal}{$js_dir}{literal}lightbox/lightbox-ico-loading.gif',
	imageBtnClose: '{/literal}{$js_dir}{literal}lightbox/close.png',
	imageBtnPrev: '{/literal}{$js_dir}{literal}lightbox/lightbox-btn-prev.gif',
	imageBtnNext: '{/literal}{$js_dir}{literal}lightbox/lightbox-btn-next.gif',
	containerResizeSpeed: 350,
	txtImage: 'Zdjęcie',
	txtOf: 'z'
	}); // Select all links with lightbox class
});
{/literal}
</script>
{if $HOOK_BOTTOM}{section name=bottom loop=$HOOK_BOTTOM}{$HOOK_BOTTOM[bottom]}{/section}{/if}
</body>
</html>