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
    let data = {...question};
    data['page'] = page;
    data['number'] = index;

    return function(dispath){

        axios.post(BASE_URL + 'admin/question/add/survey/' + SURVEY_ID, data, {
            headers: {'X-Requested-With': 'XMLHttpRequest'},
        })
        .then((response) => {
            
            axios.get(BASE_URL + 'question/'+ response.data.response.id +'/html').then((responseHTML) => {
                response.data.response['html'] = responseHTML.data;
                dispath({type:'SAVE_QUESTION', payload: response.data.response});
            })
            //dispath({type:'SAVE_QUESTION', payload: response.data.response});


        })
        .catch((error) => {
            alert('Error' + error);
            console.log(error);
        })
    }
}