document.addEventListener("DOMContentLoaded", load);

function load(){
    let submit = document.getElementById("submit");
    submit.addEventListener("click", validate);

    let form = document.getElementById("add_store_form");
    form.addEventListener("submit", validate);
}

function validate(e){
    // e.preventDefault();
    let checks = [
        valid_store_owner_first_name(),
        valid_store_owner_last_name(),
        valid_store_business_email(),
        valid_store_phone_country_code(),
        valid_store_phone_number(),
        valid_store_name(),
        valid_store_type(),
        valid_store_street_address(),
        valid_store_unit_number(),
        valid_store_city(),
        valid_store_province()
    ];

    if(checks.includes(false)){
        e.preventDefault();
        console.log("form has an error");
        console.log(checks);
    }
}

function valid_store_owner_first_name(){
    let store_owner_first_name = document.getElementById("store_owner_first_name").value.trim();
    let regex = (/^[a-zA-Z\s'.-]{1,50}$/);

    if(store_owner_first_name === "" || !regex.test(store_owner_first_name)){
        document.getElementById("store_owner_first_name_error_message").style.display = "block";

        return false;
    }
    else{
        document.getElementById("store_owner_first_name_error_message").style.display = "none";
    }

    return true;
}

function valid_store_owner_last_name(){
    let store_owner_last_name = document.getElementById("store_owner_last_name").value.trim();
    let regex = (/^[a-zA-Z\s'-]{1,50}$/);

    if(store_owner_last_name === "" || !regex.test(store_owner_last_name)){
        document.getElementById("store_owner_last_name_error_message").style.display = "block";

        return false;
    }
    else{
        document.getElementById("store_owner_last_name_error_message").style.display = "none";
    }

    return true;
}

function valid_store_business_email(){
    let store_business_email = document.getElementById("store_business_email").value.trim();
    let regex = (/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/);

    if(store_business_email === "" || !regex.test(store_business_email)){
        document.getElementById("store_business_email_error_message").style.display = "block";

        return false;
    }
    else{
        document.getElementById("store_business_email_error_message").style.display = "none";
    }

    return true;
}

function valid_store_phone_country_code(){
    let store_phone_country_code = document.getElementById("store_phone_country_code").value.trim();
    let regex = (/\+[0-9]{1,4}/);

    if(store_phone_country_code === "" || !regex.test(store_phone_country_code)){
        document.getElementById("store_phone_country_code_error_message").style.display = "block";

        return false;
    }
    else{
        document.getElementById("store_phone_country_code_error_message").style.display = "none";
    }

    return true;
}

function valid_store_phone_number(){
    let store_phone_number = document.getElementById("store_phone_number").value.trim();
    let regex = (/^\(?[0-9]{3}\)?[-.( ]?[0-9]{3}[-.)( ]?[0-9]{4}\)?$/);

    if(store_phone_number === "" || !regex.test(store_phone_number)){
        document.getElementById("store_phone_number_error_message").style.display = "block";

        return false;
    }
    else{
        document.getElementById("store_phone_number_error_message").style.display = "none";
    }

    return true;
}

function valid_store_name(){
    let store_name = document.getElementById("store_name").value.trim();
    let regex = (/^[a-zA-Z0-9\s.'&-]+$/);

    if(store_name === "" || !regex.test(store_name)){
        document.getElementById("store_name_error_message").style.display = "block";

        return false;
    }
    else{
        document.getElementById("store_name_error_message").style.display = "none";
    }

    return true;
}

function valid_store_type(){
    let store_type = document.getElementById("store_type").value.trim();
    let regex = (/^[a-zA-Z\s.-]+$/);

    if(store_type === "" || !regex.test(store_type)){
        document.getElementById("store_type_error_message").style.display = "block";

        return false;
    }
    else{
        document.getElementById("store_type_error_message").style.display = "none";
    }

    return true;
}

function valid_store_street_address(){
    let store_street_address = document.getElementById("store_street_address").value.trim();
    let regex = (/^[0-9a-zA-Z\s'.&,-]+$/);

    if(store_street_address === "" || !regex.test(store_street_address)){
        document.getElementById("store_street_address_error_message").style.display = "block";

        return false;
    }
    else{
        document.getElementById("store_street_address_error_message").style.display = "none";
    }

    return true;
}

function valid_store_unit_number(){
    let store_unit_number = document.getElementById("store_unit_number").value.trim();
    let regex = (/^[0-9a-zA-Z\s,()#.-]+$/);

    if(store_unit_number === "" || !regex.test(store_unit_number)){
        document.getElementById("store_unit_number_error_message").style.display = "block";

        return false;
    }
    else{
        document.getElementById("store_unit_number_error_message").style.display = "none";
    }

    return true;
}

function valid_store_city(){
    let store_city = document.getElementById("store_city").value.trim();
    let regex = (/^[a-zA-Z\s'.,()-]+$/);

    if(store_city === "" || !regex.test(store_city)){
        document.getElementById("store_city_error_message").style.display = "block";

        return false;
    }
    else{
        document.getElementById("store_city_error_message").style.display = "none";
    }

    return true;
}

function valid_store_province(){
    let store_province = document.getElementById("store_province").value.trim();
    let regex = (/^[a-zA-Z\s'.,()-]+$/);

    if(store_province === "" || !regex.test(store_province)){
        document.getElementById("store_province_error_message").style.display = "block";

        return false;
    }
    else{
        document.getElementById("store_province_error_message").style.display = "none";
    }

    return true;
}