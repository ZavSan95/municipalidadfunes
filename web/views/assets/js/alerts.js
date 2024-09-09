/*=============================================
Alerta SweetAlert
=============================================*/

function fncSweetAlert(type, text, url){

	switch (type) {

		case "error":

		if(url == ""){

			Swal.fire({

				icon: "error",
				title: "Error",
				text: text

			})

		}else{

			Swal.fire({

				icon: "error",
				title: "Error",
				text: text

			}).then((result) =>{

				if (result.value){ 

					window.open(url, "_top");

				}
			
			})

		}

		break;

		case "success":

		if(url == ""){

			Swal.fire({

				icon: "success",
				title: "Correcto",
				text: text

			})

		}else{

			Swal.fire({

				icon: "success",
				title: "Correcto",
				text: text

			}).then((result) =>{

				if (result.value){ 

					window.open(url, "_top");

				}
			
			})

		}

		break;

		case "loading":

			Swal.fire({
            	allowOutsideClick: false,
            	icon: 'info',
            	text:text
          	})
          	Swal.showLoading()

		break;

		case "confirm":

			return new Promise(resolve=>{ 

		 		Swal.fire({
		 			text: text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'No',
                    confirmButtonText: 'Si, continuar!'
		 		}).then(function(result){
         
                    resolve(result.value);
               
                })

		 	})
		break;

		case "close":

		 	Swal.close()
		 	
		break;

	}

}
