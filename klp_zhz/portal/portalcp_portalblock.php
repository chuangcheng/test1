<?php echo '';exit;?>
<!--{template common/header}-->
<!--{if !$_G[inajax]}-->
<div id="pt" class="bm cl">
	<div class="z">
		<a href="./" class="nvhm" title="{lang homepage}">$_G[setting][bbname]</a> <em>&rsaquo;</em>
		<!--{if $_G['setting']['portalstatus'] }--><a href="$_G[setting][navs][1][filename]">{lang portal}</a> <em>&rsaquo;</em><!--{/if}-->
		<a href="portal.php?mod=portalcp"><!--{if $_G['setting']['portalstatus'] }-->{lang portal_manage}<!--{else}-->{lang portal_block_manage}<!--{/if}--></a> <em>&rsaquo;</em>
		<!--{if $_G['setting']['portalstatus'] }-->{lang block_management}<!--{/if}-->
	</div>
</div>

<div id="ct" class="ct2_a wp cl">
	<div class="mn">
		<h1 class="mt">{lang block_management}</h1>
		<div class="bm bw0">
			<div id="block_selection">
<!--{/if}-->

<!--{if $op=='recommend'}-->
	<!--{if $_GET['getdata']}-->
		<!--{subtemplate portal/portalcp_pageblock}-->
	<!--{else}-->
		<h3 class="flb">
			<em id="return_$_GET[handlekey]">{lang push}</em>
			<!--{if $_G[inajax]}--><span><a href="javascript:;" onclick="hideWindow('$_GET[handlekey]');" class="flbc" title="{lang close}">{lang close}</a></span><!--{/if}-->
		</h3>
		<script type="text/javascript" src="{$_G[setting][jspath]}portal.js?{VERHASH}"></script>
		<form id="recommendform" method="post" enctype="multipart/form-data" action="portal.php?mod=portalcp&ac=block&op=recommend&id=$_GET[id]&idtype=$_GET[idtype]" onsubmit="if(recommenditem_check()) { ajaxpost('recommendform','return_$_GET[handlekey]','return_$_GET[handlekey]','onerror');} return false;">
			<div class="c">
				<p{if $_G[inajax]} style="width:520px;"{/if}>
					<!--{if $tpls}-->
					{lang block_page}:
					<select name="targettplname" id="rtargettplname"class="ps vm" onchange="$('rsearchkey').value='';listblock_bypage('$_GET[id]', '$_GET[idtype]')">
						<option value="">{lang all_page}</option>
						<!--{loop $tpls $tpl $tplname}-->
							<option value="$tpl"{if $tpl == $_GET['targettplname']}selected{/if}>$tplname</option>
						<!--{/loop}-->
					</select><span class="klp_mhh"></span>
					<!--{/if}-->
					{lang block_id}:
					<input type="text" class="px vm" name="searchkey" id="rsearchkey" value="$_GET[searchkey]" />&nbsp;
					<button type="button" class="pn vm" onclick="listblock_bypage('$_GET[id]', '$_GET[idtype]')"><em>{lang find}</em></button>
				</p>
				<input type="hidden" name="recommend_bid" id="recommend_bid" value="" />
				<input type="hidden" name="recommend_thread_pid" id="recommend_thread_pid" value="$_GET[pid]" />
				<table class="tfm">
					<tbody id="itemeditarea">
						<!--{subtemplate portal/portalcp_pageblock}-->
					</tbody>
					<tbody id="olditemeditarea" style="display:none;"></tbody>
				</table>
			</div>
			<p class="o pns">
				<input type="hidden" name="formhash" value="{FORMHASH}" />
				<input type="hidden" name="recommendsubmit" value="1" />
				<input type="hidden" name="handlekey" value="$_GET['handlekey']" />
				<input type="hidden" name="referer" value="{echo dreferer()}">
				<!--{if ($_GET['idtype'] == 'tid' || $_GET['idtype'] == 'gtid')}-->
				<input type="hidden" class="px vm" name="recommendto" id="recommendto" value="" />&nbsp;
				<label for="showrecommendtip"><input type="checkbox" name="showrecommendtip" id="showrecommendtip" class="pc" fwin="mods" value="1">{lang show_push}</label>&nbsp;
				<label for="sendreasonpm"><input type="checkbox" name="sendreasonpm" id="sendreasonpm" class="pc"{if $_G['group']['reasonpm'] == 2 || $_G['group']['reasonpm'] == 3} checked="checked" disabled="disabled"{/if} value="1"/>{lang admin_pm}</label>&nbsp;
				<!--{/if}-->
				<button type="submit" class="pn pnc" value="true"><strong>{lang submit}</strong></button>
			</p>
		</form>
		<script type="text/javascript" reload="1">
			function errorhandle_recommenditem(message) {
				var editarea = $('itemeditarea');
				ajaxinnerhtml(editarea, '<tr><td>&nbsp;</td><td>' + message + '</td></tr>');
			}
			ajaxupdateevents($('itemeditarea'));
		</script>
	<!--{/if}-->

