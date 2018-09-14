<?php

add_filter('excerpt_length', function($length) {
	return 25;
});

add_filter('jpeg_quality', function($quality) {
	return 100;
});