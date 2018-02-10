<?php
/**
 * Info controller allows for database access
 * and returns JSON
 */
class Info extends Application
{
    /**
     * Returns the application name
     */
    public function index()
    {
        $data = array("scenario" => "Crunch A PC");
        
        echo json_encode($data);
    }
    /**
     * Returns the category with $key id
     * If $key is null, returns all categories
     * 
     * @param type $key PK of category
     */
    public function category($key = NULL)
    {
        if ($key == NULL)
        {
            $json = json_encode($this->categories->all());
        }
        else
        {
            $json = json_encode($this->categories->get($key));
        }
        
        echo $json;
    }
    /**
     * Returns the item with $key id
     * If $key is null, returns all items
     * 
     * @param type $key PK of item
     */
    public function item($key = NULL)
    {
        if ($key == NULL)
        {
            $json = json_encode($this->items->all());
        }
        else
        {
            $json = json_encode($this->items->get($key));
        }
        
        echo $json;
    }
    /**
     * Returns the set with $key id
     * If $key is null, returns all sets
     * 
     * @param type $key PK of category
     */
    public function set($key = NULL)
    {
        if ($key == NULL)
        {
            $json = json_encode($this->sets->all());
        }
        else
        {
            $json = json_encode($this->sets->get($key));
        }
        
        echo $json;
    }
}