<?php
App::uses('Sanitize', 'Utility');
class DelphaController extends AppController {

	var $name = 'Delpha';
	var $helpers = array('Csv');
	var $paginate = array('limit' => 25);
	var $components = array('RequestHandler'); 
	var $actsAs = array ('Searchable');
	    var $validate = array(
        'title' => array(
            'rule' => array('minLength', 1)
        ),
        'body' => array(
            'rule' => array('minLength', 1)
        )
    ); 
	function index() {
		$this->set('delphas', $this->Delpha->find('all'));
	}
	function list_delph() {
		$data = $this->paginate('Delpha');
		$this->set('delph',$data);
	}
	function search() {
		//$this->paginate['conditions'][]['delph.q'] = $this->passedArgs['q'];
		# sanitize the query
		 #print_r($this->data); 
    	if($this->data['delpha']['first']=='true') {
    		#echo 'true';
        	$this->pageTitle = "Customer List";    
        	// clear the session on first page visit
        	$this->Session->delete($this->name.'.search');
    	} 
		if(!empty($this->data))
        	$search = $this->data['delpha']['q'];
    	elseif($this->Session->check($this->name.'.search'))	
    		$search = $this->Session->read($this->name.'.search'); 
    	else
    		$search = 'the';
		//$input = $this->params['url']['q']; 
		//debug($search);
	    App::import('Sanitize');
        $q = Sanitize::escape($search); 
		//$condstr = array('fullcitation like' => $q);
		if(isset($search)) { 
			$options="MATCH(fullcitation,keywords)  AGAINST('$q')";
			$this->Session->write($this->name.'.search', $search);  
		}
		//explode($conditions);
		//$this->paginate['conditions'][]= array('delphas.fullcitation LIKE' => "%$search%");
		//$this->Delpha->recursive = 1;
		$this->set(array('delph'=>$this->paginate('Delpha',$options)));
	}
	function search_csv() {
		$this->layout = null;
		$this->autoLayout = false;
		//$this->paginate['conditions'][]['delph.q'] = $this->passedArgs['q'];
		# sanitize the query

		if(!empty($this->data))
        	$search = $this->data['delpha']['q'];
    	elseif($this->Session->check($this->name.'.search'))	
    		$search = $this->Session->read($this->name.'.search'); 
    	else
    		$search = 'the';
		//$input = $this->params['url']['q']; 
		//debug($search);
	    App::import('Sanitize');
        $q = Sanitize::escape($search); 
		//$condstr = array('fullcitation like' => $q);
		if(isset($search)) { 
			$options=array('conditions'=> "MATCH(fullcitation, keywords)  AGAINST('$q')");
			$this->Session->write($this->name.'.search', $search);  
		}
		//explode($conditions);
		//$this->paginate['conditions'][]= array('delphas.fullcitation LIKE' => "%$search%");
		$this->Delpha->recursive = 1;
		//debug($options);
		$this->set('delph',$this->Delpha->find('all',$options));
	}
	function view() {
		$this->set('delphs', $this->Delpha->find('all'));
	}

	
}
?>
