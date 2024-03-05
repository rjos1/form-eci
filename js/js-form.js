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
        $('#campus').select2({
            placeholder: "Seleccione su campus o sede de estudio",
            allowClear: true,
            width:"100%",
            // closeOnSelect: false,
            dropdownParent: $("#campus-container"),
            theme: 'bootstrap-5'
        });
        
        $('#jornada').select2({
            placeholder: "Seleccione su jornada estudio",
            allowClear: true,
            width:"100%",
            // closeOnSelect: false,
            dropdownParent: $("#jornada-container"),
            theme: 'bootstrap-5'
        });

        $('#modalidad').select2({
            placeholder: "Seleccione su modalidad de estudio",
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
    let cel = document.getElementById("cel").value;
    let campus = document.getElementById("campus").value;
    let jornada = document.getElementById("jornada").value;
    let modalidad = document.getElementById("modalidad").value;
    

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

    if(cel=="" || cel==null || cel.length<8){
        checkFailed.fire({
            html: "Debe ingresar un número de celular válido"
        })
        return false;
    }

    if(campus.length==null || campus.length==0 || campus==""){
        checkFailed.fire({
            html: "Debe seleccionar un campus"
        })
        return false;
    }

    if(jornada.length==null || jornada.length==0 || jornada==""){
        checkFailed.fire({
            html: "Debe seleccionar una jornada"
        })
        return false;
    }

    if(modalidad.length==null || modalidad.length==0 || modalidad==""){
        checkFailed.fire({
            html: "Debe seleccionar una modalidad"
        })
        return false;
    }
    
    let form = new FormData();
    form.append("nombre", nombre);
    form.append("mail", correo);
    form.append("cel", cel);
    form.append("campus", campus);
    form.append("jornada", jornada);
    form.append("modalidad", modalidad);


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