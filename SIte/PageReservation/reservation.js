let Case = document.getElementsByClassName('case')

let date = new Date();
let year = date.getFullYear();
let month = date.getMonth() + 1;
let day = date.getDate();

const monthName = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "ocotbre", "novembre", "décembre"];

const UP_MONTH = 'upMonth'
const DOWN_MONTH = 'downMonth'

function  CALENDRIER_REDUCER(action) {
    switch (action) {
        case UP_MONTH:
            if (month < 12) month++
            else {
                year++
                month = 1
            }
            break;

        case DOWN_MONTH:
            if (month > 0) month--
            else {
                year--
                month = 12
            }
            break;

        default:
            break;

    }   
    calendrier(year, month)
}

document.getElementById('avant').onclick = function () {
    CALENDRIER_REDUCER(DOWN_MONTH)
    console.log(month)
}

document.getElementById('apres').onclick = function () {
    CALENDRIER_REDUCER(UP_MONTH)
    console.log(month)
}

function calendrier(year, month){
    const monthNB = month + 12 * (year-2020)

    let cld = [{dayStart: 2, length: 31, year: 2020, month: "janvier"}]

    for (let i =0; 1 < monthNB - 1; i++){
        let yearSimulé = 2020 + Math.floor(i / 12)
        const monthSimuléLongueur = [31, getFévrierLength(yearSimulé), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]
        let monthSimuléIndex = (i+1) - (yearSimulé - 2020) * 12

        cld[i +1] = {
            dayStart : (cld[i].dayStart + monthSimuléLongueur[monthSimuléIndex - 1]) % 7,
            length : monthSimuléLongueur[monthSimuléIndex],
            year: 2020 + Math.floor((i + 1) / 12),
            month: monthName[monthSimuléIndex]
        }

        if (cld[i+1].month === undefined) {
            cld[i+1].month = "janvier"
            cld[i+1].length = 31
        }
    }

    for(let i=0; i < Case.length; i++){
        Case[i].innerText = ""
    }

    for(let i=0; i   < cld[cld.length - 1].length; i++){
       Case[i + cld[cld.length - 1].dayStart].innerText = i + 1
    }

    document.getElementById('cldt').innerText = cld[cld.length - 1].month.toLocaleUpperCase() + " " + cld[cld.length - 1].year

}


function getFévrierLength(year){
    if(year % 4 === 0)return 29
    else return 28
   
}

calendrier()