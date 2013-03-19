<?php

/**
 * @file classes/manager/form/SectionForm.inc.php
 *
 * Copyright (c) 2003-2011 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class SectionForm
 * @ingroup manager_form
 *
 * @brief Form for creating and modifying journal sections.
 */

// $Id$

import('lib.pkp.classes.form.Form');

class InstitutionForm extends Form {

	/** @var $sectionId int The ID of the section being edited */
	var $institutionId;

	/** @var $includeSectionEditor object Additional section editor to
	 *       include in assigned list for this section
	 */
	var $includeSectionEditor;

	/** @var $omitSectionEditor object Assigned section editor to omit from
	 *       assigned list for this section
	 */
	var $omitSectionEditor;

	/** @var $sectionEditors array List of user objects representing the
	 *       available section editors for this journal.
	 */
	var $sectionEditors;

	/**
	 * Constructor.
	 * @param $journalId int omit for a new journal
	 */
	function InstitutionForm($institutionId = null) {
		parent::Form('manager/institutions/institutionForm.tpl');
		$this->institutionId = $institutionId;

		// Validation checks for this form
		$this->addCheck(new FormValidator($this, 'title', 'required', 'manager.institutions.form.nameRequired'));
		$this->addCheck(new FormValidator($this, 'region', 'required', 'manager.institutions.form.regionRequired'));
		/*
		$this->addCheck(new FormValidatorCustom($this, 'title', 'required', 'manager.sections.form.titleAlreadyUsed', array(DAORegistry::getDAO('SectionDAO'), 'ercExistsByTitle'), array($this->sectionId), true));
		$this->addCheck(new FormValidatorCustom($this, 'abbrev', 'required', 'manager.sections.form.abbrevAlreadyInUsed', array(DAORegistry::getDAO('SectionDAO'), 'ercExistsByAbbrev'), array($this->sectionId), true));
		
		$this->addCheck(new FormValidatorPost($this));
		$this->addCheck(new FormValidatorCustom($this, 'reviewFormId', 'optional', 'manager.sections.form.reviewFormId', array(DAORegistry::getDAO('ReviewFormDAO'), 'reviewFormExists'), array(ASSOC_TYPE_JOURNAL, $journal->getId())));
		$this->includeSectionEditor = $this->omitSectionEditor = null;

		// Get a list of section editors for this journal.
		$roleDao =& DAORegistry::getDAO('RoleDAO');
		$this->sectionEditors =& $roleDao->getUsersByRoleId(ROLE_ID_SECTION_EDITOR, $journal->getId());
		$this->sectionEditors =& $this->sectionEditors->toArray();
		*/
	}

	/**
	 * When displaying the form, include the specified section editor
	 * in the assigned list for this section.
	 * @param $sectionEditorId int
	 
	function includeSectionEditor($sectionEditorId) {
		foreach ($this->sectionEditors as $key => $junk) {
			if ($this->sectionEditors[$key]->getId() == $sectionEditorId) {
				$this->includeSectionEditor =& $this->sectionEditors[$key];
			}
		}
	}

	/**
	 * When displaying the form, omit the specified section editor from
	 * the assigned list for this section.
	
	function omitSectionEditor($sectionEditorId) {
		foreach ($this->sectionEditors as $key => $junk) {
			if ($this->sectionEditors[$key]->getId() == $sectionEditorId) {
				$this->omitSectionEditor =& $this->sectionEditors[$key];
			}
		}
	}

	/**
	 * Get the names of fields for which localized data is allowed.
	 * @return array
	
	function getLocaleFieldNames() {
		$sectionDao =& DAORegistry::getDAO('SectionDAO');
		return $sectionDao->getLocaleFieldNames();
	}

	/**
	 * Display the form.
	 */
	function display() {
		$journal =& Request::getJournal();
		$templateMgr =& TemplateManager::getManager();
		
		$templateMgr->assign('institutionId', $this->institutionId);
/*
		$templateMgr->assign('commentsEnabled', $journal->getSetting('enableComments'));
		$templateMgr->assign('helpTopicId','journal.managementPages.sections');

		$reviewFormDao =& DAORegistry::getDAO('ReviewFormDAO');
		$reviewForms =& $reviewFormDao->getActiveByAssocId(ASSOC_TYPE_JOURNAL, $journal->getId());
		$reviewFormOptions = array();
		while ($reviewForm =& $reviewForms->next()) {
			$reviewFormOptions[$reviewForm->getId()] = $reviewForm->getLocalizedTitle();
		}
		$templateMgr->assign_by_ref('reviewFormOptions', $reviewFormOptions);
*/
		// Get list of regions of Philippines
		// Added by EL February 11th 2013
       		$regionDAO =& DAORegistry::getDAO('RegionsOfPhilippinesDAO');
        	$regions =& $regionDAO->getRegionsOfPhilippines();
        	$templateMgr->assign_by_ref('regions', $regions);
        
		parent::display(); 
	}

