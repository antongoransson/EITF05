<?php

function csrf_tag() {
	return hash('sha256', session_id());
}

function csrf_input_tag() {
	return '<input type="hidden" name="csrf" value="'.csrf_tag().'">';
}

function csrf_check($alleged_csrf_tag) {
	return $alleged_csrf_tag == csrf_tag();
}
