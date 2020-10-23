/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	config.skin = 'moonocolor_v1.1';
	config.height = '300';
	config.language = 'pt-br';
	config.removePlugins = 'elementspath';
	config.magicline_color = '#ff911a';
	config.enterMode = CKEDITOR.ENTER_BR;
	config.extraPlugins = "youtube";
	config.allowedContent = true;
	config.toolbar = [
		[ 'Source', 'Preview', 'Maximize' ],
		[ 'Undo', 'Redo' ],
		[ 'Find', 'Replace' ],
		[ 'Scayt' ],
		'/',
		[ 'NumberedList', 'BulletedList' ],
		[ 'Table' ],
		[ 'HorizontalRule' ],
		[ 'Outdent', 'Indent', '-', 'Blockquote' ],
		[ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ],
		[ 'BidiLtr', 'BidiRtl' ],
		[ 'ShowBlocks', 'Templates' ],
		'/',
		[ 'Link', 'Unlink' ],
		[ 'Image', 'Youtube', 'Flash' ],
		[ 'FontSize', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'TextColor', 'BGColor', '-', 'RemoveFormat' ]
	];
	
	config.youtube_width = '490';
	config.youtube_height = '292';
	config.youtube_related = false;
	config.youtube_older = false;
	config.youtube_privacy = false;

};