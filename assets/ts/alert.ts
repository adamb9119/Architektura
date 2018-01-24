import * as $ from "jquery";
import 'bootstrap/js/dist/util';
import 'bootstrap/js/dist/modal';

export default class Alert{

    template:string = `<div class="modal" id="alert" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{{title}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>{{message}}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary ok-button">OK</button>
          <button type="button" class="btn btn-secondary close-button" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    </div>`;

    title:string;
    message:string;
    onSuccess:Function;
    onFalse:Function;
    modal;

    constructor($title, $message, $onSuccess = function(){}, $onFalse = function(){}){
        this.title = $title;
        this.message = $message;
        this.onSuccess = $onSuccess;
        this.onFalse = $onFalse;
        
        this.getModal();
    }


    getModal(){
        $('body').append(this.template.replace('{{title}}', this.title).replace('{{message}}', this.message));
        this.modal = $('#alert.modal');
        let _this = this;
        this.modal.on('hidden.bs.modal',function(){
            _this.modal.remove();
            _this.modal = null;
        });
        $('body').on('click', '#alert.modal .ok-button', this.successCallback.bind(this));
        $('body').on('click', '#alert.modal .close-button', this.falseCallback.bind(this));
    }

    show(){
        this.modal.modal('show');
    }

    successCallback(){
        if(this.onSuccess instanceof Function){
            this.onSuccess();
        }
        this.modal.modal('hide');
    }

    falseCallback(){
        if(this.onFalse instanceof Function){
            this.onFalse();
        }
    }



}
