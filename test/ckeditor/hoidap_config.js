/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'vi';
	// config.uiColor = '#AADC6E';
	config.skin = 'kama';
	config.enterMode = CKEDITOR.ENTER_BR;
	//config.toolbar = 'basic';
	config.uiColor = '#3188CD';
	config.basicEntities = false;
	config.entities = false;

	config.toolbar =    [

    ['Source','-','Preview'],

    ['Cut','Copy','Paste','PasteText','PasteFromWord'],

    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],

    ['Link','Unlink','Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe','Maximize'],
	
	['TextColor','BGColor'],
    
    '/',

    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],

    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],

    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],

    ['Format','Font','FontSize']    

    ];
        

    config.filebrowserBrowseUrl = '/quanlynoidung/ckfinder_baiviet/ckfinder.html';
   
    config.filebrowserImageBrowseUrl = '/quanlynoidung/ckfinder_baiviet/ckfinder.html?type=Images';

    config.filebrowserFlashBrowseUrl = '/quanlynoidung/ckfinder_baiviet/ckfinder.html?type=Flash';

    config.filebrowserUploadUrl = '/quanlynoidung/ckfinder_baiviet/core/connector/php/connector.php?command=QuickUpload&type=Files';

    config.filebrowserImageUploadUrl = '/quanlynoidung/ckfinder_baiviet/core/connector/php/connector.php?command=QuickUpload&type=Images';

    config.filebrowserFlashUploadUrl = '/quanlynoidung/ckfinder_baiviet/core/connector/php/connector.php?command=QuickUpload&type=Flash';

};
