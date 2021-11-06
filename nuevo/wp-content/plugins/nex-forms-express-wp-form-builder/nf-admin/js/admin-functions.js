// JavaScript Document
/* SET FIELD NAMES TO STANDARD FORMAT */
'use strict';
//IMPORT FORM
jQuery(document).ready(
function()
	{
	jQuery(document).on('click','.new_form_option',
			function()
				{
				jQuery('.wizard_step').hide();
				jQuery('.'+jQuery(this).attr('data-nex-step')).show();
				jQuery('.import_error').remove();
				}
			);
		
		
		
		jQuery(document).on('click','.load_template',
			function()
				{
				var data =
					{
					action	 						: 'load_template',
					template						: jQuery(this).attr('data-template-name'),
					};
				jQuery.post
					(
					ajaxurl, data, function(response)
						{
						jQuery('.wizard_step').hide();
						jQuery('.creating_new_form').show();
						var url = jQuery('.admin_url').text() + 'admin.php?page=nex-forms-builder&open_form=' + response;
						jQuery(location).attr('href',url);
						}
					);
				}
			);
		
		
	jQuery(document).on('click','#upload_form,#upload_form2',
			function()
				{
				jQuery('input[name="form_html"]').trigger('click');
				}
			);
		
	jQuery(document).on('change','input[name="form_html"]',
			function()
				{
				jQuery('#import_form').submit();
				jQuery('input[name="form_name"]').val('');
				jQuery('#nex-forms #form_update_id').text('');
				jQuery('.nex-forms-container').html('');
				jQuery('.open-form').removeClass('active');	
				jQuery('.center_panel').hide();
				}
		)
		jQuery('#import_form').ajaxForm({
			data: {
			   action: 'do_form_import'
			},
			beforeSubmit: function(formData, jqForm, options) {
				jQuery('div.nex-forms-container').html('<div class="loading"><i class="fa fa-circle-o-notch fa-spin"></i></div>');
				
				jQuery('.import_error').remove();
				
				jQuery('.wizard_step').hide();
				jQuery('.creating_new_form').show();
			},
		   success : function(responseText, statusText, xhr, $form) {
			   	
				if(responseText=='0')
					{
					jQuery('.wizard_step').show();
					jQuery('.creating_new_form').hide();
					jQuery('.creating_new_form').after('<div class="import_error alert alert-danger"><strong>ERROR 403:</strong><br><br>See this article: <a href="https://www.wpbeginner.com/wp-tutorials/how-to-fix-the-403-forbidden-error-in-wordpress/" target="_blank">Fixing 403 Forbidden Error in WordPress</a> or please ask your hosting provider to assist you with this issue.</div>');
					}
				else if(!isNumber(responseText))
					{
					jQuery('.creating_new_form').hide();
					jQuery('.creating_new_form').after('<div class="import_error alert alert-danger"><strong>ERROR 403:</strong><br><br>See this article: <a href="https://www.wpbeginner.com/wp-tutorials/how-to-fix-the-403-forbidden-error-in-wordpress/" target="_blank">Fixing 403 Forbidden Error in WordPress</a> or please ask your hosting provider to assist you with this issue.</div>');
					}
				else
					{
					var url = jQuery('.admin_url').text() + 'admin.php?page=nex-forms-builder&open_form=' + responseText;
					jQuery(location).attr('href',url);	
					//console.log(responseText);
					}
			},
			 error: function(jqXHR, textStatus, errorThrown)
				{
				console.log(errorThrown)
				}
		});	
	jQuery('#new_nex_form').ajaxForm({
			data: {
			   action: 'nf_insert_record',
			   table: 'wap_nex_forms',
			   is_form: 1,
			   is_template: 0
			},
			beforeSubmit: function(formData, jqForm, options) {
				jQuery('#create_new_form button').html('&nbsp;&nbsp;&nbsp;<span class="fa fa-spin fa-spinner"></span>&nbsp;Creating...&nbsp;&nbsp;&nbsp;')
				 jQuery('.wizard_step').hide();
				jQuery('.creating_new_form').show();
			},
		   success : function(responseText, statusText, xhr, $form) {
			  
			  jQuery(location).attr('href',jQuery('#siteurl').text()+'/wp-admin/admin.php?page=nex-forms-builder&open_form=' + responseText)
			},
			 error: function(jqXHR, textStatus, errorThrown)
				{
				console.log(errorThrown)
				}
		});	
	jQuery(document).on('click','.create_new_form',
		function()
			{
			jQuery('.import_error').remove();
			jQuery('.wizard_step').hide();
			jQuery('.select_new_form_option').show();
			jQuery('#new_form_wizard').modal('open');
			}
		);
	jQuery('div.updated').remove();
	jQuery('.update-nag').remove();
	jQuery('div.error').remove();	
	}
);

function unformat_name(input_value){
	if(!input_value)
		return;
	
	var new_value = input_value.replace('_',' ').replace('[','').replace(']','');
	
	return new_value;
}
function format_illegal_chars(input_value){
	
	if(!input_value)
		return;
	
	input_value = input_value.toLowerCase();
	input_value = input_value.replace(/<(.|\n)*?>/g, '');
	
	if(input_value=='name' || input_value=='page' || input_value=='post' || input_value=='id')
		input_value = '_'+input_value;
		
	var illigal_chars = '"+=!@#$%^&*()*{};<>,.?~`|/\'';
	
	var new_value ='';
	
    for(var i=0;i<input_value.length;i++)
		{
		if (illigal_chars.indexOf(input_value.charAt(i)) != -1)
			{
			input_value.replace(input_value.charAt(i),'');
			}
		else
			{
			if(input_value.charAt(i)==' ')
			new_value += '_';
			else
			new_value += input_value.charAt(i);
			}
		}
	return new_value;	
}

function strstr(haystack, needle, bool) {
    var pos = 0;

    haystack += "";
    pos = haystack.indexOf(needle); if (pos == -1) {
       return false;
    } else {
       return true;
    }
}

function short_str(str) {
    if(str)
       return str.substring(0, 30);
    
}

function insertAtCaret(areaId,text) {
    var txtarea = document.getElementById(areaId);
    var scrollPos = txtarea.scrollTop;
    var strPos = 0;
    var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ? 
    	"ff" : (document.selection ? "ie" : false ) );
    if (br == "ie") { 
    	txtarea.focus();
    	var range = document.selection.createRange();
    	range.moveStart ('character', -txtarea.value.length);
    	strPos = range.text.length;
    }
    else if (br == "ff") strPos = txtarea.selectionStart;

    var front = (txtarea.value).substring(0,strPos);  
    var back = (txtarea.value).substring(strPos,txtarea.value.length); 
    txtarea.value=front+text+back;
    strPos = strPos + text.length;
    if (br == "ie") { 
    	txtarea.focus();
    	var range = document.selection.createRange();
    	range.moveStart ('character', -txtarea.value.length);
    	range.moveStart ('character', strPos);
    	range.moveEnd ('character', 0);
    	range.select();
    }
    else if (br == "ff") {
    	txtarea.selectionStart = strPos;
    	txtarea.selectionEnd = strPos;
    	txtarea.focus();
    }
    txtarea.scrollTop = scrollPos;
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
} 

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function nf_form_modified(modification){	
	jQuery('.check_save').addClass('not_saved');	
	jQuery('.prime_save').find('.ns').remove();	
	jQuery('.prime_save').append('<span class="ns">*</span>');
}
function isNumber(n) {
   if(n!='')
		return !isNaN(parseFloat(n)) && isFinite(n);
	
	return true;
}
