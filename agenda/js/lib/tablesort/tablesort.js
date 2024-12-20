
$(document).ready(function($){
	
/* THIRD PARTY ----------------------------------------------------------- */
	
	/**
	 * Name        : Tablesorter
	 * Description : Table sorting plugin(bootstrap example)
	 * File Name   : tablesorter.js
	 * Plugin Url  : http://tablesorter.com
	 * Updated     : --/--/----	
	 * Dependency  : jQuery core, bootstrap
	 * Developer   : Brandon
	**/	
	
	$.extend($.tablesorter.themes.bootstrap, {
		// these classes are added to the table. To see other table classes available,
		// look here: http://twitter.github.com/bootstrap/base-css.html#tables
		table      : 'table table-bordered',
		header     : 'bootstrap-header', // give the header a gradient background
		footerRow  : '',
		footerCells: '',
		icons      : '', // add "fa fa-white" to make them white; this icon class is added to the <i> in the header
		sortNone   : 'fa fa-sort',
		sortAsc    : 'fa fa-sort-up',
		sortDesc   : 'fa fa-sort-down',
		active     : '', // applied when column is sorted
		hover      : '', // use custom css here - bootstrap class may not override it
		filterRow  : '', // filter row class
		even       : '', // odd row zebra striping
		odd        : ''  // even row zebra striping
	});
	
	// call the tablesorter plugin and apply the uitheme widget
	$('#tablesorting-1').tablesorter({
		theme          : "bootstrap", // this will 
		widthFixed     : true,
		headerTemplate : '{content} {icon}', // new in v2.7. Needed to add the bootstrap icon!
		// widget code contained in the jquery.tablesorter.widgets.js file
		// use the zebra stripe widget if you plan on hiding any rows (filter widget)
		widgets        : [ "uitheme", "filter", "zebra" ],
		widgetOptions  : {
			// using the default zebra striping class name, so it actually isn't included in the theme variable above
			// this is ONLY needed for bootstrap theming if you are using the filter widget, because rows are hidden
			zebra : ["even", "odd"],
			// reset filters button
			filter_reset : ".reset",
			// set the uitheme widget to use the bootstrap theme class names
			// uitheme : "bootstrap"
		}
	}).tablesorterPager({
		// target the pager markup - see the HTML block below
		container  : $(".pager"),
		// target the pager page select dropdown - choose a page
	    cssGoto    : ".pagenum",
		// remove rows from the table to speed up the sort of large tables.
	    // setting this to false, only hides the non-visible rows; needed if you plan to add/remove rows with the pager enabled.
		removeRows : false,
		// output string - default is '{page}/{totalPages}';
		// possible variables: {page}, {totalPages}, {filteredPages}, {startRow}, {endRow}, {filteredRows} and {totalRows}
		output     : '{startRow} - {endRow} / {filteredRows} ({totalRows})'
	});

});
