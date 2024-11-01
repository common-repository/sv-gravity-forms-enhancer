/*wp.data.subscribe(function () {
	var isSavingPost = wp.data.select('core/editor').isSavingPost();
	var isAutosavingPost = wp.data.select('core/editor').isAutosavingPost();
	var success = wp.data.select('core/editor').didPostSaveRequestSucceed();

	//if (isSavingPost || isAutosavingPost || !success) { return;}

	if (success && !isAutosavingPost && !isSavingPost) {
		// Here goes your AJAX code ......
			var data				= {
				'action'			: 'sv_core_gutenberg_save_post_update_metaboxes',
				'ID'				: wp.data.select('core/editor').getCurrentPostId(),
			};

			jQuery.post(ajaxurl, data, function(response){
				r = JSON.parse(response);
				jQuery.each(r, function(index, value){
					jQuery('[data-sv_field_id="'+index+'"]').replaceWith(value);
					console.log('Metabox refreshed: '+index)
				});
			});
	}
})

wp.hooks.addAction(
	'editor.effects.postUpdated',
	'sv_core/gutenberg',
	function( newPost, isAutosave ) {
		console.log('test');
		if ( true === isAutosave ) {
			return; // Don't do anything during autosaves.
		}
		// Do your stuff here.
		consoe.dir( newPost );
	}
);
*/

// @ https://github.com/WordPress/gutenberg/issues/13413

window.DAIM = {};

wp.data.subscribe(function () {
	if (wp.data.select('core/editor').getCurrentPostLastRevisionId() !== null &&
		window.DAIM.currentPostLastRevisionId !== null &&
		window.DAIM.currentPostLastRevisionId !== wp.data.select('core/editor').getCurrentPostLastRevisionId()) {

		var data				= {
			'action'			: 'sv_core_gutenberg_save_post_update_metaboxes',
			'ID'				: wp.data.select('core/editor').getCurrentPostId(),
		};

		jQuery.post(ajaxurl, data, function(response){
			r = JSON.parse(response);
			jQuery.each(r, function(index, value){
				jQuery('[data-sv_field_id="'+index+'"]').replaceWith(value);
				console.log('Metabox refreshed: '+index)
			});
		});
	}

	window.DAIM.currentPostLastRevisionId = wp.data.select('core/editor').getCurrentPostLastRevisionId();
});