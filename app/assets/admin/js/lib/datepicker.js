!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a(jQuery)}(function(a){function b(a){if(a.minTime&&(a.minTime=s(a.minTime)),a.maxTime&&(a.maxTime=s(a.maxTime)),a.durationTime&&"function"!=typeof a.durationTime&&(a.durationTime=s(a.durationTime)),a.disableTimeRanges.length>0){for(var b in a.disableTimeRanges)a.disableTimeRanges[b]=[s(a.disableTimeRanges[b][0]),s(a.disableTimeRanges[b][1])];a.disableTimeRanges=a.disableTimeRanges.sort(function(a,b){return a[0]-b[0]});for(var b=a.disableTimeRanges.length-1;b>0;b--)a.disableTimeRanges[b][0]<=a.disableTimeRanges[b-1][1]&&(a.disableTimeRanges[b-1]=[Math.min(a.disableTimeRanges[b][0],a.disableTimeRanges[b-1][0]),Math.max(a.disableTimeRanges[b][1],a.disableTimeRanges[b-1][1])],a.disableTimeRanges.splice(b,1))}return a}function c(b){var c=b.data("timepicker-settings"),f=b.data("timepicker-list");if(f&&f.length&&(f.remove(),b.data("timepicker-list",!1)),c.useSelect){f=a("<select />",{"class":"ui-timepicker-select"});var g=f}else{f=a("<ul />",{"class":"ui-timepicker-list"});var g=a("<div />",{"class":"ui-timepicker-wrapper",tabindex:-1});g.css({display:"none",position:"absolute"}).append(f)}if(c.noneOption)if(c.noneOption===!0&&(c.noneOption=c.useSelect?"Time...":"None"),a.isArray(c.noneOption)){for(var i in c.noneOption)if(parseInt(i,10)===i){var k=d(c.noneOption[i],c.useSelect);f.append(k)}}else{var k=d(c.noneOption,c.useSelect);f.append(k)}c.className&&g.addClass(c.className),null===c.minTime&&null===c.durationTime||!c.showDuration||(g.addClass("ui-timepicker-with-duration"),g.addClass("ui-timepicker-step-"+c.step));var l=c.minTime;"function"==typeof c.durationTime?l=s(c.durationTime()):null!==c.durationTime&&(l=c.durationTime);var n=null!==c.minTime?c.minTime:0,o=null!==c.maxTime?c.maxTime:n+v-1;n>=o&&(o+=v),o===v-1&&-1!==c.timeFormat.indexOf("H")&&(o=v);for(var t=c.disableTimeRanges,u=0,w=t.length,i=n;o>=i;i+=60*c.step){var x=i,z=r(x,c.timeFormat);if(c.useSelect){var A=a("<option />",{value:z});A.text(z)}else{var A=a("<li />");A.data("time",86400>=x?x:x%86400),A.text(z)}if((null!==c.minTime||null!==c.durationTime)&&c.showDuration){var B=q(i-l,c.step);if(c.useSelect)A.text(A.text()+" ("+B+")");else{var C=a("<span />",{"class":"ui-timepicker-duration"});C.text(" ("+B+")"),A.append(C)}}w>u&&(x>=t[u][1]&&(u+=1),t[u]&&x>=t[u][0]&&x<t[u][1]&&(c.useSelect?A.prop("disabled",!0):A.addClass("ui-timepicker-disabled"))),f.append(A)}if(g.data("timepicker-input",b),b.data("timepicker-list",g),c.useSelect)f.val(e(b.val(),c)),f.on("focus",function(){a(this).data("timepicker-input").trigger("showTimepicker")}),f.on("blur",function(){a(this).data("timepicker-input").trigger("hideTimepicker")}),f.on("change",function(){m(b,a(this).val(),"select")}),b.hide().after(f);else{var D=c.appendTo;"string"==typeof D?D=a(D):"function"==typeof D&&(D=D(b)),D.append(g),j(b,f),f.on("click","li",function(){b.off("focus.timepicker"),b.on("focus.timepicker-ie-hack",function(){b.off("focus.timepicker-ie-hack"),b.on("focus.timepicker",y.show)}),h(b)||b[0].focus(),f.find("li").removeClass("ui-timepicker-selected"),a(this).addClass("ui-timepicker-selected"),p(b)&&(b.trigger("hideTimepicker"),g.hide())})}}function d(b,c){var d,e,f;return"object"==typeof b?(d=b.label,e=b.className,f=b.value):"string"==typeof b?d=b:a.error("Invalid noneOption value"),c?a("<option />",{value:f,"class":e,text:d}):a("<li />",{"class":e,text:d}).data("time",f)}function e(b,c){if(a.isNumeric(b)||(b=s(b)),null===b)return null;var d=60*c.step;return r(Math.round(b/d)*d,c.timeFormat)}function f(){return new Date(1970,1,1,0,0,0)}function g(b){var c=a(b.target),d=c.closest(".ui-timepicker-input");0===d.length&&0===c.closest(".ui-timepicker-wrapper").length&&(y.hide(),a(document).unbind(".ui-timepicker"))}function h(a){var b=a.data("timepicker-settings");return(window.navigator.msMaxTouchPoints||"ontouchstart"in document)&&b.disableTouchKeyboard}function i(b,c,d){if(!d&&0!==d)return!1;var e=b.data("timepicker-settings"),f=!1,g=30*e.step;return c.find("li").each(function(b,c){var e=a(c);if("number"==typeof e.data("time")){var h=e.data("time")-d;return Math.abs(h)<g||h==g?(f=e,!1):void 0}}),f}function j(a,b){b.find("li").removeClass("ui-timepicker-selected");var c=s(l(a));if(null!==c){var d=i(a,b,c);if(d){var e=d.offset().top-b.offset().top;(e+d.outerHeight()>b.outerHeight()||0>e)&&b.scrollTop(b.scrollTop()+d.position().top-d.outerHeight()),d.addClass("ui-timepicker-selected")}}}function k(b){if(""!==this.value){{var c=a(this);c.data("timepicker-list")}if(!c.is(":focus")||b&&"change"==b.type){var d=s(this.value);if(null===d)return void c.trigger("timeFormatError");var e=c.data("timepicker-settings"),f=!1;if(null!==e.minTime&&d<e.minTime?f=!0:null!==e.maxTime&&d>e.maxTime&&(f=!0),a.each(e.disableTimeRanges,function(){return d>=this[0]&&d<this[1]?(f=!0,!1):void 0}),e.forceRoundTime){var g=d%(60*e.step);g>=30*e.step?d+=60*e.step-g:d-=g}var h=r(d,e.timeFormat);f?m(c,h,"error")&&c.trigger("timeRangeError"):m(c,h)}}}function l(a){return a.is("input")?a.val():a.data("ui-timepicker-value")}function m(a,b,c){if(a.is("input")){a.val(b);var d=a.data("timepicker-settings");d.useSelect&&a.data("timepicker-list").val(e(b,d))}return a.data("ui-timepicker-value")!=b?(a.data("ui-timepicker-value",b),"select"==c?a.trigger("selectTime").trigger("changeTime").trigger("change"):"error"!=c&&a.trigger("changeTime"),!0):(a.trigger("selectTime"),!1)}function n(b){var c=a(this),d=c.data("timepicker-list");if(!d||!d.is(":visible")){if(40!=b.keyCode)return!0;h(c)||c.focus()}switch(b.keyCode){case 13:return p(c)&&y.hide.apply(this),b.preventDefault(),!1;case 38:var e=d.find(".ui-timepicker-selected");return e.length?e.is(":first-child")||(e.removeClass("ui-timepicker-selected"),e.prev().addClass("ui-timepicker-selected"),e.prev().position().top<e.outerHeight()&&d.scrollTop(d.scrollTop()-e.outerHeight())):(d.find("li").each(function(b,c){return a(c).position().top>0?(e=a(c),!1):void 0}),e.addClass("ui-timepicker-selected")),!1;case 40:return e=d.find(".ui-timepicker-selected"),0===e.length?(d.find("li").each(function(b,c){return a(c).position().top>0?(e=a(c),!1):void 0}),e.addClass("ui-timepicker-selected")):e.is(":last-child")||(e.removeClass("ui-timepicker-selected"),e.next().addClass("ui-timepicker-selected"),e.next().position().top+2*e.outerHeight()>d.outerHeight()&&d.scrollTop(d.scrollTop()+e.outerHeight())),!1;case 27:d.find("li").removeClass("ui-timepicker-selected"),y.hide();break;case 9:y.hide();break;default:return!0}}function o(b){var c=a(this),d=c.data("timepicker-list");if(!d||!d.is(":visible"))return!0;if(!c.data("timepicker-settings").typeaheadHighlight)return d.find("li").removeClass("ui-timepicker-selected"),!0;switch(b.keyCode){case 96:case 97:case 98:case 99:case 100:case 101:case 102:case 103:case 104:case 105:case 48:case 49:case 50:case 51:case 52:case 53:case 54:case 55:case 56:case 57:case 65:case 77:case 80:case 186:case 8:case 46:j(c,d);break;default:return}}function p(a){var b=a.data("timepicker-settings"),c=a.data("timepicker-list"),d=null,e=c.find(".ui-timepicker-selected");if(e.hasClass("ui-timepicker-disabled"))return!1;if(e.length?d=e.data("time"):l(a)&&(d=s(l(a)),j(a,c)),null!==d)if("string"==typeof d)a.val(d);else{var f=r(d,b.timeFormat);m(a,f,"select")}return!0}function q(a,b){var c,d,e=Math.round(a/60),f=[];return 60>e?f=[e,x.mins]:(c=Math.floor(e/60),d=e%60,30==b&&30==d&&(c+=x.decimal+5),f.push(c),f.push(1==c?x.hr:x.hrs),30!=b&&d&&(f.push(d),f.push(x.mins))),f.join(" ")}function r(a,b){if(null!==a){var c=new Date(u.valueOf()+1e3*a);if(!isNaN(c.getTime())){for(var d,e,f="",g=0;g<b.length;g++)switch(e=b.charAt(g)){case"a":f+=c.getHours()>11?x.pm:x.am;break;case"A":f+=c.getHours()>11?x.PM:x.AM;break;case"g":d=c.getHours()%12,f+=0===d?"12":d;break;case"G":f+=c.getHours();break;case"h":d=c.getHours()%12,0!==d&&10>d&&(d="0"+d),f+=0===d?"12":d;break;case"H":d=c.getHours(),a===v&&(d=24),f+=d>9?d:"0"+d;break;case"i":var h=c.getMinutes();f+=h>9?h:"0"+h;break;case"s":a=c.getSeconds(),f+=a>9?a:"0"+a;break;default:f+=e}return f}}}function s(a){if(""===a)return null;if(!a||a+0==a)return a;"object"==typeof a&&(a=a.getHours()+":"+t(a.getMinutes())+":"+t(a.getSeconds())),a=a.toLowerCase();{var b;new Date(0)}if(-1===a.indexOf(":")?(b=a.match(/^([0-9]):?([0-5][0-9])?:?([0-5][0-9])?\s*([pa]?)m?$/),b||(b=a.match(/^([0-2][0-9]):?([0-5][0-9])?:?([0-5][0-9])?\s*([pa]?)m?$/))):b=a.match(/^(\d{1,2})(?::([0-5][0-9]))?(?::([0-5][0-9]))?\s*([pa]?)m?$/),!b)return null;var c,d=parseInt(1*b[1],10);c=b[4]?12==d?"p"==b[4]?12:0:d+("p"==b[4]?12:0):d;var e=1*b[2]||0,f=1*b[3]||0;return 3600*c+60*e+f}function t(a){return("0"+a).slice(-2)}var u=f(),v=86400,w={className:null,minTime:null,maxTime:null,durationTime:null,step:30,showDuration:!1,timeFormat:"g:ia",scrollDefaultNow:!1,scrollDefaultTime:!1,selectOnBlur:!1,disableTouchKeyboard:!1,forceRoundTime:!1,appendTo:"body",orientation:"ltr",disableTimeRanges:[],closeOnWindowScroll:!1,typeaheadHighlight:!0,noneOption:!1},x={am:"am",pm:"pm",AM:"AM",PM:"PM",decimal:".",mins:"mins",hr:"hr",hrs:"hrs"},y={init:function(d){return this.each(function(){var e=a(this),f=[];for(var g in w)e.data(g)&&(f[g]=e.data(g));var h=a.extend({},w,f,d);h.lang&&(x=a.extend(x,h.lang)),h=b(h),e.data("timepicker-settings",h),e.addClass("ui-timepicker-input"),h.useSelect?c(e):(e.prop("autocomplete","off"),e.on("click.timepicker focus.timepicker",y.show),e.on("change.timepicker",k),e.on("keydown.timepicker",n),e.on("keyup.timepicker",o),k.call(e.get(0)))})},show:function(b){b&&b.preventDefault();var d=a(this),e=d.data("timepicker-settings");if(e.useSelect)return void d.data("timepicker-list").focus();h(d)&&d.blur();var f=d.data("timepicker-list");if(!d.prop("readonly")&&(f&&0!==f.length&&"function"!=typeof e.durationTime||(c(d),f=d.data("timepicker-list")),!f.is(":visible"))){y.hide(),f.show();var j={};j.left="rtl"==e.orientation?d.offset().left+d.outerWidth()-f.outerWidth()+parseInt(f.css("marginLeft").replace("px",""),10):d.offset().left+parseInt(f.css("marginLeft").replace("px",""),10),j.top=d.offset().top+d.outerHeight(!0)+f.outerHeight()>a(window).height()+a(window).scrollTop()?d.offset().top-f.outerHeight()+parseInt(f.css("marginTop").replace("px",""),10):d.offset().top+d.outerHeight()+parseInt(f.css("marginTop").replace("px",""),10),f.offset(j);var k=f.find(".ui-timepicker-selected");if(k.length||(l(d)?k=i(d,f,s(l(d))):e.scrollDefaultNow?k=i(d,f,s(new Date)):e.scrollDefaultTime!==!1&&(k=i(d,f,s(e.scrollDefaultTime)))),k&&k.length){var m=f.scrollTop()+k.position().top-k.outerHeight();f.scrollTop(m)}else f.scrollTop(0);return a(document).on("touchstart.ui-timepicker mousedown.ui-timepicker",g),e.closeOnWindowScroll&&a(document).on("scroll.ui-timepicker",g),d.trigger("showTimepicker"),this}},hide:function(){var b=a(this),c=b.data("timepicker-settings");return c&&c.useSelect&&b.blur(),a(".ui-timepicker-wrapper:visible").each(function(){var b=a(this),c=b.data("timepicker-input"),d=c.data("timepicker-settings");d&&d.selectOnBlur&&p(c),b.hide(),c.trigger("hideTimepicker")}),this},option:function(d,e){var f=this,g=f.data("timepicker-settings"),h=f.data("timepicker-list");if("object"==typeof d)g=a.extend(g,d);else if("string"==typeof d&&"undefined"!=typeof e)g[d]=e;else if("string"==typeof d)return g[d];return g=b(g),f.data("timepicker-settings",g),h&&(h.remove(),f.data("timepicker-list",!1)),g.useSelect&&c(f),this},getSecondsFromMidnight:function(){return s(l(this))},getTime:function(a){var b=this,c=l(b);if(!c)return null;a||(a=new Date);var d=s(c),e=new Date(a);return e.setHours(d/3600),e.setMinutes(d%3600/60),e.setSeconds(d%60),e.setMilliseconds(0),e},setTime:function(a){var b=this,c=r(s(a),b.data("timepicker-settings").timeFormat);return m(b,c),b.data("timepicker-list")&&j(b,b.data("timepicker-list")),this},remove:function(){var a=this;if(a.hasClass("ui-timepicker-input"))return a.removeAttr("autocomplete","off"),a.removeClass("ui-timepicker-input"),a.removeData("timepicker-settings"),a.off(".timepicker"),a.data("timepicker-list")&&a.data("timepicker-list").remove(),a.removeData("timepicker-list"),this}};a.fn.timepicker=function(b){return this.length?y[b]?this.hasClass("ui-timepicker-input")?y[b].apply(this,Array.prototype.slice.call(arguments,1)):this:"object"!=typeof b&&b?void a.error("Method "+b+" does not exist on jQuery.timepicker"):y.init.apply(this,arguments):this}});

