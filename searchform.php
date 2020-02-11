
<form action="<?php echo home_url( '/' ) ?>" method="get" role="search" class="widget">
	<div class="search-now">
		<h2>Start Typing</h2>
		<div class="input-group" id="adv-search">
			<input type="text" name="s" id="search" class="form-control" placeholder="Search by Keyword or post" value="<?php the_search_query(); ?>" />

			<div class="input-group-btn">
				<div class="btn-group" role="group">
					<button type="submit" class="btn btn-xo"><span class="fa fa-search" aria-hidden="true" style="padding-right: 10px;"></span>Search</button>
				</div>
			</div>
		</div>
	</div>
</form>