import * as $ from "jquery";
import 'jquery-ui/ui/widgets/datepicker';
import * as ClassicEditor from '@ckeditor/ckeditor5-build-classic/build/ckeditor';
import {Question} from './question';

require('jquery-ui/themes/base/datepicker.css');
require('jquery-ui/themes/base/theme.css');
require('../scss/main.scss');

/**
 * On click add new question
 */
$('.addQuestion').click(function(){
    let test = new Question();
    test.getNewForm(function(form){
        $('.questions-list__page__questions').append('<li class="question question-new-form">' + form + '</li>');
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
        url: '/index.php/admin/question/add',
        data: form.serialize(),
        success: function(data){
           alert(data);
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

