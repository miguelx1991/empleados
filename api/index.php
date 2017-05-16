<?php

require 'Slim/Slim.php';
require 'Slim/ChangeString.php';
require 'Slim/CompleteRange.php';
require 'Slim/ClearPar.php';

$app = new Slim();

$app->get('/empleados', 'MostrarEmpleados');
$app->get('/empleados/cadena/:query', 'ConvertirCadena');
$app->get('/array', 'MostrarArray');
$app->get('/caracter/cadena/:query', 'QuitarCaracter');
$app->get('/empleados/:id',	'TraeEmpleadoCodigo');

$app->run();

function MostrarEmpleados() {
	try {
		$str = file_get_contents('employees.json', FILE_USE_INCLUDE_PATH);
		echo '{"empleados": ' . $str . '}';
    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e-> getMessage() .'}}';
    }	
}
function ConvertirCadena($query) {	
	try {
		$loCadena = new ChangeString();
        $loCadena->setCadena($query);
		//echo $loCadena->getCadena();
        echo $loCadena->ConvertirCadena();
        //echo "Hola";
	} 
    catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function MostrarArray()
{
    try
    {
        $laArray = array(1, 2, 4, 5);
        $laUltArr = array_reverse($laArray);
        $lnPriNum = $laArray[0];
        $lnUltNum = $laUltArr[0];
        $loCadena = new CompleteRange();
        $loCadena->setPriNum($lnPriNum);
        $loCadena->setSegNum($lnUltNum);
        
        echo $loCadena->CompletarRango();
        //echo ($lnUltNum);
    }
    catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function QuitarCaracter($query)
{
    try
    {
        $loCadena = new ClearPar();
        $loCadena->setCadena($query);

        echo $loCadena->QuitarCaracteres();
        //echo $query;
    }
    catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function TraeEmpleadoCodigo($id)
{
    try 
    {
		$str = file_get_contents('employees.json', FILE_USE_INCLUDE_PATH);
        $str = '{"empleados": ' . $str . '}';
        $json = json_decode($str);
        
        foreach($json->empleados as $item)
        {
            if($item->id == $id)
            {
                //echo '{"empleados": ' . $item . '}';
                echo json_encode($item);
                break;
            }
        }
        
		//echo '{"empleados": ' . $str . '}';
    } 
    catch(PDOException $e) 
    {
        echo '{"error":{"text":'. $e-> getMessage() .'}}';
    }
}

?>