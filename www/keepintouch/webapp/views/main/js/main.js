var __extends = (this && this.__extends) || function (d, b) {
    for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p];
    function __() { this.constructor = d; }
    d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
};
var webapp;
(function (webapp) {
    var keepintouch;
    (function (keepintouch) {
        var ViewModel = kit.ViewModel;
        var EmailUIField = kit.fields.EmailUIField;
        var MainPage = (function (_super) {
            __extends(MainPage, _super);
            function MainPage() {
                _super.call(this, null);
                this.AdrEmail = new EmailUIField('email', null);
            }
            return MainPage;
        })(ViewModel);
        new MainPage().applyBindings("#test");
    })(keepintouch = webapp.keepintouch || (webapp.keepintouch = {}));
})(webapp || (webapp = {}));
//# sourceMappingURL=main.js.map