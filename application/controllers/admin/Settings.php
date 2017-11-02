<?php
class Settings extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();
		remove_ssl();

		
		
		$this->load->model('Messages_model');

	}
	
	
	
	function index()
	{
		
		$data['canned_messages']	= $this->Messages_model->get_list();
                
		$this->load->view($this->config->item('admin_folder').'/email-template', $data);
	}
	

	
	function canned_message_form($id=false)
	{
		$data['page_title'] = 'canned_message_form';

		$data['id']			= $id;
		$data['email_name']		= '';
		$data['subject']	= '';
		$data['content']	= '';
		
		
		if($id)
		{
			$message = $this->Messages_model->get_message($id);
						
			$data['email_name']		= $message['tplshortname'];
			$data['subject']	= $message['tplsubject'];
			$data['content']	= $message['tplmessage'];
			
		}
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('email_name', 'Email name', 'trim|required');
		$this->form_validation->set_rules('subject', 'Email subject', 'trim|required');
		$this->form_validation->set_rules('content', 'Email message content', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['errors'] = validation_errors();
			
			$this->load->view($this->config->item('admin_folder').'/email_template_form', $data);
		}
		else
		{
			
			$save['tplid']			= $id;
			$save['tplshortname']		= $this->input->post('email_name');
			$save['tplsubject']	= $this->input->post('subject');
			$save['tplmessage']	= $this->input->post('content');
		
			$this->Messages_model->save_message($save);
			
			$this->session->set_flashdata('message', 'message_saved_message');
			redirect($this->config->item('admin_folder').'/Settings');
		}
	}
	
	function delete_message($id)
	{
		$this->Messages_model->delete_message($id);
		
		$this->session->set_flashdata('message', 'message_deleted_message');
		redirect($this->config->item('admin_folder').'/Settings');
	}
}
?>