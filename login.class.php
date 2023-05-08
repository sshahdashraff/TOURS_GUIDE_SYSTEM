<?php 
class LoginUser{
	
	private $email;
	private $password;
	public $error;
	public $success;
	private $storage = "users.json";
	private $stored_users;


	public function __construct($email, $password){
		$this->email = $email;
		$this->password = $password;
		$this->stored_users = json_decode(file_get_contents($this->storage), true);
		$this->login();
	}

	private function login(){
		foreach ($this->stored_users as $user) {
			if($user['email'] == $this->email && !empty($this->email)){
				if(password_verify($this->password, $user['encrypted_password'])){
					session_start();
					$_SESSION['user'] = $this->email;
					$_SESSION['user_id'] = $user['id'];

					if($user['role'] == 'admin'){
						header("location:admin.php ");
						exit;
					}else{
						header("location: welcome.php");
						exit;
					}
					$this->success = "Login successful";
					return;
				}
			}
		}
		$this->error = "Wrong email or password";
	}
}
