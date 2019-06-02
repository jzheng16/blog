<?php

class Category extends CI_MODEL
{

  public function __construct()
  {
    # Enables the $this->db property
    $this->load->database();
  }


  public function get_categories()
  {
    $query = $this->db->get('category');
    return $query->result_array();
  }
}
