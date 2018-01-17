import React from 'react';
import ReactDOM from 'react-dom';
import update from 'react-addons-update';


function Error(props){
    console.log(props);
    if(!props.isSending){
        return null;
    }

    if(props.value == ''){

        let message = "Input having error!";

        if(props.message){
            message = props.message;
        }

        return (
            <div>{message}</div>
        );
    }
    return null;
}

export default class Question extends React.Component {
    
    constructor(props) {
        super(props);

        this.state = {
            title: '',
            type: 'text',
            hasError: false,
            test: "<p>test</p>",
            isSending: false
        };

    }

    handleChange(e) {
        if(e.target.value == ''){
            this.setState({ hasError: true });
        }
        this.setState({ title: e.target.value });
    }

    typeChange(e){
        this.setState({ type: e.target.value });
    }

    add(){
        
        this.setState({ isSending: true });
        
        if(this.state.hasError){
            alert('asdasdadad');
        }

        const data = update(this.state, {$merge: this.props});
        console.log(data);

    }

    render() {
        return (
            <div className="question">

                <div className="form-group">
                    <input 
                        className="form-control"
                        type="text" 
                        value={this.state.title} 
                        onChange={this.handleChange.bind(this)} 
                        placeholder="Title" />
                        <Error value={this.state.title} isSending={this.state.isSending} message="This field cannot be empty!"/>
                </div>

                <div className="form-group">
                    <select 
                        onChange={this.typeChange.bind(this)} 
                        className="form-control"
                    >
                        <option values="text" selected={ this.state.type == 'type' ?  'selected' : null }>Text</option>
                        <option value="open" selected={ this.state.type == 'open' ?  'selected' : null }>Open</option>
                        <option value="single" selected={ this.state.type == 'single' ?  'selected' : null }>Single choice</option>
                        <option value="multiple" selected={ this.state.type == 'multiple' ?  'selected' : null }>Multiple choice</option>
                    </select>
                </div>
                <div className="form-group">
                    <button className="btn btn-primary" onClick={this.add.bind(this)}>Save</button>
                </div>
            </div>
        );
    }
}