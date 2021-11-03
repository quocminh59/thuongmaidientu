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

/***/ "./resources/effect/homepage/carousel.js":
/*!***********************************************!*\
  !*** ./resources/effect/homepage/carousel.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

document.addEventListener("DOMContentLoaded", function () {
  var areaAdtiversements = document.getElementsByClassName('advertisement');
  var button = document.getElementsByClassName('flickity-button');
  console.log(button);

  areaAdtiversements[0].onmouseover = function () {
    button.forEach(function (item) {
      item.style.opacity = '1';
    });
  };

  areaAdtiversements[0].onmouseout = function () {
    button.forEach(function (item) {
      item.style.opacity = '0';
    });
  };
});

/***/ }),

/***/ "./resources/effect/homepage/category.js":
/*!***********************************************!*\
  !*** ./resources/effect/homepage/category.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

document.addEventListener("DOMContentLoaded", function () {
  var wrapCategory = document.querySelectorAll(".home-category");
  var wrapSubCategory = document.querySelectorAll(".wrap-subcategory");
  var parentCategories = document.querySelectorAll(".parent-category");
  var subCategories = document.querySelectorAll(".sub-category");

  var _loop = function _loop(i) {
    wrapCategory[i].onmouseover = function () {
      wrapSubCategory[i].style.display = "block";
    };

    wrapCategory[i].onmouseout = function () {
      wrapSubCategory[i].style.display = "none";
    };
  };

  for (var i = 0; i < wrapCategory.length; i++) {
    _loop(i);
  }

  var _loop2 = function _loop2(_i) {
    parentCategories[_i].onmouseover = function () {
      for (var _i2 = 0; _i2 < parentCategories.length; _i2++) {
        subCategories[_i2].style.display = "none";
      }

      subCategories[_i].style.display = "block";
    };
  };

  for (var _i = 0; _i < parentCategories.length; _i++) {
    _loop2(_i);
  }
});

/***/ }),

/***/ "./resources/effect/homepage/menu.js":
/*!*******************************************!*\
  !*** ./resources/effect/homepage/menu.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var colorBefore = '#80808078';
var colorAfter = '#1435C3';
document.addEventListener("DOMContentLoaded", function () {
  var a = document.getElementsByClassName('function');
  var span = document.getElementsByClassName('ct');
  var inherit = document.getElementsByClassName('cd');

  var _loop = function _loop(i) {
    a[i].onmouseover = function () {
      span[i].style.color = colorAfter;
      inherit[i].style.color = colorAfter;
    };

    if (i == 2 || i == 6) {
      wrap = document.getElementsByClassName('wrap-user');
      panel = document.getElementsByClassName('panel');
      btnAuth = document.getElementsByClassName('user');
      console.log(panel);

      var _loop2 = function _loop2(j) {
        btnAuth[j].onmouseover = function () {
          panel[j].classList.remove('hidden');
          span[i].style.color = colorAfter;
          inherit[i].style.color = colorAfter;
        };

        wrap[j].onmouseleave = function () {
          panel[j].classList.add('hidden');
          span[i].style.color = colorBefore;
          inherit[i].style.color = colorBefore;
        };
      };

      for (var j = 0; j < panel.length; j++) {
        _loop2(j);
      }
    } else {
      a[i].onmouseout = function () {
        span[i].style.color = colorBefore;
        inherit[i].style.color = colorBefore;
      };
    }
  };

  for (var i = 0; i < span.length; i++) {
    var wrap;
    var panel;
    var btnAuth;

    _loop(i);
  } // when scroll


  var menu = document.getElementsByClassName('wrap-menu');
  var btnCate = document.getElementsByClassName('btn-cate');
  var brand = document.getElementsByClassName('brand');
  window.addEventListener('scroll', function () {
    if (window.pageYOffset >= 100) {
      menu[0].classList.add('wrap-menu-scroll');
      btnCate[0].classList.remove('display');
      brand[0].classList.add('display');
      brand[1].classList.remove('display');
    } else {
      menu[0].classList.remove('wrap-menu-scroll');
      btnCate[0].classList.add('display');
      brand[0].classList.remove('display');
      brand[1].classList.add('display');
    }
  }); //button category

  var category = document.getElementsByClassName('category-scroll');
  var btnCate = document.getElementsByClassName('btn-cate');

  btnCate[0].onmouseover = function () {
    category[0].classList.remove('display');
    btnCate[0].style.background = 'lightgray';
  };

  btnCate[0].onmouseout = function () {
    category[0].classList.add('display');
    btnCate[0].style.background = 'none';
  }; // Excute Cart


  var cart = document.getElementById('btn-cart');
  var panelCart = document.getElementsByClassName('panal-cart');
  var count = 0;

  cart.onclick = function () {
    count++;

    if (count == 1) {
      panelCart[0].classList.remove('hidden');
    } else if (count == 2) {
      panelCart[0].classList.add('hidden');
      count = 0;
    }
  };
});

/***/ }),

/***/ "./resources/effect/main.js":
/*!**********************************!*\
  !*** ./resources/effect/main.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./homepage/carousel.js */ "./resources/effect/homepage/carousel.js");

__webpack_require__(/*! ./homepage/category.js */ "./resources/effect/homepage/category.js");

__webpack_require__(/*! ./homepage/menu.js */ "./resources/effect/homepage/menu.js");

__webpack_require__(/*! ./owl-carousel.js */ "./resources/effect/owl-carousel.js");

__webpack_require__(/*! ./productdetail/effectbutton.js */ "./resources/effect/productdetail/effectbutton.js");

/***/ }),

/***/ "./resources/effect/owl-carousel.js":
/*!******************************************!*\
  !*** ./resources/effect/owl-carousel.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  $('#carousel-laptop.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    navText: ["<i class='fal fa-chevron-left'></i>", "<i class='fal fa-chevron-right'></i>"],
    items: 5
  });
});
$(document).ready(function () {
  $('#sub-image-carousel.owl-carousel').owlCarousel({
    loop: false,
    margin: 10,
    nav: true,
    navText: ["<span class='material-icons-outlined'>chevron_left</span>", "<span class='material-icons-outlined'>chevron_right</span>"],
    items: 5
  });
});

/***/ }),

/***/ "./resources/effect/productdetail/effectbutton.js":
/*!********************************************************!*\
  !*** ./resources/effect/productdetail/effectbutton.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

document.addEventListener('DOMContentLoaded', function () {
  var button = document.getElementsByClassName('button-content');
  var span = document.querySelector('.button-content span');
  var i = document.querySelector('.button-content i');
  var content = document.getElementsByClassName('product-content');
  var countCLicked = 0;

  button[0].onclick = function () {
    countCLicked++;

    if (countCLicked == 1) {
      span.textContent = 'Thu gọn';
      i.classList.add('fa-chevron-up');
      i.classList.remove('fa-chevron-down');
      content[0].style.height = 'auto';
    } else if (countCLicked == 2) {
      span.textContent = 'Xem thêm';
      i.classList.add('fa-chevron-down');
      i.classList.remove('fa-chevron-up');
      content[0].style.height = '74rem';
      countCLicked = 0;
    }
  };
});

/***/ }),

/***/ 1:
/*!****************************************!*\
  !*** multi ./resources/effect/main.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\qmcomputer\resources\effect\main.js */"./resources/effect/main.js");


/***/ })

/******/ });