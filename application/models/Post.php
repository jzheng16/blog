<?php

class Post extends CI_Model
{
  public function __construct()
  {
    # Enables the $this->db property
    $this->load->database();
  }

  # Slug is automatically sanitized for you by QueryBuilder
  public function get_posts($id = FALSE)
  {
    if ($id === FALSE) {
      $this->db->order_by('created_at', 'DESC');
      $query = $this->db->get('post');
      return $query->result_array();
    }

    $query = $this->db->get_where('post', ['id' => $id]);
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

  public function get_count()
  {
    return $this->db->count_all('post');
  }

  public function get_posts_by_page($limit = NULL, $offset = NULL)
  {
    $result = [];
    if (isset($limit) && isset($offset)) {
      $this->db->limit($limit, $offset);
      $query = $this->db->get('post');
      $result = $query->result_array();
    }
    return $result;
  }
}
