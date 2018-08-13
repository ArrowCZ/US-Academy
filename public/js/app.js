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
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 11);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */,
/* 1 */,
/* 2 */,
/* 3 */,
/* 4 */,
/* 5 */,
/* 6 */,
/* 7 */,
/* 8 */,
/* 9 */,
/* 10 */,
/* 11 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(12);
__webpack_require__(13);
__webpack_require__(14);
module.exports = __webpack_require__(15);


/***/ }),
/* 12 */
/***/ (function(module, exports) {


$(document).ready(function () {
    $(".title").lettering();
    $(".button").lettering();
});

$(document).ready(function () {
    animation();
}, 1000);

function animation() {
    var title1 = new TimelineMax();
    title1.to(".button", 0, { visibility: 'hidden', opacity: 0 });
    title1.staggerFromTo(".title span", 0.5, { ease: Back.easeOut.config(1.7), opacity: 0, bottom: -80 }, { ease: Back.easeOut.config(1.7), opacity: 1, bottom: 0 }, 0.05);
    title1.to(".button", 0.2, { visibility: 'visible', opacity: 1 });
}

/***/ }),
/* 13 */
/***/ (function(module, exports) {

!function (e) {
  var t = { strength: 25, scale: 1.05, animationSpeed: "100ms", contain: true, wrapContent: false };e.fn.interactive_bg = function (n) {
    return this.each(function () {
      var r = e.extend({}, t, n),
          i = e(this),
          s = i.outerHeight(),
          o = i.outerWidth(),
          u = r.strength / s,
          a = r.strength / o,
          f = "ontouchstart" in document.documentElement;if (r.contain == true) {
        i.css({ overflow: "hidden" });
      }if (r.wrapContent == false) {
        i.prepend("<div class='ibg-bg'></div>");
      } else {
        i.wrapInner("<div class='ibg-bg'></div>");
      }if (i.data("ibg-bg") !== undefined) {
        i.find("> .ibg-bg").css({ background: "url('" + i.data("ibg-bg") + "') no-repeat center center", "background-size": "cover" });
      }i.find("> .ibg-bg").css({ width: o, height: s });if (f || screen.width <= 699) {
        var l = function l(e) {
          var t = Math.round(event.accelerationIncludingGravity.x * 10) / 10,
              n = Math.round(event.accelerationIncludingGravity.y * 10) / 10,
              s = -(t / 10) * r.strength,
              o = -(n / 10) * r.strength,
              u = -(s * 2),
              a = -(o * 2);i.find("> .ibg-bg").css({ "-webkit-transform": "matrix(" + r.scale + ",0,0," + r.scale + "," + u + "," + a + ")", "-moz-transform": "matrix(" + r.scale + ",0,0," + r.scale + "," + u + "," + a + ")", "-o-transform": "matrix(" + r.scale + ",0,0," + r.scale + "," + u + "," + a + ")", transform: "matrix(" + r.scale + ",0,0," + r.scale + "," + u + "," + a + ")" });
        };

        window.addEventListener("devicemotion", l, false);
      } else {
        i.mouseenter(function (e) {
          if (r.scale != 1) i.addClass("ibg-entering");i.find("> .ibg-bg").css({ "-webkit-transform": "matrix(" + r.scale + ",0,0," + r.scale + ",0,0)", "-moz-transform": "matrix(" + r.scale + ",0,0," + r.scale + ",0,0)", "-o-transform": "matrix(" + r.scale + ",0,0," + r.scale + ",0,0)", transform: "matrix(" + r.scale + ",0,0," + r.scale + ",0,0)", "-webkit-transition": "-webkit-transform " + r.animationSpeed + " linear", "-moz-transition": "-moz-transform " + r.animationSpeed + " linear", "-o-transition": "-o-transform " + r.animationSpeed + " linear", transition: "transform " + r.animationSpeed + " linear" }).on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function () {
            i.removeClass("ibg-entering");
          });
        }).mousemove(function (e) {
          if (!i.hasClass("ibg-entering") && !i.hasClass("exiting")) {
            var t = e.pageX || e.clientX,
                n = e.pageY || e.clientY,
                t = t - i.offset().left - o / 2,
                n = n - i.offset().top - s / 2,
                f = a * t * -1,
                l = u * n * -1;i.find("> .ibg-bg").css({ "-webkit-transform": "matrix(" + r.scale + ",0,0," + r.scale + "," + f + "," + l + ")", "-moz-transform": "matrix(" + r.scale + ",0,0," + r.scale + "," + f + "," + l + ")", "-o-transform": "matrix(" + r.scale + ",0,0," + r.scale + "," + f + "," + l + ")", transform: "matrix(" + r.scale + ",0,0," + r.scale + "," + f + "," + l + ")", "-webkit-transition": "none", "-moz-transition": "none", "-o-transition": "none", transition: "none" });
          }
        }).mouseleave(function (e) {
          if (r.scale != 1) i.addClass("ibg-exiting");i.addClass("ibg-exiting").find("> .ibg-bg").css({ "-webkit-transform": "matrix(1,0,0,1,0,0)", "-moz-transform": "matrix(1,0,0,1,0,0)", "-o-transform": "matrix(1,0,0,1,0,0)", transform: "matrix(1,0,0,1,0,0)", "-webkit-transition": "-webkit-transform " + r.animationSpeed + " linear", "-moz-transition": "-moz-transform " + r.animationSpeed + " linear", "-o-transition": "-o-transform " + r.animationSpeed + " linear", transition: "transform " + r.animationSpeed + " linear" }).on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function () {
            i.removeClass("ibg-exiting");
          });
        });
      }
    });
  };
}(window.jQuery);

/***/ }),
/* 14 */
/***/ (function(module, exports) {

throw new Error("Module build failed: ModuleBuildError: Module build failed: \r\n}\r\n^\r\n      Invalid CSS after \"}\": expected 1 selector or at-rule, was \"<<<<<<< HEAD\"\r\n      in C:\\Users\\super\\Desktop\\Práce\\US-Academy\\resources\\assets\\sass\\app.scss (line 60, column 2)\n    at runLoaders (C:\\Users\\super\\Desktop\\Práce\\US-Academy\\node_modules\\webpack\\lib\\NormalModule.js:195:19)\n    at C:\\Users\\super\\Desktop\\Práce\\US-Academy\\node_modules\\loader-runner\\lib\\LoaderRunner.js:364:11\n    at C:\\Users\\super\\Desktop\\Práce\\US-Academy\\node_modules\\loader-runner\\lib\\LoaderRunner.js:230:18\n    at context.callback (C:\\Users\\super\\Desktop\\Práce\\US-Academy\\node_modules\\loader-runner\\lib\\LoaderRunner.js:111:13)\n    at Object.asyncSassJobQueue.push [as callback] (C:\\Users\\super\\Desktop\\Práce\\US-Academy\\node_modules\\sass-loader\\lib\\loader.js:55:13)\n    at Object.done [as callback] (C:\\Users\\super\\Desktop\\Práce\\US-Academy\\node_modules\\neo-async\\async.js:7974:18)\n    at options.error (C:\\Users\\super\\Desktop\\Práce\\US-Academy\\node_modules\\node-sass\\lib\\index.js:294:32)");

/***/ }),
/* 15 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);