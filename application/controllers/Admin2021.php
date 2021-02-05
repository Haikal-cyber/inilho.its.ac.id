<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin2021 extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    is_logged_in();
  }

  public function index()
  {
    $data['title'] = 'Dashboard';
    $data['shorten_link'] = $this->db->get('shorten_link')->num_rows();
    $data['order_total'] = $this->db->get('data_order');

    $data['unpaid'] = $this->db->get_where('data_order', ['status' => 'Belum Bayar'])->num_rows();
    $data['reject'] = $this->db->get_where('data_order', ['status' => 'Ditolak'])->num_rows();
    $data['finished'] = $this->db->get_where('data_order', ['status' => 'Selesai'])->num_rows();

    $this->db->where('status', 'Sudah Bayar');
    $this->db->or_where('status', 'Sedang Diproses');
    $data['paid'] = $this->db->get('data_order')->num_rows();

    $this->load->view('admin/templates/header', $data);
    $this->load->view('admin/templates/sidebar');
    $this->load->view('admin/templates/navbar');
    $this->load->view('admin/dashboard/index');
    $this->load->view('admin/templates/footer');
  }
}
