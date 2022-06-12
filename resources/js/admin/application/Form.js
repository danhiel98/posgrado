import AppForm from '../app-components/Form/AppForm';

Vue.component('application-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                entrence_year:  '' ,
                graduation_year:  '' ,
                cum:  '' ,
                graduation_date:  '' ,
                high_school_title:  '' ,
                birth_certificate:  '' ,
                paes:  '' ,
                health_certificate:  '' ,
                specialization_id:  '' ,
                degree_id:  '' ,
                applicant_id:  '' ,
                
            }
        }
    }

});