/*
 jquery.numeric
 git://github.com/danielgindi/jquery.numeric.git
*/
(function(b,e){"function"===typeof define&&define.amd?define("jquery.numeric",["jquery"],e):"object"===typeof exports?module.exports=e(require("jquery")):e(b.jQuery)})(this,function(b){function e(a){return a.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g,"\\$&")}var f=(1.1).toLocaleString().match(/\d(.*?)\d/)[1],n=new RegExp("\\"+e(f),"g");b.fn.numeric=function(a){this.each(function(e,d){var c="INPUT"===d.tagName;"boolean"===typeof a&&(a={decimal:a});a=a||{};"undefined"===typeof a.negative&&(a.negative=
c?d.getAttribute("min")?0>parseFloat(d.getAttribute("min")):!0:!0);var h=!1===a.decimal?"":"string"===typeof a.decimal&&a.decimal?a.decimal:f,g=!!a.negative;h&&"INPUT"===this.tagName&&"number"===this.type&&"valueAsNumber"in this&&(h=f);"undefined"===typeof a.decimal&&c&&(c=d.getAttribute("step"))&&"any"!==c&&-1===c.indexOf(".")&&(h="");return b(d).data("numeric.decimal",h).data("numeric.negative",g).on("keypress.numericValue",b.fn.numeric._event).on("keyup.numericValue",b.fn.numeric._event).on("blur.numericValue",
b.fn.numeric._event).on("input.numericValue",b.fn.numeric._event)});return this};b.fn.valueAsNumber=function(){if(!this.length)return null;var a=arguments;if(a.length)return this.each(function(){"INPUT"===this.tagName&&"number"===this.type&&"valueAsNumber"in this?this.valueAsNumber=a[0]:this.value=a[0].toString().replace(/\./,b.data(this,"numeric.decimal")||f)});if("INPUT"===this[0].tagName&&"number"===this[0].type&&"valueAsNumber"in this[0])return this[0].valueAsNumber;var g=this.data("numeric.decimal"),
g=g?new RegExp(e(g),"g"):n;return""===this[0].value?null:parseFloat(this[0].value.replace(g,"."))};b.fn.numeric._event=function(a){a=b.data(this,"numeric.decimal");var g=b.data(this,"numeric.negative"),d=this.value,c="",h=!1;if("number"!==this.type)var f=this.selectionStart,m=this.selectionEnd;a&&e(a);a&&e(a);for(var k=0,l;k<d.length;k++)l=d.charAt(k),"0"<=l&&"9">=l||g&&"-"===l&&!c.length?c+=l:a&&d.substr(k,a.length)===a&&!h?(h=!0,c+=a,k+=a.length-1):(k<=f&&f--,k<=m&&m--);d!==c&&(this.value=c,"number"!==
this.type&&(this.selectionStart=f,this.selectionEnd=m))};b.fn.removeNumeric=function(){return this.removeData("numeric.decimal").removeData("numeric.negative").off(".numericValue")}});