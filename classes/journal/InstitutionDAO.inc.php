<?php

/**
 * @file classes/journal/ErcReviewersDAO.inc.php
 *
 *
 * @class ErcReviewersDAO
 * @ingroup journal
 *
 * @brief Class for DAO relating erc to reviewers.
 */

// $Id$
import ('classes.journal.Institution');
class InstitutionDAO extends DAO {

	/*
	 *Returns all institution in the database
	 * */
	function &getAllInstitutions($rangeInfo = null, $sortBy, $sortDirection) {

		$params = array($sort, $sortDirection);
		$sql = 'SELECT * FROM institutions'
		
		$result =& $this->retrieveRange(
			$sql.($sortBy?(' ORDER BY ' . $this->getSortMapping($sortBy). ' '. 
		$result =& $this->retrieveRange(
			$sql.($sortBy?(' ORDER BY ' . $this->getSortMapping($sortBy) . ' ' . $this->getDirectionMapping($sortDirection)) : ''),
				count($params)===1?array_shift($params):$params,
				$rangeInfo
		);		

		/*
		while (!$result->EOF) {
			//$row = $result->GetRowAssoc(false);
			$row = $this->_returnInstitutionFromRow($result->GetRowAssoc(false));
			$institution[] = $row;
			$result->moveNext();
		}
		*/
		$institution = new DAOResultFactory($result, $this, '_returnInstitutionFromRow');
		return $institution;
	}

/*
	 * Return institution object using the institutionID
	 */
	function getInstitutionById($institutionId = null){
		$result =& $this->retrieve(
			"SELECT * FROM institutions WHERE institution_id = '$institutionId'"
		);
		$institution = $this->_returnInstitutionFromRow($result->GetRowAssoc(false));
		
		return $institution;
	}

	function insertInstitution(&$institution){
		
		$this->update(
			'INSERT INTO institutions
				(institution, region_code)
				VALUES
				(?,?)',
			array(
				$institution->getInstitution(),
				$institution->getRegion()
			)
		);

	}
	
	function deleteInstitutionById($institutionId) {
		return $this->update('DELETE FROM institutions WHERE institution_id = ?', array($institutionId));
	}
	
	function updateInstitution(&$institution){
		/*
		print_r($institution->getId());
		print_r($institution->getInstitution());
		print_r($institution->getRegion());
		$outId = $institution->getId();
		$outIns = $institution->getInstitution();
		$outReg = $institution->getRegion();
		$query =' UPDATE institutions
				SET
					institution = "'.$outIns.'",
					region_code = "'.$outReg.'",
				WHERE institution_id = '.$outId;
		print_r($query);
		break;*/
		return $this->update(
			'UPDATE institutions
				SET
					institution = ?,
					region_code = ?
				WHERE institution_id = ?',
			array(
				$institution->getInstitution(),
				$institution->getRegion(),
				$institution->getId()
			)
		);
	}
	/**
	 * Internal function to return a Institution object from a row.
	 * @param $row array
	 * @return Section
	 */
	function &_returnInstitutionFromRow(&$row) {
		$philRegions =& DAORegistry::getDAO('RegionsOfPhilippinesDAO');
		$institution = new Institution();
		$institution->setId($row['institution_id']);
		$institution->setInstitution($row['institution']);
		/*
			$regionCode = $row['region_code'];
			$regionName = $philRegions->getRegionOfPhilippines($regionCode);
			$institution->setRegion($regionName);
		*/
		$institution->setRegion($row['region_code']);

		HookRegistry::call('InstitutionDAO::_returnInstitutionFromRow', array(&$institution, &$row));

		return $institution;
	}
}

?>
