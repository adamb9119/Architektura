import React from 'react';
import ReactDOM from 'react-dom';
import Question from './question';

export default class Page extends React.Component {
    
    constructor(props) {
        super(props);

        this.state = {
        };

        this.questions = [];
    }

    getQuestions(){
        const listItems = this.questions.map((page, i) =>
            <div key={i}>
                <Question page={this.props.number} number={i}/>
            </div>
        );
        return listItems;
    }

    addQuestion(){
        this.setState({
            questions: this.questions.push(this.questions.length)
        });
    }

    render() {
        return (
            <div>
                <h4 className="text-center">Page {this.props.number} of {this.props.pagecount}</h4>
                {this.getQuestions()}
                <button onClick={this.addQuestion.bind(this)}>Add question</button>
            </div>
        );
    }
}