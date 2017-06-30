<?php
class Cron_notify extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Project_overview');
		$this->load->model('Proposal');
		$this->load->model('MeetingModel');
	}

	function meeting_alert()
	{
		date_default_timezone_set('Asia/Singapore');

		$today = date('Y-m-d');
		$time = '';

		$meetings = $this->MeetingModel->get_all_meeting_to_alert($today);

		$cc_mail = $this->config->item('manager_email') ? $this->config->item('manager_email') : $this->config->item('notification_email');

		$cc = array($cc_mail);

		foreach ($meetings as $k => $meeting) {

			if(strtolower($meeting->reminder_time_type) == 'minute'){
				$time_add = $meeting->reminder_time;
				$time = date('h:i', strtotime("+$time_add minute"));
			} else if(strtolower($meeting->reminder_time_type) == 'hour'){
				$time_add = $meeting->reminder_time;
				$time = date('h:i', strtotime("+$time_add hour"));
			}

			$client = $this->Customer->get_info($meeting->client_id);

			$msg = '<html>
				<h3> Dear '.$client->person_contact.', </h3>
				<p> This is a gentle reminder for the scheduled meeting with the team from Asia Leap on '.$today.' at '.$meeting->time.' .</p>
				<p> <b>Venue : </b> '.$meeting->where.'</p>
				<p> We look forward to seeing you.</p>
			</html>';

			if(!empty($time) && ($time == $meeting->time)) {	

				$subject = $meeting->subject;
				array_push($cc, $meeting->email);

				$to = $client->email;

				$success = $this->sendMail($subject, $msg, $to, $cc);
				if($success) {
					$this->MeetingModel->update_meeting_to_alert($meeting->id);
				}
			}
		}

		exit();		
	}

	function issue_invoice()
	{
		$five_after_currdate = date('Y-m-d', strtotime('+5 days'));
		$issue_invoices = $this->Project_overview->get_all_issue_invoice($five_after_currdate);

		$to_mail = $this->config->item('manager_email') ? $this->config->item('manager_email') : $this->config->item('notification_email');
		$to = array($to_mail);

		foreach($issue_invoices as $issue_invoice) {

			$project = $this->Project_overview->get_info($issue_invoice->project_id);
			array_push($to, $project->email);

			$step2 = unserialize($this->Proposal->get_info($project->proposal_id)->step_two);
			$s2_phase_titles = unserialize($step2['step_two'])['milestone_contents']['titles'];	

			$phase_line_title = strtolower($s2_phase_titles[$issue_invoice->phase_line]['title']);
			$project_title = strtolower($project->project_title);

			$subject = '[project fee breakdown] Issue invoice';
			$msg = '<html>
				<h3> Dear Asia Leap, </h3>
				<p> This is gentle reminder to issue invoice for '.$project_title.' on '. $five_after_currdate .'.</p>
			</html>';

			$sent = $this->sendMail($subject, $msg, $to);

			if($sent) {
				$this->Project_overview->update_issue_invoice_cron($issue_invoice);
			}
		}

		exit();
	}

	/* function for send notification of issue invoice */
    function sendMail($subject, $msg, $to, $cc = false, $from = 'no-reply@asialeap.com') {
        
        $this->load->library('email');
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
        $this->email->from($from);
        $this->email->to($to);
        if($cc != false) {
        	$this->email->cc($cc);
        }
        $this->email->subject($subject);
        $this->email->message($msg);
          
        if (!$this->email->send()) {
            return FALSE;
        } else {
        	return TRUE;
        }
    }	
}