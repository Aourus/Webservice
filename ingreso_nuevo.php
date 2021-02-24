<?

require_once 'webservice.php';

//// CREATE CUSTOM RECORD DESGLOSE DE SERVICIO

// Articulo
$cfItem = new SelectCustomFieldRef();
$cfItem->value = new ListOrRecordRef();
$cfItem->scriptId = "custrecord_pslad_item";
$cfItem->value->internalId = 45;


// Descripcion del articulo
//$cfItem_Desc = new StringCustomFieldRef();
//$cfItem_Desc->scriptId = "custrecord_pslad_item_desc";
//$cfItem_Desc->value = "Test Articulo";


// Cantidad del articulo
$cfQuantity = new DoubleCustomFieldRef();
$cfQuantity->scriptId = "custrecord_pslad_quantity";
$cfQuantity->value = 2;


// Costo del articulo
$cfCost = new DoubleCustomFieldRef();
$cfCost->scriptId = "custrecord_pslad_cost";
$cfCost->value = 150.15;


// Costo Total del articulo
$cfCostTotal = new DoubleCustomFieldRef();
$cfCostTotal->scriptId = "custrecord_pslad_costo_total";
$cfCostTotal->value = 300.30;


// Precio Unitario del articulo
$cfPriceUnit = new DoubleCustomFieldRef();
$cfPriceUnit->scriptId = "custrecord_pslad_prec";
$cfPriceUnit->value = 280.50;


// Precio Total del articulo
$cfPriceTotal = new DoubleCustomFieldRef();
$cfPriceTotal->scriptId = "custrecord_pslad_precio_total";
$cfPriceTotal->value = 561.20;

// Oportunidad realacionada
$cfOpportunity = new SelectCustomFieldRef();
$cfOpportunity->value = new ListOrRecordRef();
$cfOpportunity->scriptId = "custrecord_oportunidad";
$cfOpportunity->value->internalId = "999";


$basicCustomRecord = new CustomRecord();
$basicCustomRecord->recType = new RecordRef();
$basicCustomRecord->recType->internalId = "326"; 
$basicCustomRecord->customFieldList = new CustomFieldList();
$basicCustomRecord->customFieldList->customField = array($cfItem, $cfQuantity, $cfCost, $cfCostTotal, $cfPriceUnit, $cfPriceTotal, $cfOpportunity); // como crear un array dinamico donde se agreguen N cantidad de articulos desde un json

$addRequest = new AddRequest();
$addRequest->record = $basicCustomRecord;
$addResponse = $service->add($addRequest);



if (!$addResponse->writeResponse->status->isSuccess) {
    echo "ADD ERROR".$addResponse;
    exit();
} else {
    echo " - CUSTOM RECORD ADDED SUCCESSFULLY, id " . $addResponse->writeResponse->baseRef->internalId;
}
