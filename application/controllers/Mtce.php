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

        $role = $this->session->userdata('userrole');
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
        $role = $this->session->userdata('userrole');
        $this->data['cc'] .= '<h1 style="text-align: center;">Welcome ' . $role . '!</h1>';
        $this->data['cc'] .= '<div class="row">';
        for($i = 1; $i <= 5; $i++){
            $this->printCategory($i);
        }

        $this->data['cc'] .= '</div><hr/>';
    }

    /**
     * Prints the ith category.
     * @param $i the index of the category
     */
    private function printCategory($i)
    {
        $role = $this->session->userdata('userrole');
        if ($role == ROLE_ADMIN) {
            $this->data['cc'] .= '<div class="row"><a class="h1" href="editCategory/' . $this->data['categories'][$i]->id . '">' . $this->data['categories'][$i]->name .'</a></div><hr/>';
        }
        else {
            $this->data['cc'] .= '<h1>';
            $this->data['cc'] .=  $this->data['categories'][$i]->name;
            $this->data['cc'] .= '</h1>';
        }
        $this->data['cc'] .= '<div class="row">';
        foreach ($this->data['accessories'][$i] as $value)
        {
            $this->printAccessory($value);
        }
        $this->data['cc'] .= '</div>';

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

        $role = $this->session->userdata('userrole');
        if ($role == ROLE_ADMIN) {
            $this->data['cc'] .= '<a class="btn btn-primary" href="edit/' . $value->id . '">Edit</a>';
        }

        $this->data['cc'] .= '</div>';
    }

    public function editCategory($id = null)
    {
        if ($id == null)
            redirect('/mtce');
        $category = $this->categories->get($id);
        /*$task = $this->tasks->get($id);*/
        $this->session->set_userdata('category', $category);
        $this->showEditCategory();

    }

    public function showEditCategory() {
        $this->load->helper('form');
        $category = $this->session->userdata('category');
        /*var_dump($item);*/
        $this->data['id'] = $category->id;  

        // if no errors, pass an empty message
        if ( ! isset($this->data['error']))
            $this->data['error'] = '';  

        $cname = array(
            'name' => 'name',
            'value' => $category->name,
            'class' => 'form-control'
        );

        $cfields = array(
            'fname'      => form_label('Category Name', 'class="control-label"') . form_input($cname),
            'zsubmit'    => form_submit('submit', 'Submit', 'class="btn btn-primary"'),
        );
        $this->data = array_merge($this->data, $cfields);    

        $this->data['pagebody'] = 'editCategory';
        $this->render();
    }

    // Edit an item
    // Render Edit view
    // Need to modify
    public function edit($id = null)
    {
        if ($id == null)
            redirect('/mtce');
        $item = $this->items->get($id);
        /*$task = $this->tasks->get($id);*/
        $this->session->set_userdata('item', $item);
        $this->showit();
    }

    public function showit()
    {
        $this->load->helper('form');
        $item = $this->session->userdata('item');
        /*var_dump($item);*/
        $this->data['id'] = $item->id;  

        // if no errors, pass an empty message
        if ( ! isset($this->data['error']))
            $this->data['error'] = '';  

        $this->data['itemImg'] = "<img src='/assets/img/". 
                $item->description
                . ".png' width='300'>";

        $speed = array(
            'name' => 'speed',
            'value' => $item->speed,
            'class' => 'form-control'
        );
        $power = array(
            'name' => 'power',
            'value' => $item->power,
            'class' => 'form-control'
        );
        $cost = array(
            'name' => 'cost',
            'value' => $item->cost,
            'class' => 'form-control'
        );
        $description = array(
            'name' => 'description',
            'value' => $item->description,
            'class' => 'form-control'
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
        $this->session->unset_userdata('item');
        $this->session->unset_userdata('category');
        redirect('/mtce');
    }

    // handle form submission
    public function submit()
    {
        // setup for validation
        // since we check data during add/update, we don't need rules
        /*$this->load->library('form_validation');
        $this->form_validation->set_rules($this->items->rules());   */



        // retrieve & update data transfer buffer
        $item = (array) $this->session->userdata('item');
        $item = array_merge($item, $this->input->post());
        
        $item = (object) $item;  // convert back to object
        $this->session->set_userdata('item', (object) $item);   

        // validate away
       
        if (empty($item->id))
        {
            $item->id = $this->items->highest() + 1;
            $this->items->add($item);
            $this->alert('Item ' . $item->id . ' added', 'success');
        } else
        {
            $this->items->update($item);
            $this->alert('Item ' . $item->id . ' updated', 'success');
        }
      
        // $this->alert('<strong>Validation errors!<strong><br>' . validation_errors(), 'danger');
        $this->showit();
    }

    // handle category form submission
    public function submitCategory()
    {
        // setup for validation
        // since we check data during add/update, we don't need rules
        /*$this->load->library('form_validation');
        $this->form_validation->set_rules($this->items->rules());   */



        // retrieve & update data transfer buffer
        $category = (array) $this->session->userdata('category');
        $category = array_merge($category, $this->input->post());
        
        $category = (object) $category;  // convert back to object
        $this->session->set_userdata('category', (object) $category);   

        // validate away
       
        if (empty($category->id))
        {
            $category->id = $this->categories->highest() + 1;
            $this->categorys->add($category);
            $this->alert('Item ' . $category->id . ' added', 'success');
        } else
        {
            $this->categories->update($category);
            $this->alert('Item ' . $category->id . ' updated', 'success');
        }
      
        // $this->alert('<strong>Validation errors!<strong><br>' . validation_errors(), 'danger');
        $this->showEditCategory();
    }

    

    // build a suitable error mesage
    // Need to modify
    private function alert($message) {
        $this->load->helper('html');        
        $this->data['error'] = heading($message,3);
    }

    
}
