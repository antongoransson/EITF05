<?php

function csrf_token() {
	return hash('sha256', session_id());
}

function csrf_input_tag() {
	return '<input type="hidden" name="csrf" value="'.csrf_token().'">';
}

function csrf_check($alleged_csrf_token) {
	return $alleged_csrf_token == csrf_token();
}
