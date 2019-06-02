<?php

class Post extends CI_Model
{
  public function __construct()
  {
    # Enables the $this->db property
    $this->load->database();
  }

  # Slug is automatically sanitized for you by QueryBuilder
  public function get_posts($slug = FALSE)
  {
    if ($slug === FALSE) {
      $this->db->order_by('created_at', 'DESC');
      $query = $this->db->get('post');
      return $query->result_array();
    }

    $query = $this->db->get_where('post', ['slug' => $slug]);
    return $query->row_array();
  }


  public function set_post()
  {
    # Needed to create slug, we don't have that yet 
    $this->load->helper('url');
    # Input library is loaded by default, helps sanitize the data
    $data = [
      'title' => $this->input->post('title'),
      'description' => $this->input->post('description'),
      'user_id' => 1
    ];

    return $this->db->insert('post', $data);
  }
}
