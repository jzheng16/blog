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

  # Default data needed to load? Default is paginated
  public function index($page = NULL)
  {
    $this->load->library('pagination');
    $config = [
      'base_url' => base_url() . 'posts',
      'total_rows' => $this->post->get_count(),
      'per_page' => 10
    ];
    $this->pagination->initialize($config);

    if (isset($page)) {
      $data['posts'] = $this->post->get_posts_by_page($config['per_page'], $page); // Is this correct?
    } else {
      $data['posts'] = $this->post->get_posts_by_page($config['per_page'], 0); // No offset
    }
    // $this->output->enable_profiler(TRUE);
    // $this->output->cache(10);
    $data['links'] = $this->pagination->create_links();
    $data['title'] = 'Your posts';
    $this->load->view('templates/header', $data);
    $this->load->view('posts/index', $data);
    $this->load->view('templates/footer', $data);
  }

  # Function for particular post item

  public function view($id = FALSE)
  {
    $data['post'] = $this->post->get_posts($id);


    if (empty($data['post'])) {
      show_404();
    }

    $data['title'] = $data['post']['title'];

    $this->load->view('templates/header', $data);
    $this->load->view('posts/view', $data);
    $this->load->view('templates/footer');
  }

  public function create()
  {
    # Need to load form helper for form_open
    # Need to load form validation from library
    $this->load->helper('form');
    $this->load->library('form_validation');


    #
    $data['title'] = 'Create a new post';
    $data['css'] = ['createpost'];
    $data['categories'] = $this->category->get_categories();

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
