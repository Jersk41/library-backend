// const http = new XMLHttpRequest();
// http.onreadystatechange = function () {
//     if (this.readyState == 4 && this.status == 200) {
//         let response = JSON.parse(this.responseText);
//         console.log(response);
//     }
// }
// http.open("GET","index.php",true);
// http.send();
let checkboxes = document.querySelectorAll('input[type=checkbox]'),
    checkboxArray = Array.from(checkboxes);

// function confirmCheck() {
//     if (this.checked) {
//         alert('checked');
//     }
// }
// let i = 0;
// let un;
// checkboxArray.forEach(function (checkbox) {
//     checkbox.addEventListener('change', function(){
//         let parent = checkbox.parentNode;
//         console.log(checkboxArray);
//     });
//     i++;
// });

function getBox(){
    return box;
}

let ls = document.querySelectorAll('.list-group-item');
ls.forEach(function (check){
    let box = check.children[0].children[1];
    check.addEventListener('change',(ev)=>{
        console.log(box);
    });
});
