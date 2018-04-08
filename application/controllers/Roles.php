<?php
class Roles extends Application {
	
	// Changes the role in the current session
	public function actor($role = ROLE_USER) {
		$this->session->set_userdata('userrole',$role);
		redirect($_SERVER['HTTP_REFERER']); // back where we came from
	}
}