import React from 'react';
import { connect } from 'react-redux';
import Validator from 'validatorjs';
import MyForm from '../forms/MyForm';
import * as QuestionActions from '../actions/questionActions';

const _connect = (store) => {
    return {
        survey: store.survey.survey.pages
    };
};
class Question extends React.Component{

    constructor(props){
        super(props);
        this.state = {
            ... props.question
        };

        this.rules = {
            title: 'required',
            desription: 'required',
        }
    } 

    handleChangeTitle(e){
        this.setState({
            title: e.target.value
        });

    }

    edit(){
        this.setState({...this.props.question, edit: true});
        this.props.dispatch(QuestionActions.editQuestion(this.props.number,this.props.index));
    }

    submit(data){
        data.edit = false;
        this.props.dispatch(QuestionActions.__saveQuestion(this.props.number,this.props.index,data));
    }

    getForm(){
        return <MyForm data={this.state} onSuccess={this.submit.bind(this)}/>
    }

    getContent(){
        const { question } = this.props;
        return <div className="question-navbar-container">
            <div className="question-navbar">
                <button className="btn btn-secondary" onClick={this.edit.bind(this)}>Edit</button>
            </div>
           <div dangerouslySetInnerHTML={{__html: question.html}} />
        </div>
    }

    render(){
        return (<div className="question-content">
            { this.props.question.edit ? this.getForm() : this.getContent() }
        </div>)
    }
}
export default connect(_connect)(Question);