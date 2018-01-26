import get from 'axios';

export function fetchSurvey(){
    return function(dispath){
        get(BASE_URL + 'admin/question/all/survey/' + SURVEY_ID)
        .then((response) => {
            dispath({type:'FETCH_SURVEY', payload: response.data.response})
        })
        .catch((error) => {
            alert('Error' + error);
            console.log(error);
        })
    }
}

export function changeTitleSurvey(title){
    return {
        type: 'CHANGE_TITLE_SURVEY',
        payload: title
    }
}
