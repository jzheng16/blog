<?php

class Pages extends CI_Controller
{

  public function view($page = 'home')
  {
    if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {

      # Built in codeigniter function to display 404
      show_404();
    }

    # $data variable? will always be array?
    # The key for this array will always be mapped to the variable in the actual view file EX: $data['title'] => $title in the actual page

    $data['title'] = ucfirst($page);

    # Load pages now, two args: path to page and data
    # Pah is relative to the views folder 
    $this->load->view('templates/header', $data);
    $this->load->view('pages/' . $page, $data);
    $this->load->view('templates/footer', $data);
  }
}
