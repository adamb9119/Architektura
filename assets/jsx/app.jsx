import React from 'react';
import ReactDOM from 'react-dom';
import Question from './question';
import Page from './page';


class App extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            comment: ''
        };

        this.pages = [];

    }

    getPages(){
        const listItems = this.pages.map((page, i) =>
            <Page key={i} number={page} pagecount={this.pages.length}/>
        );
        return listItems;
    }

    addPage(){
        this.setState({
            pages: this.pages.push(this.pages.length + 1)
        });
    }

    render() {
        return (
            <div>
                {this.getPages()}
                <button onClick={this.addPage.bind(this)}>Add Page</button>
            </div>
        );
    }
}

ReactDOM.render(
    <App/>,
    document.getElementById('surveyApp')
);