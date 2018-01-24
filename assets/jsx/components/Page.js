import React from 'react';
import { connect } from 'react-redux';
import Question from './Question';
import * as PageActions from '../actions/pageActions';
import { addQuestion } from '../actions/surveyActions';


const questionType = {
    title:'',
    description:''
}

const _connect = (store) => {
    return {
        survey: store.survey.survey
    };
};
class Page extends React.Component{

    componentWillMount(){
    }

    moveUp(){
        this.props.dispatch(PageActions.changePagePosition(this.props.number));
    }
    moveDown(){
        this.props.dispatch(PageActions.changePagePosition(this.props.number, false));
    }

    addQuestion(){
        this.props.dispatch(PageActions.addQuestion(this.props.number));
    }

    getQuestions(){
        if(this.props.survey.pages.length === 0) return;
        let questions = null;
        if(this.props.survey.pages[this.props.number].length){
            questions = this.props.survey.pages[this.props.number].map((question,key) => <Question question={question} number={this.props.number} index={key} key={key}/>)
        }
        return questions;
    }

    getTitle(){
        if(!this.props.survey.isSorted){
            return 'Page ' + (this.props.number + 1);
        }

        let title = '';
        if(this.props.survey.pages[this.props.number].length){
            title = this.props.survey.pages[this.props.number].map((question,key) => question.title != '' ? question.title + ", " : 'Not defined')
        }
        return title;
    }

    render(){
        return <div className={'page page-' + this.props.number + 1}>
            <h4 className="text-center page-title">
                {this.getTitle()}
                <span className="buttons">
                    <button className="btn btn-default" onClick={this.moveUp.bind(this)}><i className="fa fa-angle-up"/></button>
                    <button className="btn btn-default" onClick={this.moveDown.bind(this)}><i className="fa fa-angle-down"/></button>
                </span>
            </h4>
            <div className="questions-list">
                {this.getQuestions()}
            </div>
            <div className="text-center add-question-block">
                <button className="btn btn-light add-question" onClick={this.addQuestion.bind(this)}>Add question</button>
            </div>
        </div>
    }
}
export default connect(_connect)(Page);