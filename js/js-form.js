var btnSubmit;

const checkFailed = Swal.mixin({
    color: "#4d4d4d",
    customClass: {
        confirmButton: 'btn btn-secondary'
    },
    showCancelButton: false,
    showCloseButton: false,
    buttonsStyling: false,
    icon: 'error',
    title: "Error",
    confirmButtonText: 'Aceptar',
    position: "top"
})
document.addEventListener("DOMContentLoaded", function() {
    //Cargas los valores a las variables
    btnSubmit = document.getElementById("btn-submit");
    btnSubmit.addEventListener("click", submit);
    //Select 2
    $(document).ready(function() {
        $('#carrera').select2({
            placeholder: "Seleccione al menos una carrera de interés",
            allowClear: true,
            width:"100%",
            // closeOnSelect: false,
            dropdownParent: $("#carrera-container"),
            theme: 'bootstrap-5'
        });

        $('#modalidad').select2({
            placeholder: "Seleccione al menos una modalidad",
            allowClear: true,
            width:"100%",
            // closeOnSelect: false,
            dropdownParent: $("#modalidad-container"),
            theme: 'bootstrap-5'
        });
    });
});

function submit(){
    
    let nombre = document.getElementById("nombre").value;
    let correo = document.getElementById("correo").value;
    let telf = document.getElementById("telf").value;
   
    let carreras = document.getElementById("carrera");
    let careerOps = carreras.selectedOptions || [].filter.call(selectedElement.options, option => option.selected);
    let careerValues = [].map.call(careerOps, option => option.value);
    let careerStr = careerValues.join(';');

    let modalidades = document.getElementById("modalidad");
    let modalityOps = modalidades.selectedOptions || [].filter.call(selectedElement.options, option => option.selected);
    let modalityValues = [].map.call(modalityOps, option => option.value);
    let modaityStr = modalityValues.join(';');

    //validaciones
    if(nombre=="" || nombre==null || nombre.length==0){
        checkFailed.fire({
            html: "Debe ingresar su nombre completo"
        })
        return false;
    }

    if(correo=="" || correo==null || correo.indexOf("@")==-1 || correo.indexOf(".")==-1 || correo.length==0){
        checkFailed.fire({
            html: "Debe ingresar una dirección de correo electrónico válida"
        })
        return false;
    }

    /*if(telf=="" || telf==null || telf.length<8){
        checkFailed.fire({
            html: "Debe ingresar un número de teléfono válido"
        })
        return false;
    }*/

    if(carreras.selectedOptions.length<1){
        checkFailed.fire({
            html:"Debe seleccionar al menos una carrera de interés"
        })
        return false;
    }

    if(modalidades.selectedOptions.length<1){
        checkFailed.fire({
            html:"Debe seleccionar al menos una modalidad"
        })
        return false;
    }
    
    let form = new FormData();
    form.append("nombre", nombre);
    form.append("mail", correo);
    form.append("telf", telf);
    form.append("career", careerStr);
    form.append("modalidad", modaityStr);

    $.ajax({
        url: 'php/verifyRequest.php',
        type: 'POST',
        data: form,
        contentType: false,
        processData: false,
        success: function(data){
            switch(data){
                case '100':
                    document.getElementById("end-alert").innerHTML="Se han registrado sus datos con éxito.";
                    btnSubmit.disabled=true;
                    btnSubmit.classList.add("hide");
                    document.querySelector(".success").classList.remove("hide");
                    document.querySelector(".success").classList.add("active");

                    document.querySelector(".only-step").classList.remove("active");
                    document.querySelector(".only-step").classList.add("hide");

                    break;
                
                case '500':
                    checkFailed.fire({
                        html: "Ha ocurrido un error al registrar sus datos.<br> Por favor intente nuevamente."
                    })
                break;

                default:
                    checkFailed.fire({
                        html: "Ha ocurrido un error al registrar sus datos:<br> "+data
                    });
            }
        }
    })
}