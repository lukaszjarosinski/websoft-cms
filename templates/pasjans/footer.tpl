{*
Copyright 2012 by WAWRUS Agencja Interaktywna
www.wawrus.pl
tel. 91 562 42 66
*}
</div>
</div>

</div>
<div id="footer">
<div class="inside">
{$posts->getPages()}
{$links->getLinks()}
<p class="left">Copyright &copy; by pasjansa.pl.</p>
<p class="right"><strong>Kontakt:</strong> <a href="mailto:administracja@pasjansa.pl">administracja@pasjansa.pl</a></p>
</div>
</div>
{if $HOOK_BOTTOM}{section name=bottom loop=$HOOK_BOTTOM}{$HOOK_BOTTOM[bottom]}{/section}{/if}
</body>
</html>
