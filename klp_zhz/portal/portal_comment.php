<?php echo '';exit;?>
     <div class="content-box klp_catwp"> 
      <div class="toolhd" style="border:none; margin-bottom:5px"> 
       <!--{if $data[commentnum]}--><h3 class="comments-title"><a href="$common_url">评论</a><span>($data[commentnum])</span></h3><!--{/if}-->
      </div> 

      <div id="respond" class="cmt_answer"> 
       <div class="comt"> 
        <div class="cmt_con"> 
              <!--{if !empty($pricount)}-->
			<p class="mtn mbn y">{lang hide_portal_comment}</p>
		<!--{/if}-->
        
        		<!--{if !$data[htmlmade]}-->
			<form id="cform" name="cform" action="$form_url" method="post" autocomplete="off">
                <!--{if $_G['uid']}-->
				<textarea name="message" class="cmt_inputtext" id="message" placeholder="发表评论" onkeydown="ctrlEnter(event, 'commentsubmit_btn');"></textarea>
                <!--{else}-->
                <textarea disabled="disabled" placeholder="请您先登录" class="cmt_inputtext cmt_inputtextdis" rows="4"></textarea> 
                <!--{/if}-->
				<!--{if $secqaacheck || $seccodecheck}-->
					<!--{block sectpl}--><sec> <span id="sec<hash>" onclick="showMenu(this.id);"><sec></span><div id="sec<hash>_menu" class="p_pop p_opt klp_popt" style="display:none"><sec></div><!--{/block}-->
					<div class="mtm"><!--{subtemplate common/seccheck}--></div>
				<!--{/if}-->
				<!--{if !empty($topicid) }-->
					<input type="hidden" name="referer" value="$topicurl#comment" />
					<input type="hidden" name="topicid" value="$topicid">
				<!--{else}-->
					<input type="hidden" name="portal_referer" value="$viewurl#comment">
					<input type="hidden" name="referer" value="$viewurl#comment" />
					<input type="hidden" name="id" value="$data[id]" />
					<input type="hidden" name="idtype" value="$data[idtype]" />
					<input type="hidden" name="aid" value="$aid">
				<!--{/if}-->
				<input type="hidden" name="formhash" value="{FORMHASH}">
				<input type="hidden" name="replysubmit" value="true">
				<input type="hidden" name="commentsubmit" value="true" />
				<button type="submit" name="commentsubmit_btn" id="commentsubmit_btn" value="true" class="cmt_sbm"><!--{if $_G['uid']}-->{lang comment}<!--{else}--><a href="member.php?mod=logging&action=login" class="klp_login">请您先登录</a><!--{/if}--></button>
			</form>
		<!--{/if}-->
        </div> 
       </div> 
      </div> 
      <div id="postcomments" class="postcomments"> 
       <ol class="commentlist"> 
       		<!--{loop $commentlist $comment}-->
		<!--{template portal/comment_li}-->
		<!--{if !empty($aimgs[$comment[cid]])}-->
			<script type="text/javascript" reload="1">aimgcount[{$comment[cid]}] = [<!--{echo implode(',', $aimgs[$comment[cid]]);}-->];attachimgshow($comment[cid]);</script>
		<!--{/if}-->
		<!--{/loop}-->
       </ol> 
        
      </div> 
     </div>
