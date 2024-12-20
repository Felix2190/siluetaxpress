'use strict';

jQuery(document).ready(
function()
	{
	create_droppable(jQuery('div.nex-forms-container'));
	jQuery(document).on('click', '.draggable_object', 
		function()
			{
			nf_form_modified('drop');
			var animation_class = 'flipInX';
			var clone_element = jQuery(this).closest('.form_field ').clone();
			
			if(jQuery('.nex-forms-container .active_step').attr('class') && !clone_element.hasClass('step'))
				{
				if(jQuery('div.nex-forms-container .active_step').find('.nex_prev_steps').attr('class'))
					jQuery('div.nex-forms-container .active_step').find('.nex_prev_steps').before(clone_element);
				else
					jQuery('div.nex-forms-container .active_step .panel-body').first().append(clone_element);	
				}
			else
				{
				jQuery('div.nex-forms-container').append(clone_element);
				}
				clone_element.addClass('animated').addClass(animation_class);	
				
				setTimeout(function(){ clone_element.removeClass('animated').removeClass(animation_class) },1000);
				setup_form_element(clone_element);
			
				if(jQuery('.form-canvas-area').hasClass('split_view'))
					{
					setTimeout(function() { nf_save_nex_form('','preview', '') },300);
					}
			if(jQuery('select[name="set_form_theme"]').val()!='bootstrap')
				reset_field_theme(jQuery('select[name="set_form_theme"]').val(),clone_element);
			
			
			if(clone_element.hasClass('step'))
				{
				clone_element.find('.form_field').each(
					function()
						{
						jQuery(this).attr('id','_' + Math.round(Math.random()*99999));	
						}
					);	
				var total_steps = nf_count_multi_steps();
				jQuery('.multi-step-tools ul li:eq('+ total_steps +')').find('a').trigger('click');
				jQuery('#ms-css-settings').show();
				jQuery('.show_all_steps').show();
				}
			else
				{
				var the_offset = clone_element.offset();
					setTimeout(function(){jQuery(".form_canvas").animate(
							{
							scrollTop:30000
							},100
						);
					},100);
				}
			}
		);
	});

function reset_zindex(obj){
	if(obj)
		obj.attr('style','');
}
Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};	


function create_droppable(obj){
	
	var the_droppable 	= obj;
	var the_draggable 	= jQuery('div.field-selection-tools .form_field');
	//Drag
   the_draggable.draggable(
		{
		drag: function( event, ui ) {  the_droppable.addClass('placing-field'); ui.helper.addClass('moving'); nf_form_modified('drag'); },//ui.helper.addClass('moving');
		stop: function( event, ui ) {  the_droppable.removeClass('placing-field'); ui.helper.removeClass('moving'); 
		},
		stack  : '.draggable',
		revert : 'invalid', 
		tolerance: 'pointer',
		connectToSortable:obj,
		snap:true,
		helper : 'clone',
		}
	);
	the_droppable.droppable(
		{
		drop   		: function(event, ui)
						{
						if(!ui.draggable.hasClass('dropped'))
						setup_form_element(ui.draggable);
						reset_zindex(ui.draggable);
						jQuery(this).removeClass('over');
						nf_form_modified('drop');				
						},
		over        : function(){jQuery(this).addClass('over')},
		out         : function(){jQuery(this).removeClass('over')},	  
		tolerance 	: 'fit',
		helper 		: 'clone'	,
		accept      : '.form_field'
	}).sortable(
		{
		start : function(event, ui)
			{ 
			//the_droppable.addClass('placing-field');
			ui.helper.removeClass('field');
			ui.helper.addClass('moving');			
			}, 
		cursorAt: { left:0, top:0 },
		stop : function(event, ui){ 
			if(jQuery('.form-canvas-area').hasClass('split_view'))
				{
				setTimeout(function() {nf_save_nex_form('','preview', '') },300);
				}
			
			nf_reset_multi_steps();
			nf_count_multi_steps();
			
			the_droppable.removeClass('placing-field');
			jQuery('.moving').removeClass('moving'); nf_form_modified('sort'); },           
			placeholder: 'place-holder',
			forcePlaceholderSize : true,
			connectWith:'.panel-body'
		}
	);
	
	

	
	
}









