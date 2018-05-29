var __cookieLawTimer = 0; 				// Segundos hasta la aceptación automática
var __cookieLawCountBeforeAccept = 1; 	// Paginas a visitar hasta la aceptación
var __cookieLawAcceptByScroll = true;	// Aceptación por scroll de página (recomendado)
var __cookieAcceptInferred = false; 	// Si se activa las aceptaciones tácitas son solo a nivel de sesión

var __cookieLawCookiePolicyUrl = "/drupal/politica-de-cookies";
var __cookieLawBannerPosition = "bottom"; // "top" o "bottom"
var __cokieLawTextPolCookiesName = "aqu&iacute;";
var __cokieLawTextAccept = "Aceptar";
var __cookieLawTextWarning = "Utilizamos cookies propias y de terceros para mejorar nuestros servicios y mostrarle publicidad relacionada con sus preferencias mediante el an&aacute;lisis de sus h&aacute;bitos de navegaci&oacute;n.<br/>Si continua navegando, consideramos que acepta su uso. Puede cambiar la configuraci&oacute;n u obtener m&aacute;s informaci&oacute;n ";

var __cookieLawBannerDivId = "cookieLawBannerId"; var __cookieLawCookieBannerShownCountName = "__cookieBannerShownCount";
var __cookieLawCookieBannerShownTimeName = "__cookieBannerShownTime"; var __cookieLawCookieAcceptName = "__cookieAccept";

if ( __checkCookiesEnabled() ) {
	if ( __checkCookieLawExists() == false ) { // show banner if no cookie
		__setOrUpdateCookieBannerShownCount();
		__setCookieBannerShownTime();
		if ( __testCookieBannerShownCountExceded() ) { // count exceded
			__doCookieLawAcceptInferred();
		} else if ( __testCookieBannerShownTimeExceded() ) { // timer exceded
			__doCookieLawAcceptInferred();
		} else {
			__showCookieBanner();
			// activate watchdogs
			__timerConsentWatchdog();
			if (__cookieLawAcceptByScroll) {
				__scrollWatchdog();
			}
		}
	}
}

//Display del banner

function __showCookieBanner() {
	var divCookieAlert = document.getElementById(__cookieLawBannerDivId);
	if ( divCookieAlert == null ) {
		divCookieAlert = document.createElement("div");
		divCookieAlert.id = __cookieLawBannerDivId;
		divCookieAlert.className = "cookieLawBox";
		divCookieAlert.style.width = "auto";
		divCookieAlert.style.boxSizing = "border-box";
		divCookieAlert.style.padding = "10px 10px 10px 10px";
		divCookieAlert.style.position = "fixed";
		// paso a css: divCookieAlert.style.textAlign = "center";
		if ( __cookieLawBannerPosition == "top" ) {
			divCookieAlert.style.top = "0px";
		} else if ( __cookieLawBannerPosition == "bottom" ) {
			divCookieAlert.style.bottom = "0px";
		}
		divCookieAlert.style.left = "0px";
		divCookieAlert.style.right = "0px";
		divCookieAlert.innerHTML = " <a class=\"btn btn-default cookieLawButton cookieLawButtonAccept\" style=\"margin-left: 20px; float: right; \" href='javascript:__doCookieLawAccept()'>"+__cokieLawTextAccept+"</a>";
		divCookieAlert.innerHTML += __cookieLawTextWarning+" <a class=\"cookieLawAnchor\" href=\"javascript:__doCookieLawInfo()\">"+__cokieLawTextPolCookiesName+"</a>";
		document.body.appendChild(divCookieAlert);
	}
	// TODO que pasa si no hay firstFchild
}
function __hideCookieBanner() {
	var divCookieAlert = document.getElementById(__cookieLawBannerDivId);
	if ( divCookieAlert != null ) {
		divCookieAlert.parentNode.removeChild(divCookieAlert);
	}
}

//Aceptación de cookies

function __doCookieLawInfo() {
	document.location = __cookieLawCookiePolicyUrl;
}
function __doCookieLawAccept() {
	__saveCookieValue(__cookieLawCookieAcceptName,"accepted", 31536000000, "/"); // expiry = 1 year
	__hideCookieBanner();
}
function __doCookieLawAcceptInferred() {
	if (__cookieAcceptInferred) {
		__saveCookieValue(__cookieLawCookieAcceptName,"accepted", 0, "/"); // expiry = session
		__hideCookieBanner();
	} else {
		__doCookieLawAccept();
	}
}

//Funciones internas ge gestión de cookies

