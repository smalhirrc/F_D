document.addEventListener("DOMContentLoaded", load);

function load(){

}

function getLocation(){
    let map = document.getElementById("map");
    // document.getElementById("address-search-container").innerHTML = "";
    document.getElementById("address-search-container").appendChild(map);

    navigator.geolocation.getCurrentPosition(position => {
    const { latitude, longitude } = position.coords;
    // Show a map centered at latitude / longitude.
    map.innerHTML = '<iframe width="700" height="300" src="https://maps.google.com/maps?q='+latitude+','+longitude+'&amp;z=15&amp;output=embed"</iframe>' 
    
    console.log(latitude, longitude);

    }); 
}  