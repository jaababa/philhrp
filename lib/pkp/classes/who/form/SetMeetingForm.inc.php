<?php

/**
 * @defgroup sectionEditor_form
 */

/**
 * @file lib/pkp/classes/who/SetMeetingForm.inc.php
 *
 * Added by MSB. Last Updated: July 14, 2011
 * @class SetMeetingForm
 * @ingroup sectionEditor_form
 *
 * Last updated by EL on February 25, 2013
 *
 * @brief Form for section editors to create meeting.
 */


import('lib.pkp.classes.form.Form');

class SetMeetingForm extends Form {

	/**
	 * Constructor.
	 */
	function SetMeetingForm(&$request) {
		parent::Form('sectionEditor/meetings/setMeeting.tpl');
		$site =& Request::getSite();
		$user =& Request::getUser();
		
		// Validation checks for this form
		$this->addCheck(new FormValidatorPost($this));
		$this->addCheck(new FormValidator($this,'meetingDate', 'required', 'editor.meetings.form.meetingDateRequired'));
		$this->addCheck(new FormValidator($this,'meetingLength', 'required', 'editor.meetings.form.meetingLengthRequired'));
		$this->addCheck(new FormValidator($this,'investigator', 'required', 'editor.meetings.form.meetingInvestigatorRequired'));
		$this->addCheck(new FormValidator($this,'selectedProposals', 'required', 'editor.meetings.form.selectAtleastOneProposal'));
	}
	
	/**
	 * Assign form data to user-submitted data.
	 */
	function readInputData() {
		$this->readUserVars(array(
			'selectedProposals',
			'meetingDate',
			'meetingLength',
			'location',
			'investigator',
			'meetingId'
		));
	
	}


	/**
	 * Display the form.
	 */
	function display(&$args) {

		$meetingId = isset($args[0]) ? $args[0]: 0;
		$journal =& Request::getJournal();
		$journalId = $journal->getId();
		$user =& Request::getUser();

		$site =& Request::getSite();
		
		$sectionEditorSubmissionDao =& DAORegistry::getDAO('SectionEditorSubmissionDAO');
		
		$submissions =& $sectionEditorSubmissionDao->getSectionEditorSubmissionsForErcReview(
			$user->getCommitteeId(),
			$journalId
		);
	
		/*Get the selected submissions to be reviewed*/
		$meetingDao =& DAORegistry::getDAO('MeetingDAO');
		$meeting =& $meetingDao->getMeetingById($meetingId);

		/*Get the selected submissions to be reviewed*/
		$meetingSubmissionDao =& DAORegistry::getDAO('MeetingSubmissionDAO');
		$selectedSubmissions =$meetingSubmissionDao->getMeetingSubmissionsByMeetingId($meetingId);
		$templateMgr =& TemplateManager::getManager();
		$templateMgr->assign('meetingId', $meetingId);
		$templateMgr->assign('meetingDate', $meeting->getDate());
		$templateMgr->assign('meetingLength', $meeting->getLength());
		$templateMgr->assign('location', $meeting->getLocation());
		$templateMgr->assign('investigator', $meeting->getInvestigator());
		$templateMgr->assign_by_ref('submissions', $submissions);
		$templateMgr->assign_by_ref('selectedProposals', $selectedSubmissions);
		$templateMgr->assign('baseUrl', Config::getVar('general', "base_url"));
		parent::display();
	}

	
}

?>
