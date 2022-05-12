define([
    'jquery',
    'mage/url',
    'underscore',
    'uiRegistry',
    'Magento_Ui/js/form/element/select',
    'Magento_Ui/js/modal/modal'
], function ($, url,_, uiRegistry, select, modal) {
    'use strict';

    return select.extend({

        /**
         * On value change handler.
         *
         * @param {String} value
         */
        onUpdate: function (value) {
            var self = this;
           var parentMenu = $('select[name="parent_id"]');
           var menuUrl = self.url;

           parentMenu.empty();
           $.ajax({
                url: menuUrl,
                data: {'type':value,'menu_id':$('input[name="id"]').val()},
                type: "POST",
                cache: false,
                dataType: 'json'
                }).done(function (data) {
                    if (data.success) {
                        $.each(data.menu, function (index, value) {
                            console.log(value);
                            parentMenu.append($("<option></option>")
                            .attr("value", value.value)
                            .text(value.label));
                        });
                    }
                });
            return this._super();
        }
        
    });
});
