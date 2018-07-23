<?php

class NotfoundView extends View {
	
	function main() {
		$content = '
			<div class="card bg-outline-secondary text-muted text-center mx-5 my-5">
				<div class="card-body">
					<h2>Oops! We\'re sorry but that page can\'t be found.</h2>
					<hr>
					<small>404 - page not found!</small>
				</div>
			</div>
		';
		parent::setMainContent($content);
	}
}