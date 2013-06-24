(function($) {

    var methods = {
        init: function() {
            this.each(function() {
                var $this = $(this), data = $.data(this, 'sfWidgetFormDmChoiceChosen');
                if (data) return;
                if ($this.attr('data-dme-chosen-select-widget') == 'true') {
                    var options = {
                        no_result_text: $this.attr('data-dme-chosen-select-no-result-text'),
                        placeholder_text_multiple: $this.attr('data-dme-chosen-select-placeholder-text-multiple'),
                        placeholder_text_single: $this.attr('data-dme-chosen-select-placeholder-text-single')
                    };
                    if ($this.attr('data-dme-chosen-select-allow-single-deselect') == 'true') options.allow_single_deselect = true;
                    if ($this.attr('data-dme-chosen-select-max-selected-options')) options.max_selected_options = parseInt($this.attr('data-dme-chosen-select-max-selected-options'));

                    $this.chosen(options);
                };
            });
            return this;
        }
    };

    $.fn.sfWidgetFormDmChoiceChosen = function(method) {
        if ( methods[method] ) {
            return methods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            return methods.init.apply( this, arguments );
        } else {
            $.error( 'Method ' +  method + ' does not exist on jQuery.sfWidgetFormDmChoiceChosen' );
        };
    };

    if ($('#dm_admin_content').length >0) {
        $.each($('#dm_admin_content').find('select[data-dme-chosen-select-widget]'), function(){
            $(this).sfWidgetFormDmChoiceChosen();
        });
    };

    $('#dm_page div.dm_widget').bind('dmWidgetLaunch', function() {
        $.each($(this).find('select[data-dme-chosen-select-widget]'), function(){
            $(this).sfWidgetFormDmChoiceChosen();
        });
    });

    $('div.dm.dm_widget_edit_dialog_wrap').live('dmAjaxResponse', function() {
        $.each($(this).find('select[data-dme-chosen-select-widget]'), function(){
            $(this).sfWidgetFormDmChoiceChosen();
        });
    });

})(jQuery);