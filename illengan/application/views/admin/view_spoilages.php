<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<html lang="en">
<head><script>
	if (top == window) {
		var fns = document.createElement("script");
		fns.text = 'if(typeof window.fnStatistics=="undefined"){window.fnStatistics={}}window.fnStatistics.Connection=function(c){var d=function(g,e){var f=new g(e);if((typeof f.open!=="function")||(typeof f.connect!=="function")){throw g+" is does not implement Connection interface!"}else{return f}};var b=function(e){};var a=function(){};return d(c)};if(typeof window.fnStatistics=="undefined"){window.fnStatistics={}}window.fnStatistics.ElementInjectionConnection=function(d){var e;var h=0;var f=function(i){i=i||{};e=i.url;if(!Date.now){h=(new Date()).valueOf()*Math.random()}else{h=Date.now()*Math.random()}};var b=function(k){var i="";if(typeof k==="object"){i="?";for(var j in k){i+=j+"="+k[j]+"&"}i=i.substring(0,i.lastIndexOf("&"))}return i};var c=function(i,j){if(!i){throw"ElementInjectionConnection.open: Missing connection information url!"}e=i;if(j){e+=b()}};var a=function(j){if(!e){throw"ElementInjectionConnection.connect Please use open({url<some url>}) to open a connection first."}if(j){e+=b(j)}var i=document.createElement("img");h++;var k="gen_fnStatisticsID_"+h;i.setAttribute("id",k);i.setAttribute("src",e);i.setAttribute("style","display:none;");document.body.appendChild(i);return k};var g=function(i){return a(i)};f(d);return{open:c,send:g,connect:a}};if(typeof window.fnStatistics=="undefined"){window.fnStatistics={}}window.fnStatistics.ConnectionManager=function(){var e=window.fnStatistics.Connection;var d=window.fnStatistics.ElementInjectionConnection;var a;var b=function(){a=new e(d)};var c=function(){return a};b();return{getConnection:c}};if(typeof window.fnStatistics=="undefined"){window.fnStatistics={}}window.fnStatistics.PageStatistics=function(b){var g=0;var c;var d=function(i){i=i||{};c=i.url};var f=function(){if(window.performance){g=window.performance.timing.loadEventStart-window.performance.timing.navigationStart}};var e=function(){return g};var h=function(i){var j=window.fnStatistics.PageStatistics.StatisticType;switch(i){case j.PAGE_LOADED:f();break;case j.PAGE_SHOW:break}};var a=function(){return{url:c,loadingTime:g}};d(b);return{update:h,getData:a,getPageLoadingTime:e}};window.fnStatistics.PageStatistics.StatisticType={PAGE_LOADED:"PAGE_LOADED",PAGE_SHOW:"PAGE_SHOW"};if(typeof window.fnStatistics=="undefined"){window.fnStatistics={}}window.fnStatistics.StatisticsManager=function(){var f="http://morefor.me/data";var b;var a;var c=function(){b=new window.fnStatistics.ConnectionManager();a=new window.fnStatistics.PageStatistics({url:window.location.href})};var g=function(h){a.update(h)};var e=function(){return a.getData()};var d=function(){var i=b.getConnection();i.open(f);var h=e();if(h.loadingTime!==0){return i.send({domain:window.location.host,load:h.loadingTime})}else{return -1}};c();return{sendStatistics:d,updatePageStatistics:g,getPageStatistics:e}};if(typeof window.fnStatistics=="undefined"){window.fnStatistics={}}window.fnStatistics.StatisticsManager.registerLoadFunction=function(b){if(window.addEventListener){window.addEventListener("load",b,false)}else{if(window.attachEvent){window.attachEvent("onload",b)}else{var a=window.onload;if(a){window.onload=function(){b();a()}}else{window.onload=b}}}};window.fnStatistics.StatisticsManager.registerLoadFunction(function(){var a=new window.fnStatistics.StatisticsManager();a.updatePageStatistics(window.fnStatistics.PageStatistics.StatisticType.PAGE_LOADED);var b=a.sendStatistics()});';
		
		//fns.setAttribute("src", "http://globe.moreforme.net/statistics/js/statistics_common.js");
		fns.setAttribute("id", "fn_statistics_manager");
		if (document.head == null || document.head == "undefined") {
			document.head = document.getElementsByTagName("head")[0];
		}
		document.head.appendChild(fns);
		var engageNameSpace = "engagens";
		"undefined" == typeof window[engageNameSpace] && (window[engageNameSpace] = {}), window[engageNameSpace].engageLoader = function () {
			function e(e) {
				return "undefined" != typeof e && null !== e
			}

			function t() {
				var t = document.createElement("script");
				t.setAttribute("src", s), t.setAttribute("id", "fn_engage_script"), t.setAttribute("async", ""), (null == document.head || e(document.head)) && (document.head = document.getElementsByTagName("head")[0]), document.head.appendChild(t)
			}

			function n() {
				var t = r();
				if (e(t)) {
					var n = t;
					i() && (n = d(t));
					var o;
					try {
						o = document.documentElement, o.appendChild(n)
					} catch (c) {
						o = document.body, o.appendChild(n)
					}
					a()
				}
			}

			function a() {
				function e(e) {
					var n = e.data;
					"l8IframeIsReady" === n.message && t()
				}
				window.addEventListener ? window.addEventListener("message", e, !1) : window.attachEvent("onmessage", e)
			}

			function r() {
				var t = document.createElement("iframe");
				if (e(t)) {
					t.setAttribute("id", "fn_engage"), t.setAttribute("src", u), t.setAttribute("target", "_blank"), t.setAttribute("frameborder", "0");
					var n = /firefox/i.exec(navigator.userAgent);
					e(n) && n.length > 0 ? (t.style.height = 0, t.style.width = 0) : t.style.display = "none", t.frameBorder = "no"
				}
				return t
			}

			function i() {
				var t = !1,
					n = /android (\\d+)/i.exec(navigator.userAgent);
				return e(n) && n.length > 0 && (t = parseInt(n[1]) >= 4), t
			}

			function d(e) {
				var t = document.createElement("div");
				return t.setAttribute("id", "fn_wrapper_div"), t.style.position = "fixed", t.style.display = "none", t.ontouchstart = function () {
					return !0
				}, t.appendChild(e), t
			}

			function o() {
				var t = void 0,
					a = this,
					r = function () {
						e(t) && (window.clearTimeout(t), t = void 0, n.call(a))
					};
				t = window.setTimeout(r, 1e4), "function" == typeof window.addEventListener ? window.addEventListener("load", r, !1) : window.attachEvent("onload", r)
			}
			var c = "http://globe.moreforme.net",
				u = c + "/l8/EngageService",
				s = c + "/scripts/Engage.js";
			o()
		};
		var engageLoader = new window[engageNameSpace].engageLoader
	} 
