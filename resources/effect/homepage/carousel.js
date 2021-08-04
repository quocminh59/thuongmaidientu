document.addEventListener("DOMContentLoaded", function() {
    var areaAdtiversements = document.getElementsByClassName('advertisement');
    var button = document.getElementsByClassName('flickity-button');
    console.log(button);
    areaAdtiversements[0].onmouseover = function() {
        button.forEach(function(item){
                item.style.opacity = '1';
        });
    };
    areaAdtiversements[0].onmouseout = function() {
        button.forEach(function(item){
            item.style.opacity = '0';
        });
    };
});