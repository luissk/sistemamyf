//funciones globales
function swal_confirm(obj){
    Swal.fire({
        title: obj.title,
        text: obj.text,
        icon: obj.icon,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: obj.confirmButtonText,
        cancelButtonText: obj.cancelButtonText,
    }).then((result) => {
        if (result.value) {
            obj.funcion();
        }
    });
}

function swal_alert(title, text, icon, buttonText){
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: buttonText
    });
}