import * as $ from "jquery";
import 'jquery-ui/ui/widgets/datepicker';
import * as ClassicEditor from '@ckeditor/ckeditor5-build-classic/build/ckeditor';


let editors = document.querySelectorAll('.text-editor');
for(let i = 0; i < editors.length; i++){
    let test = ClassicEditor.create( editors[i], {
        config:{
            height:'3000px'
            
        }
    });
}

require('jquery-ui/themes/base/datepicker.css');
require('jquery-ui/themes/base/theme.css');

$('.datetimepicker').datepicker({ dateFormat: 'yy-mm-dd' });

require('../scss/main.scss');
