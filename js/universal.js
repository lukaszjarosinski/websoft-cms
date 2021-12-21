function formSubmit(formId,target,returnUrl)
{
data = $('#' + formId).serialize();
$.ajax({
type: 'POST',
url: target,
async: false,
cache: false,
dataType: "html",
data: data ,
beforeSend: function(html){
$("#komunikat").html("<p style=\"text-align:center\"><img src=\"/images/ajax_loader.gif\" alt=\"Ładowanie...\" /></p>");         
},
success: function(msg){
$("#komunikat").html(msg);
if(returnUrl != null && returnUrl != '') setTimeout(function() {window.location.href=returnUrl},2000);
},
error:	function(msg){
$("#komunikat").html(msg);   
},

});
return false;
}

function execute(target,type,id)
{
$.ajax({
type: 'GET',
url: target,
async: false,
cache: false,
dataType: "html",
beforeSend: function(html){
$("#komunikat").html("<p style=\"text-align:center\"><img src=\"/images/ajax_loader.gif\" alt=\"Ładowanie...\" /></p>");         
},
success: function(msg){
$("#komunikat").html(msg);
if (type == 'delete') $('#' + id).hide();
if (type == 'remove') $('#' + id).addClass('trash');
if (type == 'restore') $('#' + id).removeClass('trash');
if (type == 'restore') $('#' + id).removeClass('draw');
},
error:	function(msg){
$("#komunikat").html(msg);   
},

});
return false;
}