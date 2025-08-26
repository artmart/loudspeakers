<?php

$rawSql = $dataProvider->query->createCommand()->rawSql;

// Use var_dump to inspect the raw SQL
//var_dump($rawSql);
//exit;
$models =  $dataProvider->getModels(); //->query->all(); //
//var_dump($models);

//echo count($models);
$cnt = 0;
//exit;
foreach($models as $model){
    $cnt++;
    //echo $model->Pmax_Rated.'<br />';
     
   echo $this->render('_item_view', ['model' => $model]); 
} 

if($cnt==0){  
    //echo $cnt . ' results';  
}

exit;
?>