"use strict";

var KTCardTools = function () {
    // Toastr
    var initToastr = function() {
        // toastr.options.showDuration = 1000;
    }

    // Demo 1
    var demo1 = function() {
        // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
        var card = new KTCard('kt_card_1');
    }

    // Demo 2
    var demo2 = function() {
        // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
        var card = new KTCard('kt_card_2');
    }

    // Demo 3
    var demo3 = function() {
        // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
        var card = new KTCard('kt_card_3');
    }

    // Demo 4
    var demo4 = function() {
        // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
        var card = new KTCard('kt_card_4');
    }

    return {
        //main function to initiate the module
        init: function () {
            // init demos
            demo1();
            demo2();
            demo3();
            demo4();
        }
    };
}();

jQuery(document).ready(function() {
    KTCardTools.init();
});
