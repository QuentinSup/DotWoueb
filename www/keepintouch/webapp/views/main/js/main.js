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
        var ToggleUIField = kit.fields.ToggleUIField;
        var TextUIField = kit.fields.TextUIField;
        var Query = kit.helpers.Query;
        var MainPage = (function (_super) {
            __extends(MainPage, _super);
            function MainPage() {
                _super.call(this, null);
                this.AdrEmailCoche = new ToggleUIField('EmailCoche', true, false, false);
                this.AdrEmailCoche.showLabel(false);
                this.AdrEmail = new EmailUIField('Adresse email', null, false);
                this.AdrEmail.placeholder("Entrer une adresse email");
                this.AdrEmail.isDisabled.makeTrueIfNot(this.AdrEmailCoche.dataValue);
                this.AdrPostalCoche = new ToggleUIField('AdrPostaleCoche', true, false, false);
                this.AdrPostalCoche.showLabel(false);
                this.AdrPostalLigne1 = new TextUIField('Adresse postale', null, false);
                this.AdrPostalLigne2 = new TextUIField('', null, false);
                this.AdrPostalLigne3 = new TextUIField('', null, false);
                this.AdrPostalCdPost = new TextUIField('', null, false);
                this.AdrPostalVille = new TextUIField('', null, false);
                this.AdrPostalCdPost.showLabel(false);
                this.AdrPostalVille.showLabel(false);
                this.AdrPostalLigne1.isDisabled.makeTrueIfNot(this.AdrPostalCoche.dataValue);
                this.AdrPostalLigne2.isDisabled.makeTrueIfNot(this.AdrPostalCoche.dataValue);
                this.AdrPostalLigne3.isDisabled.makeTrueIfNot(this.AdrPostalCoche.dataValue);
                this.AdrPostalCdPost.isDisabled.makeTrueIfNot(this.AdrPostalCoche.dataValue);
                this.AdrPostalVille.isDisabled.makeTrueIfNot(this.AdrPostalCoche.dataValue);
            }
            /**
             *
             */
            MainPage.prototype.onSubmit = function () {
                var json = [];
                if (this.AdrEmailCoche.dataValue()) {
                    json.push({
                        'type': 'email',
                        'value': this.AdrEmail.dataValue()
                    });
                }
                if (this.AdrPostalCoche.dataValue()) {
                    json.push({
                        'type': 'adress',
                        'value': {
                            'street-address': this.AdrPostalLigne1.dataValue(),
                            'extended-address': this.AdrPostalLigne2.dataValue(),
                            'postal-code': this.AdrPostalCdPost.dataValue(),
                            'locality': this.AdrPostalVille.dataValue()
                        }
                    });
                }
                if (json.length > 0) {
                    Query.POST(app.servicesPath + 'request', json, function (data, status) {
                    });
                }
            };
            return MainPage;
        })(ViewModel);
        new MainPage().applyBindings("#test");
    })(keepintouch = webapp.keepintouch || (webapp.keepintouch = {}));
})(webapp || (webapp = {}));
//# sourceMappingURL=main.js.map