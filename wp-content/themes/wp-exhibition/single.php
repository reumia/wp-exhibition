<? 
get_header();
the_post();
$categories_list = get_the_category_list(', ');
$tag_list = get_the_tag_list('', ', '); 
?>

<div class="body">
	
	<div class="post-title"><h1><?the_title()?></h1></div>
	<div class="post-meta">
		<ul>
			<li>글쓴이 : <?the_author()?></li>
			<li>날짜 : <?=get_the_date()?></li>
			<li>카테고리 : <?=$categories_list?></li>
			<li><a href="http://left21.com">레프트21 가기</a></li>
		</ul>
	</div>
	<div class="content"><?=the_content()?></div>
	<div class="post-meta">
		<ul>
			<li>글쓴이 : <?the_author()?></li>
			<li>날짜 : <?=get_the_date()?></li>
			<li>카테고리 : <?=$categories_list?></li>
			<li><a href="http://left21.com">레프트21 가기</a></li>
			<?if($tag_list){?>
			<li>태그 : <?=$tag_list?></li>
			<?}?>
			<?php next_post_link('<li>다음글 ↑ : %link</li>', '%title <small class="date">(%date)</small>'); ?>
			<?php previous_post_link('<li>이전글 ↓ : %link</small></li>', '%title <small class="date">(%date)</small>'); ?>
		</ul>
	</div><!-- .entry-meta -->
	
	<?php comments_template( '', true ); ?>
</div>
<? get_footer(); ?>