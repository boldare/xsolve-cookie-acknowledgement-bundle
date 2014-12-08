(function () {
    var COOKIE_BAR = {
        itemName: 'xsolve.cookie-law-accepted',
        itemValue: 'accepted',
        cookieBarDiv: document.getElementById('cookie-law-info-bar'),
        cookieAcceptButton: document.getElementById('js-cookie-law-close-button'),

        showCookieBar: function () {
            this.cookieBarDiv.style.display = 'block';
        },

        hideCookieBar: function () {
            this.cookieBarDiv.style.display = 'none';
        },

        shouldShowCookieBar: function () {
            return window.localStorage.getItem(this.itemName) !== this.itemValue;
        },

        processCookieBar: function () {
            if (this.shouldShowCookieBar()) {
                this.showCookieBar();
            }
        },

        processCookieAccept: function () {
            window.localStorage.setItem(this.itemName, this.itemValue);
            this.hideCookieBar();
        },

        init: function () {
            var _this = this;

            this.processCookieBar();
            this.cookieAcceptButton.onclick = function () {
                _this.processCookieAccept();
            };
        }
    };

    document.addEventListener("DOMContentLoaded", function() {
        COOKIE_BAR.init();
    });
}());
