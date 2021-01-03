let http = new XMLHttpRequest();
http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        let myObj = JSON.parse(this.responseText);
        document.querySelector('#lists').innerHTML = myObj.agenda;
    }
}
http.open("GET","data.json",true);
http.send();