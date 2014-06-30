/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.extraPlugins = 'youtube';
    config.youtube_width = '640';
    config.youtube_height = '480';
    config.youtube_related = true;
    config.enterMode = CKEDITOR.ENTER_BR;
};
