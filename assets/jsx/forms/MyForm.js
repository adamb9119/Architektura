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
            [name]:e.target.value
        });
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
                    <select className="form-control" name="type" onChange={this.handleChange.bind(this)}>
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
                {(() => {
                    switch (this.state.type) {
                    case "single":   return "#FF0000";
                    case "multiple": return "#00FF00";
                    default:      return null;
                    }
                })()}

            </div>
            <div className="right">
                <div className="form-group">
                    <label htmlFor="description">Options</label>
                </div>
                <div className="form-check custom-control custom-radio">
                    <input type="checkbox" className="form-check-input custom-control-input" name="show_title" id="show_title"/>
                    <label onChange={this.handleChange.bind(this)} className="form-check-label custom-control-label" htmlFor="show_title">Show title</label>
                </div>
                <div className="form-check custom-control custom-radio">
                    <input type="checkbox" className="form-check-input custom-control-input" name="show_description" id="show_description"/>
                    <label onChange={this.handleChange.bind(this)} className="form-check-label custom-control-label" htmlFor="show_description">Show description</label>
                </div>
            </div>
            <div className="buttons-bottom">
                <button className="btn btn-primary" onClick={this.save.bind(this)}>Save</button>
            </div>
        </div>)
        
    }
}
export default MyForm;