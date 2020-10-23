/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	config.skin = 'moonocolor_v1.1';
	config.language = 'pt-br';
	config.magicline_color = '#ff911a';
	config.enterMode = CKEDITOR.ENTER_BR;
	config.extraPlugins = "youtube";
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
		[ 'Image', 'YouTube', 'Flash' ],
		[ 'FontSize', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'TextColor', 'BGColor', '-', 'RemoveFormat' ]
];



CKEDITOR.dialog.add( 'youtube', function( editor )
{
    return {
        title : 'Inserir vídeo do YouTube',
        minWidth : 390,
        minHeight : 60,
        contents : [
        {
            id : 'urlTab',
            label : 'URL do Vídeo',
            title : 'URL do Vídeo',
            elements :
            [
                {
                    id : 'url',
                    type : 'text',
                    label : 'Cole a URL do vídeo do YouTube'
                }
                ,
                {
                    id : 'xhtml',
                    type : 'checkbox',
                    label : 'XHTML válido'
                },
                {
                    id : 'width',
                    type : 'text',
                    label : 'Largura',
                    width : '40'
                },
                {
                    id : 'height',
                    type : 'text',
                    label : 'Altura',
                    width : '30'
                }
            ]
        }
        ,
        {
            id : 'embedTab',
            label : 'Código Embed',
            title : 'Código Embed',
            elements :
            [
                {
                    id : 'embed',
                    type : 'textarea',
                    label : 'Cole o código gerado pelo YouTube (embed)'
                }
            ]
        }
        ],
        onOk : function() {
            var editor = this.getParentEditor();
            var contentUrl = this.getValueOf( 'urlTab', 'url' );
            var contentEmbed = this.getValueOf( 'embedTab', 'embed' );
            var xhtml = this.getValueOf( 'urlTab', 'xhtml' );
            var width = this.getValueOf( 'urlTab', 'width' );
            var height = this.getValueOf( 'urlTab', 'height' );
 
            width = width ? width : 450;
            height = height ? height : 366;
                     
            if ( contentUrl.length > 0 ) {
                if (xhtml == true){
                    contentUrl = contentUrl.replace(/^[^v]+v.(.{11}).*/,"$1");
                    editor.insertHtml('<object type="application/x-shockwave-flash" style="width:' + width + 'px; height:' + height + 'px;" data="http://www.youtube.com/v/'+contentUrl+'"><param name="movie" value="http://www.youtube.com/v/'+contentUrl+'" /></object>');
                }
                else {
                    contentUrl = contentUrl.replace(/^[^v]+v.(.{11}).*/, "$1");
                    editor.insertHtml('<object width="' + width + '" height="' + height + '"><param name="movie" value="http://www.youtube.com/v/'+contentUrl+'"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'+contentUrl+'" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="' + width + '" height="' + height + '"></embed></object>');
                }
            }  
            else
            if ( contentEmbed.length > 0 ) {
                editor.insertHtml(contentEmbed);                       
            }
        },
    buttons : [ CKEDITOR.dialog.okButton, CKEDITOR.dialog.cancelButton ]
    };
 
} );
 
 
CKEDITOR.plugins.add( 'youtube',
{
    init : function( editor )
    {
        var command = editor.addCommand( 'youtube', new CKEDITOR.dialogCommand( 'youtube' ) );
        command.modes = { wysiwyg:1, source:1 };
        command.canUndo = false;
 
        editor.ui.addButton( 'YouTube',
        {
            label : 'Inserir vídeo do YouTube',
            command : 'youtube',
            icon : this.path + 'images/icon.png'
        });
 
        CKEDITOR.dialog.add( 'youtube', 'youtube' );
    }
});
};
