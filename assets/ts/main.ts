import * as $ from "jquery";
import 'jquery-ui/ui/widgets/datepicker';
import * as ClassicEditor from '@ckeditor/ckeditor5-build-classic/build/ckeditor';
import {slugify} from './slugify';
import Alert from './alert';
import 'bootstrap';
import 'bootstrap/js/dist/util';
 
require('jquery-ui/themes/base/datepicker.css');
require('jquery-ui/themes/base/theme.css');
require('../scss/main.scss');


$('body').on('click', 'a.prealert', function(){
    let link = $(this);
    let _message = new Alert(link.attr('data-title'),link.attr('data-message'),function(){
        window.location.href = link.attr('href');
    });
    _message.show();
    return false;
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

$('body').on('keyup','#edit_survey_slug', function(e){
    var value = $(this).val();
    var link = $('#edit_survey_slug_target');
    if(typeof link !== 'undefined'){
        if(value != ''){
            link.text(link.attr('data-href') + '/' + slugify(value));
        }else{
            link.text(link.attr('data-href') + '/' + slugify($('#edit_survey_title').val()));
        }
    }

});

/**
 * Add datepicker to input .datetimepicker
 */
$('.datetimepicker').datepicker({ dateFormat: 'yy-mm-dd' });

