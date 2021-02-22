'use strict'
class Categoria{
    constructor(){
        this.idcategoria = '';
        this.categoria = '';
    }

    guardarCategoria(form){
        let btn = document.querySelector('#btnNuevaCategoria'),
            txtbtn = btn.textContent,
            btnHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';

        btn.setAttribute('disabled', 'disabled');
        btn.innerHTML = `${btnHTML} Guardando`;        

        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", BASE_URL+"/categoria/saveCategoria", true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        //xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function(e){
            if(xhr.readyState == 4 && xhr.status == 200){
                if(xhr.responseText)
                    location.reload();
                else{
                    btn.removeAttribute('disabled');
                    btn.innerHTML = txtbtn;
                }               
            }
        }
        xhr.send(formData);
    }

    editarCategoria(form){
        let btn = document.querySelector('#btnEditCategoria'),
            txtbtn = btn.textContent,
            btnHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
        btn.setAttribute('disabled', 'disabled');
        btn.innerHTML = `${btnHTML} Guardando`;

        let formData = new FormData(form);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", BASE_URL+"/categoria/updateCategoria", true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        //xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function(e){
            if(xhr.readyState == 4 && xhr.status == 200){
                if(xhr.responseText)
                    location.reload();
                else{
                    btn.removeAttribute('disabled');
                    btn.innerHTML = txtbtn;
                }            
            }
        }
        xhr.send(formData);
    }

    eliminarCategoria(idcategoria){
        let formData = new FormData;
        formData.append('idcategoria', idcategoria);
        let xhr = new XMLHttpRequest();
        xhr.open("POST", BASE_URL+"/categoria/deleteCategoria", true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        //xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function(e){
            if(xhr.readyState == 4 && xhr.status == 200){
                console.log(xhr.responseText);
                if(xhr.responseText > 0){
                    swal_alert('No puedes eliminar la categoría', 'La categoría a eliminar tiene ' + xhr.responseText + ' producto(s)', 'info', 'Aceptar');
                }else if(xhr.responseText == 'borrado'){
                    location.reload();
                }else{
                    //
                }
            }
        }
        xhr.send(formData);
    }
}

document.addEventListener('DOMContentLoaded', function(){
    //NUEVA CATEGORIA
    const frmNuevaCategoria = document.querySelector('#frmNuevaCategoria');
    frmNuevaCategoria.addEventListener('submit', function(ev){
        ev.preventDefault();
        //console.log(this.elements['nCategoria'].value);
        let categoria = new Categoria;
        categoria.guardarCategoria(this);
    });

    //EDITAR CATEGORIA  
    let editCat = function(el){
        let idcat = el.getAttribute('idcat'),
            cat = el.getAttribute('cat'),
            nCategoriaE = document.querySelector('[name=nCategoriaE]'),
            idCategoriaE = document.querySelector('[name=idCategoriaE]');
        
        nCategoriaE.value  = cat;
        idCategoriaE.value = idcat;
        $("#modalCategoriaE").modal();
    };

    const tblCategorias = document.querySelector("#tblCategorias");
    tblCategorias.addEventListener('click', function(e){ 
        e.preventDefault();
        //EDITAR CATEGORIA 
        if(e.target.closest('.editCategoria')){
            editCat(e.target.closest('.editCategoria'));
        }

        //ELIMINAR CATEGORIA
        if(e.target.closest('.deleteCategoria')){
            let el = e.target.closest('.deleteCategoria'),
                idcat = el.getAttribute('idcat'),
                cat = el.getAttribute('cat');
            
            let objConfirm = {
                title: '¿Estás seguro?',
                text: "Vas a eliminar la categoría: "+cat,
                icon: 'warning',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'No',
                funcion: function(){
                    let categoria = new Categoria;
                    categoria.eliminarCategoria(idcat);
                }
            }            
            swal_confirm(objConfirm);
        }
    });

    //EDITAR CATEGORIA 
    const frmEditCategoria = document.querySelector('#frmEditCategoria');
    frmEditCategoria.addEventListener('submit', function(ev){
        ev.preventDefault();
        let categoria = new Categoria;
        categoria.editarCategoria(this);
    });
});