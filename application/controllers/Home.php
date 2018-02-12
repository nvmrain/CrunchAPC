<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Application
{

	/**
	 * Index Page for this controller.
	 *
	 */
	public function index()
	{

		//get all data from sets and items
		$mSets = $this->sets->all();
		

		//insert set information to home view selection tag
		$options = '';
		foreach ($mSets as $mSet) {

			$options .= "<option value='" . $mSet->id . "'>" . $mSet->description . "</option>";
		}
		$this->data['mSets'] = $mSets;
		$this->data['options'] = $options;
		$this->data['pagebody'] = 'home';
		$this->data['images'] = $this->selectBuild(-1);
		//$this->selectBuild(1);
		$this->render(); 
		
	}

	/**
	*	This method will find the build by id.
	*	
	*	@param id set id
	*	@return a string include all images html tag
	*/
	public function selectBuild($id) {
		if ($id == -1) {
			$images = "<div class='h1' style='text-align: center'>Please choose a build!</div>";
			return $images;
		}
		$images = '<img src="/assets/img/Motherboard.png" alt="motherboard" class="motherboard">';
		

		//get all data from sets and items
		$mSets = $this->sets->all();
		$mItems = $this->items->all();

		//find the item id of each item
		foreach ($mSets as $s) {
			if ($s->id == $id) {
				$cpuId = $s->cpuId;
				$ramId = $s->ramId;
				$gpuId = $s->gpuId;
				$fanId = $s->fanId;
				$psuId = $s->psuId;
			} else {
				//$images .= "can not find build!!!!!!";
			}
		}

		//find item by item id;
		foreach ($mItems as $i) {
			if ($i->id == $cpuId) {
				$images .= "<img src='/assets/img/". 
				$i->description
				. ".png' alt='CPU' class='cpu-img' width='170'>";
			}

			if ($i->id == $ramId) {
				$images .= "<img src='/assets/img/". 
				$i->description
				. ".png' alt='RAM' class='memory-img' width='200'>";
			}
			if ($i->id == $gpuId) {
				$images .= "<img src='/assets/img/". 
				$i->description
				. ".png' alt='GPU' class='gpu-img' width='400'>";
			}
			if ($i->id == $fanId) {
				$images .= "<img src='/assets/img/". 
				$i->description
				. ".png' alt='FAN' class='cooler-img' width='180'>";
			}
			if ($i->id == $psuId) {
				$images .= "<img src='/assets/img/"
				. $i->description
				. ".png' alt='PSU' class='psu-img' width='300'>";
			}
		}



		//$this->data['images'] = $images;
		echo $images;
		//$this->data['pagebody'] = 'home';
		//$this->render();
		//$this->index();

	}

}