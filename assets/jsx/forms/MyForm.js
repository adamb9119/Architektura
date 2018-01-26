import React from 'react';
import Validator from 'validatorjs';

class MyForm extends React.Component{

    constructor(props){
        super(props);
        this.state = {...props.data};
    } 


    handleChange(e){
        const name = e.target.name;
        this.setState({
            [name]: e.target.value
        });

        if(name == 'type'){
            this.setState({
                answers: []
            });
        }
        
        console.log(this.state);
    }

    handleChangeOption(e){
        const name = e.target.name;
        const value = e.target.type === 'checkbox' ? e.target.checked : e.target.value;
        this.setState({
            options:{
                ...this.state.options,
                [name]: value
            }
        });
        console.log(this.state);
    }

    handleChangeAnswer(e){
        const name = e.target.name.split('.');
        const backup = [...this.state.answers];
        backup[name[1]][name[2]] = e.target.value;
        this.setState({
            answers: backup
        });
        console.log(this.state);
    }

    getAnswers(){
        if(this.state.type != 'single' && this.state.type != 'multiple'){
            return null;
        }

        const listItems = this.state.answers.map((answer,key) =>
            <div className="answer-row" key={key}>
                <input type="text" className="form-control" name={'answer.' + key + '.title'} onChange={this.handleChangeAnswer.bind(this)} value={answer.title}/>
            </div>
        );

        return (
            <div>
                <div className="form-group">
                    <label>Answers</label>
                    <div>
                        {listItems}
                    </div>
                    <button className="btn btn-secondary" onClick={this.addAnswer.bind(this)}>Add answer</button>
                </div>
            </div>
        );
    }

    addAnswer(){
        const answers = [...this.state.answers];
        answers.push({
            title: '',
            id: null
        });
        this.setState({answers});
    }

    save(){
        
        this.props.onSuccess(this.state);
    }

    render(){
        return (<div className="form-edit-question">
            <div className="left">
                <div className="form-group">
                    <label htmlFor="title">Title</label>
                    <input type="text" className="form-control" name="title" id="title" value={this.state.title} onChange={this.handleChange.bind(this)}/>
                </div>
                <div className="form-group">
                    <label htmlFor="type">Type</label>
                    <select className="form-control" name="type" onChange={this.handleChange.bind(this)} defaultValue={this.state.type} readOnly={this.state.id ? 'readonly' : null}>
                        <option value="text">Text</option>
                        <option value="single">Single Choice</option>
                        <option value="multiple">Multiple choice</option>
                        <option value="open">Open</option>
                    </select>
                </div>
                <div className="form-group">
                    <label htmlFor="description">Description</label>
                    <textarea className="form-control" name="description" id="description" value={this.state.description} onChange={this.handleChange.bind(this)}></textarea>
                </div>
                {this.getAnswers()}

            </div>
            <div className="right">
                <div className="form-group">
                    <label htmlFor="description">Options</label>
                </div>
                <div className="form-check custom-control custom-radio">
                    {this.state.options.show_title}
                    <input type="checkbox" onChange={this.handleChangeOption.bind(this)} className="form-check-input custom-control-input" name="show_title" id={'show_title' + this.state.id} defaultChecked={this.state.options.show_title}/>
                    <label className="form-check-label custom-control-label" htmlFor={'show_title' + this.state.id}>Show title</label>
                </div>
                <div className="form-check custom-control custom-radio">
                    <input type="checkbox" onChange={this.handleChangeOption.bind(this)} className="form-check-input custom-control-input" name="show_description" id={'show_description' + this.state.id} defaultChecked={this.state.options.show_description}/>
                    <label className="form-check-label custom-control-label" htmlFor={'show_description' + this.state.id}>Show description</label>
                </div>
            </div>
            <div className="buttons-bottom">
                <button className="btn btn-primary" onClick={this.save.bind(this)}>Save</button>
            </div>
        </div>)
        
    }
}
export default MyForm;