export function changePagePosition(index,up = true){
    return {
        type: 'CHANGE_PAGE_POSITION',
        payload: {
            index: index,
            up: up
        }
    }
}

export function setSortedPage(){
    return {
        type: 'SET_SORTED_PAGE'
    }
}

export function addPage(){
    return {
        type: 'ADD_PAGE'
    }
}

export function addQuestion(page){
    return {
        type: 'ADD_QUESTION',
        payload: page
    }
}