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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// removed by extract-text-webpack-plugin//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvY3NzL2FwcC5jc3M/MTM4MCJdLCJuYW1lcyI6W10sIm1hcHBpbmdzIjoiQUFBQSIsImZpbGUiOiIuL3Jlc291cmNlcy9jc3MvYXBwLmNzcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8vIHJlbW92ZWQgYnkgZXh0cmFjdC10ZXh0LXdlYnBhY2stcGx1Z2luIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/css/app.css\n");

/***/ }),

/***/ "./resources/js/helpers/responsive-collapse.js":
/*!*****************************************************!*\
  !*** ./resources/js/helpers/responsive-collapse.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// https://bootstrapstudio.io/forums/topic/how-disable-data-togglecollapse-action-in-desktop-view/\nfunction adjustCollapseView() {\n  var desktopView = window.innerWidth;\n  console.log(desktopView);\n\n  if (desktopView >= 1052) {\n    $(\".collapse:not(.show)\").addClass(\"show\");\n  } else {\n    $('.collapse.show').removeClass('show');\n  }\n}\n\n$(function () {\n  adjustCollapseView();\n  $(window).on(\"resize\", function () {\n    adjustCollapseView();\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvaGVscGVycy9yZXNwb25zaXZlLWNvbGxhcHNlLmpzPzRlYzgiXSwibmFtZXMiOlsiZGVza3RvcFZpZXciLCJ3aW5kb3ciLCJjb25zb2xlIiwiJCIsImFkanVzdENvbGxhcHNlVmlldyJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQSw4QkFBNkI7QUFDekIsTUFBSUEsV0FBVyxHQUFHQyxNQUFNLENBQXhCO0FBRUFDLFNBQU8sQ0FBUEE7O0FBRUEsTUFBR0YsV0FBVyxJQUFkLE1BQXVCO0FBQ25CRyxLQUFDLENBQURBLHNCQUFDLENBQURBO0FBREosU0FFTztBQUNIQSxLQUFDLENBQURBLGdCQUFDLENBQURBO0FBQ0g7QUFDSjs7QUFFREEsQ0FBQyxDQUFDLFlBQVU7QUFDUkMsb0JBQWtCO0FBQ2xCRCxHQUFDLENBQURBLE1BQUMsQ0FBREEsY0FBdUIsWUFBVTtBQUM3QkMsc0JBQWtCO0FBRHRCRDtBQUZKQSxDQUFDLENBQURBIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL2hlbHBlcnMvcmVzcG9uc2l2ZS1jb2xsYXBzZS5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8vIGh0dHBzOi8vYm9vdHN0cmFwc3R1ZGlvLmlvL2ZvcnVtcy90b3BpYy9ob3ctZGlzYWJsZS1kYXRhLXRvZ2dsZWNvbGxhcHNlLWFjdGlvbi1pbi1kZXNrdG9wLXZpZXcvXG5mdW5jdGlvbiBhZGp1c3RDb2xsYXBzZVZpZXcoKXtcbiAgICBsZXQgZGVza3RvcFZpZXcgPSB3aW5kb3cuaW5uZXJXaWR0aDtcblxuICAgIGNvbnNvbGUubG9nKGRlc2t0b3BWaWV3KTtcblxuICAgIGlmKGRlc2t0b3BWaWV3ID49IDEwNTIpe1xuICAgICAgICAkKFwiLmNvbGxhcHNlOm5vdCguc2hvdylcIikuYWRkQ2xhc3MoXCJzaG93XCIpO1xuICAgIH0gZWxzZSB7XG4gICAgICAgICQoJy5jb2xsYXBzZS5zaG93JykucmVtb3ZlQ2xhc3MoJ3Nob3cnKTtcbiAgICB9XG59XG5cbiQoZnVuY3Rpb24oKXtcbiAgICBhZGp1c3RDb2xsYXBzZVZpZXcoKTtcbiAgICAkKHdpbmRvdykub24oXCJyZXNpemVcIiwgZnVuY3Rpb24oKXtcbiAgICAgICAgYWRqdXN0Q29sbGFwc2VWaWV3KCk7XG4gICAgfSk7XG59KTtcbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/js/helpers/responsive-collapse.js\n");

/***/ }),

/***/ 0:
/*!***********************************************************************************!*\
  !*** multi ./resources/js/helpers/responsive-collapse.js ./resources/css/app.css ***!
  \***********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /home/vagrant/game-hosting-panel/resources/js/helpers/responsive-collapse.js */"./resources/js/helpers/responsive-collapse.js");
module.exports = __webpack_require__(/*! /home/vagrant/game-hosting-panel/resources/css/app.css */"./resources/css/app.css");


/***/ })

/******/ });