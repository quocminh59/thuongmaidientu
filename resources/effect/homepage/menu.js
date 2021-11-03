const colorBefore = '#80808078';
const colorAfter = '#1435C3';
document.addEventListener("DOMContentLoaded",function(){
    var a = document.getElementsByClassName('function');
    var span = document.getElementsByClassName('ct');
    var inherit = document.getElementsByClassName('cd');
    for(let i=0;i < span.length; i++) {
        a[i].onmouseover = function(){
            span[i].style.color = colorAfter;
            inherit[i].style.color = colorAfter;
        }
        if(i == 2 || i == 6 ){
            var wrap = document.getElementsByClassName('wrap-user');
            var panel = document.getElementsByClassName('panel');
            var btnAuth = document.getElementsByClassName('user');

            console.log(panel);
            for(let j = 0; j < panel.length; j++) {
                btnAuth[j].onmouseover = function(){
                    panel[j].classList.remove('hidden');
                    span[i].style.color = colorAfter;
                    inherit[i].style.color = colorAfter;
                }
                wrap[j].onmouseleave = function() {
                    panel[j].classList.add('hidden');
                    span[i].style.color = colorBefore;
                    inherit[i].style.color = colorBefore;
                }
            }
        }
        else {
            a[i].onmouseout = function(){
                span[i].style.color = colorBefore;
                inherit[i].style.color = colorBefore;
            }
        }
    }

    // when scroll
    var menu = document.getElementsByClassName('wrap-menu');
    var btnCate = document.getElementsByClassName('btn-cate');
    var brand = document.getElementsByClassName('brand');
    window.addEventListener('scroll', function() {
        if(window.pageYOffset >= 100) {
            menu[0].classList.add('wrap-menu-scroll');
            btnCate[0].classList.remove('display');
            brand[0].classList.add('display');
            brand[1].classList.remove('display');     
        }
        else {
            menu[0].classList.remove('wrap-menu-scroll');
            btnCate[0].classList.add('display');
            brand[0].classList.remove('display');
            brand[1].classList.add('display');
        }
    })

    //button category
    var category = document.getElementsByClassName('category-scroll');
    var btnCate = document.getElementsByClassName('btn-cate');
    btnCate[0].onmouseover = function() {
        category[0].classList.remove('display'); 
        btnCate[0].style.background = 'lightgray';
    }
    btnCate[0].onmouseout = function(){
        category[0].classList.add('display');
        btnCate[0].style.background = 'none';
    }

    // Excute Cart
    var cart = document.getElementById('btn-cart');
    var panelCart = document.getElementsByClassName('panal-cart');
    var count = 0;
    cart.onclick = function(){
        count++;
        if(count == 1) {
            panelCart[0].classList.remove('hidden');
        }
        else if(count == 2) {
            panelCart[0].classList.add('hidden');
            count = 0;
        }
        
    }


   
})