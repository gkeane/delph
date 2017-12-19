
    <?php //debug($delph); ?>
   <?php foreach ($delph as $d): ?>
	<?php  
	$csv = new CsvHelper();
	//debug($d);

	$csv->addField($d['Delpha']['id']); 

   $csv->addField($d['Delpha']['authors']);

   $csv->addField($d['Delpha']['year']);

   $csv->addField($d['Delpha']['title']);

   $csv->addField($d['Delpha']['journal']);

   $csv->addField($d['Delpha']['page']);
	$csv->endRow();
	echo $csv->render('results.csv');
   ?>
   <?php endforeach; 
   
   ?>
    
   
