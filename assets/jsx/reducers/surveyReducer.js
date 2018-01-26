//import {arrayMove} from 'react';

import { Map } from 'immutable';

const questionType = {
    id:null,
    title:'',
    description:'',
    type:'text',
    edit:true,
    html:'',
    options:{},
    answers:{}
}

export default function reducer(state = {
    survey:     {
        id: null,
        title: null,
        description:null,
        pages:[],
        isSorted: false
    }
}, action) {

    switch (action.type) {

        /**************************************
         * SURVEY ACTIONS
         **************************************/

        case 'FETCH_SURVEY':{
            
            return { 
                ...state, 
                survey: {...action.payload.survey, pages: action.payload.questions}
            }
        }

        /**************************************
         * QUESTION ACTIONS
         **************************************/

        /**
         * Add new question to page
         */
        case 'ADD_QUESTION':{
            state.survey.pages[action.payload].push({...questionType});
            return { 
                ...state, 
                survey: {...state.survey, pages: state.survey.pages}
            }
        } 

        /**
         * Set edit question page status
         */
        case 'EDIT_QUESTION':{
            let newPages = [...state.survey.pages];

            newPages[action.payload.page][action.payload.index].edit = true;

            return { 
                ...state, 
                survey: {...state.survey, pages: newPages}
            }
        }

        /**
         * Push questions state to store
         */
        case 'SAVE_QUESTION':{
            let newPages = [...state.survey.pages];

            newPages[action.payload.page][action.payload.number] = action.payload;

            return { 
                ...state, 
                survey: {...state.survey, pages: newPages}
            }
        }


        /**************************************
         * PAGE ACTIONS
         **************************************/

        /**
         * Adding new page
         */
        case 'ADD_PAGE':{
            state.survey.pages.push([{...questionType}]);
            return { 
                ...state, 
                survey: {...state.survey, pages: state.survey.pages}
            }
        }
        
        /**
         * Change page position
         * payload:{
         *  index:number,
         *  up:boolean
         * }
         */
        case 'CHANGE_PAGE_POSITION':{
            let newPages = [...state.survey.pages];
            let backup = [...state.survey.pages[action.payload.index]];

            Object.keys(newPages).forEach(function (key) {
                var item = newPages[key];
                
            });
            
            const newIndex = action.payload.up ? action.payload.index - 1 : action.payload.index + 1;

            newPages.splice(action.payload.index, 1);
            newPages.splice(newIndex, 0, backup);

            return {
                ...state, 
                survey: {...state.survey, pages: newPages}
            }
        }

        /**
         * Set sorting page status
         */
        case 'SET_SORTED_PAGE':{
            return { 
                ...state, 
                survey: {...state.survey, isSorted: !state.survey.isSorted}
            }
        }


        default:{
            return state;
        }
    }
}