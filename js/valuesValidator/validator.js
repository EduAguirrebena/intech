function isNumeric(value){

    return $.isNumeric(value)

}

function isNull(value){

    if(value === "" || value === null || value === undefined ){
        return true
    }else{
        return false
    }
}



function minLength(value,min){

    let length = value.length

    if(length < min){
        return false
    }else{
        return true
    }
}

function maxLength(value,max){

    let length = value.length

    if(length > max){
        return false
    }else{
        return true
    }

}
