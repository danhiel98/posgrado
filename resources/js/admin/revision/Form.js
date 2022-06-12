import AppForm from '../app-components/Form/AppForm';

Vue.component('revision-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                result:  false ,
                comments:  '' ,
                hrworker_id:  '' ,
                request_id:  '' ,
                
            }
        }
    }

});