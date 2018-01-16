export class Question{

    constructor(){
        
    }

    getNewForm(success:Function){
        let request = $.ajax({
            url: '/index.php/admin/question/form/new',
            dataType: 'html'
        });
        
        request.done(function(data){
            success(data);
        });
    }

}