function setup_form_element(obj){
	jQuery('div.nex-forms-container').find('div.draggable_object').remove();
	obj.find('div.form_object').show();
	jQuery('div.nex-forms-container').find('div.form_field').removeClass('field');

	obj.removeClass('field');


	/*if(obj.hasClass('grid-system'))
		{
		obj.resizableGrid();
		console.log('test');
		}*/
	if(obj.hasClass('jq-datepicker'))
		{	
		 obj.find('#datetimepicker input').datepicker();
		}
	
	if(obj.hasClass('md-datepicker'))
		{
			obj.find('input').bootstrapMaterialDatePicker({
				time: false,
				clearButton:false,
				nowButton:false,
				cancelText: '<span class="fa fa-close"></span>', 
				okText: '<span class="fa fa-check"></span>', 
				format: (obj.find('#datetimepicker').attr('data-format')) ? obj.find('#datetimepicker').attr('data-format') : 'MM/DD/YYYY',
				lang : (obj.find('#datetimepicker').attr('data-language')) ? obj.find('#datetimepicker').attr('data-language') : 'en',
		  });
		 if(obj.find('#datetimepicker').attr('data-disable-past-dates')=='1')
		  	obj.find('input').bootstrapMaterialDatePicker('setMinDate', new Date());
		}
	if(obj.hasClass('md-time-picker'))
		{
		 obj.find('input').bootstrapMaterialDatePicker({ date: false, shortTime: false, format: 'HH:mm' })
		}
	
	if(obj.hasClass('jq-radio-group') || obj.hasClass('jq-check-group'))
		{
		obj.find( "#the-radios input" ).checkboxradio();
		}
	
	
	if(obj.hasClass('digital-signature'))
		{
		obj.find('.js-signature').jqSignature();
		}

	
	if(obj.hasClass('md-select'))
		{
		obj.find('select').material_select();
		}

	if(obj.hasClass('text') || obj.hasClass('textarea'))
		{
		if(obj.find('.the_input_element').attr('data-value'))
				obj.find('.the_input_element').val(obj.find('.the_input_element').attr('data-value'));
		}
	if(obj.hasClass('paragraph') || obj.hasClass('heading'))
		{
		if(!obj.find('input.set_math_result').attr('name'))
			obj.find('.the_input_element').parent().append('<input type="hidden" class="set_math_result" value="0" name="math_result">');
		}
					
	if(obj.hasClass('grid'))
		{
		var panel = obj.find('.panel-body');
		create_droppable(panel);
		create_droppable(jQuery('div.nex-forms-container'));
		}
	if(obj.hasClass('datetime'))
		{
		obj.find('#datetimepicker').datetimepicker( 
				{ 
				format: (obj.find('#datetimepicker').attr('data-format')) ? obj.find('#datetimepicker').attr('data-format') : 'MM/DD/YYYY hh:mm A',
				locale: (obj.find('#datetimepicker').attr('data-language')) ? obj.find('#datetimepicker').attr('data-language') : 'en'
				} 
			);	
		}
	if(obj.hasClass('date'))
		{
		obj.find('#datetimepicker').datetimepicker( 
				{ 
				minDate: (obj.find('#datetimepicker').attr('data-disable-past-dates')=='1') ? new Date() : false,
				format: (obj.find('#datetimepicker').attr('data-format')) ? obj.find('#datetimepicker').attr('data-format') : 'MM/DD/YYYY',
				locale: (obj.find('#datetimepicker').attr('data-language')) ? obj.find('#datetimepicker').attr('data-language') : 'en'
				} 
			);	
		}	
	if(obj.hasClass('time'))
		{
		obj.find('#datetimepicker').datetimepicker( 
				{ 
				format: (obj.find('#datetimepicker').attr('data-format')) ? obj.find('#datetimepicker').attr('data-format') : 'HH:mm',
				locale:(obj.find('#datetimepicker').attr('data-language')) ? obj.find('#datetimepicker').attr('data-language') : 'en'
				} 
			);	
		}
	
	if(obj.hasClass('jq-datepicker'))
		{
		if((obj.find('#datetimepicker').attr('data-disable-past-dates')=='1'))
			{	
			 obj.find('#datetimepicker input').datepicker(
					{
					minDate: (obj.find('#datetimepicker').attr('data-disable-past-dates')=='1') ? new Date() : false,
					}
				
				 );
			}
		else
			{
			obj.find('#datetimepicker input').datepicker({});
			}
		}
	

	if(obj.hasClass('touch_spinner'))
		{
		var the_spinner = obj.find("#spinner");
		the_spinner.TouchSpin({
			verticalbuttons: (the_spinner.attr('data-verticalbuttons')=='true') ? true : false,
			initval: parseInt(the_spinner.attr('data-starting-value')),
			min:  parseInt(the_spinner.attr('data-minimum')),
			max:  parseInt(the_spinner.attr('data-maximum')),
			step:  parseInt(the_spinner.attr('data-step')),
			decimals:  parseInt(the_spinner.attr('data-decimals')),
			boostat: 5,
			maxboostedstep: 10,
			postfix: (the_spinner.attr('data-postfix-icon')) ? '<span class="'+ the_spinner.attr('data-postfix-icon') +' '+ the_spinner.attr('data-postfix-class') +'">' + the_spinner.attr('data-postfix-text') + '</span>' : '',
			prefix: (the_spinner.attr('data-prefix-icon')) ? '<span class="'+ the_spinner.attr('data-prefix-icon') +' '+ the_spinner.attr('data-prefix-class') +'">' + the_spinner.attr('data-prefix-text') + '</span>' : '',
			buttondown_class:  'btn ' + the_spinner.attr('data-down-class'),
			buttonup_class: 'btn ' + the_spinner.attr('data-up-class')
		});
		}
	if(obj.hasClass('color_pallet'))
		{
		obj.find('#colorpalette').colorPalette().on('selectColor', function(e) {
		obj.find('#selected-color').val(e.color);
		obj.find('#selected-color').trigger('change');
		obj.find('.input-group-addon').css('background',e.color);
		});	
		}
	
	if(obj.hasClass('slider'))
		{
		var count_text = obj.find( "#slider" ).attr('data-starting-value');
		var the_slider = obj.find( "#slider" )
		var set_min = the_slider.attr('data-min-value');
		var set_max = the_slider.attr('data-max-value')
		var set_start = the_slider.attr('data-starting-value');
		var set_step = the_slider.attr('data-step-value')

		obj.find( "#slider" ).slider({
				range: "min",
				min: parseInt(set_min),
				max: parseInt(set_max),
				value: parseInt(set_start),
				step: parseInt(set_step),
				slide: function( event, ui ) {	
					count_text = '<span class="ui-slider-tip count-text">' + the_slider.attr('data-count-text').replace('{x}',parseInt(ui.value).format(0)) + '</span>';	
					the_slider.find( '.ui-slider-handle' ).html( '<span id="icon" class="'+ the_slider.attr('data-dragicon') +'"></span> '+ count_text).addClass(the_slider.attr('data-dragicon-class')).removeClass('ui-state-default');
					obj.find( 'input' ).val(ui.value);
					obj.find( 'input' ).trigger('change');
				},
				create: function( event, ui ) {	
					count_text = '<span class="ui-slider-tip count-text">'+ the_slider.attr('data-count-text').replace('{x}',((set_start) ? set_start : set_min)) +'</span>';	
					the_slider.find( '.ui-slider-handle' ).html( '<span id="icon" class="'+ the_slider.attr('data-dragicon') +'"></span> '+ count_text).addClass(the_slider.attr('data-dragicon-class')).removeClass('ui-state-default');
					
				}
				
			});
			//Slider text color
			the_slider.find('.ui-slider-handle').css('color',the_slider.attr('data-text-color'));
			//Handel border color
			the_slider.find('.ui-slider-handle').css('border-color',the_slider.attr('data-handel-border-color'));
			//Handel Background color
			the_slider.find('.ui-slider-handle').css('background-color',the_slider.attr('data-handel-background-color'));
			//Slider border color
			the_slider.find('.ui-widget-content').css('border-color',the_slider.attr('data-slider-border-color'));
			//Slider background color
			//Slider fill color
			the_slider.find('.ui-slider-range:first-child').css('background',the_slider.attr('data-fill-color'));
			the_slider.find('.ui-slider-range:last-child').css('background',the_slider.attr('data-background-color'));
		}	
	
	if(obj.hasClass('md-slider'))
		{
		var count_text = obj.find( "#slider" ).attr('data-starting-value');
		var the_slider = obj.find( "#slider" )
		var set_min = the_slider.attr('data-min-value');
		var set_max = the_slider.attr('data-max-value')
		var set_start = the_slider.attr('data-starting-value');
		var set_step = the_slider.attr('data-step-value')

		obj.find( "#slider" ).slider({
				range: "min",
				min: parseInt(set_min),
				max: parseInt(set_max),
				value: parseInt(set_start),
				step: parseInt(set_step),
				slide: function( event, ui ) {	

				obj.find('.count-text').html(the_slider.attr('data-count-text').replace('{x}',parseInt(ui.value).format(0)));
				
				obj.find( 'input' ).val(ui.value);
				obj.find( 'input' ).trigger('change');
				
				},
				create: function( event, ui ) {	
					count_text = '<span class="noUi-tooltip"><span class="count-text">'+ the_slider.attr('data-count-text').replace('{x}',((set_start) ? parseInt(set_start).format(0) : parseInt(set_min).format(0))) +'</span></span>';	
					the_slider.find( '.ui-slider-handle' ).html( count_text).addClass(the_slider.attr('data-dragicon-class')).removeClass('ui-state-default');
					
					the_slider.find( '.ui-slider-handle' ).addClass('noUi-handle noUi-handle-lower ').removeClass('btn').removeClass('btn-default');
					
				}
				
			});
			
		}			
	
			
	if(obj.hasClass('star-rating'))
		{
		obj.find('#star').raty({
		  number   : parseInt(obj.find('#star').attr('data-total-stars')),
		  scoreName: format_illegal_chars(obj.find('.the_label').text()),
		  half: (obj.find('#star').attr('data-enable-half')=='false') ? false : true 
		});
		obj.find('#star input').addClass('the_input_element').addClass('hidden');
		obj.find('#star input').prop('type','text');
		}
		if(obj.hasClass('select'))
			{	
			obj.find('select.jq_select').selectmenu();
			}
	
	if(obj.hasClass('tags'))
		{	
		var the_tag_input = obj.find('input#tags');
		 the_tag_input.tagsinput( {maxTags: (the_tag_input.attr('data-max-tags')) ? the_tag_input.attr('data-max-tags') : '' });
		 
		obj.find('.bootstrap-tagsinput input').css('color',the_tag_input.attr('data-text-color'));
		obj.find('.bootstrap-tagsinput').css('border-color',the_tag_input.attr('data-border-color'));
		obj.find('.bootstrap-tagsinput').css('background-color',the_tag_input.attr('data-background-color'));
		obj.find('.bootstrap-tagsinput').addClass('error_message').addClass('the_input_element');
		obj.find(".bootstrap-tagsinput").attr('data-placement',the_tag_input.attr('data-placement'));
		obj.find(".bootstrap-tagsinput").attr('data-error-class',the_tag_input.attr('data-error-class'));
		obj.find(".bootstrap-tagsinput").attr('data-content',the_tag_input.attr('data-content'));
		}
		
		
	if(obj.hasClass('autocomplete'))
		{
		var items = obj.find('div.get_auto_complete_items').text();
		items = items.split('\n');
		obj.find("#autocomplete").autocomplete({
		source: items
		});	
		}	

	if(obj.hasClass('single-image-select-group'))
		{
		obj.find('input[type="radio"]').nexchecks();
		obj.find('input[type="radio"]').closest('label').find('.input-label').addClass('img-thumbnail');
		}
	
	if(obj.hasClass('multi-image-select-group'))
		{
		obj.find('input[type="checkbox"]').nexchecks();
		obj.find('input[type="checkbox"]').closest('label').find('.input-label').addClass('img-thumbnail');
		}
	if(obj.hasClass('radio-group') && !obj.hasClass('classic-radio-group'))
		{
		obj.find('input[type="radio"]').nexchecks()
		}
	if(obj.hasClass('check-group') && !obj.hasClass('classic-check-group'))
		{
		obj.find('input[type="checkbox"]').nexchecks()
		}
	
	if(obj.hasClass('upload_fields'))
		{
		obj.find('.btn-file').removeClass('btn');	
		}
	
	if(obj.hasClass('grid-system'))
		obj.removeClass('ui-widget-content')
		

	if(!obj.hasClass('dropped'))
		{
		var set_Id = '_' + Math.round(Math.random()*99999);
		obj.attr('id',set_Id);	
		obj.addClass('dropped');
		}
		
	if(obj.hasClass('heading') || obj.hasClass('html') || obj.hasClass('math_logic') || obj.hasClass('paragraph') || obj.hasClass('divider'))
		{
		obj.find('.field_settings').html('<div class="btn btn-default waves-effect waves-light btn-xs move_field"><i class="fa fa-arrows"></i></div><div class="btn btn-default waves-effect waves-light btn-xs edit" title="Edit Field Attributes"><i class="fa fa-edit"></i></div><div class="btn btn-default waves-effect waves-light btn-xs duplicate_field" title="Duplicate Field"><i class="fa fa-files-o"></i></div><div class="btn btn-default waves-effect waves-light btn-xs delete" title="Delete field"><i class="fa fa-close"></i></div>');
		obj.removeClass('material_field');
		}
}