	/**
	 * Initialize form data from current settings.
	 */
	function initData() {
		if (isset($this->institutionId)) {
			$institutionDao =& DAORegistry::getDAO('InstitutionDAO');
			$institution =& $institutionDao->getInstitutionById($this->institutionId);
			
			$this->_data = array(
				'institution' => $institution->getInstitution(), // Localized
				'region' => $institution->getRegion(), // Localized
			);
		}
	}

	/**
	 * Assign form data to user-submitted data.
	 * Added region
	 * EL on February 11th 2013
	*/
	function readInputData() {
	
		$this->readUserVars(array('title', 'region'));
	}

	/**
	 * Save institution.
	*/
	function execute() {

		$institutionDao =& DAORegistry::getDAO('InstitutionDAO');

		if (isset($this->institutionId)) {
			$institution =& $institutionDao->getInstitutionById($this->institutionId);
		}
		
		if (!isset($institution))
			$institution = new Institution();
		
		$institution->setInstitution($this->getData('title'), null);
		$institution->setRegion($this->getData('region'), null);
		
		if ($institution->getId() != null)
			$institutionDao->updateInstitution($institution);
		else
			$institutionDao->insertInstitution($institution);
		/*
		
		$section->setTitle($this->getData('title'), null); // Localized
		
		// Added region
		// EL on Febraurt 11th 2013
			$section->setRegion($this->getData('region'), null);
		
		$reviewFormId = $this->getData('reviewFormId');
		if ($reviewFormId === '') $reviewFormId = null;
		$section->setReviewFormId($reviewFormId);
		$section->setMetaIndexed($this->getData('metaIndexed') ? 0 : 1); // #2066: Inverted
		$section->setMetaReviewed($this->getData('metaReviewed') ? 0 : 1); // #2066: Inverted
		$section->setAbstractsNotRequired($this->getData('abstractsNotRequired') ? 1 : 0);
		$section->setIdentifyType($this->getData('identifyType'), null); // Localized
		$section->setEditorRestricted($this->getData('editorRestriction') ? 1 : 0);
		$section->setHideTitle($this->getData('hideTitle') ? 1 : 0);
		$section->setHideAuthor($this->getData('hideAuthor') ? 1 : 0);
		$section->setHideAbout($this->getData('hideAbout') ? 1 : 0);
		$section->setDisableComments($this->getData('disableComments') ? 1 : 0);
		$section->setPolicy($this->getData('policy'), null); // Localized
		$section->setAbstractWordCount($this->getData('wordCount'));

		if ($section->getId() != null) {
			$sectionDao->updateSection($section);
			$sectionId = $section->getId();

		} else {
			$sectionId = $sectionDao->insertSection($section);
			$sectionDao->resequenceSections($journalId);
		}

		// Save assigned editors
		$assignedEditorIds = Request::getUserVar('assignedEditorIds');
		if (empty($assignedEditorIds)) $assignedEditorIds = array();
		elseif (!is_array($assignedEditorIds)) $assignedEditorIds = array($assignedEditorIds);
		$sectionEditorsDao =& DAORegistry::getDAO('SectionEditorsDAO');
		$sectionEditorsDao->deleteEditorsBySectionId($sectionId, $journalId);
		foreach ($this->sectionEditors as $key => $junk) {
			$sectionEditor =& $this->sectionEditors[$key];
			$userId = $sectionEditor->getId();
			// We don't have to worry about omit- and include-
			// section editors because this function is only called
			// when the Save button is pressed and those are only
			// used in other cases.
			if (in_array($userId, $assignedEditorIds)) $sectionEditorsDao->insertEditor(
				$journalId,
				$sectionId,
				$userId,
				Request::getUserVar('canReview' . $userId),
				Request::getUserVar('canEdit' . $userId)
			);
			unset($sectionEditor);
		}
		*/
	}
}

?>
