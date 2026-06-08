document.addEventListener("DOMContentLoaded", load);

function load(){
    let submit = document.getElementById("submit");
    submit.addEventListener("click", validate);

    let form = document.getElementById("add-restaurant-form");
    form.addEventListener("submit", validate);
}

function validate(e){
    e.preventDefault();
}