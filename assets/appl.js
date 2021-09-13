
var online_email_extractor = {

    mailsOnly: function (__input) {
        return __input.match(/([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi);
    },

    extract: function (__input) {
        var self = this,
            tx = String(__input),
            rs = "";
        if (tx.indexOf("@") > -1) {
            tx = self.mailsOnly(tx);
            tx = text.trim(tx);
            tx = text.toLowerCase(tx);
            var mailz = tx.split(","),
                uniqueMailz = [],
                k = 0;
            jQuery.each(mailz, function (i, el) {
                if (jQuery.inArray(el, uniqueMailz) === -1) uniqueMailz.push(el);
            });
            if (uniqueMailz.length > 0) {
                uniqueMailz = uniqueMailz.sort();
                for (k = 0; k < uniqueMailz.length; k += 1) {
                    rs += uniqueMailz[k] + "; ";
                }
            }
        }
        return rs;
    },

    after_effects: function (bttn) {
        bttn.prop("disabled", true);
        setTimeout(function () {
            bttn.css("background-color", "");
            bttn.prop("disabled", false);
        }, 250);
    }

}

jQuery(document).ready(function () {

    jQuery("#appl .cmd_extract").click(function (e) {

        e.preventDefault();

        jQuery("#appl .inp_text").val(online_email_extractor.extract(jQuery("#appl .inp_text").val()));
        jQuery("#appl .inp_text").focus();

        online_email_extractor.after_effects(jQuery(this));

    });

});
