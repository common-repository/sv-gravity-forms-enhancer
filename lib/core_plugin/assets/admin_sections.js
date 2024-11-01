jQuery(document).ready(function($) {

    if( typeof SVCA != 'undefined' ){

        SVCA.sections = new function(){

            self = this; // prevents scope problem within loops

            self.params = {
                container: null,
            };

            self.call = null;

            self.init = function(params){
                console.log('SVCA-SECTIONS init');
                if(typeof params != 'undefined'){
                    if(typeof params.container != 'undefined' && jQuery(params.container).length > 0){
                        self.params.container = jQuery(params.container);
                    }else{
                        console.log('ERROR - container element not found');
                    }
                }

                // load first page or deep link
                const section = SVCA.get_url_param('section');

                if(jQuery('#section_'+section).length > 0){
                    self.params.container.children('.sv_admin_section').first().fadeIn();
                }else{
                    if(jQuery('#section_'+section).hasClass('ajax_none')){
                        jQuery('#section_'+section).fadeIn();
                    }else{
                        self.get(section);
                    }
                }

                console.log('SVCA-SECTIONS init - done');
            };

            self.get_call = function(){
                return self.call;
            }

            self.stop_call = function(){
                SVCA.loader(false);
                self.call.abort();
            }

            self.close_call = function(){
                SVCA.loader(false);
                bind_events(); // remove after admin.js refactoring
                return self.call = null;
            }

            self.get = function(section){
                if(typeof section == 'undefined' || section == null){
                    return;
                }

                if( this.get_call() != null ){
                    self.stop_call();
                }

                let output = '';
                section    = section.replace('#section_','');

                // update URL
                SVCA.set_url_param({
                    'section': section,
                });

                // prepare content area
                SVCA.loader();
                jQuery('.sv_admin_menu_item').removeClass('active');
                jQuery('.sv_admin_section').removeClass('active').hide();
                //self.params.container.find('.sv_admin_section:not(.ajax_none)').remove();
                // don't reload pages
                if(jQuery('#section_'+section).length > 0){
                    SVCA.loader(false);
                    jQuery('#section_'+section).addClass('active ajax-loaded').fadeIn();
                    return;
                }

                // call
                return self.call = jQuery.ajax({
                    url: SVCA.params.ajax_url,
                    data: {
                        'action'    : 'sv_ajax_get_section',
                        'section'   : section.replace('#section_',''),
                        'page'      : SVCA.get_url_param('page'),
                        'nonce'     : SVCA.get_plugin_localized_nonce(),
                    },
                    success:function(res) {
                        SVCA.loader(false); // hotfix to force loader hide
                        if(res){
                            const html = atob(res.data);
                            self.params.container.prepend( html );
                            section = '#section_' + section;
                            if(jQuery(section).length > 0){
                                jQuery('.sv_admin_menu_item[data-sv_admin_menu_target="' + section + '"]').addClass('active');
                                jQuery(section).addClass('active ajax-loaded').fadeIn();
                            }

                        }
						jQuery('body').trigger('sv_admin_section_loaded');
                        self.close_call();
                    },
                    error: function(errorThrown){
                        console.log(errorThrown);
                        self.close_call();
                    },
                });
            }
        };
        SVCA.sections.init({container:'.sv_dashboard_content'});
    }
});