document.addEventListener("DOMContentLoaded", function() {
    var wrapCategory = document.querySelectorAll(".home-category");
    var wrapSubCategory = document.querySelectorAll(".wrap-subcategory");
    var parentCategories = document.querySelectorAll(".parent-category");
    var subCategories = document.querySelectorAll(".sub-category");
    
    for(let i = 0; i < wrapCategory.length; i++) {
        wrapCategory[i].onmouseover = function() {
           wrapSubCategory[i].style.display = "block"; 
        }

        wrapCategory[i].onmouseout = function() {
            wrapSubCategory[i].style.display = "none";
        }
    }
  
    for(let i = 0; i < parentCategories.length; i++) {
        parentCategories[i].onmouseover = function() {
            for(let i = 0; i < parentCategories.length; i++) {
                subCategories[i].style.display = "none";
            }
            subCategories[i].style.display = "block";
        }

        
    }
});