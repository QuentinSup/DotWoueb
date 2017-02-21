
module webapp.keepintouch {
    
    import ViewModel = kit.ViewModel;
    import EmailUIField = kit.fields.EmailUIField;
    import ToggleUIField = kit.fields.ToggleUIField;
    import TextUIField = kit.fields.TextUIField;
    import Query = kit.helpers.Query;
    
    class MainPage extends ViewModel {
        
        public AdrEmail: EmailUIField;
        public AdrEmailCoche: ToggleUIField;
        
        public AdrPostalLigne1: TextUIField;
        public AdrPostalLigne2: TextUIField;
        public AdrPostalLigne3: TextUIField;
        public AdrPostalCdPost: TextUIField;
        public AdrPostalVille: TextUIField;
        public AdrPostalCoche: ToggleUIField;
        
        public constructor() {
            super(null);
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
        public onSubmit(): void {
            
            var json = [];
            
            if(this.AdrEmailCoche.dataValue()) {
                json.push({
                    'type': 'email',
                    'value': this.AdrEmail.dataValue()    
                });
            }
            
            if(this.AdrPostalCoche.dataValue()) {
                json.push({
                    'type': 'adress',
                    'value': {
                        'street-address'    : this.AdrPostalLigne1.dataValue(),
                        'extended-address'  : this.AdrPostalLigne2.dataValue(),
                        'postal-code'       : this.AdrPostalCdPost.dataValue(),
                        'locality'          : this.AdrPostalVille.dataValue()
                    }    
                });
            }
            
            if(json.length > 0) {
                Query.POST(app.servicesPath + 'request', json, (data, status): void => {
                    
                });
            }
            
        }

    }    
    
    new MainPage().applyBindings("#test");
   
    
}