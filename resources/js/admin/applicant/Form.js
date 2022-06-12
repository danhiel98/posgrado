import AppForm from '../app-components/Form/AppForm';

Vue.component('applicant-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                first_name:  '' ,
                last_name:  '' ,
                dui:  '' ,
                student_id:  '' ,
                birth_date:  '' ,
                phone_number:  '' ,
                email:  '' ,
                
            }
        }
    }

});