
module webapp.keepintouch {
    
    import ViewModel = kit.ViewModel;
    import EmailUIField = kit.fields.EmailUIField;
    
    class MainPage extends ViewModel {
        
        public AdrEmail: EmailUIField;
        
        public constructor() {
            super(null);
            this.AdrEmail = new EmailUIField('email', null);

        }

    }    
    
    new MainPage().applyBindings("#test");
   
    
}