<?php

/**
 * @file classes/journal/Section.inc.php
 *
 * Copyright (c) 2003-2011 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class Section
 * @ingroup journal
 * @see SectionDAO
 *
 * @brief Describes basic section properties.
 */

// $Id$


class Institution extends DataObject {

	/**
	 * Constructor.
	 */
	function Institution() {
		parent::DataObject();
	}

	/**
	 * Get localized institution name by ID.
	 * @return string
	 */

	/**
	 * Get localized institution name.
	 * @return string
	 */
	function getInstitution() {
		return $this->getData('institution');
	}
	/**
	 * Get localized region.
	 * @return string
	 */
	function getRegion() {
		return $this->getData('region');
	}

	function getRegionText() {
		$regionDAO =& DAORegistry::getDAO('RegionsOfPhilippinesDAO');
		return $regionDAO->getRegionOfPhilippines($this->getRegion());
	}
	

	/**
	 * Set institution.
	 * @param $institution string
	 * @param $locale string
	 */
	function setInstitution($institution) {
		return $this->setData('institution', $institution);
	}

	function setRegion($region) {
		return $this->setData('region', $region);
	}

// Region of the ERC in section_settings
	
}

?>
