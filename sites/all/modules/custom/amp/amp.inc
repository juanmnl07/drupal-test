<?php
function validateAmpFunctionality(){
	//obtener las rutas AMP a utilizar almacenadas en la variable amp_routes
	$amp_routes = variable_get('amp_routes');
	$urls_array = explode("\n", $amp_routes);
	$amp_validate = false;
	
	//validar rutas con el url actual
	foreach ($urls_array as $key => $value) {
		//obtener ruta actual
		$node = menu_get_object();
		$currentRoute = current_path();
		$pathAlias = $currentRoute;
		$equal = false;

		if(is_object($node)){
			$pathAlias = drupal_lookup_path('alias',$currentRoute);
		}
		//convertir a array el alias
		$pathAliasArray = explode('/', $pathAlias);

		//convertir a array el url AMP
		$pathAmpArray = explode('/', $value);

		if(count($pathAliasArray) == count($pathAmpArray)){
			$counter = count($pathAmpArray);
			for ($i=0; $i < $counter; $i++) { 
				if(($pathAmpArray[$i] == $pathAmpArray[$i]) || ($pathAmpArray[$i] == '*')){
					$equal = true;
				} else {
					$equal = false;
				}
			}
		}
		//si existe alguna coincidencia en las rutas, se procede a verificar si esta en un movil
		if($equal){
			$detect = mobile_detect_get_object();
			$is_mobile = $detect->isMobile();
			if($is_mobile){
				$amp_validate = true;
				break; //salimos del ciclo principal al encontrar una coincidencia
			}
		}
		//var_export($amp_validate);
	}
	return $amp_validate;
}