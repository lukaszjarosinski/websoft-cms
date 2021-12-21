<?php

function smarty_modifier_varvar($string)
{
    global $smarty;
    return $smarty->_tpl_vars[$string];
}

?>