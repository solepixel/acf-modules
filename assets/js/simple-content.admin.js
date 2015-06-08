var acfmod_bind_load_content;

(function($) {

	$(function(){

		if( typeof acf == 'undefined' )
			return;

		// this event happens when new HTML is added by acf
		acf.add_action('append', function( $el ){

			var $cbx = $el.find('tr[data-name="load_post_content"] input[type="checkbox"]');

			acfmod_bind_load_content( $cbx );

		}); // acf append

		acfmod_bind_load_content = function( $cbx ){
			$cbx.on('click', function(){
				var $cbx = $(this);

				if( $cbx.is(':checked') ){
					// show spinner
					var $spinner = $('<div class="spinner" style="float:right;visibility:visible;" />');
					$cbx.parents('li:first').append( $spinner );

					// make sure they're OK with this
					if( ! confirm( 'This will overwrite the editor content. Are you sure you want to import post_content?' ) ){
						$spinner.remove();
						return;
					}

					// find the correct instance of TinyMCE
					var $textarea = $cbx.parents('.row-layout:first').find( '.acf-editor-wrap textarea.wp-editor-area:first' );

					// load the post_content
					$.ajax({
						url: acfmod_vars.ajax_url + '?acfmod-get-post-content',
						data: { id: $('#post_ID').val(), action: 'acfmod_get_post_content' },
						type: 'get',
						success: function( response ){
							if( response.success ){
								// insert response.post_content into the simple content editor
								tinymce.get( $textarea.attr('id') ).setContent( response.post_content );

								// remove spinner
								$spinner.remove();
							}
						}
					}); // ajax

				} // if checked

			}); // click function

		}; // acfmod_bind_load_content

		acfmod_bind_load_content( $('tr[data-name="load_post_content"] input[type="checkbox"]') );

	}); // document ready

})(jQuery);
