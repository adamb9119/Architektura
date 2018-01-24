import axios from 'axios';

export function editQuestion(page,index){
    return {
        type: 'EDIT_QUESTION',
        payload: {
            page,
            index
        }
    }
}

export function saveQuestion(page,index,question){
    return {
        type: 'SAVE_QUESTION',
        payload: {
            page,
            index,
            question
        }
    }
}

export function __saveQuestion(page,index,question){
    console.log(question);
    return function(dispath){

        axios.post('/admin/question/add/survey/6', {
            question: question,
            page: page,
            index: index
        }, {
            headers: {'X-Requested-With': 'XMLHttpRequest'},
        })
        .then((response) => {
            console.log(response.data);
            dispath({type:'FETCH_TWEETS_FULFILLED', payload: response.data})
        })
        .catch((error) => {
            dispath({type:'FETCH_TWEETS_REJECTED', payload: error})
        })
    }
}