import Config from './declare';
import {AjaxJsonResult} from './ajaxResult';

export class Question{

    constructor(){
        
    }

    getNewForm(page:number, order:number, success:Function){
        let request = $.ajax({
            url: Config.routes.newQuestionForm,
            dataType: 'html'
        });
        
        request.done(function(data){
            let form = jQuery(data);
            form.find('#question_new_number').val(order);
            form.find('#question_new_page').val(page);

            success(form);
        });
    }

}