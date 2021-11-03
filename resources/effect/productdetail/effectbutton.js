document.addEventListener('DOMContentLoaded', function() {
    var button = document.getElementsByClassName('button-content');
    var span = document.querySelector('.button-content span');
    var i = document.querySelector('.button-content i');
    var content = document.getElementsByClassName('product-content');
    var countCLicked = 0;
    button[0].onclick = function() {
        countCLicked++;
        if(countCLicked == 1) {
            span.textContent = 'Thu gọn';
            i.classList.add('fa-chevron-up');
            i.classList.remove('fa-chevron-down');
            content[0].style.height = 'auto';
        }
        else if(countCLicked == 2 ) {
            span.textContent = 'Xem thêm';
            i.classList.add('fa-chevron-down');
            i.classList.remove('fa-chevron-up');
            content[0].style.height = '74rem';
            countCLicked = 0;
        }
    }
});