import * as $ from "jquery";
import 'jquery-ui/ui/widgets/datepicker';
import * as ClassicEditor from '@ckeditor/ckeditor5-build-classic/build/ckeditor';
import {Question} from './question';
import Config from './declare';
import {AjaxJsonResult} from './ajaxResult';

require('jquery-ui/themes/base/datepicker.css');
require('jquery-ui/themes/base/theme.css');
require('../scss/main.scss');

/**
 * On click add new question
 */
$('.addQuestion').click(function(){
    var button = $(this);
    var order = button.closest('.questions-list__page').find('.questions-list__page__questions li').length;
    var page: number = Number(button.attr('data-page'));
    let test = new Question();
    test.getNewForm(page, order, function(form){
        var li = $('<li class="question question-new-form"></li>').append(form);
        $('.questions-list__page__questions').append(li);
    });
    return false;
});

/**
 * New question form submit
 */
$('#content').on('submit','[name="question_new"]',function(event){
    event.preventDefault();
    let form = $(this);
    $.ajax({
        type: 'POST',
        url: Config.routes.editQuestionForm,
        data: form.serialize(),
        success: function(response:AjaxJsonResult){
            /**
             * Has errors
             */
            if(response.code == 201){
                form.find('.ajaxErrors').remove();
                form.prepend(`<div class="ajaxErrors alert alert-danger" role="alert">${response.data}</div>`);
                setTimeout(function(){form.find('.ajaxErrors').remove();},2000);
                return false;
            }
            /**
             * Question added.
             */
            if(response.code == 200){
                form.remove();
                return true;
            }
        }
    });
});

/**
 * Add WYSWIG Editor
 */
let editors = document.querySelectorAll('.text-editor');
for(let i = 0; i < editors.length; i++){
    let test = ClassicEditor.create( editors[i], {
        config:{
            height:'3000px'
            
        }
    });
}

/**
 * Add datepicker to input .datetimepicker
 */
$('.datetimepicker').datepicker({ dateFormat: 'yy-mm-dd' });

