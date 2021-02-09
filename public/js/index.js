/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/index.js":
/*!*******************************!*\
  !*** ./resources/js/index.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

jQuery(function () {
  $.each($(".ability"), function (i, val) {
    if ($(val).text() === "S") {
      $(val).css('color', '#ffc0cb');
    } else if ($(val).text() === "A") {
      $(val).css('color', '#ff1493');
    } else if ($(val).text() === "B") {
      $(val).css('color', '#ff0000');
    } else if ($(val).text() === "C") {
      $(val).css('color', '#ffa500');
    } else if ($(val).text() === "D") {
      $(val).css('color', '#ffff00');
    } else if ($(val).text() === "E") {
      $(val).css('color', '#32cd32');
    } else if ($(val).text() === "F") {
      $(val).css('color', '#0000cd');
    } else {
      $(val).css('color', '#8b008b');
    }
  });
  $.each($(".rank"), function (i, val) {
    //console.log(val);
    if ($(val).text() === '1位') {
      //$(val).text('1位');
      $(val).css('color', '#ffd700');
      $(val).css('font-weight', '700');
    } else if ($(val).text() === '2位') {
      //$(val).text('2位');
      $(val).css('color', '#c0c0c0');
      $(val).css('font-weight', '600');
    } else if ($(val).text() === '3位') {
      //$(val).text('3位');
      $(val).css('color', '#a52a2a');
      $(val).css('font-weight', '500');
    }
  }); // $.each($(".ave"), function(i, val) {
  // 	if(i === 0){
  // 		//$(val).css('color','#AA0000');
  // 		$(val).css('font-weight', '700');
  // 		console.log('true',i,val);
  // 	}
  // });
  // $.each($(".hr"), function(i, val) {
  // 	if(i === 0){
  // 		//$(val).css('color','#AA0000');
  // 		$(val).css('font-weight', '700');
  // 		console.log('true',i,val);
  // 	}
  // });
  // $.each($(".rbi"), function(i, val) {
  // 	if(i === 0){
  // 		//$(val).css('color','#AA0000');
  // 		$(val).css('font-weight', '700');
  // 		console.log('true',i,val);
  // 	}
  // });

  $('.games').css('font-size', '30px');
  $(".fade").css({
    left: "-100px",
    opacity: "0.0"
  }).animate({
    left: "100px",
    opacity: "1.0"
  }, 3200);
}(jQuery));

/***/ }),

/***/ 1:
/*!*************************************!*\
  !*** multi ./resources/js/index.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /home/ubuntu/environment/soppli/resources/js/index.js */"./resources/js/index.js");


/***/ })

/******/ });