import get from 'axios';

export function fetchTweets(){
    return function(dispath){
        get('http://rest.learncode.academy/api/test123/tweets')
        .then((response) => {
            dispath({type:'FETCH_TWEETS_FULFILLED', payload: response.data})
        })
        .catch((error) => {
            dispath({type:'FETCH_TWEETS_REJECTED', payload: error})
        })
    }
}

export function fetchSurvey(){
    return {
        type: 'FETCH_SURVEY',
        payload: {
            id: 1,
            title: 'Moja ankieta',
            description: 'Opis mojej ankiety!',
            isSorted: false,
            pages: []
        }
    }
}

export function changeTitleSurvey(title){
    return {
        type: 'CHANGE_TITLE_SURVEY',
        payload: title
    }
}
