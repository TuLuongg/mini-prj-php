<?php
require_once('models/Blog.php');
class BlogController
{
	var $model;

	function __construct()
	{
		$this->model = new Blog();
	}
	function list()
	{
		$data = $this->model->All();
		require_once('views/blog/list.php');
	}

	function find()
	{
		$id = $_GET['id'];
		$data = $this->model->find($id);
		require_once('views/blog/find.php');
	}

	function add()
	{
		require_once('views/blog/add.php');
	}

	function store()
	{
		$data = $_POST;
		$status = $this->model->insert($data);
		if ($status == true) {
			setcookie('msg', 'Thêm mới thành công', time() + 1);
			header('location: index.php');
		} else {
			setcookie('msg', 'Thêm mới thất bại.', time() + 1);
			header('location: index.php?');
		}
	}

	function edit()
	{
		$id = $_GET['id'];
		$data = $this->model->find($id);
		require_once('views/blog/edit.php');
	}

	function update()
	{
		$data = $_POST;
		$status = $this->model->update($data);
		if ($status == true) {
			setcookie('msg', 'Sửa thành công', time() + 1);
			header('location: index.php?mod=employee');
		} else {
			setcookie('msg', 'Sửa thất bại.', time() + 1);
			header('location: index.php?mod=employee&act=edit');
		}
	}

	function delete()
	{
		$id = $_GET['id'];
		$status = $this->model->delete($id);
		if ($status == true) {
			setcookie('msg', 'Xoá thành công', time() + 1);
			header('location: index.php?mod=employee');
		} else {
			setcookie('msg', 'Xoá thất bại.', time() + 1);
			header('location: index.php?mod=employee&act=list');
		}
	}
}
