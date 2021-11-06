// JavaScript Document
'use strict';

jQuery(document).ready(
function()
	{
	jQuery(document).on('focus','select[name="fields_for_conditions"]',
		function()
			{
			
			 var select_clone = '';
			var the_select = jQuery(this);
			var get_selected = the_select.attr('data-selected')
			jQuery('select[name="cl_current_fields_container"] option').each(
				function()
					{	
					if(jQuery(this).val()==get_selected)
						jQuery(this).attr('selected',true);
					else
						jQuery(this).attr('selected',false);
					}
				);
			jQuery('select[name="cl_current_fields_container"] option:selected').trigger('click');
			select_clone = jQuery('select[name="cl_current_fields_container"]').clone();
			select_clone.removeClass('hidden').addClass('form-control').addClass('cl_field')
			select_clone.attr('name','reloaded_fields');
			select_clone.attr('data-selected',get_selected)
			the_select.after(select_clone);
			the_select.remove();
			
			setTimeout(function(){select_clone.trigger('mousedown')},100);
			}
		);
	jQuery(document).on('focus','.cla_field',
		function()
			{
			
			 var select_clone = '';
			var the_select = jQuery(this);
			var get_selected = the_select.attr('data-selected')
			jQuery('select[name="cl_current_action_fields_container"] option').each(
				function()
					{
					if(jQuery(this).val()==get_selected)
						jQuery(this).attr('selected',true);
					else
						jQuery(this).attr('selected',false);
					}
				);
			jQuery('select[name="cl_current_action_fields_container"] option:selected').trigger('click');
			select_clone = jQuery('select[name="cl_current_action_fields_container"]').clone();
			select_clone.removeClass('hidden').addClass('form-control')
			select_clone.attr('name','cla_field');
			select_clone.attr('data-selected',get_selected)
			the_select.after(select_clone);
			the_select.remove();
			}
		);
	
	
	
	jQuery(document).on('click','.refresh_cl_fields',
		function()
			{
			jQuery('select[name="reloaded_fields"]').attr('name','fields_for_conditions');
			jQuery('select[name="cla_field"]').addClass('cla_field');	
				
			jQuery(this).find('.fa').addClass('fa-spin');
			set_c_logic_fields();
			setTimeout(function(){jQuery('.refresh_cl_fields').find('.fa').removeClass('fa-spin')},500);
			}
		);
	
	jQuery(document).on('click','.conditional-logic-btn',
		function()
			{
			jQuery('.conditional_logic_wrapper').addClass('opened');
			jQuery(this).addClass('active');
			jQuery('.form_canvas').addClass('conditional-logic-opened');
			jQuery('.overall-settings-column #close-settings').trigger('click');
			jQuery('.field-settings-column #close-settings').trigger('click');
			}
		);
	
	jQuery(document).on('click','.conditional_logic_wrapper #close-settings',
		function()
			{
			jQuery('.conditional-logic-btn').removeClass('active');
			jQuery('.conditional_logic_wrapper').removeClass('opened');
			jQuery('.form_canvas').removeClass('conditional-logic-opened');
			jQuery('.conditional_logic_wrapper').removeClass('opened');
			}
		);
	
	reset_rule_complexity();
	setTimeout(function(){set_c_logic_fields()},1000);
	jQuery(document).on('change', '.cl_field, select[name="cla_field"]', function()
		{
		jQuery(this).attr('data-selected',jQuery(this).val());
		}
	);
	
	
	jQuery(document).on('change', 'input[name="adv_cl"]', function()
		{
		if(jQuery(this).prop('checked')==true)
			{
			jQuery('.conditional_logic').removeClass('simple_view').addClass('advanced_view');	
			}
		else
			{
			jQuery('.conditional_logic').addClass('simple_view').removeClass('advanced_view');
			
			var count1 = 0;
			var count2 = 0;
			
			reset_rule_complexity();
				
			}
		}
	);
	jQuery(document).on('click', '.add_new_rule', function()
		{
		var new_rule = jQuery('.conditional_logic_clonables .new_rule').clone();
		jQuery('.set_rules').append(new_rule);
		var radio_name =  Math.round(Math.random()*9999);
		
		new_rule.find('input[type="radio"]').attr('name',radio_name);

		jQuery('.con-logic-column .inner').animate(
					{
					scrollTop:100000
					},0
				);
		count_nf_conditions();
		}
	);

	jQuery(document).on('click', '.add_condition', function()
		{
		var new_condition = jQuery('.conditional_logic_clonables .set_rule_conditions').clone();
		
		new_condition.removeClass('set_rule_conditions').addClass('the_rule_conditions');
		
		jQuery(this).parent().find('.get_rule_conditions').append(new_condition);
		}
	);

	
	jQuery(document).on('click', '.add_action', function()
		{
		var new_condition = jQuery('.conditional_logic_clonables .set_rule_actions').clone();
		new_condition.removeClass('set_rule_actions').addClass('the_rule_actions');
		jQuery(this).parent().find('.get_rule_actions').append(new_condition);
		}
	);

	jQuery(document).on('click', '.delete_action, .delete_condition', function()
		{
		jQuery(this).parent().remove();
		reset_rule_complexity();
		}
	);
	jQuery(document).on('click', '.delete_rule, .delete_simple_rule', function()
		{
		jQuery(this).closest('.new_rule').remove();
		reset_rule_complexity();
		}
	);	
});

