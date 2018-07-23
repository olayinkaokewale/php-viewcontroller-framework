<?php

class HomeView extends View {

	function main() {
		$content = '
			<div class="card bg-primary text-white my-3 mx-3">
				<div class="card-body">
					<h2>Main View</h2>
					<hr>
					<small>Welcome to my MVC framework!</small>
				</div>
			</div>
		';

		parent::setMainContent($content);
	}
}