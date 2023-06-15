
let ok = document.getElementById("ok");

let person = {
    nameS: '',
    email: '',
    psw: '',
}


ok.addEventListener("click", function(event) {
    let email = document.getElementById("email").value,
        psw = document.getElementById("psw").value,
        nameS = document.getElementById("name").value;

    person.email = email;
    person.psw = psw;
    person.nameS = nameS;
    event.preventDefault();

    const pers = JSON.stringify(person)

    axios
        .post("./app/api/server.php", pers)
        .then(function(response) {
            console.log(response.data);

        })
        .catch(function (error) {
            console.log(error);
        });

/* 
    console.log(person); */

    document.getElementById("email").value = "";
    document.getElementById("psw").value = "";
    document.getElementById("name").value = "";
});
