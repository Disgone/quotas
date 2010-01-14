<?php
class User extends AppModel {

	var $name = 'User';
	var $validate = array(
		'username' 		=> array(
								'notEmpty'	=> array(
									'rule' 		=> 'notEmpty',
									'required' 	=> true,
									'message' 	=> 'Username is required'
									),
								'unique' => array(
									'rule'		=> 'isUnique',
									'on'		=> array('create'),
									'message'	=> 'Account already exists with that username.'
									)
								),
		'email' 		=> array(
								'email'	=> array(
									'rule' 		=> 'email',
									'required' 	=> false,
									'allowEmpty' => true,
									'message' 	=> 'Invalid email addresss'
									)
								),
		'password' 		=> array(
								'notEmpty'	=> array(
									'rule' 		=> 'notEmpty',
									'required' 	=> true,
									'message' 	=> 'A password is required'
									),
								'minLength'	=> array(
									'rule' 		=> array('minLength', 6),
									'required' 	=> true,
									'on'		=> array('create'),
									'message' 	=> 'Passwords must be at least 6 characters'
									)
								),
		'displayname' 	=> array('notEmpty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasAndBelongsToMany = array(
		'Project' => array(
			'className'					=> 'Project',
			'joinTable'					=> 'projects_users',
			'foreignKey'				=> 'user_id',
			'associationForeignKey' 	=> 'project_id',
			'unique'					=> false
		)
	);
	
	function confirmPassword($data) {
		$valid = $data['password'] == $this->data['User']['confirm'] ? true : false; 
		return $valid;
	}
	
	/**
	 * Returns a users favorite projects.
	 * @param $id the user id of the person you are requesting favorites from
	 * @return array
	 */
	function favorites($id) {
		return $this->ProjectsUser->find('all', array('conditions' => array('ProjectsUser.user_id' => $id)));
	}
	
	/**
	 * Checks if a user has a project on their favorites list.
	 * @param $id the user id
	 * @param $project_id the id of the project
	 * @return boolean
	 */
	function isTrackingProject($id, $project_id) {
		if($id == null)
			return false;
			
		$result = $this->ProjectsUser->find('all', array('conditions' => array('ProjectsUser.user_id' => $id, 'ProjectsUser.project_id' => $project_id)));
		
		if(!empty($result))
			return true;
			
		return false;
	}
}
?>