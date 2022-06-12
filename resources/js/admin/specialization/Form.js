import AppForm from '../app-components/Form/AppForm';

Vue.component('specialization-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                degree_id:  '' ,
                
            }
        }
    }

});