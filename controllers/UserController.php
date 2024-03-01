<?php
require_once('models/User.php');
class UserController
{
	var $model;

	function __construct()
	{
		$this->model = new User();
	}

	function login()
	{
		$data = $_POST;
		$status = $this->model->login($data);
		$remember = isset($_POST['remember']);
		if ($status == true) {
			session_start();
			$_SESSION['username'] = $data['username'];
			if ($remember) {
				setcookie('username', $_SESSION['username'], time() + (86400 * 30), "/"); // 30 days
			}
			setcookie('msg', 'Đăng nhập thành công', time() + 1);
			header('location: index.php');
		} else {
			setcookie('msg', 'Đăng nhập thất bại.', time() + 1);
			header('location: index.php?mod=user&act=login');
		}
	}

	function logout()
	{
		unset($_SESSION['username']);
		session_destroy();
		setcookie('username', '', time() - 3600, "/");
		header('location: index.php');
	}

	function register()
	{
		$data = $_POST;
		$status = $this->model->register($data);
		if ($status == true) {
			setcookie('msg', 'Đăng ký thành công', time() + 1);
			header('location: index.php?mod=user&act=login');
		} else {
			setcookie('msg', 'Đăng ký thất bại.', time() + 1);
			header('location: index.php?mod=user&act=register');
		}
	}
}