<!--{else}-->
	<form action="portal.php?mod=portalcp&ac=portalblock&op=$op" method="get" class="mbm">
		<input type="hidden" name="mod" value="portalcp" />
		<input type="hidden" name="ac" value="portalblock" />
		<input type="hidden" name="op" value="$op" />
		<!--{if $tpls}-->
		{lang block_page}:
		<select name="targettplname" class="vm" onchange="this.form.submit();">
			<option value="">{lang all_page}</option>
			<!--{loop $tpls $tpl $tplname}-->
				<option value="$tpl"{if $tpl == $_GET['targettplname']}selected{/if}>$tplname</option>
			<!--{/loop}-->
		</select>&nbsp;
		<!--{/if}-->
		{lang block_id}:
		<input type="text" class="px vm" name="searchkey" id="searchkey" value="$_GET[searchkey]" />&nbsp;
		<button type="submit" class="pn vm"><em>{lang find}</em></button>
	</form>

	<!--{if !empty($_GET['targettplname'])}-->
		<p>
			{lang view_select_mod}<a href="portal.php?mod=portalcp&ac=portalblock" class="xi2">{lang click_return_list}</a>
		</p>
	<!--{/if}-->
	<!--{if $blocks}-->
		<!--{if in_array($op, array('getblocklist', 'verifydata', 'verifieddata'))}-->
			{eval
			$addurl = $_GET['targettplname'] ? '&targettplname='.$_GET['targettplname'] : '';
			$addurl .= $_GET['searchkey'] ? '&searchkey='.$_GET['searchkey'] : '';
			$_block = count($blocks) == 1 ? current($blocks) : array();
			}
			<ul class="tb cl">
				<!--{if $_GET['searchkey'] && $_block}-->
					<li{if $op === 'getblocklist'} class="a"{/if}><a href="portal.php?mod=portalcp&ac=portalblock&op=getblocklist$addurl">$_block['name']</a></li>
				<!--{else}-->
					<li{if $op === 'getblocklist'} class="a"{/if}><a href="portal.php?mod=portalcp&ac=portalblock&op=getblocklist">{lang block_list}</a></li>
				<!--{/if}-->
				<li{if $op === 'verifydata'} class="a"{/if}><a href="portal.php?mod=portalcp&ac=portalblock&op=verifydata$addurl">{lang block_verifydata}</a></li>
				<li{if $op === 'verifieddata'} class="a"{/if}><a href="portal.php?mod=portalcp&ac=portalblock&op=verifieddata$addurl">{lang block_verifieddata}</a></li>
				<!--{if $_GET['searchkey'] && $_block}-->
					<li class="o"><a href="portal.php?mod=portalcp&ac=portalblock&op=getblocklist">{lang return}{lang block_list}</a></li>
				<!--{/if}-->
			</ul>
			<form action="portal.php?mod=portalcp&ac=portalblock&op=$op" method="post">
		<!--{/if}-->
			<table class="dt mtm">
			<!--{if $initemdata}-->
				<!--{if $blockdata}-->
					<!--{if $op === 'verifieddata'}-->
						<tr>
							<th width="40">{lang delete}</th>
							<th>{lang display_order}</th>
							<th>{lang title}</th>
							<th>{lang block_page}</th>
							<th>{lang block_id}</th>
							<th>{lang pass_moderate_time}</th>
							<th>{lang is_stick}</th>
							<th width="80">{lang operation}</th>
						</tr>
						<!--{loop $blockdata $value}-->
						<tr>
							<td><input type="checkbox" class="pc" name="ids[]" value="$value[dataid]" /></td>
							<td><input type="hidden" name="olddisplayorder[{$value[dataid]}]" value="$value[displayorder]" />
								<input type="input" class="px" name="displayorder[{$value[dataid]}]" value="$value[displayorder]" size="2" maxlength="4" /></td>
							<td><a href="$value[url]" target="_blank">$value['title']</a></td>
							<!--{eval $page = empty($blocks[$value[bid]]['page']) ? '{lang unused}' : implode('<br/>' ,$blocks[$value[bid]]['page']);}-->
							<td>$page</td>
							<td><a href="portal.php?mod=portalcp&ac=block&bid=$value[bid]" target="_blank">$blocks[$value[bid]][name]</a></td>
							<td>$value['verifiedtime']</td>
							<td><!--{if $value['stickgrade']}-->{lang stick} $value[stickgrade]<!--{else}-->{lang no}<!--{/if}--></td>
							<td>
								<a href="portal.php?mod=portalcp&ac=block&op=managedata&bid=$value[bid]&dataid=$value[dataid]{if $_GET[from]}&from=$_GET[from]{/if}" onclick="showWindow('showblock', this.getAttribute('href'));">{lang edit}</a>
							</td>
						</tr>
						<!--{/loop}-->
						<tr>
							<td colspan="8">
								<label for="chkall" onclick="checkall(this.form, 'ids')"><input type="checkbox" name="chkall" id="chkall" class="pc" />{lang select_all}</label>
								<input type="hidden" name="handlekey" value="$_GET['handlekey']" />
								<input type="hidden" name="verifieddatasubmit" value="true" />
								<input type="hidden" name="formhash" value="{FORMHASH}" />
								<button type="submit" class="pn pnc"><strong>{lang confirms}</strong></button>
							</td>
						</tr>
					<!--{elseif $op === 'verifydata'}-->
						<tr>
							<th width="40">{lang select}</th>
							<th>{lang title}</th>
							<th>{lang block_page}</th>
							<th>{lang block_id}</th>
							<th>{lang push_people}</th>
							<th>{lang push_dateline}</th>
							<th width="80">{lang block_operation}</th>
						</tr>
						<!--{loop $blockdata $value}-->
						<tr>
							<td><input type="checkbox" name="ids[]" class="pc" value="$value[dataid]" /></td>
							<td><a href="$value[url]" target="_blank">$value[title]</a></td>
							<!--{eval $page = empty($blocks[$value[bid]]['page']) ? '{lang unused}' : implode('<br/>' ,$blocks[$value[bid]]['page']);}-->
							<td>$page</td>
							<td><a href="portal.php?mod=portalcp&ac=block&bid=$value[bid]" target="_blank">$blocks[$value[bid]][name]</a></td>
							<td><a href="home.php?uid=$value[uid]" target="_blank">$value[username]</a></td>
							<td>$value[dateline]</td>
							<td>
								<a href="portal.php?mod=portalcp&ac=block&op=verifydata&bid=$value[bid]&dataid=$value[dataid]" onclick="showWindow('verifydata', this.href, 'get', 0)" class="xi2">{lang moderate}</a>
							</td>
						</tr>
						<!--{/loop}-->
						<tr>
							<td colspan="7">
								<label for="chkall" onclick="checkall(this.form, 'ids')"><input type="checkbox" name="chkall" id="chkall" class="pc" />{lang select_all}</label>
								<label for="op_delete"><input id="op_delete" class="pr" value="delete" name="optype" type="radio">{lang delete}</label>
								<label for="op_pass"><input id="op_pass" class="pr" value="pass" name="optype" type="radio">{lang passed}</label>
								<input type="hidden" name="verifydatasubmit" value="1" />
								<input type="hidden" name="formhash" value="{FORMHASH}" />
								<button type="submit" value="true" name="trashsubmit" class="pn vm"><em>{lang submit}</em></button>
								[{lang update_block_tips}]
							</td>
						</tr>
					<!--{/if}-->
				<!--{else}-->
					<tr><td>{lang no_data}</td></tr>
				<!--{/if}-->
			<!--{else}-->
				<!--{if $blocks}-->
					<tr>
						<th width="50">&nbsp;</th>
						<th width="260">{lang block_id}</th>
						<th>{lang mod_category}</th>
						<th>{lang block_data_source}</th>
						<th>{lang block_page}</th>
						<th width="120">{lang block_operation}</th>
					</tr>
					<!--{loop $blocks $block}-->
					<tr>
						<!--{if $op == 'getblocklist'}-->
						<td><!--{if $block['cachetime']}--><input type="checkbox" name="bids[]" class="pc" value="$block[bid]" /><!--{/if}--></td>
						<!--{eval $updatetime = $block['cachetime'] ? $block['cachetime'] - (TIMESTAMP - $block['dateline']) : false;}-->
						<td title="{if $updatetime > 0 }$updatetime{lang block_not_in_updateline}{elseif $updatetime !== false }{lang block_in_updateline}{else}{/if}"{if !$block[favorite]} onmouseover="display('bfav_$block[bid]');" onmouseout="display('bfav_$block[bid]');"{/if}>$block[name] <a href="javascript:;" id="bfav_$block[bid]" onclick="blockFavorite($block[bid]);"{if !$block[favorite]} style="visibility:hidden"{/if}><!--{if $block[favorite]}--><img src="{IMGDIR}/fav.gif" alt="fav" title="{lang block_cancel_favorite}" class="favmark" /><!--{else}--><img src="{IMGDIR}/fav_grey.gif" alt="normal" title="{lang block_favorite}" class="favmark" /><!--{/if}--></a></td>
						<!--{else}-->
						<td{if !$block[favorite]} onmouseover="display('bfav_$block[bid]');" onmouseout="display('bfav_$block[bid]');"{/if}>$block[name] <a href="javascript:;" id="bfav_$block[bid]" onclick="blockFavorite($block[bid]);"{if !$block[favorite]} style="visibility:hidden"{/if}><!--{if $block[favorite]}--><img src="{IMGDIR}/fav.gif" alt="fav" title="{lang block_cancel_favorite}" class="favmark" /><!--{else}--><img src="{IMGDIR}/fav_grey.gif" alt="normal" title="{lang block_favorite}" class="favmark" /><!--{/if}--></a></td>
						<!--{/if}-->
						<td>$block[blockclassname]</td>
						<td>$block[datasrc]</td>
						<!--{eval $page = empty($block['page']) ? '{lang unused}' : implode('<br/>' ,$block['page']);}-->
						<td>$page</td>
						<td>
							<!--{if $block['perm']['allowproperty']}-->
							<a href="portal.php?mod=portalcp&ac=block&op=block&bid=$block[bid]" target="_blank">{lang property}</a>
							<!--{else}-->
							{lang unoperation}
							<!--{/if}-->
							<!--{if $block['perm']['allowdata']}-->
							<a href="portal.php?mod=portalcp&ac=block&op=data&bid=$block[bid]" target="_blank">{lang data}</a>
							<!--{else}-->
							{lang unoperation}
							<!--{/if}-->
							<!--{if $block['isrecommendable']}-->
							<a href="portal.php?mod=portalcp&ac=portalblock&op=verifydata&searchkey=$block[bid]">{lang moderate}</a>
							<a href="portal.php?mod=portalcp&ac=portalblock&op=verifieddata&searchkey=$block[bid]">{lang block_itemdata}</a>
							<!--{else}-->
							{lang unoperation}
							{lang unoperation}
							<!--{/if}-->
						</td>
					</tr>
					<!--{/loop}-->
					<!--{if $op == 'getblocklist'}-->
					<tr>
						<td>
							<label for="chkall"><input type="checkbox" name="chkall" id="chkall" class="pc" onclick="checkall(this.form, 'bids')" />{lang select_all}</label>
						</td>
						<td colspan="5">
							<input type="hidden" name="{$op}submit" value="1" />
							<input type="hidden" name="formhash" value="{FORMHASH}" />
							<button type="submit" value="true" name="submit" class="pn"><em>{lang push_updateblock}</em></button>
							<img src="{IMGDIR}/faq.gif" alt="Tip" class="vm" onmouseover="showTip(this)" tip="{lang push_updateblock_tips}" />
						</td>
					</tr>
					<!--{/if}-->
				<!--{else}-->
					<tr><td>{lang no_data}</td></tr>
				<!--{/if}-->
			<!--{/if}-->
			</table>
			<!--{if $multi}--><div class="pgs mtn cl">$multi</div><!--{/if}-->
		<!--{if in_array($op, array('getblocklist', 'verifydata', 'verifieddata'))}-->
		</form>
		<!--{/if}-->

	<!--{else}-->
		<p class="emp">{lang block_no_managable}</p>
	<!--{/if}-->
<!--{/if}-->

<!--{if !$_G[inajax]}-->
			</div>
		</div>
	</div>
	<div class="appl">
		<!--{subtemplate portal/portalcp_nav}-->
	</div>
</div>
<!--{/if}-->
<!--{template common/footer}-->