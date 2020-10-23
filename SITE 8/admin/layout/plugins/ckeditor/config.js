/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	config.skin = 'office2013';
	config.height = '300';
	config.language = 'pt-br';
	config.magicline_color = '#3c8dbc';
	config.enterMode = CKEDITOR.ENTER_BR;
	config.extraPlugins = "youtube";
	config.allowedContent = true;
	config.toolbar = [
		[ 'Undo', 'Redo', 'Scayt' ],
		[ 'Link', 'Unlink' ],
		[ 'FontSize', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'TextColor', 'BGColor', 'RemoveFormat' ],
		[ 'Image', 'Youtube' ],
		[ 'NumberedList', 'BulletedList', 'Table', 'HorizontalRule', 'Outdent', 'Indent' ],
		[ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ],
		[ 'BidiLtr', 'BidiRtl' ],
		[ 'ShowBlocks', 'Templates' ],
		[ 'Find', 'Replace' ],
		[ 'Preview', 'Maximize', 'Source' ]
	];
	config.youtube_width = '460';
	config.youtube_height = '259';
	config.youtube_related = false;
	config.youtube_older = false;
	config.youtube_privacy = false;
};
