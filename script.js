function PosmotretDannye() {
    if("savedData" in localStorage) { // если сохр данные в локалстор, то он выводит элемент в сейвконт
        document.getElementById("savedContent").innerHTML = decodeURI(localStorage.getItem("savedData"));
        // в див добавляются данные из локалстор
        localStorage.setItem("savedData", document.getElementById("content").innerHTML); // в локалстор должны
        // записать данные из дива с айди контент
    }
    else {
        document.getElementById("savedContent").innerHTML = "No saved content";

    }
}
function SaveDannye() {
    localStorage.setItem("savedData", document.getElementById("content").innerHTML);
}