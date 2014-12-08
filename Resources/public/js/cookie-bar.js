(function () {
    var COOKIE_BAR = {
        itemName: 'xsolve.cookie-law-accepted',
        itemValue: 'accepted',

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

            this.cookieBarDiv = document.getElementById('cookie-law-info-bar'),
            this.cookieAcceptButton = document.getElementById('js-cookie-law-close-button');

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
