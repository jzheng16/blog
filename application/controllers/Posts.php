<?php

class Posts extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    # Kind of like calling super? So that you can use the parent methods in the constructor
    $this->load->model('post');
    $this->load->model('category');
    $this->load->helper('url_helper');
  }

  # Default data needed to load? Default is All Post items
  public function index()
  {
    $this->output->enable_profiler(TRUE);
    $this->output->cache(10);
    $data['posts'] = $this->post->get_posts();
    $data['categories'] = $this->category->get_categories();
    $data['title'] = 'Your posts';
    $this->load->view('templates/header', $data);
    $this->load->view('posts/index', $data);
    $this->load->view('templates/footer', $data);
  }

  # Function for particular post item

  //   public function view($slug = NULL)
  //   {
  //     $data['posts_item'] = $this->post->get_posts($slug);


  //     if (empty($data['posts_item'])) {
  //       show_404();
  //     }

  //     $data['title'] = $data['posts_item']['title'];

  //     $this->load->view('templates/header', $data);
  //     $this->load->view('posts/view', $data);
  //     $this->load->view('templates/footer');
  //   }

  public function create()
  {
    # Need to load form helper for form_open
    # Need to load form validation from library
    $this->load->helper('form');
    $this->load->library('form_validation');


    #
    $data['title'] = 'Create a new post';
    $data['css'] = ['createpost'];
    # Set some rules

    #set_rules takes three arguments
    # 1: Name of input
    # 2: Name to be used in error message
    # 3: The rule 
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('description', 'Description', 'required');

    if ($this->form_validation->run() === FALSE) {
      $this->load->view('templates/header', $data);
      $this->load->view('posts/create', $data);
      $this->load->view('templates/footer', $data);
    } else {
      $data['posts'] = $this->post->get_posts();
      $this->post->set_post();
      $this->load->view('templates/header', $data);
      $this->load->view('posts/index', $data);
      $this->load->view('templates/footer', $data);
    }
  }
}
