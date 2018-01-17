import React from 'react';
import ReactDOM from 'react-dom';

export default class NewQuestionForm extends React.Component {
    render(){
        return(
            <div>
                New form<br/>
                {this.props.data.title}
                <br/>
                {this.props.data.type}
            </div>
        );
    }
}
    