function __retrieveCookieValue(cookieName) {
	var auxCookiesString = document.cookie;
	var arrMatches = auxCookiesString.split(";");
	for ( var i = 0; arrMatches != null && i < arrMatches.length; i++ ) {
		if ( arrMatches[i] != null && arrMatches[i].indexOf("=") != -1 ) {
			var auxCookieName = arrMatches[i].substring(0,arrMatches[i].indexOf("="));
			auxCookieName = cookieNameTrim(auxCookieName);
			var auxCookieValue = arrMatches[i].substring(arrMatches[i].indexOf("=")+1);
			if ( auxCookieName == cookieName ) {
				return auxCookieValue;
			}
		}
	}
	return null;
}
function __saveCookieValue(cookieName,cookieValue,cookieExpirationMilisFromNow, cookiePath) {
	if ( cookieExpirationMilisFromNow == 0 ) {
		document.cookie = cookieName + "=" + cookieValue + '; expires=0; path=' + cookiePath;
	} else {
		var auxDate = new Date();
		var auxTime = auxDate.getTime();
		auxTime = auxTime + cookieExpirationMilisFromNow;
		auxDate.setTime(auxTime);
		document.cookie = cookieName + "=" + cookieValue + '; expires=' + auxDate.toGMTString() + '; path=' + cookiePath;
	}
}
function cookieNameTrim(s) {
	if ( typeof s === "undefined" ) return s;
	if	( s == null ) return s;
	var ret = "";
	for ( var i=0; i < s.length; i++ ) {
		if ( s.charAt(i) != " " ) ret = ret + s.charAt(i);
	}
	return ret;
}
function __deleteCookieJs(cookieName) {
	document.cookie = cookieName + "=; expires=Thu, 01 Jan 1970 00:00:01 GMT;";
	document.cookie = cookieName + "=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/";
	var auxDomain = document.domain;
	var auxSubdomain = auxDomain;
	if ( auxSubdomain.indexOf(".") != -1 ) auxSubdomain = auxSubdomain.substring(auxSubdomain.indexOf(".")+1);
	document.cookie = cookieName + "=; expires=Thu, 01 Jan 1970 00:00:01 GMT; path=/; domain = "+auxSubdomain;
}

//Controles del banner, watchdogs y lógica de negocio

function __setOrUpdateCookieBannerShownCount() {
	var auxCount = __retrieveCookieValue(__cookieLawCookieBannerShownCountName);
	if ( auxCount == null || isNaN(auxCount) ) {
		__saveCookieValue(__cookieLawCookieBannerShownCountName,""+__cookieLawCountBeforeAccept, 0, "/");
	}
	else {
		var auxCountNum = parseInt(auxCount);
		auxCountNum = auxCountNum - 1;
		__saveCookieValue(__cookieLawCookieBannerShownCountName,""+auxCountNum, 0, "/");
	}
}
function __setCookieBannerShownTime() {
	if ( __retrieveCookieValue(__cookieLawCookieBannerShownTimeName) == null ) {
		var auxDate = new Date();
		var auxTime = auxDate.getTime();
		__saveCookieValue(__cookieLawCookieBannerShownTimeName,""+auxTime, 0, "/");
	}
}
function __checkCookiesEnabled(){
	var retCookieEnabled = (navigator.cookieEnabled)? true : false;
	if ( typeof navigator.cookieEnabled =="undefined" && !retCookieEnabled ){
		document.cookie="__auxTestCookie";
		retCookieEnabled=(document.cookie.indexOf("__auxTestCookie")!=-1)? true : false;
		__deleteCookieJs("__auxTestCookie");
	}
	return retCookieEnabled;
}

function __testCookieBannerShownCountExceded() {
	var auxCount = __retrieveCookieValue(__cookieLawCookieBannerShownCountName);
	if ( auxCount == null ) {
		return false;
	} else if ( isNaN(auxCount) ) {
		return false;
	} else { // is a number
		if ( auxCount > 0 ) {
			return false;
		} else {
			return true;
		}
	}
}
function __testCookieBannerShownTimeExceded() {
	if (__cookieLawTimer != 0) {
		var auxTime = __retrieveCookieValue(__cookieLawCookieBannerShownTimeName);
		if ( auxTime == null ) {
			return false;
		} else if ( isNaN(auxTime) ) {
			return false;
		} else {// is a number
			var auxTimeNum = parseInt(auxTime);
			var auxTimeLimitNum = auxTimeNum + (__cookieLawTimer * 1000);
			var auxTimeNumNow = (new Date()).getTime();
			if ( auxTimeNumNow > auxTimeLimitNum ) {
				return true;
			} else {
				return false;
			}
		}
	}
}
function __checkCookieLawExists() {
	var auxCookie = __retrieveCookieValue(__cookieLawCookieAcceptName);
	if ( auxCookie != null && ( ( auxCookie == "accepted" ) || ( auxCookie == "denied" ) ) ) {
		return true;
	};
	return false;
}

function __timerConsentWatchdog() {
	if (__cookieLawTimer != 0) {
		if ( __checkCookieLawExists() == false ) {
			if ( __testCookieBannerShownTimeExceded() == true ) {
				__doCookieLawAcceptInferred();
			} else {
				var t=setTimeout(function(){__timerConsentWatchdog()},1000);
			}
		}
	}
}
function __scrollWatchdog() {
	if ( __checkCookieLawExists() == false ) {
		if (__getScroll() != '0') {
			__doCookieLawAcceptInferred();
		} else {
			var t=setTimeout(function(){__scrollWatchdog()},1000);
		};
	}
}

function __getScroll() {
	var auxY = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
	return auxY;
}
