async function login(event){
    let form = event.target.form; //cant use event.target when using santiagos validator??
    // console.log(form)
    // const email = document.querySelector("#emailInput");
    // const password = document.querySelector("#passwordInput");
    // const loginData = {
    //     email: email.value,
    //     password: password.value,
    // }
    let conn = await fetch("api/api-login", {
        method: "POST",
        // body: new FormData(document.querySelector("form"))
        body: new FormData(form)
    });
    let res = await conn.json()
    if(conn.ok){
        location.href = "index"
    } else{
        document.querySelector(".errorMsg").innerText = res.info;
    }
}
