document.addEventListener('DOMContentLoaded', function(){
    
    document.getElementById('imagenp').addEventListener('change', function(e){
        isImage(this,'imagePreview');
    })

    document.getElementById('imagenpe').addEventListener('change', function(e){
        isImage(this,'imagePreviewE');
    })

    function isImage(fileInput, div) { 
        //console.log(fileInput.files[0]);          
        var filePath = fileInput.value; 
      
        // Allowing file type 
        var allowedExtensions =  
                /(\.jpg|\.jpeg|\.png)$/i;
          
        if(!allowedExtensions.exec(filePath)){ 
            swal_alert('Imagen Inválida', 'Formatos aceptados (JPG y PNG)', 'info', 'Aceptar');
            fileInput.value = ''; 
            return false; 
        }else if(fileInput.files[0].size > 4194304){
            swal_alert('Imagen Inválida', 'No debe sobrepasar los 4MB', 'info', 'Aceptar');
            fileInput.value = ''; 
            return false;
        }else{
            // Image preview 
            if (fileInput.files && fileInput.files[0]) { 
                var reader = new FileReader(); 
                reader.onload = function(e) { 
                    document.getElementById( 
                        div).innerHTML =  
                        '<img src="' + e.target.result 
                        + '" class="img-fluid"/>'; 
                }; 
                  
                reader.readAsDataURL(fileInput.files[0]); 
            } 
        } 
    } 
    
    $("#frmNuevoProducto").on('submit', function(e){
        e.preventDefault();
        let btn = document.querySelector('#btnNuevoProducto'),
            txtbtn = btn.textContent,
            btnHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
        btn.setAttribute('disabled', 'disabled');
        btn.innerHTML = `${btnHTML} Guardando`;

        let formData = new FormData(this);
        $.ajax({
            beforeSend: function(){
                //         
            },
            url: BASE_URL+'/producto/saveProducto',
            type:"POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                if(data === 'revisar'){
                    swal_alert('Campos Inválidos', 'Revise bien los campos', 'info', 'Aceptar');
                    btn.removeAttribute('disabled');
                    btn.innerHTML = txtbtn;
                }else if(data === 'ok'){
                    location.reload();
                }else{
                    btn.removeAttribute('disabled');
                    btn.innerHTML = txtbtn;
                }
                //console.log(data);               
            }
        });
    });

    $("#tblProductos").on('click', '.editProducto', function(e){
        e.preventDefault();
        let idproducto = $(this).attr('idpro');

        $.post(BASE_URL+'/producto/productoParaEditar', {
            idproducto:idproducto
        }, function(data){
            if(data){
                //console.log(JSON.parse(data));
                let p = JSON.parse(data);
                $("#frmEditarProducto select[name=categoriap] option[value="+p.idcategoria+"]").attr('selected','1');
                $("#frmEditarProducto [name=nombrep]").val(p.nombre);
                $("#frmEditarProducto [name=descripcionp]").val(p.descripcion);
                $("#frmEditarProducto [name=preciocp]").val(p.precio_compra);
                $("#frmEditarProducto [name=preciovp]").val(p.precio_venta);
                $("#frmEditarProducto [name=stockp]").val(p.stock);
                $("#imagePreviewE").html(`<img src='${BASE_URL}/public/img/products/${p.idproducto}/${p.imagen_small}' class='img-fluid'/>`);
                $("#frmEditarProducto [name=idproducto]").val(p.idproducto);
                $("#frmEditarProducto [name=img_anterior]").val(p.imagen);
                $("#frmEditarProducto [name=img_anteriorsmall]").val(p.imagen_small);
                $("#frmEditarProducto [name=vendidosp]").val(p.vendidos);
            }
        });

        $("#modalProductoE").modal();
    });

    $("#frmEditarProducto").on('submit', function(e){
        e.preventDefault();
        let btn = document.querySelector('#btnEditarProducto'),
            txtbtn = btn.textContent,
            btnHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
        btn.setAttribute('disabled', 'disabled');
        btn.innerHTML = `${btnHTML} Guardando`;

        let formData = new FormData(this);
        $.ajax({
            beforeSend: function(){
                //         
            },
            url: BASE_URL+'/producto/updateProducto',
            type:"POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){
                if(data === 'revisar'){
                    swal_alert('Campos Inválidos', 'Revise bien los campos', 'info', 'Aceptar');
                    btn.removeAttribute('disabled');
                    btn.innerHTML = txtbtn;
                }else if(data === 'ok'){
                    location.reload();
                }else{
                    btn.removeAttribute('disabled');
                    btn.innerHTML = txtbtn;
                }
                console.log(data);               
            }
        });
    });

    $("#tblProductos").on('click', '.deleteProducto', function(e){
        e.preventDefault();
        let idproducto = $(this).attr('idpro'),
            codigo = $(this).attr('codigo');

        let objConfirm = {
            title: '¿Estás seguro?',
            text: "Vas a eliminar el producto: "+codigo,
            icon: 'warning',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'No',
            funcion: function(){
                $.post(BASE_URL+'/producto/deleteProducto', {
                    idproducto:idproducto
                }, function(data){
                    if(data){
                        location.reload();
                    }
                });
            }
        }            
        swal_confirm(objConfirm);
    });

});


function filterFloat(evt,input){
    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;    
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    if(key >= 48 && key <= 57){
        if(filter(tempValue)=== false){
            return false;
        }else{       
            return true;
        }
    }else{
          if(key == 8 || key == 13 || key == 0) {     
              return true;              
          }else if(key == 46){
                if(filter(tempValue)=== false){
                    return false;
                }else{       
                    return true;
                }
          }else{
              return false;
          }
    }
}
function filter(__val__){
    var preg = /^([0-9]+\.?[0-9]{0,2})$/; 
    if(preg.test(__val__) === true){
        return true;
    }else{
       return false;
    }
    
}