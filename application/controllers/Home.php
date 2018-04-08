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
        // Load the category lists and headers
        $category = '';
        $category_headers = '';
        $categories = $this->categories->all();
        for ($categoryId = 1; $categoryId <= $this->categories->highest(); $categoryId++) {
            // Load headers
            $category_headers .= "<div class='col-xs-2'>" . $categories[$categoryId]->name . "</div>";

            // Load category list
            $item_id = "items-" . $categoryId;
            $category .= "<div class='col-xs-2'>";
            $category .= "<select class='form-control' id='" . $item_id . "'>";
            $category .= "<option value=''></option>";
            $items = $this->items->category($categoryId);
            foreach ($items as $item) {
                $category .= "<option value='" . $item->id . "'>" . $item->description . "</option>";
            }
            $category .= "</select>";
            $category .= "</div>";
        }
        $this->data['mSets'] = $mSets;
        $this->data['options'] = $options;
        $this->data['pagebody'] = 'home';
        $this->data['images'] = $this->selectBuild(-1);
        $this->data['category-headers'] = $category_headers;
        $this->data['category'] = $category;
        
        $this->render();
    }
    
    public function setImage($id = 0) {
        if ($id != 0) {
            $item = $this->items->get($id);
            $output = "/assets/img/". 
                        $item->description
                        . ".png";
            
            echo $output;
        }
        
        echo "";
    }

    public function createBuild($name) {
        $entry = $this->sets->create();
        $entry->id = $this->sets->size() + 1;
        $entry->description = $name;
        $this->sets->add($entry);
    }
    
    public function saveBuild($setId, $cpuId, $ramId, $gpuId, $fanId, $psuId) {
        $set = $this->sets->get($setId);
        
        if ($set != null) {
            if ($cpuId == -1) {
            $set->cpuId = "";
        } else {
            $set->cpuId = $cpuId;
        }
        if ($ramId == -1) {
            $set->ramId = "";
        } else {
            $set->ramId = $ramId;
        }
        if ($gpuId == -1) {
            $set->gpuId = "";
        } else {
            $set->gpuId = $gpuId;
        }
        if ($fanId == -1) {
            $set->fanId = "";
        } else {
            $set->fanId = $fanId;
        }
        if ($psuId == -1) {
            $set->psuId = "";
        } else {
            $set->psuId = $psuId;
        }
        
        $this->sets->update($set);
        }
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
                    break;
                }
        }
        
        for ($categoryId = 1; $categoryId <= $this->categories->highest(); $categoryId++) {
            $found = false;
            $items = $this->items->category($categoryId);
            $close;
            foreach ($items as $item) {
                switch ($categoryId) {
                    case 1:
                        $close = "' alt='CPU' class='cpu-img' width='170'>";
                        if ($item->id == $cpuId) {
                            $images .= "<img src='/assets/img/". 
                            $item->description
                            . ".png" . $close;
                            $found = true;
                        }
                        break;
                    case 2:
                        $close = "' alt='RAM' class='memory-img' width='200'>";
                        if ($item->id == $ramId) {
                            $images .= "<img src='/assets/img/". 
                            $item->description
                            . ".png" . $close;
                            $found = true;
                        }
                        break;
                    case 3:
                        $close = "' alt='GPU' class='gpu-img' width='400'>";
                        if ($item->id == $gpuId) {
                            $images .= "<img src='/assets/img/". 
                            $item->description
                            . ".png" . $close;
                            $found = true;
                        }
                        break;
                    case 4:
                        $close = "' alt='FAN' class='cooler-img' width='180'>";
                        if ($item->id == $fanId) {
                            $images .= "<img src='/assets/img/". 
                            $item->description
                            . ".png" . $close;
                            $found = true;
                        }
                        break;
                    case 5:
                        $close = "' alt='PSU' class='psu-img' width='300'>";
                        if ($item->id == $psuId) {
                            $images .= "<img src='/assets/img/". 
                            $item->description
                            . ".png" . $close;
                            $found = true;
                        }
                        break;
                }
            }
            
            if (!$found) {
                $images .= "<img src='" . $close;
            }
        }

        echo $images;
    }
    
}