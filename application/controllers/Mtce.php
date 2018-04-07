<?php
class Mtce extends Application {

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
        //$this->data['categories'] = $this->catagories->getAll();
        //$this->data['accessories'] = $this->accessories->getAll();

        // test data
        //$this->data['categories'] = array("Processor", "RAM", "Graphics Card", "CPU Fan", "Power Source");

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

        $this->data['cc'] .= '<a class="btn btn-primary" href="edit/' . $value->id . '">Edit</a>';

        $this->data['cc'] .= '</div>';
    }

    /**
    * Edit an item
    *  @param $id of item
    *  @param $desc of item
    */
    /*private function edit($id, $desc)
    {

    }*/

    // Edit an item
    // Render Edit view
    // Need to modify
    public function edit($id = null)
    {
        if ($id == null)
            redirect('/mtce');
        $item = $this->items->get($id);
        /*$task = $this->tasks->get($id);*/
        $this->load->helper('form');
        $this->data['id'] = $item->id;  

        // if no errors, pass an empty message
        if ( ! isset($this->data['error']))
            $this->data['error'] = '';  

        $this->data['itemImg'] = "<img src='/assets/img/". 
                $item->description
                . ".png' width='300'>";

        $speed = array(
            'value' => $item->speed,
            'class' => 'form-control'
        );
        $power = array(
            'value' => $item->power,
            'class' => 'form-control'
        );
        $cost = array(
            'value' => $item->cost,
            'class' => 'form-control'
        );
        $description = array(
            'value' => $item->description,
            'class' => 'form-control'
        );

        $submit = array(
        );

        $fields = array(
            'fdescritption'      => form_label('Description', 'class="control-label"') . form_input($description),
            'fspeed'  => form_label('Speed', 'class="control-label"') . form_input($speed),
            'fpower'      => form_label("Power", 'class="control-label"') . form_input($power),
            'fcost'     => form_label("Cost", 'class="control-label"') . form_input($cost),
            'zsubmit'    => form_submit('submit', 'Submit', 'class="btn btn-primary"'),
        );
        $this->data = array_merge($this->data, $fields);    

        $this->data['pagebody'] = 'edit';
        $this->render();

        /*$this->session->set_userdata('task', $task);
        $this->showit();*/
    }

    // Forget about this edit
    // Need to modify
    function cancel() {
        /*$this->session->unset_userdata('task');*/
        redirect('/mtce');
    }

    // handle form submission
    public function submit()
    {
        // setup for validation
        // no validation yet
        /*$this->load->library('form_validation');
        $this->form_validation->set_rules($this->tasks->rules());  */ 

        // retrieve & update data transfer buffer
        /*$task = (array) $this->session->userdata('task');*/
        /*$task = array_merge($task, $this->input->post());*/
        // $task = (object) $task;  // convert back to object
        // $this->session->set_userdata('task', (object) $task);   

        // validate away
        if ($this->form_validation->run())
        {
            if (empty($task->id))
            {
                $task->id = $this->tasks->highest() + 1;
                $this->tasks->add($task);
                $this->alert('Task ' . $task->id . ' added', 'success');
            } else
            {
                $this->tasks->update($task);
                $this->alert('Task ' . $task->id . ' updated', 'success');
            }
        } else
        {
            $this->alert('<strong>Validation errors!<strong><br>' . validation_errors(), 'danger');
        }
        $this->showit();
    }

    

    // build a suitable error mesage
    // Need to modify
    private function alert($message) {
        $this->load->helper('html');        
        $this->data['error'] = heading($message,3);
    }

    
}