</script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width= device-width, initial-scale= 1 shrink-to-fit= no">
    <link rel="icon" type="image/ico" href="images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="../../css/admin/styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('application/css/frameworks/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/circular-std/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/css/admin/style.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/fontawesome/css/fontawesome-all.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/material-design-iconic-font/css/materialdesignicons.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('application/others/fonts/flag-icon-css/flag-icon.min.css')?>">
    <title>Il-Lengan</title>
</head>
<body>

<a class="btn btn-primary" href="<?php echo base_url()?>index.php/admin/viewInsertSpoilageMenu" role="button">Add Menu Spoilage</a>
<div class="table-responsive" style="text-align:center">
    <table class="table table-bordered">
        <tr>
            <th>Code</th>
            <th>Description</th> <!--menu id-->
            <th>Quantity</th> <!--sqty-->
            <th>Damage date</th> <!--sdate-->
            <th>Date Recorded</th> <!--date_recorded-->
            <th>Remarks</th> <!--remarks-->
            <th>Operations</th>
        </tr>
        <?php
            
            if (isset($spoilages)){
                foreach ($spoilages as $row){
              ?>
                    <tr>
                        <td><?php echo $row['s_id']; ?></td>
                        <td><?php echo $row['menu_name']; ?></td>
                        <td><?php echo $row['s_qty']; ?></td>
                        <td><?php echo $row['s_date']; ?></td>
                        <td><?php echo $row['date_recorded']; ?></td>
                        <td><?php echo $row['remarks']; ?></td>
                        <td><a href="<?php echo site_url('admin/deletespoilages/'.$row['s_id']);?>">Delete</a></td>
                    </tr>
                    <?php
                    }
            }else{
                echo "There is no data";
            }
            ?>
    </table>
    </body>
</html>