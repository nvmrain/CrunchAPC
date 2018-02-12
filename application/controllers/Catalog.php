<?php
class Catalog extends Application {

    /**
     * Controller function for the catalog page
     */
    public function index()
    {
        // 1. Load the data:
        $this->load->model('items');
        $this->load->model('categories');

        // 2. Make the data available to the view
        $this->data['pagebody'] = 'catalog';
//        $this->data['categories'] = $this->catagories->getAll();
//        $this->data['accessories'] = $this->accessories->getAll();

        // test data
//        $this->data['categories'] = array("Processor", "RAM", "Graphics Card", "CPU Fan", "Power Source");

        $this->data['categories'] = $this->categories->all();
        $all = $this->items->all();

        foreach ($this->data['categories'] as $c)
        {

            $this->data['accessories'][$c->id] = array();
            foreach ($all as $item)
            {
                if($item->categoryId== $c->id)
                {
                    $this->data['accessories'][$c->id][] = $item;
                }

            }
        }


        // 3. Render the view:`


        $this->data['cc'] = '';
        $this->printBody();
        $this->render();
    }

    /**
     * Prints the body
     */
    private function printBody()
    {
        $this->data['cc'] .= '<div class="row">';
        for($i = 1; $i <= 5; $i++){
            $this->printCategory($i);
        }

        $this->data['cc'] .= '</div>';
    }

    /**
     * Prints the ith category.
     * @param $i the index of the category
     */
    private function printCategory($i)
    {
        $this->data['cc'] .= '<h1>';
        $this->data['cc'] .=  $this->data['categories'][$i]->name;
        $this->data['cc'] .= '</h1>';
        foreach ($this->data['accessories'][$i] as $value)
        {
            $this->printAccessory($value);
        }

    }

    /**
     * Prints an accessory.
     * @param $value The accessory
     */
    private function printAccessory($value)
    {
        $this->data['cc'] .= '<div class="col-md-4">';

        $this->data['cc'] .= '<p>';
        $this->data['cc'] .= 'Code: ';
        $this->data['cc'] .= $value->id;
        $this->data['cc'] .= '</p>';

        $this->data['cc'] .= '<p>';
        $this->data['cc'] .= 'Description: ';
        $this->data['cc'] .= $value->description;
        $this->data['cc'] .= '</p>';

        $this->data['cc'] .= '<img class="catalog-img" src="assets/img/';
        $this->data['cc'] .= $value->description;
        $this->data['cc'] .= '.png">';

        $this->data['cc'] .= '<p>';
        $this->data['cc'] .= 'Speed: ';
        $this->data['cc'] .= $value->speed;
        $this->data['cc'] .= '</p>';

        $this->data['cc'] .= '<p>';
        $this->data['cc'] .= 'Power: ';
        $this->data['cc'] .= $value->power;
        $this->data['cc'] .= '</p>';

        $this->data['cc'] .= '<p>';
        $this->data['cc'] .= 'Cost: ';
        $this->data['cc'] .= $value->cost;
        $this->data['cc'] .= '</p>';

        $this->data['cc'] .= '</div>';
    }
}
