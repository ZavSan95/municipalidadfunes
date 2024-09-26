<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class TemplateController{

    /*=============================================
	Traemos la Vista Principal de la plantilla
	=============================================*/
    public function index(){
        include 'views/template.php';
    }

    /*=============================================
	Ruta Principal o Dominio del sitio
	=============================================*/
	static public function path(){

		if(!empty($_SERVER["HTTPS"]) && ("on" == $_SERVER["HTTPS"])){
			return "https://".$_SERVER["SERVER_NAME"]."/";
		}else{
			return "http://".$_SERVER["SERVER_NAME"]."/";
		}

	}

	/*=============================================
	Ruta Principal o Dominio del sitio
	=============================================*/
	static public function sendMail($subject, $email, $title, $message, $link){
		
		date_default_timezone_set('America/Argentina/Buenos_Aires');

		$mail = new PHPMailer();
		
		$mail->CharSet = 'utf-8';
		//$mail->Encoding = 'base64'; //Habilitar al subir al hosting

		$mail->isMail();
		$mail->UseSendmailOptions = 0;

		$mail->setFrom('noreply@funes.com.ar', 'Municipalidad de Funes');
		$mail->Subject = $subject;
		$mail->addAddress($email);
		$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-top:40px; padding-bottom: 40px;">
		
			<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
				
				<center>
					

					<h3 style="font-weight:100; color:#999">'.$title.'</h3>

					<hr style="border:1px solid #ccc; width:80%">

					'.$message.'

					<a href="'.$link.'" target="_blank" style="text-decoration: none;">
						
						<div style="line-height:25px; background:#000; width:60%; padding:10px; color:white; border-radius:5px">Haz clic aquí</div>
					</a>

					<br>

					<hr style="border:1px solid #ccc; width:80%">

					<h5 style="font-weight:100; color:#999">Si no solicitó el envío de este correo, comuniquese con nosotros de inmediato.</h5>

				</center>

			</div>

		</div>');

		$send = $mail->Send();

		if(!$send){
			
			return $mail->ErrorInfo;

		}else{

			return 'ok';

		}

	}

	/*=============================================
	Limpar HTML
	=============================================*/

	static public function htmlClean($code){

		$search = array('/\>[^\S ]+/s','/[^\S ]+\</s','/(\s)+/s');

		$replace = array('>','<','\\1');

		$code = preg_replace($search, $replace, $code);

		$code = str_replace("> <", "><", $code);

		return $code;
	}

	/*=============================================
	Capitalizar inputs
	=============================================*/
	static public function capitalize($value){

		$value = mb_convert_case($value, MB_CASE_TITLE, "utf-8");

		return $value;
	}

	/*=============================================
	Función para almacenar imágenes
	=============================================*/

	static public function saveImage($image, $folder, $name, $width, $height){

		if(isset($image["tmp_name"]) && !empty($image["tmp_name"])) { 
	
			/*=============================================
			Configuramos la ruta del directorio donde se guardará la imagen
			=============================================*/
			$directory = strtolower("views/".$folder);
	
			/*=============================================
			Preguntamos primero si no existe el directorio, para crearlo
			=============================================*/
			if(!file_exists($directory)){
				mkdir($directory, 0755);
			}
	
			/*=============================================
			De acuerdo al tipo de imagen aplicamos las funciones por defecto
			=============================================*/
			if($image["type"] == "image/jpeg" || $image["type"] == "image/png" || $image["type"] == "image/gif"){
	
				// Obtener las dimensiones originales de la imagen
				list($originalWidth, $originalHeight) = getimagesize($image["tmp_name"]);
	
				// Crear una nueva imagen en blanco del tamaño especificado
				$newImage = imagecreatetruecolor($width, $height);
	
				// Manejar transparencia para PNG y GIF
				if($image["type"] == "image/png" || $image["type"] == "image/gif") {
					imagealphablending($newImage, false);
					imagesavealpha($newImage, true);
					$transparent = imagecolorallocatealpha($newImage, 0, 0, 0, 127);
					imagefilledrectangle($newImage, 0, 0, $width, $height, $transparent);
				}
	
				if($image["type"] == "image/jpeg"){
					$start = imagecreatefromjpeg($image["tmp_name"]);
				} elseif($image["type"] == "image/png"){
					$start = imagecreatefrompng($image["tmp_name"]);
				} elseif($image["type"] == "image/gif"){
					$start = imagecreatefromgif($image["tmp_name"]);
				}
	
				// Redimensionar la imagen original a las dimensiones especificadas
				imagecopyresampled($newImage, $start, 0, 0, 0, 0, $width, $height, $originalWidth, $originalHeight);
	
				// Definir la ruta donde se guardará la nueva imagen
				$newImagePath = $directory.'/'.$name.'.'.pathinfo($image['name'], PATHINFO_EXTENSION);
	
				// Guardar la imagen redimensionada en el directorio especificado
				if($image["type"] == "image/jpeg"){
					imagejpeg($newImage, $newImagePath);
				} elseif($image["type"] == "image/png"){
					imagepng($newImage, $newImagePath);
				} elseif($image["type"] == "image/gif"){
					imagegif($newImage, $newImagePath);
				}
	
				// Liberar memoria
				imagedestroy($newImage);
				imagedestroy($start);
	
				// Devolver el nombre de la nueva imagen
				return $name.'.'.pathinfo($image['name'], PATHINFO_EXTENSION);
			}
		}
	
		return "error";
	}

/*=============================================
Función para almacenar imágenes conservando dimensiones originales
=============================================*/
static public function saveImageOriginal($image, $folder, $name){

	if(isset($image["tmp_name"]) && !empty($image["tmp_name"])) { 

		/*=============================================
		Configuramos la ruta del directorio donde se guardará la imagen
		=============================================*/
		$directory = strtolower("views/".$folder);

		/*=============================================
		Preguntamos primero si no existe el directorio, para crearlo
		=============================================*/
		if(!file_exists($directory)){
			mkdir($directory, 0755);
		}

		/*=============================================
		De acuerdo al tipo de imagen aplicamos las funciones por defecto
		=============================================*/
		if($image["type"] == "image/jpeg" || $image["type"] == "image/png" || $image["type"] == "image/gif"){

			// Obtener las dimensiones originales de la imagen
			list($originalWidth, $originalHeight) = getimagesize($image["tmp_name"]);

			// Crear una nueva imagen con las dimensiones originales
			$newImage = imagecreatetruecolor($originalWidth, $originalHeight);

			// Manejar transparencia para PNG y GIF
			if($image["type"] == "image/png" || $image["type"] == "image/gif") {
				imagealphablending($newImage, false);
				imagesavealpha($newImage, true);
				$transparent = imagecolorallocatealpha($newImage, 0, 0, 0, 127);
				imagefilledrectangle($newImage, 0, 0, $originalWidth, $originalHeight, $transparent);
			}

			// Crear la imagen según su tipo
			if($image["type"] == "image/jpeg"){
				$start = imagecreatefromjpeg($image["tmp_name"]);
			} elseif($image["type"] == "image/png"){
				$start = imagecreatefrompng($image["tmp_name"]);
			} elseif($image["type"] == "image/gif"){
				$start = imagecreatefromgif($image["tmp_name"]);
			}

			// Copiar la imagen original sin redimensionar
			imagecopyresampled($newImage, $start, 0, 0, 0, 0, $originalWidth, $originalHeight, $originalWidth, $originalHeight);

			// Definir la ruta donde se guardará la nueva imagen
			$newImagePath = $directory.'/'.$name.'.'.pathinfo($image['name'], PATHINFO_EXTENSION);

			// Guardar la imagen original en el directorio especificado
			if($image["type"] == "image/jpeg"){
				imagejpeg($newImage, $newImagePath);
			} elseif($image["type"] == "image/png"){
				imagepng($newImage, $newImagePath);
			} elseif($image["type"] == "image/gif"){
				imagegif($newImage, $newImagePath);
			}

			// Liberar memoria
			imagedestroy($newImage);
			imagedestroy($start);

			// Devolver el nombre de la nueva imagen
			return $name.'.'.pathinfo($image['name'], PATHINFO_EXTENSION);
		}
	}

	return "error";
}


	/*=============================================
	Generar URLS
	=============================================*/
	static public function generateUrl($string) {
		// Eliminar caracteres especiales
		$string = preg_replace('/[^a-zA-Z0-9\s]/', '', $string);
		
		// Reemplazar espacios en blanco por guiones bajos
		$string = str_replace(' ', '_', $string);
		
		// Convertir a minúsculas
		$string = strtolower($string);
		
		return $string;
	}

	

}