function reset_rule_complexity(){
	jQuery('.set_rules .new_rule').each(
				function()
					{
					var count1 = jQuery(this).find('.delete_condition').size();
					var count2 = jQuery(this).find('.delete_action').size();
					
					if(count1>1 || count2>1)
						jQuery(this).addClass('advanced_view');
					else
						jQuery(this).removeClass('advanced_view');
					}
				);
	count_nf_conditions();
}

function count_nf_conditions(){
	jQuery('.set_rules .new_rule').each(
		function(index)
			{
			jQuery(this).find('.rule_number').text(index+1)
			}
		);
	
}


function set_c_logic_fields(the_select){
	
	var set_current_fields_conditional_logic = '<option value="0">-- Fields --</option>';
	var set_current_action_fields_conditional_logic ='';
	set_current_fields_conditional_logic += '<optgroup label="Text Fields">';
	jQuery('div.nex-forms-container div.form_field input[type="text"]').each(
		function()
			{
			
			if(jQuery(this).attr('name')!='multi_step_name')
				{
				if(jQuery(this).attr('name') && jQuery(this).attr('name')!='undefined')
					{
					if(jQuery(this).closest('.form_field').hasClass('date'))
						set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="date" value="'+ jQuery(this).closest('.form_field').attr('id') +'**date##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
					else if(jQuery(this).closest('.form_field').hasClass('datetime'))
						set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="datetime" value="'+ jQuery(this).closest('.form_field').attr('id') +'**datetime##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
					else if(jQuery(this).closest('.form_field').hasClass('time'))
						set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="time"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**time##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
					else if(jQuery(this).closest('.form_field').hasClass('star-rating'))
						set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="stars"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**hidden##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
					else
						set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="text"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**text##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
					}
				}
			}
		);	
	set_current_fields_conditional_logic += '</optgroup>';
	
	set_current_fields_conditional_logic += '<optgroup label="Radio Buttons">';
	var old_radio = '';
	var new_radio = '';
	
	jQuery('div.nex-forms-container div.form_field input[type="radio"]').each(
		function()
			{
			if(jQuery(this).attr('name')!='undefined')
				{
				old_radio = jQuery(this).attr('name');
				if(old_radio != new_radio)
					set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="radio"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**radio##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
				
				new_radio = old_radio;
				}
			
			}
		);	
	set_current_fields_conditional_logic += '</optgroup>';
	
	var old_check = '';
	var new_check = '';
	set_current_fields_conditional_logic += '<optgroup label="Check Boxes">';
	jQuery('div.nex-forms-container div.form_field input[type="checkbox"]').each(
		function()
			{
			if(jQuery(this).attr('name')!='undefined')
				{
				old_check = jQuery(this).attr('name');
				if(old_check != new_check)
					set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="checkbox"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**checkbox##'+ jQuery(this).attr('name')  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
				new_check = old_check;
				}
			}
		);	
	set_current_fields_conditional_logic += '</optgroup>';
	
	set_current_fields_conditional_logic += '<optgroup label="Selects">';
	jQuery('div.nex-forms-container div.form_field select').each(
		function()
			{
			if(jQuery(this).attr('name')!='undefined')
				{
				set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="select"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**select##'+ jQuery(this).attr('name')  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
				}
			}
		);	
	set_current_fields_conditional_logic += '</optgroup>';
	
	set_current_fields_conditional_logic += '<optgroup label="Text Areas">';
	jQuery('div.nex-forms-container div.form_field textarea').each(
		function()
			{
			set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="textarea"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**textarea##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
			}
		);	
	set_current_fields_conditional_logic += '</optgroup>';
	
	
	set_current_fields_conditional_logic += '<optgroup label="File Uploaders">';
	jQuery('div.nex-forms-container div.form_field input[type="file"]').each(
		function()
			{
			if(jQuery(this).attr('name')!='undefined')
				{
				set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="file"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**file##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
				}
			}
		);	
	set_current_fields_conditional_logic += '</optgroup>';
	
	set_current_fields_conditional_logic += '<optgroup label="Hidden Fields">';
	
	
	jQuery('.hidden_fields_setup .hidden_fields .hidden_field').each(
		function()
			{
			set_current_fields_conditional_logic += '<option data-field-id="hidden_field" data-field-name="'+ format_illegal_chars(jQuery(this).find('.hidden_field_name').val())  +'" data-field-type="hidden"  value="hidden_field**hidden##'+ format_illegal_chars(jQuery(this).find('.hidden_field_name').val())  +'">'+ unformat_name(jQuery(this).find('.hidden_field_name').val()) +'</option>';
			}
		);	
	
	
	
	jQuery('div.nex-forms-container div.form_field input[type="hidden"]').each(
		function()
			{
			if(jQuery(this).attr('name')!='undefined' && jQuery(this).attr('name')!='math_result')
				{
				set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="hidden"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**hidden##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
				}
			}
		);	
	set_current_fields_conditional_logic += '</optgroup>';
	
	
	set_current_fields_conditional_logic += '<optgroup label="Password Fields">';
	jQuery('div.nex-forms-container div.form_field input[type="password"]').each(
		function()
			{
			if(jQuery(this).attr('name')!='undefined')
				{
				set_current_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).attr('name'))  +'" data-field-type="hidden"  value="'+ jQuery(this).closest('.form_field').attr('id') +'**password##'+ format_illegal_chars(jQuery(this).attr('name'))  +'">'+ unformat_name(jQuery(this).attr('name')) +'</option>';
				}
			}
		);	
	set_current_fields_conditional_logic += '</optgroup>';
	
	set_current_action_fields_conditional_logic += '<optgroup label="Buttons">';
	jQuery('div.nex-forms-container div.form_field.button_fields').each(
		function()
			{
			//if(jQuery(this).find('.the_input_element').hasClass('nex-submit'))
				//set_current_action_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).find('.the_input_element').text())  +'" data-field-type="button"  value="'+ jQuery(this).attr('id') +'**button##button">'+ jQuery(this).find('.the_input_element').text() +'</option>';
			//else
				set_current_action_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ format_illegal_chars(jQuery(this).find('.the_input_element').text())  +'" data-field-type="button"  value="'+ jQuery(this).attr('id') +'**button##button">'+ jQuery(this).closest('.step').find('input[name="multi_step_name"]').val() +' - '+ jQuery(this).find('.the_input_element').text() +'</option>';
			}
		);	
	set_current_action_fields_conditional_logic += '</optgroup>';
	
	set_current_action_fields_conditional_logic += '<optgroup label="Panels">';
	jQuery('div.nex-forms-container div.form_field.is_panel').each(
		function()
			{
			set_current_action_fields_conditional_logic += '<option  data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="panel" data-field-type="panel"   value="'+ jQuery(this).attr('id') +'**panel##panel">'+ short_str(jQuery(this).find('.panel-heading').text()) +'</option>';
				
			}
		);	
	set_current_action_fields_conditional_logic += '</optgroup>';
	
	set_current_action_fields_conditional_logic += '<optgroup label="Headings">';
	jQuery('div.nex-forms-container div.form_field.heading').each(
		function()
			{
			set_current_action_fields_conditional_logic += '<option   data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="heading" data-field-type="heading"   value="'+ jQuery(this).attr('id') +'**heading##heading">'+ short_str(jQuery(this).find('.the_input_element').text()) +'</option>';
			}
		);	
	set_current_action_fields_conditional_logic += '</optgroup>';
	
	set_current_action_fields_conditional_logic += '<optgroup label="HTML/Paragraphs">';
	jQuery('div.nex-forms-container div.form_field.html').each(
		function()
			{
			set_current_action_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="html" data-field-type="html"  value="'+ jQuery(this).attr('id') +'**paragraph##html">'+ short_str(jQuery(this).find('.the_input_element').text()) +'</option>';
			}
		);	
	jQuery('div.nex-forms-container div.form_field.paragraph').each(
		function()
			{
			set_current_action_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="paragraph" data-field-type="paragraph" value="'+ jQuery(this).attr('id') +'**heading##html">'+ short_str(jQuery(this).find('.the_input_element').text()) +'</option>';
			}
		);	
	set_current_action_fields_conditional_logic += '</optgroup>';


	
	
	set_current_action_fields_conditional_logic += '<optgroup label="Steps">';
	jQuery('div.nex-forms-container div.form_field.step').each(
		function()
			{
			set_current_action_fields_conditional_logic += '<option data-field-id="'+ jQuery(this).closest('.form_field').attr('id') +'" data-field-name="'+ jQuery(this).attr('data-step-num') +'" data-field-type="step"  value="'+ jQuery(this).attr('id') +'**' + jQuery(this).attr('data-step-num') + '##step">'+ short_str(jQuery(this).find('input[name="multi_step_name"]').val()) +'</option>';
			}
		);		
	set_current_action_fields_conditional_logic += '</optgroup>';
		
	

jQuery('select[name="cl_current_fields_container"]').html(set_current_fields_conditional_logic);
jQuery('select[name="cl_current_action_fields_container"]').html(set_current_fields_conditional_logic + set_current_action_fields_conditional_logic);
}