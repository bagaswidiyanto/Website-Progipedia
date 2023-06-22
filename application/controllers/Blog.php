<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Blog extends MY_Controller
{
    public function index()
    {
        $this->data['kategori'] = $this->db->get('tbl_master_kategori_post')->result();
        $this->data['txt'] = $this->db->get_where('tbl_text_hero', array('id' => 1))->row();

        $this->db->select('tbl_posts.*');
        $this->db->from('tbl_posts');
        $this->db->order_by('tbl_posts.created_date', 'desc');
        $this->db->limit(1);
        $featured = $this->db->get();
        $this->data['featured'] = $featured->row();

        $this->db->select('tbl_posts.*');
        $this->db->from('tbl_posts');
        $this->db->limit(5);
        $post_side = $this->db->get();
        $this->data['post_side'] = $post_side->result();


        $this->load->library('pagination');
        $param = @$_GET['s'];
        $jml = $this->db->count_all('tbl_posts');
        $config['base_url'] = base_url() . 'blog/index/';
        $config['uri_segment'] = 3;
        $config['total_rows'] = $jml;
        $config['per_page'] = 5;
        $config['full_tag_open'] = '<ul class="pagination ">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->pagination->initialize($config);

        $this->db->select('tbl_posts.*');
        $this->db->from('tbl_posts');
        $this->db->order_by('created_date', 'desc');
        $this->db->limit($config['per_page']);
        $this->db->offset($page);
        $this->db->group_start();
        $this->db->like('Title', $param);
        $this->db->group_end();
        $blog = $this->db->get();


        $this->data['blog'] = $blog;
        $this->data['pagination'] = $this->pagination->create_links();
        $this->web = 'content/v_blog';
        $this->layout();
    }


    public function detail()
    {

        $slug = $this->uri->segment(3);

        $blog = $this->db->get_where('tbl_posts', array('slug' => $slug));
        $this->data['blog'] = $blog->row();

        $this->db->select('tbl_posts.*');
        $this->db->from('tbl_posts');
        $this->db->limit(5);
        $related_post = $this->db->get();
        $this->data['related_post'] = $related_post->result();

        $this->web = 'content/v_detail_blog';
        $this->layout();
    }


    public function category()
    {

        $this->data['txt'] = $this->db->get_where('tbl_text_hero', array('id' => 1))->row();
        $this->data['kategori'] = $this->db->get('tbl_master_kategori_post')->result();

        $this->db->select('tbl_posts.*');
        $this->db->from('tbl_posts');
        $this->db->order_by('tbl_posts.created_date', 'desc');
        $this->db->limit(1);
        $featured = $this->db->get();
        $this->data['featured'] = $featured->row();

        $this->db->select('tbl_posts.*');
        $this->db->from('tbl_posts');
        $this->db->limit(5);
        $post_side = $this->db->get();
        $this->data['post_side'] = $post_side->result();

        $this->data['id_kategori'] = $this->input->get('id_kategori');



        $id_kategori = $this->input->get('id_kategori');

        $this->load->library('pagination');
        $param = @$_GET['s'];


        $this->db->select('tbl_posts.* ,b.nama, b.id');
        $this->db->from('tbl_posts');
        $this->db->join('tbl_master_kategori_post b', 'b.id = tbl_posts.id_kategori', 'left');
        $this->db->where('tbl_posts.id_kategori', $id_kategori);

        $query =  $this->db->get();
        $jml = $query->num_rows();

        $config['base_url'] = base_url() . 'blog/category/' . $id_kategori . '/index/';
        $config['uri_segment'] = 3;
        $config['total_rows'] = $jml;
        $config['per_page'] = 5;
        $config['full_tag_open'] = '<ul class="pagination ">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->pagination->initialize($config);

        $this->db->select('tbl_posts.* ,b.nama, b.id');
        $this->db->from('tbl_posts');
        $this->db->join('tbl_master_kategori_post b', 'b.id = tbl_posts.id_kategori', 'left');

        $this->db->where('tbl_posts.id_kategori', $id_kategori);
        $this->db->group_by('tbl_posts.id');
        $this->db->order_by('tbl_posts.created_date', 'desc');
        $this->db->limit($config['per_page']);
        $this->db->like('Title', $param);
        $this->db->offset($page);

        $blog = $this->db->get();

        $this->data['blog'] = $blog;
        $this->data['pagination'] = $this->pagination->create_links();
        $this->web = 'content/v_blog';
        $this->layout();
    }
}