$(document).ready(function() {
    const r = new RegistrationHandler();
    r.registerEventHandlers();
});

class RegistrationHandler {
    constructor() {
        this.user = "#username";
        this.email = "#email";
        this.pw = "#password";
        this.pw2 = "#password2";
        this.register = "#btnRegister";
    }

    isEmptyOrSpaces(str){
        return str === null || str.match(/^ *$/) !== null;
    }

    isFormInputValid() {
        if(this.isEmptyOrSpaces($(this.user).val())) {
            $.announce.danger('username is empty');
            return false;
        }
        if(this.isEmptyOrSpaces($(this.email).val())) {
            $.announce.danger('email is empty');
            return false;
        }
        if(this.isEmptyOrSpaces($(this.pw).val())) {
            $.announce.danger('password is empty');
            return false;
        }
        if(this.isEmptyOrSpaces($(this.pw2).val())) {
            $.announce.danger('password verification is empty');
            return false;
        }
        if($(this.pw).val() !== $(this.pw2).val()) {
            $.announce.danger('The passwords do not match');
            return false;
        }
    }

    sendToBackend() {

    }

    registerEventHandlers() {
        let self = this;

        $(this.register).click(function() {
            if(self.isFormInputValid()) {

            }
        });
    }
}
