<script>
	$(function() {
		var availableTag=['<?php 
		foreach($users as $user){
			echo $user->username . "','";
		}
		?>',];
		$( "#tags" ).autocomplete({
			source: availableTag
		});
	});
	</script>


	
<div class="demo">

<div class="ui-widget">
	<label for="tags">Tags: </label>
	<input id="tags">
</div>

</div><!-- End demo -->



<div style="display: none;" class="demo-description">
<p>The Autocomplete widgets provides suggestions while you type into the field. Here the suggestions are tags for programming languages, give "ja" (for Java or JavaScript) a try.</p>
<p>The datasource is a simple JavaScript array, provided to the widget using the source-option.</p>
</div><!-- End demo-description -->