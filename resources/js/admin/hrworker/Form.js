import AppForm from '../app-components/Form/AppForm';

Vue.component('hrworker-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                birth_date:  '' ,
                phone_number:  '' ,
                address:  '' ,
                dui:  '' ,
                
            }
        }
    }

});