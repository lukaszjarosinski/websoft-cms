function sendForm(formId,comId,loader,domain)
{
data = $('#' + formId).serialize();
$.ajax({
type: 'POST',
url: domain,
async: false,
cache: false,
dataType: "html",
data: data ,
beforeSend: function(html){
$("#" + comId).html('<p style="text-align:center"><img src="' + loader + '" alt="Ładowanie..." /></p>');         
},
success: function(msg){
$("#" + comId).show();
$("#" + comId).html(msg);
},
error:	function(msg){
$("#" + comId).show();
$("#" + comId).html(msg);   
},

});
return false;
}