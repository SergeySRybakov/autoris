
let ok = document.getElementById("ok");

let person = {
    nameS: '',
    email: '',
    psw: '',
}


ok.addEventListener("click", function(event) {
    let email = document.getElementById("email").value,
        psw = document.getElementById("psw").value;

    person.email = email;
    person.psw = psw;
    event.preventDefault();

    const pers = JSON.stringify(person)

    axios
        .post("./autoris.php", pers)
        .then(function(response) {
            console.log(response.data);

        })
        .catch(function (error) {
            console.log(error);
        });

});
