'use strict'
var img = document.querySelector('#img'),
        wraper = document.querySelector('#image-wrap'),
        src_wraper = wraper.getAttribute('data-src');

$(function(){
    /* SLIDER CAPTION */
    const div_thumbs = document.querySelector('.thumbs');
    /*div_imgs = document.querySelectorAll('.thumbs > div'),
    imgs = document.querySelectorAll('.thumbs img');
    let ancho_padre = div_thumbs.parentElement.offsetWidth;
    const array = [...div_imgs];
    let ancho_imgs = array.reduce( (acc, v) => v.offsetWidth + acc, 0);
    console.log(ancho_imgs);
    if( ancho_imgs > ancho_padre ){
        console.log('flechas');
    }*/

    div_thumbs.addEventListener('click', function(e){
        if(e.target.nodeName === 'IMG'){
            let imagen = e.target;
            img.src = imagen.src;
            src_wraper = imagen.getAttribute('data-src');
            wraper.setAttribute('data-src', src_wraper);
            wraper.style.backgroundImage = "url('"+src_wraper+"')";
        }
    })


    img.addEventListener('mousemove', function (e) {
        let src = img.getAttribute('src');
        wraper.style.backgroundImage = "url('"+src_wraper+"')";

        let width = wraper.offsetWidth;
        let height = wraper.offsetHeight;
        let mouseX = e.offsetX;
        let mouseY = e.offsetY;
        
        let bgPosX = (mouseX / width * 100);
        let bgPosY = (mouseY / height * 100);
        
        wraper.style.backgroundPosition = `${bgPosX}% ${bgPosY}%`;
        wraper.style.backgroundSize = "220%";
        img.style.opacity = "0";
    });

    img.addEventListener('mouseleave', function () {
        wraper.style.backgroundPosition = "center";
        wraper.style.backgroundSize = "100%";
        //wraper.style.backgroundImage = "none";
        img.style.opacity = "1";
    });

    img.addEventListener('touchmove', function (e) {
        e.preventDefault();
        let src = img.getAttribute('src');
        wraper.style.backgroundImage = "url('"+src_wraper+"')";

        let width = wraper.offsetWidth;
        let height = wraper.offsetHeight;
        let mouseX = e.touches[0].clientX;
        let mouseY = e.touches[0].clientY;
        
        let bgPosX = (mouseX / width * 100);
        let bgPosY = (mouseY / height * 100);
        
        wraper.style.backgroundPosition = `${bgPosX}% ${bgPosY}%`;
        wraper.style.backgroundSize = "220%";
        img.style.opacity = "0";
    });

    img.addEventListener('touchend', function (e) {
        wraper.style.backgroundPosition = "center";
        wraper.style.backgroundSize = "100%";
        img.style.opacity = "1";
    });


    
    
});

document.addEventListener('DOMContentLoaded', function(){
    
});