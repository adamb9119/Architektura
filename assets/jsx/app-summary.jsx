import React from 'react';
import ReactDOM from 'react-dom';
import get from 'axios';
import {LineChart, Line, XAxis, YAxis, CartesianGrid, Tooltip, Legend} from 'recharts';


export default class AppSummary extends React.Component {

    constructor(props) {
        super(props);

        this.month = {
            0:'01',
            1:'02',
            2:'03',
            3:'04',
            4:'05',
            5:'06',
            6:'07',
            7:'08',
            8:'09',
            9:'10',
            10:'11',
            11:'12'
        }

        var today = new Date();
        var end = new Date();
        today.setDate(today.getDate() - 7);
        var array = this.generateArray(today, end.setDate(today.getDate() + 7));
        console.log(array);
        this.state = {
            data: array
        };
        
        get('/admin/ajax/survey/summary/views/' + SURVEY_ID)
            .then(this.setDataViews.bind(this))
            .catch(function (error) {
                console.log(error);
            });
    }

    
    setDataViews(response){
        var newStateData = [...this.state.data];
        for(var i = 0; i < newStateData.length; i++){
            for(var _i = 0; _i < response.data.views.length; _i++){
                var date = new Date(response.data.views[_i].date.date);
                console.log(newStateData[i].name + ' ' + date.getFullYear() + '-' + this.month[date.getMonth()] + '-' + date.getDate() );
                if(newStateData[i].name == date.getFullYear() + '-' + this.month[date.getMonth()] + '-' + date.getDate()){
                    newStateData[i].views = newStateData[i].views + 1;
                }
            }
        }
        this.setState({
            date: newStateData
        });
        
    }

    click(){
    } 

    generateArray(start, end){
        var array = [];

        while(start <= end){
            start.setDate(start.getDate() + 1);
            array.push({
                name: start.getFullYear() + '-' + this.month[start.getMonth()] + '-' + start.getDate(),
                views: 0,
            });
        }
        return array;
    }


    render() {
        return (
            <div>
                <button onClick={this.click.bind(this)}>Change</button>
                <div style={{marginLeft: 'auto', marginRight: 'auto', width:'600px'}}>
                    <LineChart width={600} height={300} data={this.state.data}
                    margin={{top: 5, right: 30, left: 20, bottom: 5}}>
                    <XAxis dataKey="name"/>
                    <YAxis/>
                    <CartesianGrid strokeDasharray="3 3"/>
                    <Tooltip/>
                    <Legend />
                    <Line type="monotone" dataKey="views" stroke="#007bff" activeDot={{r: 8}}/>
                    </LineChart>
                </div>
            </div>
        );
    }
}
