<?php

/**
 * @defgroup pages_sectionEditor
 */

/**
 * @file pages/sectionEditor/index.php
 *
 * Copyright (c) 2003-2011 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @ingroup pages_sectionEditor
 * @brief Handle requests for section editor functions.
 *
 */

// $Id$

switch ($op) {
	//
	// Submission Tracking
	//
	case 'enrollSearch':
	case 'createReviewer':
	case 'createExternalReviewer':
	case 'suggestUsername':
	case 'enroll':
	case 'submission':
	case 'submissionRegrets':
	case 'submissionReview':
	case 'submissionEditing':
	case 'submissionHistory':
	case 'submissionCitations':
	case 'changeSection':
	case 'recordDecision':
	//if proposal is exempted, record reasons for exemption
	case 'recordReasonsForExemption':
	case 'selectReviewer':
	case 'notifyReviewer':
	case 'notifyAllReviewers':
	case 'userProfile':
	case 'clearReview':
	case 'cancelReview':
	case 'remindReviewer':
	case 'thankReviewer':
	case 'rateReviewer':
	case 'confirmReviewForReviewer':
	case 'uploadReviewForReviewer':
	case 'enterReviewerRecommendation':
	case 'makeReviewerFileViewable':
	case 'setDueDate':
	case 'viewMetadata':
	case 'saveMetadata':
	case 'removeArticleCoverPage':
	case 'editorReview':
	case 'selectCopyeditor':
	case 'notifyCopyeditor':
	case 'initiateCopyedit':
	case 'thankCopyeditor':
	case 'notifyAuthorCopyedit':
	case 'thankAuthorCopyedit':
	case 'notifyFinalCopyedit':
	case 'thankFinalCopyedit':
	case 'selectCopyeditRevisions':
	case 'uploadReviewVersion':
	case 'uploadCopyeditVersion':
	case 'completeCopyedit':
	case 'completeFinalCopyedit':
	case 'addSuppFile':
	case 'setSuppFileVisibility':
	case 'editSuppFile':
	case 'saveSuppFile':
	case 'deleteSuppFile':
	case 'deleteArticleFile':
	case 'archiveSubmission':
	case 'unsuitableSubmission':
	case 'restoreToQueue':
	case 'updateSection':
	case 'updateCommentsStatus':
	//
	// Layout Editing
	//
	case 'deleteArticleImage':
	case 'uploadLayoutFile':
	case 'uploadLayoutVersion':
	case 'assignLayoutEditor':
	case 'notifyLayoutEditor':
	case 'thankLayoutEditor':
	case 'uploadGalley':
	case 'editGalley':
	case 'saveGalley':
	case 'orderGalley':
	case 'deleteGalley':
	case 'proofGalley':
	case 'proofGalleyTop':
	case 'proofGalleyFile':
	case 'uploadSuppFile':
	case 'orderSuppFile':
	//
	// Submission History
	//
	case 'submissionEventLog':
	case 'submissionEventLogType':
	case 'clearSubmissionEventLog':
	case 'submissionEmailLog':
	case 'submissionEmailLogType':
	case 'clearSubmissionEmailLog':
	case 'addSubmissionNote':
	case 'removeSubmissionNote':
	case 'updateSubmissionNote':
	case 'clearAllSubmissionNotes':
	case 'submissionNotes':
	//
	// Misc.
	//
	case 'downloadFile':
	case 'viewFile':
	// Submission Review Form
	case 'clearReviewForm':
	case 'selectReviewForm':
	case 'previewReviewForm':
	case 'viewReviewFormResponse':
	// Proof Assignment Functions
	case 'selectProofreader':
	case 'notifyAuthorProofreader':
	case 'thankAuthorProofreader':
	case 'editorInitiateProofreader':
	case 'editorCompleteProofreader':
	case 'notifyProofreader':
	case 'thankProofreader':
	case 'editorInitiateLayoutEditor':
	case 'editorCompleteLayoutEditor':
	case 'notifyLayoutEditorProofreader':
	case 'thankLayoutEditorProofreader':
	//
	// Scheduling functions
	//
	case 'scheduleForPublication':
	 //
	 // Payments
	 //
	 case 'waiveSubmissionFee':
	 case 'waiveFastTrackFee':
	 case 'waivePublicationFee':
		define('HANDLER_CLASS', 'SubmissionEditHandler');
		import('pages.sectionEditor.SubmissionEditHandler');
		break;
	//
	// Submission Comments
	//
	case 'viewPeerReviewComments':
	case 'postPeerReviewComment':define('HANDLER_CLASS', 'SectionEditorHandler');
		import('pages.sectionEditor.SectionEditorHandler');
		break;
	case 'viewEditorDecisionComments':
	case 'blindCcReviewsToReviewers':
	case 'postEditorDecisionComment':
	case 'viewCopyeditComments':
	case 'postCopyeditComment':
	case 'emailEditorDecisionComment':
	case 'viewLayoutComments':
	case 'postLayoutComment':
	case 'viewProofreadComments':
	case 'postProofreadComment':
	case 'editComment':
	case 'saveComment':
	case 'deleteComment':
		define('HANDLER_CLASS', 'SubmissionCommentsHandler');
		import('pages.sectionEditor.SubmissionCommentsHandler');
		break;
	case 'index':
	case 'instructions':
		define('HANDLER_CLASS', 'SectionEditorHandler');
		import('pages.sectionEditor.SectionEditorHandler');
		break;
	case 'minutes':
	case 'createMinutes':
	case 'uploadMinutes':
	case 'viewMinutes':
	case 'uploadAnnouncements':
	case 'submitAnnouncements':
	case 'uploadAttendance':
	case 'submitAttendance':
	case 'selectInitialReview':
	case 'uploadInitialReview':
	case 'submitInitialReview':
	case 'completeInitialReviews':
	case 'setMinutesFinal':
		define('HANDLER_CLASS', 'MinutesHandler');
		import('pages.sectionEditor.MinutesHandler');
		break;
	case 'meetings':
	case 'setMeeting':
	case 'saveMeeting':
	case 'viewMeeting':
	case 'cancelMeeting':
	case 'setMeetingFinal':
	case 'notifyReviewersNewMeeting':
	case 'notifyReviewersChangeMeeting':
	case 'notifyReviewersFinalMeeting':
	case 'notifyReviewersCancelMeeting':
	case 'remindReviewersMeeting':
		define('HANDLER_CLASS', 'MeetingsHandler');
		import('pages.sectionEditor.MeetingsHandler');
		break;
}

?>
