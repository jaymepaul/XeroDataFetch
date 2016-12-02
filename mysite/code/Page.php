<?php
class Page extends SiteTree {

	private static $db = array(
	);

	private static $has_one = array(
	);

}
class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array (
		'Form'
	);

	public function init() {
		parent::init();
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements
	}

	public function Form(){

		$fields = new FieldList(
            TextField::create('Name', 'Your Name'),
            EmailField::create('Email', 'Your Email'),
            PhoneNumberField::create('Phone', 'Your Phone')
        );

        $actions = new FieldList(
            FormAction::create("doSayHello")->setTitle("Say hello")
        );

        $required = new RequiredFields('Name', 'Email', 'Phone');

        $form = new Form($this, 'Form', $fields, $actions, $required);

        return $form;
	}

	public function doSayHello($data, $form){

		$member = Member::get()->filter(array(
    		
    		'Email' => $data["Email"],
    		
		))->first();

		if($member){
			// if member exists in DB
			// then launch error message - 'member exists'

		}	
		else{
			$member = new Member();
			$member->FirstName = $data["Name"];
			$member->Email = $data["Email"];
			$member->Phone = $data["Phone"];

			$member->write();
		}
		
		return $this->redirectBack();


		// var_dump($data);
		// die;
	}


}
