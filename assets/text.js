
var text = {

    trim: function (text) {
        return String(text).replace(/\s+/g, " ").trim();
    },

    toLowerCase: function (text) {
        return String(text).toLowerCase();
    },

    toCamelCase: function (text) {
        return String(text).replace(/\w\S*/g, function (txt) {
            return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
        });
    },

    toUpperCase: function (text) {
        return String(text).toUpperCase();
    },

    escapeRegExp: function (text) {
        return String(text).replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
    },

    replace: function (text, find, repl) {
        var self = this;
        return String(text).replace(new RegExp(self.escapeRegExp(find), 'g'), repl);
    },

    alphaNuOnly: function (text) {
        return String(text).replace(/[^a-z0-9]+/gi, " ");
    }

};
