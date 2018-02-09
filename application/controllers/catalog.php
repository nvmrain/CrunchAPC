<?php
class Catalog extends CI_Controller {

    public function index()
    {
        // 1. Load the data:
        $this->load->model('categories');
        $this->load->model('accessories');

        $data['categories'] = $this->catagories->getAll();
        $data['accessories'] = $this->accessories->getAll();
        // 2. Make the data available to the view
        // 3. Render the view:
        $this->load->view('catalog');
    }

    private function printCatagory()
    {
        
    }

}