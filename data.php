<?
$json = file_get_contents("prueba.json");

$result = (array) json_decode($json);


$datacom =[];
foreach ($result as $productos) {

if(isset($datacom[$productos->empresa])) {

$datacom[$productos->empresa]["items"][]= [
                "item"=>$productos->codigo,
                "piezas"=>$productos->piezas,
				"cost"=>$productos->costo
				];
}
else
{
$datacom[$productos->empresa] = [

"entityestat"=>$productos->entityestat,
"department"=>$productos->departamento,
"class"=>$productos->clase,
"location"=>$productos->locacion,
"cat_cliente"=>$productos->catcliente,
"itemglobal"=>$productos->itemglobal,
"cantglobal"=>$productos->cantidadglobal,
"amount"=>$productos->monto3,
"items"=> [
[
                "item"=>$productos->codigo,
                "piezas"=>$productos->piezas,
				"cost"=>$productos->costo
]
] 
];
}
}


	print_r($datacom);
	echo '<br>';
	foreach($datacom as $keys=>$values)
	{
	echo $values['entityestat']; //esto es un item que va .......xxxx....
		echo '<br>';
	echo $values['department'];
		echo '<br>';
	echo $values['class'];
		echo '<br>';
	echo $values['location'];
		echo '<br>';
	echo $values['cat_cliente'];
		echo '<br>';
	echo $values['itemglobal'];
		echo '<br>';
	echo $values['cantglobal'];
		echo '<br>';
	echo $values['amount'];
		echo '<br>';
	
	}
	echo '<br>';
	echo '<br>';
	echo '<br>';
	
	
	$items = $datacom[0]["items"];
	
	
	foreach($items as $nuevos)
		{
			echo $nuevos['piezas'];
		}



?>
