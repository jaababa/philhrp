{**
 * sections.tpl
 *
 * Copyright (c) 2003-2011 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Display list of sections in journal management.
 *
 * $Id$
 *}
{strip}
{assign var="pageTitle" value="section.institutions"}
{include file="common/header.tpl"}
{/strip}
<script type="text/javascript">
{literal}
$(document).ready(function() { setupTableDND("#dragTable", "moveSection"); });
{/literal}
</script>
<br/>
<div id="institution">
<table width="100%" class="listing" id="dragTable">

	<tr>
		<td class="headseparator" colspan="3">&nbsp;</td>
	</tr>
	<tr class="heading" valign="bottom">
		<td width="50%">{*translate key="institution.name"*}{sort_heading key="institution.name" sort="institution"}</td>
		<td width="20%">{*translate key="institution.region"*}{sort_heading key="institution.region" sort="region"}</td>
		<td width="15%" align="right">{translate key="common.action"}</td>
	</tr>
	<tr>
		<td class="headseparator" colspan="3">&nbsp;</td>
	</tr>
{iterate from=institutions item=institution name=institutions}
	<tr valign="top" class="data">
		<td class="drag">{$institution->getInstitution()}</td>
		<td class="drag">{$institution->getRegionText()}</td>
		<td align="right" class="nowrap">
			<a href="{url op='editInstitution' path=$institution->getId()}" class="action">{translate key="common.edit"}</a>
			&nbsp;|&nbsp;
			<a href="{url op='deleteInstitution' path=$institution->getId()}" onclick="return confirm('Delete this institution?')" class="action">{translate key="common.delete"}</a>
			&nbsp;
		</td>
	</tr>

{/iterate}
	<tr>
		<td colspan="3" class="endseparator">&nbsp;</td>
	</tr>
{if $institutions->wasEmpty()}
	<tr>
		<td colspan="3" class="nodata">{translate key="manager.institution.noneCreated"}</td>
	</tr>
	<tr>
		<td colspan="3" class="endseparator">&nbsp;</td>
	</tr>
{else}
	<tr>
		<td align="left">{page_info iterator=$institutions}</td>
		<td colspan="3" align="right">{page_links anchor="institutions" name="institutions" iterator=$institutions sort=$sort sortDirection=$sortDirection}</td>
	</tr>
{/if}
</table>
<a class="action" href="{url op="createInstitution"}">{translate key="manager.institutions.create"}</a>
</div>

{include file="common/footer.tpl"}

