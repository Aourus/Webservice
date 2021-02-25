<?php
require_once 'toolkit/NWebService.php';
$service = new WebService();


//// CREATE OPPORTUNITY

$po = new Opportunity();

$po->title = "Descripcion del Titulo";
$po->memo = "Descripcion del Memo";

$po->entity = new RecordRef();
$po->entity->internalId = 50;

$po->entitystatus = new RecordRef();
$po->entitystatus->internalId = 8;

$po->department = new RecordRef();
$po->department->internalId = 20;

$po->class = new RecordRef();
$po->class->internalId = 126;

$po->location = new RecordRef();
$po->location->internalId = 5;

//Fase de la oportunidad
$aSelectField = new SelectCustomFieldRef();
$aSelectField->value = new ListOrRecordRef();
$aSelectField->value->internalId = 1;
$aSelectField->scriptId = 'custbody_pslad_fase_opportunity';

/* Los valores posibles para este campos son
1 Inicial
2 Intermedio
3 Final
*/

// Fecha del documento
$startTime = date("c", mktime(14,0,0,3,6,2021));
$cfDate = new DateCustomFieldRef();
$cfDate->value = $startTime;
$cfDate->scriptId = 'custbody_document_date';

//Categoria del cliente
$cfCategCustomer = new SelectCustomFieldRef();
$cfCategCustomer->value = new ListOrRecordRef();
$cfCategCustomer->value->internalId = 2;
$cfCategCustomer->scriptId = 'custbody_pslad_categoria_cliente';

/* Valores posibles para este campo
1 CORPORATIVO PREFERENTE
2 PARTICULAR
3 CORPORATIVO REGULAR
4 AGENTE INTERNACIONAL
*/

$po->itemList = new OpportunityItemList();
$poi = new OpportunityItem();
$poi->item = new RecordRef();
$poi->item->internalId = 45;
$poi->quantity = 3;
$poi->amount = 344;
$po->itemList->item = array($poi);

$po->customFieldList = new CustomFieldList();
$po->customFieldList->customField = array($aSelectField, $cfDate, $cfCategCustomer);

$request = new AddRequest();
$request->record = $po;

$addResponse = $service->add($request);
if (!$addResponse->writeResponse->status->isSuccess) {
    echo "ADD ERROR".$addResponse;
    exit();
} else {
    $poId = $addResponse->writeResponse->baseRef->internalId;
    echo "OPPORTUNITY ADDED SUCCESSFULLY, id " . $poId;
}


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
$cfOpportunity->value->internalId = $poId;


$basicCustomRecord = new CustomRecord();
$basicCustomRecord->recType = new RecordRef();
$basicCustomRecord->recType->internalId = "326"; 
$basicCustomRecord->customFieldList = new CustomFieldList();
$basicCustomRecord->customFieldList->customField = array($cfItem, $cfQuantity, $cfCost, $cfCostTotal, $cfPriceUnit, $cfPriceTotal, $cfOpportunity);

$addRequest = new AddRequest();
$addRequest->record = $basicCustomRecord;
$addResponse = $service->add($addRequest);



if (!$addResponse->writeResponse->status->isSuccess) {
    echo "ADD ERROR".$addResponse;
    exit();
} else {
    echo " - CUSTOM RECORD ADDED SUCCESSFULLY, id " . $addResponse->writeResponse->baseRef->internalId;
}



       ?>