/*=============================================
Limpiar alertas
=============================================*/
function fncFormatInputs(){
	
	if(window.history.replaceState){
		window.history.replaceState(null, null, window.location.href);
	}
	
}

/*=============================================
Alerta Toast
=============================================*/

function fncToastr(type, text){

	var Toast = Swal.mixin({
	  toast: true,
	  position: 'top-end',
	  showConfirmButton: false,
	  timer: 6000,
	  timerProgressBar: true,
	  didOpen: (toast) => {
	    toast.addEventListener('mouseenter', Swal.stopTimer)
	    toast.addEventListener('mouseleave', Swal.resumeTimer)
	  }
	})

	Toast.fire({
        icon: type,
        title: text
    })
}