import React from 'react';
import { connect } from 'react-redux';
import * as SurveyActions from '../actions/surveyActions';
import * as PageActions from '../actions/pageActions';
import Page from './Page';

const _connect = (store) => {
    return {
        survey: store.survey.survey
    };
};
class App extends React.Component{

    componentWillMount(){
        this.props.dispatch(SurveyActions.fetchSurvey());
    }

    changeTitle(){
        //this.props.dispatch(changeTitleSurvey('Zmiana tytułu ankiety'));
    }

    setSorted(){
        this.props.dispatch(PageActions.setSortedPage());
    }

    addPage(){
        this.props.dispatch(PageActions.addPage());
    }

    render(){
        const {survey} = this.props;
        let mappedPages = survey.pages.map((page,key) => <Page key={key} number={key}/>);

        return (<div className={survey.isSorted ? 'page-sorting' : null}>
            <div className="text-right sorting-buttons">
                <button className="btn btn-default" onClick={this.setSorted.bind(this)}>Sortuj strony</button>
            </div>
            {mappedPages}
            <div className="add-page-button">
                <button className="btn btn-default" onClick={this.addPage.bind(this)}>Add page</button>
            </div>
        </div>)
        
    }
}
export default connect(_connect)(App);