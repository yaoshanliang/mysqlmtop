<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['use_page_numbers'] = FALSE;
$config['uri_segment'] = 3;
//自定义起始链接
$config['first_link'] = '首页';
$config['first_tag_open'] = '<li>';
$config['first_tag_close'] = '</li>';
//自定义结束链接
$config['last_link'] = '末页';
$config['last_tag_open'] = '<li>';
$config['last_tag_close'] = '</li>';
//自定义“下一页”链接
$config['next_link'] = '&gt;';
$config['next_tag_open'] = '<li>';
$config['next_tag_close'] = '</li>';
//自定义“上一页”链接
$config['prev_link'] = '&lt;';
$config['prev_tag_open'] = '<li>';
$config['prev_tag_close'] = '</li>';
//自定义“当前页”链接
$config['cur_tag_open'] = '<li class="active"><a href="#">';
$config['cur_tag_close'] = '</a></li>';
//自定义“数字”链接
$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';