/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
   config.filebrowserBrowseUrl = '/plugin/kcfinder/browse.php?opener=ckeditor&type=files';
   config.filebrowserImageBrowseUrl = '/plugin/kcfinder/browse.php?opener=ckeditor&type=images';
   config.filebrowserFlashBrowseUrl = '/plugin/kcfinder/browse.php?opener=ckeditor&type=flash';
   config.filebrowserUploadUrl = '/plugin/kcfinder/upload.php?opener=ckeditor&type=files';
   config.filebrowserImageUploadUrl = '/plugin/kcfinder/upload.php?opener=ckeditor&type=images';
   config.filebrowserFlashUploadUrl = '/plugin/kcfinder/upload.php?opener=ckeditor&type=flash';

   config.skin = 'bootstrapck';
};

