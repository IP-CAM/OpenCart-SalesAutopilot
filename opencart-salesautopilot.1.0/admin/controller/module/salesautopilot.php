<?php
################################################################################################
#  DIY Module Builder for Opencart 1.5.1.x From HostJars http://opencart.hostjars.com  		   #
################################################################################################
class ControllerModuleSalesAutopilot extends Controller {
	
	private $error = array(); 
	
	public function index() {   
		//Load the language file for this module
		$this->load->language('module/salesautopilot');

		//Set the title from the language file $_['heading_title'] string
		$this->document->setTitle($this->language->get('heading_title'));
		
		//Load the settings model. You can also add any other models you want to load here.
		$this->load->model('setting/setting');
		
		//Save the settings if the user has submitted the admin form (ie if someone has pressed save).
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('salesautopilot', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}

		//This is how the language gets pulled through from the language file.
		//
		// If you want to use any extra language items - ie extra text on your admin page for any reason,
		// then just add an extra line to the $text_strings array with the name you want to call the extra text,
		// then add the same named item to the $_[] array in the language file.
		//
		// 'salesautopilot_example' is added here as an example of how to add - see admin/language/english/module/salesautopilot.php for the
		// other required part.
		
		$this->data = array_merge($this->data, $this->load->language('module/salesautopilot'));
		//END LANGUAGE
		
		//The following code pulls in the required data from either config files or user
		//submitted data (when the user presses save in admin). Add any extra config data
		// you want to store.
		//
		// NOTE: These must have the same names as the form data in your salesautopilot.tpl file
		//
		$config_data = array(
				'salesautopilot_example' //this becomes available in our view by the foreach loop just below.
		);
		
		foreach ($config_data as $conf) {
			if (isset($this->request->post[$conf])) {
				$this->data[$conf] = $this->request->post[$conf];
			} else {
				$this->data[$conf] = $this->config->get($conf);
			}
		}
	
		//This creates an error message. The error['warning'] variable is set by the call to function validate() in this controller (below)
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		//SET UP BREADCRUMB TRAIL. YOU WILL NOT NEED TO MODIFY THIS UNLESS YOU CHANGE YOUR MODULE NAME.
  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/salesautopilot', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/salesautopilot', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		if (isset($this->request->post['salesautopilot_status'])) {
			$this->data['salesautopilot_status'] = $this->request->post['salesautopilot_status'];
		} else {
			$this->data['salesautopilot_status'] = $this->config->get('salesautopilot_status');
		}

		if (isset($this->request->post['salesautopilot_username'])) {
			$this->data['salesautopilot_username'] = $this->request->post['salesautopilot_username'];
		} else {
			$this->data['salesautopilot_username'] = $this->config->get('salesautopilot_username');
		}
		
		if (isset($this->request->post['salesautopilot_password'])) {
			$this->data['salesautopilot_password'] = $this->request->post['salesautopilot_password'];
		} else {
			$this->data['salesautopilot_password'] = $this->config->get('salesautopilot_password');
		}
		
		if (isset($this->request->post['salesautopilot_listid'])) {
			$this->data['salesautopilot_listid'] = $this->request->post['salesautopilot_listid'];
		} else {
			$this->data['salesautopilot_listid'] = $this->config->get('salesautopilot_listid');
		}
		
		if (isset($this->request->post['salesautopilot_formid'])) {
			$this->data['salesautopilot_formid'] = $this->request->post['salesautopilot_formid'];
		} else {
			$this->data['salesautopilot_formid'] = $this->config->get('salesautopilot_formid');
		}
		
		if (isset($this->request->post['salesautopilot_debug'])) {
			$this->data['salesautopilot_debug'] = $this->request->post['salesautopilot_debug'];
		} else {
			$this->data['salesautopilot_debug'] = $this->config->get('salesautopilot_debug');
		}

	
		//This code handles the situation where you have multiple instances of this module, for different layouts.
		$this->data['modules'] = array();
		
		if (isset($this->request->post['salesautopilot_module'])) {
			$this->data['modules'] = $this->request->post['salesautopilot_module'];
		} elseif ($this->config->get('salesautopilot_module')) { 
			$this->data['modules'] = $this->config->get('salesautopilot_module');
		}		

		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();

		//Choose which template file will be used to display this request.
		$this->template = 'module/salesautopilot.tpl';
		$this->children = array(
			'common/header',
			'common/footer',
		);

		//Send the output.
		$this->response->setOutput($this->render());
	}
	
	/*
	 * 
	 * This function is called to ensure that the settings chosen by the admin user are allowed/valid.
	 * You can add checks in here of your own.
	 * 
	 */
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/salesautopilot')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}


}
?>