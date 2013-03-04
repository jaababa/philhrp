{**
 * fullReview.tpl
 * Show reviewer's submissions for full review.
 *
 * $Id$
 *}
 {if !$dateFrom}
{assign var="dateFrom" value="--"}
{/if}

{if !$dateTo}
{assign var="dateTo" value="--"}
{/if}

<div id="submissions">
<table class="listing" width="100%">
	<tr><td colspan="6"><strong>PROPOSALS FOR FULL REVIEW</strong></td></tr>
	<tr><td colspan="6" class="headseparator">&nbsp;</td></tr>
	<tr class="heading" valign="bottom">
		<td width="20%">PROPOSAL ID</td> <!-- Replaced id with ID, SPF, 21 Dec 2011 -->
		<td width="20%">Date submitted</td>
		<td width="40%">{translate key="article.title" sort='title'}</td>
		<td width="20%">Investigator</td>
	</tr>
	<tr><td colspan="6" class="headseparator">&nbsp;</td></tr>
{assign var="count" value=0}
{iterate from=submissionsForFullReview item=submission}
	{assign var="articleId" value=$submission->getArticleId()}
		<tr valign="top">
			<td>{$submission->getLocalizedWhoId()|escape}</td>
			<td>{$submission->getDateSubmitted()|date_format:$dateFormatLong}</td>
			<td><a href="{url op="submissionForFullReview" path=$articleId}" class="action">{$submission->getLocalizedTitle()|escape}</a></td>
			<td>{$submission->getFirstAuthor(true)|truncate:40:"..."|escape}</td>
		</tr>
		
		
		<td colspan="6" class="separator">&nbsp;</td>
		{assign var="count" value=$count+1}
{/iterate}
{if $count==0}
	<tr>
		<td colspan="6" class="nodata">{translate key="submissions.noSubmissions"}</td>
	</tr>
	<tr>
		<td colspan="6" class="endseparator">&nbsp;</td>
	</tr>
{else}
	<tr>
		<td colspan="6" class="endseparator">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="6" align="left">{$count} submission(s) for Full Review</td>
	</tr>
{/if}
</table>
</div>


