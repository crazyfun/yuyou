/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
config.toolbar = 'MXICToolbar';

config.toolbar_MXICToolbar =[
['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt','Undo','Redo','Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','Link','Unlink','Anchor','TextColor','BGColor','Maximize','ShowBlock'],
'/',
['Styles','Format','Font','FontSize']
];

	
};
