document.addEventListener('DOMContentLoaded', function(){
    
    document.getElementById('slide').addEventListener('change', function(e){
        isImage(this,'imagePreview');
    })

    document.getElementById('slidee').addEventListener('change', function(e){
        isImage(this,'imagePreviewE');
    })

    $("#frmNuevoSlider").on('submit', function(e){
        e.preventDefault();
        let btn = document.querySelector('#btnNuevoSlider'),
            txtbtn = btn.textContent,
            btnHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
        btn.setAttribute('disabled', 'disabled');
        btn.innerHTML = `${btnHTML} Guardando`;

        let formData = new FormData(this);
        $.ajax({
            beforeSend: function(){
                //         
            },
            url: BASE_URL+'/slider/saveSlider',
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

    $("#tblSliders").on('click', '.editSlider', function(e){
        e.preventDefault();
        let idslider = $(this).attr('idsli'),
            caption = $(this).attr('caption'),
            text = $(this).attr('text'),
            imagen = $(this).attr('imagen');
        //console.log(idslider, caption, text, imagen);return;

        $("#frmEditarSlider [name=captione]").val(caption);
        $("#frmEditarSlider [name=texte]").val(text);
        $("#imagePreviewE").html(`<img src='${BASE_URL}/public/img/carousel/${imagen}' class='img-fluid'/>`);
        $("#frmEditarSlider [name=idslider]").val(idslider);
        $("#frmEditarSlider [name=imagen_anterior]").val(imagen);

        $("#modalSliderE").modal();
    });

    $("#frmEditarSlider").on('submit', function(e){
        e.preventDefault();
        let btn = document.querySelector('#btnEditarSlider'),
            txtbtn = btn.textContent,
            btnHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
        btn.setAttribute('disabled', 'disabled');
        btn.innerHTML = `${btnHTML} Guardando`;

        let formData = new FormData(this);
        $.ajax({
            beforeSend: function(){
                //         
            },
            url: BASE_URL+'/slider/updateSlider',
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

    $("#tblSliders").on('click', '.deleteSlider', function(e){
        e.preventDefault();
        let idslider = $(this).attr('idsli');

        let objConfirm = {
            title: '¿Estás seguro?',
            text: "Vas a eliminar el slider: "+idslider,
            icon: 'warning',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'No',
            funcion: function(){
                $.post(BASE_URL+'/slider/deleteSlider', {
                    idslider:idslider
                }, function(data){
                    if(data){
                        location.reload();
                    }
                });
            }
        }            
        swal_confirm(objConfirm);
    });

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
        }else if(fileInput.files[0].size > 1048576){
            swal_alert('Imagen Inválida', 'No debe sobrepasar los 1MB', 'info', 'Aceptar');
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

});