/* =========================================================
 * bootstrap-datepicker.js
 * Repo: https://github.com/eternicode/bootstrap-datepicker/
 * Demo: http://eternicode.github.io/bootstrap-datepicker/
 * Docs: http://bootstrap-datepicker.readthedocs.org/
 * Forked from http://www.eyecon.ro/bootstrap-datepicker
 * =========================================================
 * Started by Stefan Petre; improvements by Andrew Rowls + contributors
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================= */

(function($, undefined){

  var $window = $(window);

  function UTCDate(){
    return new Date(Date.UTC.apply(Date, arguments));
  }
  function UTCToday(){
    var today = new Date();
    return UTCDate(today.getFullYear(), today.getMonth(), today.getDate());
  }
  function alias(method){
    return function(){
      return this[method].apply(this, arguments);
    };
  }

  var DateArray = (function(){
    var extras = {
      get: function(i){
        return this.slice(i)[0];
      },
      contains: function(d){
        // Array.indexOf is not cross-browser;
        // $.inArray doesn't work with Dates
        var val = d && d.valueOf();
        for (var i=0, l=this.length; i < l; i++)
          if (this[i].valueOf() === val)
            return i;
        return -1;
      },
      remove: function(i){
        this.splice(i,1);
      },
      replace: function(new_array){
        if (!new_array)
          return;
        if (!$.isArray(new_array))
          new_array = [new_array];
        this.clear();
        this.push.apply(this, new_array);
      },
      clear: function(){
        this.length = 0;
      },
      copy: function(){
        var a = new DateArray();
        a.replace(this);
        return a;
      }
    };

    return function(){
      var a = [];
      a.push.apply(a, arguments);
      $.extend(a, extras);
      return a;
    };
  })();


  // Picker object

  var Datepicker = function(element, options){
    this.dates = new DateArray();
    this.viewDate = UTCToday();
    this.focusDate = null;

    this._process_options(options);

    this.element = $(element);
    this.isInline = false;
    this.isInput = this.element.is('input');
    this.component = this.element.is('.date') ? this.element.find('.add-on, .input-group-addon, .btn') : false;
    this.hasInput = this.component && this.element.find('input').length;
    if (this.component && this.component.length === 0)
      this.component = false;

    this.picker = $(DPGlobal.template);
    this._buildEvents();
    this._attachEvents();

    if (this.isInline){
      this.picker.addClass('datepicker-inline').appendTo(this.element);
    }
    else {
      this.picker.addClass('datepicker-dropdown dropdown-menu');
    }

    if (this.o.rtl){
      this.picker.addClass('datepicker-rtl');
    }

    this.viewMode = this.o.startView;

    if (this.o.calendarWeeks)
      this.picker.find('tfoot th.today')
            .attr('colspan', function(i, val){
              return parseInt(val) + 1;
            });

    this._allow_update = false;

    this.setStartDate(this._o.startDate);
    this.setEndDate(this._o.endDate);
    this.setDaysOfWeekDisabled(this.o.daysOfWeekDisabled);

    this.fillDow();
    this.fillMonths();

    this._allow_update = true;

    this.update();
    this.showMode();

    if (this.isInline){
      this.show();
    }
  };

  Datepicker.prototype = {
    constructor: Datepicker,

    _process_options: function(opts){
      // Store raw options for reference
      this._o = $.extend({}, this._o, opts);
      // Processed options
      var o = this.o = $.extend({}, this._o);

      // Check if "de-DE" style date is available, if not language should
      // fallback to 2 letter code eg "de"
      var lang = o.language;
      if (!dates[lang]){
        lang = lang.split('-')[0];
        if (!dates[lang])
          lang = defaults.language;
      }
      o.language = lang;

      switch (o.startView){
        case 2:
        case 'decade':
          o.startView = 2;
          break;
        case 1:
        case 'year':
          o.startView = 1;
          break;
        default:
          o.startView = 0;
      }

      switch (o.minViewMode){
        case 1:
        case 'months':
          o.minViewMode = 1;
          break;
        case 2:
        case 'years':
          o.minViewMode = 2;
          break;
        default:
          o.minViewMode = 0;
      }

      o.startView = Math.max(o.startView, o.minViewMode);

      // true, false, or Number > 0
      if (o.multidate !== true){
        o.multidate = Number(o.multidate) || false;
        if (o.multidate !== false)
          o.multidate = Math.max(0, o.multidate);
        else
          o.multidate = 1;
      }
      o.multidateSeparator = String(o.multidateSeparator);

      o.weekStart %= 7;
      o.weekEnd = ((o.weekStart + 6) % 7);

      var format = DPGlobal.parseFormat(o.format);
      if (o.startDate !== -Infinity){
        if (!!o.startDate){
          if (o.startDate instanceof Date)
            o.startDate = this._local_to_utc(this._zero_time(o.startDate));
          else
            o.startDate = DPGlobal.parseDate(o.startDate, format, o.language);
        }
        else {
          o.startDate = -Infinity;
        }
      }
      if (o.endDate !== Infinity){
        if (!!o.endDate){
          if (o.endDate instanceof Date)
            o.endDate = this._local_to_utc(this._zero_time(o.endDate));
          else
            o.endDate = DPGlobal.parseDate(o.endDate, format, o.language);
        }
        else {
          o.endDate = Infinity;
        }
      }

      o.daysOfWeekDisabled = o.daysOfWeekDisabled||[];
      if (!$.isArray(o.daysOfWeekDisabled))
        o.daysOfWeekDisabled = o.daysOfWeekDisabled.split(/[,\s]*/);
      o.daysOfWeekDisabled = $.map(o.daysOfWeekDisabled, function(d){
        return parseInt(d, 10);
      });

      var plc = String(o.orientation).toLowerCase().split(/\s+/g),
        _plc = o.orientation.toLowerCase();
      plc = $.grep(plc, function(word){
        return (/^auto|left|right|top|bottom$/).test(word);
      });
      o.orientation = {x: 'auto', y: 'auto'};
      if (!_plc || _plc === 'auto')
        ; // no action
      else if (plc.length === 1){
        switch (plc[0]){
          case 'top':
          case 'bottom':
            o.orientation.y = plc[0];
            break;
          case 'left':
          case 'right':
            o.orientation.x = plc[0];
            break;
        }
      }
      else {
        _plc = $.grep(plc, function(word){
          return (/^left|right$/).test(word);
        });
        o.orientation.x = _plc[0] || 'auto';

        _plc = $.grep(plc, function(word){
          return (/^top|bottom$/).test(word);
        });
        o.orientation.y = _plc[0] || 'auto';
      }
    },
    _events: [],
    _secondaryEvents: [],
    _applyEvents: function(evs){
      for (var i=0, el, ch, ev; i < evs.length; i++){
        el = evs[i][0];
        if (evs[i].length === 2){
          ch = undefined;
          ev = evs[i][1];
        }
        else if (evs[i].length === 3){
          ch = evs[i][1];
          ev = evs[i][2];
        }
        el.on(ev, ch);
      }
    },
    _unapplyEvents: function(evs){
      for (var i=0, el, ev, ch; i < evs.length; i++){
        el = evs[i][0];
        if (evs[i].length === 2){
          ch = undefined;
          ev = evs[i][1];
        }
        else if (evs[i].length === 3){
          ch = evs[i][1];
          ev = evs[i][2];
        }
        el.off(ev, ch);
      }
    },
    _buildEvents: function(){
      if (this.isInput){ // single input
        this._events = [
          [this.element, {
            focus: $.proxy(this.show, this),
            keyup: $.proxy(function(e){
              if ($.inArray(e.keyCode, [27,37,39,38,40,32,13,9]) === -1)
                this.update();
            }, this),
            keydown: $.proxy(this.keydown, this)
          }]
        ];
      }
      else if (this.component && this.hasInput){ // component: input + button
        this._events = [
          // For components that are not readonly, allow keyboard nav
          [this.element.find('input'), {
            focus: $.proxy(this.show, this),
            keyup: $.proxy(function(e){
              if ($.inArray(e.keyCode, [27,37,39,38,40,32,13,9]) === -1)
                this.update();
            }, this),
            keydown: $.proxy(this.keydown, this)
          }],
          [this.component, {
            click: $.proxy(this.show, this)
          }]
        ];
      }
      else if (this.element.is('div')){  // inline datepicker
        this.isInline = true;
      }
      else {
        this._events = [
          [this.element, {
            click: $.proxy(this.show, this)
          }]
        ];
      }
      this._events.push(
        // Component: listen for blur on element descendants
        [this.element, '*', {
          blur: $.proxy(function(e){
            this._focused_from = e.target;
          }, this)
        }],
        // Input: listen for blur on element
        [this.element, {
          blur: $.proxy(function(e){
            this._focused_from = e.target;
          }, this)
        }]
      );

      this._secondaryEvents = [
        [this.picker, {
          click: $.proxy(this.click, this)
        }],
        [$(window), {
          resize: $.proxy(this.place, this)
        }],
        [$(document), {
          'mousedown touchstart': $.proxy(function(e){
            // Clicked outside the datepicker, hide it
            if (!(
              this.element.is(e.target) ||
              this.element.find(e.target).length ||
              this.picker.is(e.target) ||
              this.picker.find(e.target).length
            )){
              this.hide();
            }
          }, this)
        }]
      ];
    },
    _attachEvents: function(){
      this._detachEvents();
      this._applyEvents(this._events);
    },
    _detachEvents: function(){
      this._unapplyEvents(this._events);
    },
    _attachSecondaryEvents: function(){
      this._detachSecondaryEvents();
      this._applyEvents(this._secondaryEvents);
    },
    _detachSecondaryEvents: function(){
      this._unapplyEvents(this._secondaryEvents);
    },
    _trigger: function(event, altdate){
      var date = altdate || this.dates.get(-1),
        local_date = this._utc_to_local(date);

      this.element.trigger({
        type: event,
        date: local_date,
        dates: $.map(this.dates, this._utc_to_local),
        format: $.proxy(function(ix, format){
          if (arguments.length === 0){
            ix = this.dates.length - 1;
            format = this.o.format;
          }
          else if (typeof ix === 'string'){
            format = ix;
            ix = this.dates.length - 1;
          }
          format = format || this.o.format;
          var date = this.dates.get(ix);
          return DPGlobal.formatDate(date, format, this.o.language);
        }, this)
      });
    },

    show: function(){
      if (!this.isInline)
        this.picker.appendTo('body');
      this.picker.show();
      this.place();
      this._attachSecondaryEvents();
      this._trigger('show');
    },

    hide: function(){
      if (this.isInline)
        return;
      if (!this.picker.is(':visible'))
        return;
      this.focusDate = null;
      this.picker.hide().detach();
      this._detachSecondaryEvents();
      this.viewMode = this.o.startView;
      this.showMode();

      if (
        this.o.forceParse &&
        (
          this.isInput && this.element.val() ||
          this.hasInput && this.element.find('input').val()
        )
      )
        this.setValue();
      this._trigger('hide');
    },

    remove: function(){
      this.hide();
      this._detachEvents();
      this._detachSecondaryEvents();
      this.picker.remove();
      delete this.element.data().datepicker;
      if (!this.isInput){
        delete this.element.data().date;
      }
    },

    _utc_to_local: function(utc){
      return utc && new Date(utc.getTime() + (utc.getTimezoneOffset()*60000));
    },
    _local_to_utc: function(local){
      return local && new Date(local.getTime() - (local.getTimezoneOffset()*60000));
    },
    _zero_time: function(local){
      return local && new Date(local.getFullYear(), local.getMonth(), local.getDate());
    },
    _zero_utc_time: function(utc){
      return utc && new Date(Date.UTC(utc.getUTCFullYear(), utc.getUTCMonth(), utc.getUTCDate()));
    },

    getDates: function(){
      return $.map(this.dates, this._utc_to_local);
    },

    getUTCDates: function(){
      return $.map(this.dates, function(d){
        return new Date(d);
      });
    },

    getDate: function(){
      return this._utc_to_local(this.getUTCDate());
    },

    getUTCDate: function(){
      return new Date(this.dates.get(-1));
    },

    setDates: function(){
      var args = $.isArray(arguments[0]) ? arguments[0] : arguments;
      this.update.apply(this, args);
      this._trigger('changeDate');
      this.setValue();
    },

    setUTCDates: function(){
      var args = $.isArray(arguments[0]) ? arguments[0] : arguments;
      this.update.apply(this, $.map(args, this._utc_to_local));
      this._trigger('changeDate');
      this.setValue();
    },

    setDate: alias('setDates'),
    setUTCDate: alias('setUTCDates'),

    setValue: function(){
      var formatted = this.getFormattedDate();
      if (!this.isInput){
        if (this.component){
          this.element.find('input').val(formatted).change();
        }
      }
      else {
        this.element.val(formatted).change();
      }
    },

    getFormattedDate: function(format){
      if (format === undefined)
        format = this.o.format;

      var lang = this.o.language;
      return $.map(this.dates, function(d){
        return DPGlobal.formatDate(d, format, lang);
      }).join(this.o.multidateSeparator);
    },

    setStartDate: function(startDate){
      this._process_options({startDate: startDate});
      this.update();
      this.updateNavArrows();
    },

    setEndDate: function(endDate){
      this._process_options({endDate: endDate});
      this.update();
      this.updateNavArrows();
    },

    setDaysOfWeekDisabled: function(daysOfWeekDisabled){
      this._process_options({daysOfWeekDisabled: daysOfWeekDisabled});
      this.update();
      this.updateNavArrows();
    },

    place: function(){
      if (this.isInline)
        return;
      var calendarWidth = this.picker.outerWidth(),
        calendarHeight = this.picker.outerHeight(),
        visualPadding = 10,
        windowWidth = $window.width(),
        windowHeight = $window.height(),
        scrollTop = $window.scrollTop();

      var zIndex = parseInt(this.element.parents().filter(function(){
          return $(this).css('z-index') !== 'auto';
        }).first().css('z-index'))+10;
      var offset = this.component ? this.component.parent().offset() : this.element.offset();
      var height = this.component ? this.component.outerHeight(true) : this.element.outerHeight(false);
      var width = this.component ? this.component.outerWidth(true) : this.element.outerWidth(false);
      var left = offset.left,
        top = offset.top;

      this.picker.removeClass(
        'datepicker-orient-top datepicker-orient-bottom '+
        'datepicker-orient-right datepicker-orient-left'
      );

      if (this.o.orientation.x !== 'auto'){
        this.picker.addClass('datepicker-orient-' + this.o.orientation.x);
        if (this.o.orientation.x === 'right')
          left -= calendarWidth - width;
      }
      // auto x orientation is best-placement: if it crosses a window
      // edge, fudge it sideways
      else {
        // Default to left
        this.picker.addClass('datepicker-orient-left');
        if (offset.left < 0)
          left -= offset.left - visualPadding;
        else if (offset.left + calendarWidth > windowWidth)
          left = windowWidth - calendarWidth - visualPadding;
      }

      // auto y orientation is best-situation: top or bottom, no fudging,
      // decision based on which shows more of the calendar
      var yorient = this.o.orientation.y,
        top_overflow, bottom_overflow;
      if (yorient === 'auto'){
        top_overflow = -scrollTop + offset.top - calendarHeight;
        bottom_overflow = scrollTop + windowHeight - (offset.top + height + calendarHeight);
        if (Math.max(top_overflow, bottom_overflow) === bottom_overflow)
          yorient = 'top';
        else
          yorient = 'bottom';
      }
      this.picker.addClass('datepicker-orient-' + yorient);
      if (yorient === 'top')
        top += height;
      else
        top -= calendarHeight + parseInt(this.picker.css('padding-top'));

      this.picker.css({
        top: top,
        left: left,
        zIndex: zIndex
      });
    },

    _allow_update: true,
    update: function(){
      if (!this._allow_update)
        return;

      var oldDates = this.dates.copy(),
        dates = [],
        fromArgs = false;
      if (arguments.length){
        $.each(arguments, $.proxy(function(i, date){
          if (date instanceof Date)
            date = this._local_to_utc(date);
          dates.push(date);
        }, this));
        fromArgs = true;
      }
      else {
        dates = this.isInput
            ? this.element.val()
            : this.element.data('date') || this.element.find('input').val();
        if (dates && this.o.multidate)
          dates = dates.split(this.o.multidateSeparator);
        else
          dates = [dates];
        delete this.element.data().date;
      }

      dates = $.map(dates, $.proxy(function(date){
        return DPGlobal.parseDate(date, this.o.format, this.o.language);
      }, this));
      dates = $.grep(dates, $.proxy(function(date){
        return (
          date < this.o.startDate ||
          date > this.o.endDate ||
          !date
        );
      }, this), true);
      this.dates.replace(dates);

      if (this.dates.length)
        this.viewDate = new Date(this.dates.get(-1));
      else if (this.viewDate < this.o.startDate)
        this.viewDate = new Date(this.o.startDate);
      else if (this.viewDate > this.o.endDate)
        this.viewDate = new Date(this.o.endDate);

      if (fromArgs){
        // setting date by clicking
        this.setValue();
      }
      else if (dates.length){
        // setting date by typing
        if (String(oldDates) !== String(this.dates))
          this._trigger('changeDate');
      }
      if (!this.dates.length && oldDates.length)
        this._trigger('clearDate');

      this.fill();
    },

    fillDow: function(){
      var dowCnt = this.o.weekStart,
        html = '<tr>';
      if (this.o.calendarWeeks){
        var cell = '<th class="cw">&nbsp;</th>';
        html += cell;
        this.picker.find('.datepicker-days thead tr:first-child').prepend(cell);
      }
      while (dowCnt < this.o.weekStart + 7){
        html += '<th class="dow">'+dates[this.o.language].daysMin[(dowCnt++)%7]+'</th>';
      }
      html += '</tr>';
      this.picker.find('.datepicker-days thead').append(html);
    },

    fillMonths: function(){
      var html = '',
      i = 0;
      while (i < 12){
        html += '<span class="month">'+dates[this.o.language].monthsShort[i++]+'</span>';
      }
      this.picker.find('.datepicker-months td').html(html);
    },

    setRange: function(range){
      if (!range || !range.length)
        delete this.range;
      else
        this.range = $.map(range, function(d){
          return d.valueOf();
        });
      this.fill();
    },

    getClassNames: function(date){
      var cls = [],
        year = this.viewDate.getUTCFullYear(),
        month = this.viewDate.getUTCMonth(),
        today = new Date();
      if (date.getUTCFullYear() < year || (date.getUTCFullYear() === year && date.getUTCMonth() < month)){
        cls.push('old');
      }
      else if (date.getUTCFullYear() > year || (date.getUTCFullYear() === year && date.getUTCMonth() > month)){
        cls.push('new');
      }
      if (this.focusDate && date.valueOf() === this.focusDate.valueOf())
        cls.push('focused');
      // Compare internal UTC date with local today, not UTC today
      if (this.o.todayHighlight &&
        date.getUTCFullYear() === today.getFullYear() &&
        date.getUTCMonth() === today.getMonth() &&
        date.getUTCDate() === today.getDate()){
        cls.push('today');
      }
      if (this.dates.contains(date) !== -1)
        cls.push('active');
      if (date.valueOf() < this.o.startDate || date.valueOf() > this.o.endDate ||
        $.inArray(date.getUTCDay(), this.o.daysOfWeekDisabled) !== -1){
        cls.push('disabled');
      }
      if (this.range){
        if (date > this.range[0] && date < this.range[this.range.length-1]){
          cls.push('range');
        }
        if ($.inArray(date.valueOf(), this.range) !== -1){
          cls.push('selected');
        }
      }
      return cls;
    },

    fill: function(){
      var d = new Date(this.viewDate),
        year = d.getUTCFullYear(),
        month = d.getUTCMonth(),
        startYear = this.o.startDate !== -Infinity ? this.o.startDate.getUTCFullYear() : -Infinity,
        startMonth = this.o.startDate !== -Infinity ? this.o.startDate.getUTCMonth() : -Infinity,
        endYear = this.o.endDate !== Infinity ? this.o.endDate.getUTCFullYear() : Infinity,
        endMonth = this.o.endDate !== Infinity ? this.o.endDate.getUTCMonth() : Infinity,
        todaytxt = dates[this.o.language].today || dates['en'].today || '',
        cleartxt = dates[this.o.language].clear || dates['en'].clear || '',
        tooltip;
      this.picker.find('.datepicker-days thead th.datepicker-switch')
            .text(dates[this.o.language].months[month]+' '+year);
      this.picker.find('tfoot th.today')
            .text(todaytxt)
            .toggle(this.o.todayBtn !== false);
      this.picker.find('tfoot th.clear')
            .text(cleartxt)
            .toggle(this.o.clearBtn !== false);
      this.updateNavArrows();
      this.fillMonths();
      var prevMonth = UTCDate(year, month-1, 28),
        day = DPGlobal.getDaysInMonth(prevMonth.getUTCFullYear(), prevMonth.getUTCMonth());
      prevMonth.setUTCDate(day);
      prevMonth.setUTCDate(day - (prevMonth.getUTCDay() - this.o.weekStart + 7)%7);
      var nextMonth = new Date(prevMonth);
      nextMonth.setUTCDate(nextMonth.getUTCDate() + 42);
      nextMonth = nextMonth.valueOf();
      var html = [];
      var clsName;
      while (prevMonth.valueOf() < nextMonth){
        if (prevMonth.getUTCDay() === this.o.weekStart){
          html.push('<tr>');
          if (this.o.calendarWeeks){
            // ISO 8601: First week contains first thursday.
            // ISO also states week starts on Monday, but we can be more abstract here.
            var
              // Start of current week: based on weekstart/current date
              ws = new Date(+prevMonth + (this.o.weekStart - prevMonth.getUTCDay() - 7) % 7 * 864e5),
              // Thursday of this week
              th = new Date(Number(ws) + (7 + 4 - ws.getUTCDay()) % 7 * 864e5),
              // First Thursday of year, year from thursday
              yth = new Date(Number(yth = UTCDate(th.getUTCFullYear(), 0, 1)) + (7 + 4 - yth.getUTCDay())%7*864e5),
              // Calendar week: ms between thursdays, div ms per day, div 7 days
              calWeek =  (th - yth) / 864e5 / 7 + 1;
            html.push('<td class="cw">'+ calWeek +'</td>');

          }
        }
        clsName = this.getClassNames(prevMonth);
        clsName.push('day');

        if (this.o.beforeShowDay !== $.noop){
          var before = this.o.beforeShowDay(this._utc_to_local(prevMonth));
          if (before === undefined)
            before = {};
          else if (typeof(before) === 'boolean')
            before = {enabled: before};
          else if (typeof(before) === 'string')
            before = {classes: before};
          if (before.enabled === false)
            clsName.push('disabled');
          if (before.classes)
            clsName = clsName.concat(before.classes.split(/\s+/));
          if (before.tooltip)
            tooltip = before.tooltip;
        }

        clsName = $.unique(clsName);
        html.push('<td class="'+clsName.join(' ')+'"' + (tooltip ? ' title="'+tooltip+'"' : '') + '>'+prevMonth.getUTCDate() + '</td>');
        if (prevMonth.getUTCDay() === this.o.weekEnd){
          html.push('</tr>');
        }
        prevMonth.setUTCDate(prevMonth.getUTCDate()+1);
      }
      this.picker.find('.datepicker-days tbody').empty().append(html.join(''));

      var months = this.picker.find('.datepicker-months')
            .find('th:eq(1)')
              .text(year)
              .end()
            .find('span').removeClass('active');

      $.each(this.dates, function(i, d){
        if (d.getUTCFullYear() === year)
          months.eq(d.getUTCMonth()).addClass('active');
      });

      if (year < startYear || year > endYear){
        months.addClass('disabled');
      }
      if (year === startYear){
        months.slice(0, startMonth).addClass('disabled');
      }
      if (year === endYear){
        months.slice(endMonth+1).addClass('disabled');
      }

      html = '';
      year = parseInt(year/10, 10) * 10;
      var yearCont = this.picker.find('.datepicker-years')
                .find('th:eq(1)')
                  .text(year + '-' + (year + 9))
                  .end()
                .find('td');
      year -= 1;
      var years = $.map(this.dates, function(d){
          return d.getUTCFullYear();
        }),
        classes;
      for (var i = -1; i < 11; i++){
        classes = ['year'];
        if (i === -1)
          classes.push('old');
        else if (i === 10)
          classes.push('new');
        if ($.inArray(year, years) !== -1)
          classes.push('active');
        if (year < startYear || year > endYear)
          classes.push('disabled');
        html += '<span class="' + classes.join(' ') + '">'+year+'</span>';
        year += 1;
      }
      yearCont.html(html);
    },

    updateNavArrows: function(){
      if (!this._allow_update)
        return;

      var d = new Date(this.viewDate),
        year = d.getUTCFullYear(),
        month = d.getUTCMonth();
      switch (this.viewMode){
        case 0:
          if (this.o.startDate !== -Infinity && year <= this.o.startDate.getUTCFullYear() && month <= this.o.startDate.getUTCMonth()){
            this.picker.find('.prev').css({visibility: 'hidden'});
          }
          else {
            this.picker.find('.prev').css({visibility: 'visible'});
          }
          if (this.o.endDate !== Infinity && year >= this.o.endDate.getUTCFullYear() && month >= this.o.endDate.getUTCMonth()){
            this.picker.find('.next').css({visibility: 'hidden'});
          }
          else {
            this.picker.find('.next').css({visibility: 'visible'});
          }
          break;
        case 1:
        case 2:
          if (this.o.startDate !== -Infinity && year <= this.o.startDate.getUTCFullYear()){
            this.picker.find('.prev').css({visibility: 'hidden'});
          }
          else {
            this.picker.find('.prev').css({visibility: 'visible'});
          }
          if (this.o.endDate !== Infinity && year >= this.o.endDate.getUTCFullYear()){
            this.picker.find('.next').css({visibility: 'hidden'});
          }
          else {
            this.picker.find('.next').css({visibility: 'visible'});
          }
          break;
      }
    },

    click: function(e){
      e.preventDefault();
      var target = $(e.target).closest('span, td, th'),
        year, month, day;
      if (target.length === 1){
        switch (target[0].nodeName.toLowerCase()){
          case 'th':
            switch (target[0].className){
              case 'datepicker-switch':
                this.showMode(1);
                break;
              case 'prev':
              case 'next':
                var dir = DPGlobal.modes[this.viewMode].navStep * (target[0].className === 'prev' ? -1 : 1);
                switch (this.viewMode){
                  case 0:
                    this.viewDate = this.moveMonth(this.viewDate, dir);
                    this._trigger('changeMonth', this.viewDate);
                    break;
                  case 1:
                  case 2:
                    this.viewDate = this.moveYear(this.viewDate, dir);
                    if (this.viewMode === 1)
                      this._trigger('changeYear', this.viewDate);
                    break;
                }
                this.fill();
                break;
              case 'today':
                var date = new Date();
                date = UTCDate(date.getFullYear(), date.getMonth(), date.getDate(), 0, 0, 0);

                this.showMode(-2);
                var which = this.o.todayBtn === 'linked' ? null : 'view';
                this._setDate(date, which);
                break;
              case 'clear':
                var element;
                if (this.isInput)
                  element = this.element;
                else if (this.component)
                  element = this.element.find('input');
                if (element)
                  element.val("").change();
                this.update();
                this._trigger('changeDate');
                if (this.o.autoclose)
                  this.hide();
                break;
            }
            break;
          case 'span':
            if (!target.is('.disabled')){
              this.viewDate.setUTCDate(1);
              if (target.is('.month')){
                day = 1;
                month = target.parent().find('span').index(target);
                year = this.viewDate.getUTCFullYear();
                this.viewDate.setUTCMonth(month);
                this._trigger('changeMonth', this.viewDate);
                if (this.o.minViewMode === 1){
                  this._setDate(UTCDate(year, month, day));
                }
              }
              else {
                day = 1;
                month = 0;
                year = parseInt(target.text(), 10)||0;
                this.viewDate.setUTCFullYear(year);
                this._trigger('changeYear', this.viewDate);
                if (this.o.minViewMode === 2){
                  this._setDate(UTCDate(year, month, day));
                }
              }
              this.showMode(-1);
              this.fill();
            }
            break;
          case 'td':
            if (target.is('.day') && !target.is('.disabled')){
              day = parseInt(target.text(), 10)||1;
              year = this.viewDate.getUTCFullYear();
              month = this.viewDate.getUTCMonth();
              if (target.is('.old')){
                if (month === 0){
                  month = 11;
                  year -= 1;
                }
                else {
                  month -= 1;
                }
              }
              else if (target.is('.new')){
                if (month === 11){
                  month = 0;
                  year += 1;
                }
                else {
                  month += 1;
                }
              }
              this._setDate(UTCDate(year, month, day));
            }
            break;
        }
      }
      if (this.picker.is(':visible') && this._focused_from){
        $(this._focused_from).focus();
      }
      delete this._focused_from;
    },

    _toggle_multidate: function(date){
      var ix = this.dates.contains(date);
      if (!date){
        this.dates.clear();
      }
      else if (ix !== -1){
        this.dates.remove(ix);
      }
      else {
        this.dates.push(date);
      }
      if (typeof this.o.multidate === 'number')
        while (this.dates.length > this.o.multidate)
          this.dates.remove(0);
    },

    _setDate: function(date, which){
      if (!which || which === 'date')
        this._toggle_multidate(date && new Date(date));
      if (!which || which  === 'view')
        this.viewDate = date && new Date(date);

      this.fill();
      this.setValue();
      this._trigger('changeDate');
      var element;
      if (this.isInput){
        element = this.element;
      }
      else if (this.component){
        element = this.element.find('input');
      }
      if (element){
        element.change();
      }
      if (this.o.autoclose && (!which || which === 'date')){
        this.hide();
      }
    },

    moveMonth: function(date, dir){
      if (!date)
        return undefined;
      if (!dir)
        return date;
      var new_date = new Date(date.valueOf()),
        day = new_date.getUTCDate(),
        month = new_date.getUTCMonth(),
        mag = Math.abs(dir),
        new_month, test;
      dir = dir > 0 ? 1 : -1;
      if (mag === 1){
        test = dir === -1
          // If going back one month, make sure month is not current month
          // (eg, Mar 31 -> Feb 31 == Feb 28, not Mar 02)
          ? function(){
            return new_date.getUTCMonth() === month;
          }
          // If going forward one month, make sure month is as expected
          // (eg, Jan 31 -> Feb 31 == Feb 28, not Mar 02)
          : function(){
            return new_date.getUTCMonth() !== new_month;
          };
        new_month = month + dir;
        new_date.setUTCMonth(new_month);
        // Dec -> Jan (12) or Jan -> Dec (-1) -- limit expected date to 0-11
        if (new_month < 0 || new_month > 11)
          new_month = (new_month + 12) % 12;
      }
      else {
        // For magnitudes >1, move one month at a time...
        for (var i=0; i < mag; i++)
          // ...which might decrease the day (eg, Jan 31 to Feb 28, etc)...
          new_date = this.moveMonth(new_date, dir);
        // ...then reset the day, keeping it in the new month
        new_month = new_date.getUTCMonth();
        new_date.setUTCDate(day);
        test = function(){
          return new_month !== new_date.getUTCMonth();
        };
      }
      // Common date-resetting loop -- if date is beyond end of month, make it
      // end of month
      while (test()){
        new_date.setUTCDate(--day);
        new_date.setUTCMonth(new_month);
      }
      return new_date;
    },

    moveYear: function(date, dir){
      return this.moveMonth(date, dir*12);
    },

    dateWithinRange: function(date){
      return date >= this.o.startDate && date <= this.o.endDate;
    },

    keydown: function(e){
      if (this.picker.is(':not(:visible)')){
        if (e.keyCode === 27) // allow escape to hide and re-show picker
          this.show();
        return;
      }
      var dateChanged = false,
        dir, newDate, newViewDate,
        focusDate = this.focusDate || this.viewDate;
      switch (e.keyCode){
        case 27: // escape
          if (this.focusDate){
            this.focusDate = null;
            this.viewDate = this.dates.get(-1) || this.viewDate;
            this.fill();
          }
          else
            this.hide();
          e.preventDefault();
          break;
        case 37: // left
        case 39: // right
          if (!this.o.keyboardNavigation)
            break;
          dir = e.keyCode === 37 ? -1 : 1;
          if (e.ctrlKey){
            newDate = this.moveYear(this.dates.get(-1) || UTCToday(), dir);
            newViewDate = this.moveYear(focusDate, dir);
            this._trigger('changeYear', this.viewDate);
          }
          else if (e.shiftKey){
            newDate = this.moveMonth(this.dates.get(-1) || UTCToday(), dir);
            newViewDate = this.moveMonth(focusDate, dir);
            this._trigger('changeMonth', this.viewDate);
          }
          else {
            newDate = new Date(this.dates.get(-1) || UTCToday());
            newDate.setUTCDate(newDate.getUTCDate() + dir);
            newViewDate = new Date(focusDate);
            newViewDate.setUTCDate(focusDate.getUTCDate() + dir);
          }
          if (this.dateWithinRange(newDate)){
            this.focusDate = this.viewDate = newViewDate;
            this.setValue();
            this.fill();
            e.preventDefault();
          }
          break;
        case 38: // up
        case 40: // down
          if (!this.o.keyboardNavigation)
            break;
          dir = e.keyCode === 38 ? -1 : 1;
          if (e.ctrlKey){
            newDate = this.moveYear(this.dates.get(-1) || UTCToday(), dir);
            newViewDate = this.moveYear(focusDate, dir);
            this._trigger('changeYear', this.viewDate);
          }
          else if (e.shiftKey){
            newDate = this.moveMonth(this.dates.get(-1) || UTCToday(), dir);
            newViewDate = this.moveMonth(focusDate, dir);
            this._trigger('changeMonth', this.viewDate);
          }
          else {
            newDate = new Date(this.dates.get(-1) || UTCToday());
            newDate.setUTCDate(newDate.getUTCDate() + dir * 7);
            newViewDate = new Date(focusDate);
            newViewDate.setUTCDate(focusDate.getUTCDate() + dir * 7);
          }
          if (this.dateWithinRange(newDate)){
            this.focusDate = this.viewDate = newViewDate;
            this.setValue();
            this.fill();
            e.preventDefault();
          }
          break;
        case 32: // spacebar
          // Spacebar is used in manually typing dates in some formats.
          // As such, its behavior should not be hijacked.
          break;
        case 13: // enter
          focusDate = this.focusDate || this.dates.get(-1) || this.viewDate;
          this._toggle_multidate(focusDate);
          dateChanged = true;
          this.focusDate = null;
          this.viewDate = this.dates.get(-1) || this.viewDate;
          this.setValue();
          this.fill();
          if (this.picker.is(':visible')){
            e.preventDefault();
            if (this.o.autoclose)
              this.hide();
          }
          break;
        case 9: // tab
          this.focusDate = null;
          this.viewDate = this.dates.get(-1) || this.viewDate;
          this.fill();
          this.hide();
          break;
      }
      if (dateChanged){
        if (this.dates.length)
          this._trigger('changeDate');
        else
          this._trigger('clearDate');
        var element;
        if (this.isInput){
          element = this.element;
        }
        else if (this.component){
          element = this.element.find('input');
        }
        if (element){
          element.change();
        }
      }
    },

    showMode: function(dir){
      if (dir){
        this.viewMode = Math.max(this.o.minViewMode, Math.min(2, this.viewMode + dir));
      }
      this.picker
        .find('>div')
        .hide()
        .filter('.datepicker-'+DPGlobal.modes[this.viewMode].clsName)
          .css('display', 'block');
      this.updateNavArrows();
    }
  };

  var DateRangePicker = function(element, options){
    this.element = $(element);
    this.inputs = $.map(options.inputs, function(i){
      return i.jquery ? i[0] : i;
    });
    delete options.inputs;

    $(this.inputs)
      .datepicker(options)
      .bind('changeDate', $.proxy(this.dateUpdated, this));

    this.pickers = $.map(this.inputs, function(i){
      return $(i).data('datepicker');
    });
    this.updateDates();
  };
  DateRangePicker.prototype = {
    updateDates: function(){
      this.dates = $.map(this.pickers, function(i){
        return i.getUTCDate();
      });
      this.updateRanges();
    },
    updateRanges: function(){
      var range = $.map(this.dates, function(d){
        return d.valueOf();
      });
      $.each(this.pickers, function(i, p){
        p.setRange(range);
      });
    },
    dateUpdated: function(e){
      // `this.updating` is a workaround for preventing infinite recursion
      // between `changeDate` triggering and `setUTCDate` calling.  Until
      // there is a better mechanism.
      if (this.updating)
        return;
      this.updating = true;

      var dp = $(e.target).data('datepicker'),
        new_date = dp.getUTCDate(),
        i = $.inArray(e.target, this.inputs),
        l = this.inputs.length;
      if (i === -1)
        return;

      $.each(this.pickers, function(i, p){
        if (!p.getUTCDate())
          p.setUTCDate(new_date);
      });

      if (new_date < this.dates[i]){
        // Date being moved earlier/left
        while (i >= 0 && new_date < this.dates[i]){
          this.pickers[i--].setUTCDate(new_date);
        }
      }
      else if (new_date > this.dates[i]){
        // Date being moved later/right
        while (i < l && new_date > this.dates[i]){
          this.pickers[i++].setUTCDate(new_date);
        }
      }
      this.updateDates();

      delete this.updating;
    },
    remove: function(){
      $.map(this.pickers, function(p){ p.remove(); });
      delete this.element.data().datepicker;
    }
  };

  function opts_from_el(el, prefix){
    // Derive options from element data-attrs
    var data = $(el).data(),
      out = {}, inkey,
      replace = new RegExp('^' + prefix.toLowerCase() + '([A-Z])');
    prefix = new RegExp('^' + prefix.toLowerCase());
    function re_lower(_,a){
      return a.toLowerCase();
    }
    for (var key in data)
      if (prefix.test(key)){
        inkey = key.replace(replace, re_lower);
        out[inkey] = data[key];
      }
    return out;
  }

  function opts_from_locale(lang){
    // Derive options from locale plugins
    var out = {};
    // Check if "de-DE" style date is available, if not language should
    // fallback to 2 letter code eg "de"
    if (!dates[lang]){
      lang = lang.split('-')[0];
      if (!dates[lang])
        return;
    }
    var d = dates[lang];
    $.each(locale_opts, function(i,k){
      if (k in d)
        out[k] = d[k];
    });
    return out;
  }

  var old = $.fn.datepicker;
  $.fn.datepicker = function(option){
    var args = Array.apply(null, arguments);
    args.shift();
    var internal_return;
    this.each(function(){
      var $this = $(this),
        data = $this.data('datepicker'),
        options = typeof option === 'object' && option;
      if (!data){
        var elopts = opts_from_el(this, 'date'),
          // Preliminary otions
          xopts = $.extend({}, defaults, elopts, options),
          locopts = opts_from_locale(xopts.language),
          // Options priority: js args, data-attrs, locales, defaults
          opts = $.extend({}, defaults, locopts, elopts, options);
        if ($this.is('.input-daterange') || opts.inputs){
          var ropts = {
            inputs: opts.inputs || $this.find('input').toArray()
          };
          $this.data('datepicker', (data = new DateRangePicker(this, $.extend(opts, ropts))));
        }
        else {
          $this.data('datepicker', (data = new Datepicker(this, opts)));
        }
      }
      if (typeof option === 'string' && typeof data[option] === 'function'){
        internal_return = data[option].apply(data, args);
        if (internal_return !== undefined)
          return false;
      }
    });
    if (internal_return !== undefined)
      return internal_return;
    else
      return this;
  };

  var defaults = $.fn.datepicker.defaults = {
    autoclose: false,
    beforeShowDay: $.noop,
    calendarWeeks: false,
    clearBtn: false,
    daysOfWeekDisabled: [],
    endDate: Infinity,
    forceParse: true,
    format: 'mm/dd/yyyy',
    keyboardNavigation: true,
    language: 'en',
    minViewMode: 0,
    multidate: false,
    multidateSeparator: ',',
    orientation: "auto",
    rtl: false,
    startDate: -Infinity,
    startView: 0,
    todayBtn: false,
    todayHighlight: false,
    weekStart: 0
  };
  var locale_opts = $.fn.datepicker.locale_opts = [
    'format',
    'rtl',
    'weekStart'
  ];
  $.fn.datepicker.Constructor = Datepicker;
  var dates = $.fn.datepicker.dates = {
    en: {
      days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
      daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
      daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
      months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
      monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      today: "Today",
      clear: "Clear"
    }
  };

  var DPGlobal = {
    modes: [
      {
        clsName: 'days',
        navFnc: 'Month',
        navStep: 1
      },
      {
        clsName: 'months',
        navFnc: 'FullYear',
        navStep: 1
      },
      {
        clsName: 'years',
        navFnc: 'FullYear',
        navStep: 10
    }],
    isLeapYear: function(year){
      return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0));
    },
    getDaysInMonth: function(year, month){
      return [31, (DPGlobal.isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
    },
    validParts: /dd?|DD?|mm?|MM?|yy(?:yy)?/g,
    nonpunctuation: /[^ -\/:-@\[\u3400-\u9fff-`{-~\t\n\r]+/g,
    parseFormat: function(format){
      // IE treats \0 as a string end in inputs (truncating the value),
      // so it's a bad format delimiter, anyway
      var separators = format.replace(this.validParts, '\0').split('\0'),
        parts = format.match(this.validParts);
      if (!separators || !separators.length || !parts || parts.length === 0){
        throw new Error("Invalid date format.");
      }
      return {separators: separators, parts: parts};
    },
    parseDate: function(date, format, language){
      if (!date)
        return undefined;
      if (date instanceof Date)
        return date;
      if (typeof format === 'string')
        format = DPGlobal.parseFormat(format);
      var part_re = /([\-+]\d+)([dmwy])/,
        parts = date.match(/([\-+]\d+)([dmwy])/g),
        part, dir, i;
      if (/^[\-+]\d+[dmwy]([\s,]+[\-+]\d+[dmwy])*$/.test(date)){
        date = new Date();
        for (i=0; i < parts.length; i++){
          part = part_re.exec(parts[i]);
          dir = parseInt(part[1]);
          switch (part[2]){
            case 'd':
              date.setUTCDate(date.getUTCDate() + dir);
              break;
            case 'm':
              date = Datepicker.prototype.moveMonth.call(Datepicker.prototype, date, dir);
              break;
            case 'w':
              date.setUTCDate(date.getUTCDate() + dir * 7);
              break;
            case 'y':
              date = Datepicker.prototype.moveYear.call(Datepicker.prototype, date, dir);
              break;
          }
        }
        return UTCDate(date.getUTCFullYear(), date.getUTCMonth(), date.getUTCDate(), 0, 0, 0);
      }
      parts = date && date.match(this.nonpunctuation) || [];
      date = new Date();
      var parsed = {},
        setters_order = ['yyyy', 'yy', 'M', 'MM', 'm', 'mm', 'd', 'dd'],
        setters_map = {
          yyyy: function(d,v){
            return d.setUTCFullYear(v);
          },
          yy: function(d,v){
            return d.setUTCFullYear(2000+v);
          },
          m: function(d,v){
            if (isNaN(d))
              return d;
            v -= 1;
            while (v < 0) v += 12;
            v %= 12;
            d.setUTCMonth(v);
            while (d.getUTCMonth() !== v)
              d.setUTCDate(d.getUTCDate()-1);
            return d;
          },
          d: function(d,v){
            return d.setUTCDate(v);
          }
        },
        val, filtered;
      setters_map['M'] = setters_map['MM'] = setters_map['mm'] = setters_map['m'];
      setters_map['dd'] = setters_map['d'];
      date = UTCDate(date.getFullYear(), date.getMonth(), date.getDate(), 0, 0, 0);
      var fparts = format.parts.slice();
      // Remove noop parts
      if (parts.length !== fparts.length){
        fparts = $(fparts).filter(function(i,p){
          return $.inArray(p, setters_order) !== -1;
        }).toArray();
      }
      // Process remainder
      function match_part(){
        var m = this.slice(0, parts[i].length),
          p = parts[i].slice(0, m.length);
        return m === p;
      }
      if (parts.length === fparts.length){
        var cnt;
        for (i=0, cnt = fparts.length; i < cnt; i++){
          val = parseInt(parts[i], 10);
          part = fparts[i];
          if (isNaN(val)){
            switch (part){
              case 'MM':
                filtered = $(dates[language].months).filter(match_part);
                val = $.inArray(filtered[0], dates[language].months) + 1;
                break;
              case 'M':
                filtered = $(dates[language].monthsShort).filter(match_part);
                val = $.inArray(filtered[0], dates[language].monthsShort) + 1;
                break;
            }
          }
          parsed[part] = val;
        }
        var _date, s;
        for (i=0; i < setters_order.length; i++){
          s = setters_order[i];
          if (s in parsed && !isNaN(parsed[s])){
            _date = new Date(date);
            setters_map[s](_date, parsed[s]);
            if (!isNaN(_date))
              date = _date;
          }
        }
      }
      return date;
    },
    formatDate: function(date, format, language){
      if (!date)
        return '';
      if (typeof format === 'string')
        format = DPGlobal.parseFormat(format);
      var val = {
        d: date.getUTCDate(),
        D: dates[language].daysShort[date.getUTCDay()],
        DD: dates[language].days[date.getUTCDay()],
        m: date.getUTCMonth() + 1,
        M: dates[language].monthsShort[date.getUTCMonth()],
        MM: dates[language].months[date.getUTCMonth()],
        yy: date.getUTCFullYear().toString().substring(2),
        yyyy: date.getUTCFullYear()
      };
      val.dd = (val.d < 10 ? '0' : '') + val.d;
      val.mm = (val.m < 10 ? '0' : '') + val.m;
      date = [];
      var seps = $.extend([], format.separators);
      for (var i=0, cnt = format.parts.length; i <= cnt; i++){
        if (seps.length)
          date.push(seps.shift());
        date.push(val[format.parts[i]]);
      }
      return date.join('');
    },
    headTemplate: '<thead>'+
              '<tr>'+
                '<th class="prev">&laquo;</th>'+
                '<th colspan="5" class="datepicker-switch"></th>'+
                '<th class="next">&raquo;</th>'+
              '</tr>'+
            '</thead>',
    contTemplate: '<tbody><tr><td colspan="7"></td></tr></tbody>',
    footTemplate: '<tfoot>'+
              '<tr>'+
                '<th colspan="7" class="today"></th>'+
              '</tr>'+
              '<tr>'+
                '<th colspan="7" class="clear"></th>'+
              '</tr>'+
            '</tfoot>'
  };
  DPGlobal.template = '<div class="datepicker">'+
              '<div class="datepicker-days">'+
                '<table class=" table-condensed">'+
                  DPGlobal.headTemplate+
                  '<tbody></tbody>'+
                  DPGlobal.footTemplate+
                '</table>'+
              '</div>'+
              '<div class="datepicker-months">'+
                '<table class="table-condensed">'+
                  DPGlobal.headTemplate+
                  DPGlobal.contTemplate+
                  DPGlobal.footTemplate+
                '</table>'+
              '</div>'+
              '<div class="datepicker-years">'+
                '<table class="table-condensed">'+
                  DPGlobal.headTemplate+
                  DPGlobal.contTemplate+
                  DPGlobal.footTemplate+
                '</table>'+
              '</div>'+
            '</div>';

  $.fn.datepicker.DPGlobal = DPGlobal;


  /* DATEPICKER NO CONFLICT
  * =================== */

  $.fn.datepicker.noConflict = function(){
    $.fn.datepicker = old;
    return this;
  };


  /* DATEPICKER DATA-API
  * ================== */

  $(document).on(
    'focus.datepicker.data-api click.datepicker.data-api',
    '[data-provide="datepicker"]',
    function(e){
      var $this = $(this);
      if ($this.data('datepicker'))
        return;
      e.preventDefault();
      // component click requires us to explicitly show it
      $this.datepicker('show');
    }
  );
  $(function(){
    $('[data-provide="datepicker-inline"]').datepicker();
  });

}(window.jQuery));
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a(jQuery)}(function(a){function b(a){return a}function c(a){a.on("change.datepair",null,e)}function d(a){a.off("change.datepair")}function e(b){var e=a(this);d(e);var f=e.data("datepair-settings"),g=a(b.target);g.hasClass(f.dateClass)?""!=g.val()?j(e,g):e.data("datepair-datedelta",null):g.hasClass(f.timeClass)&&(""!=g.val()?l(e,g):e.data("datepair-timedelta",null)),m(e),k(e),c(e)}function f(a){var b=a.data("datepair-settings");return a.find("."+b.startClass+"."+b.dateClass)}function g(a){var b=a.data("datepair-settings");return a.find("."+b.endClass+"."+b.dateClass)}function h(a){var b=a.data("datepair-settings");return a.find("."+b.startClass+"."+b.timeClass)}function i(a){var b=a.data("datepair-settings");return a.find("."+b.endClass+"."+b.timeClass)}function j(a,b){var c=a.data("datepair-settings"),d=f(a),e=g(a);if(d.length&&e.length)if(d.val()&&e.val()){var h=c.parseDate(d),i=c.parseDate(e);if(b.hasClass(c.startClass)){var j=new Date(h.getTime()+a.data("datepair-datedelta"));c.updateDate(e,j)}else b.hasClass(c.endClass)&&(h>i?(a.data("datepair-datedelta",0),c.updateDate(d,i)):a.data("datepair-datedelta",i.getTime()-h.getTime()))}else if(null!==c.defaultDateDelta){if(d.val()){var h=c.parseDate(d),k=new Date(h.getTime()+c.defaultDateDelta*n);c.updateDate(e,k)}else if(e.val()){var i=c.parseDate(e),l=new Date(i.getTime()-c.defaultDateDelta*n);c.updateDate(d,l)}a.data("datepair-datedelta",c.defaultDateDelta*n)}else a.data("datepair-datedelta",null)}function k(a){var b=a.data("datepair-settings");if("function"==typeof b.setMinTime){var c=null;if(!a.data("datepair-datedelta")||a.data("datepair-datedelta")<n||a.data("datepair-timedelta")&&a.data("datepair-datedelta")+a.data("datepair-timedelta")<n){var d=h(a);c=b.parseTime(d)}var e=i(a);b.setMinTime(e,c)}}function l(a,b){var c=a.data("datepair-settings"),d=h(a),e=i(a);if(d.length&&e.length)if(d.val()&&e.val()){var f=c.parseTime(d),k=c.parseTime(e);if(b.hasClass(c.startClass)){var l=new Date(f.getTime()+a.data("datepair-timedelta"));c.updateTime(e,l),k=c.parseTime(e)}if((k.getTime()-f.getTime())*a.data("datepair-timedelta")<0){var m=g(a);if(m.val()){var o=f>k?n:-1*n,p=c.parseDate(m);c.updateDate(m,new Date(p.getTime()+o)),j(a,m)}}a.data("datepair-timedelta",k.getTime()-f.getTime())}else if(null!==c.defaultTimeDelta){if(d.val()){var f=c.parseTime(d),q=new Date(f.getTime()+c.defaultTimeDelta);c.updateTime(e,q)}else if(e.val()){var k=c.parseTime(e),r=new Date(k.getTime()-c.defaultTimeDelta);c.updateTime(d,r)}a.data("datepair-timedelta",c.defaultTimeDelta)}else a.data("datepair-timedelta",null)}function m(a){var b=h(a),c=i(a);if(b.length&&c.length&&null===a.data("datepair-timedelta"))return void a.trigger("rangeIncomplete");var d=f(a),e=g(a);return d.length&&e.length&&null===a.data("datepair-datedelta")?void a.trigger("rangeIncomplete"):void a.trigger(a.data("datepair-datedelta")+a.data("datepair-timedelta")>=0?"rangeSelected":"rangeError")}var n=864e5,o={startClass:"start",endClass:"end",timeClass:"time",dateClass:"date",defaultDateDelta:0,defaultTimeDelta:36e5,parseTime:function(a){return a.timepicker("getTime")},updateTime:function(a,b){a.timepicker("setTime",b)},parseDate:function(a){return a.datepicker("getDate")},updateDate:function(a,b){a.datepicker("update",b)},setMinTime:function(a,b){a.timepicker("option","minTime",b)}},p={init:function(d){return this.each(function(){var e=a(this),j=a.extend({},o);d&&(j=a.extend(j,d)),j=b(j),e.data("datepair-settings",j),c(e);var l=f(e),m=g(e);if(l.val()&&m.val()){var n=j.parseDate(l),p=j.parseDate(m);e.data("datepair-datedelta",p.getTime()-n.getTime())}else e.data("datepair-datedelta",null);var q=h(e),r=i(e);if(q.val()&&r.val()){var s=j.parseTime(q),t=j.parseTime(r);e.data("datepair-timedelta",t.getTime()-s.getTime())}else e.data("datepair-timedelta",null);k(e)})},option:function(c,d){var e=this,f=e.data("datepair-settings");if("object"==typeof c)f=a.extend(f,c);else if("string"==typeof c&&"undefined"!=typeof d)f[c]=d;else if("string"==typeof c)return f[c];return f=b(f),e.data("datepair-settings",f),e},getTimeDiff:function(){return $self=this,$self.data("datepair-datedelta")*n+$self.data("datepair-timedelta")},remove:function(){var a=this;return a.removeData("datepair-settings"),d(a),a}};a.fn.datepair=function(b){return p[b]?p[b].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof b&&b?void a.error("Method "+b+" does not exist on jQuery.datepair"):p.init.apply(this,arguments)}});