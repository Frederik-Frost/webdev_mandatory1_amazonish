async function signUp(){
    let conn = await fetch("api/api-signup.php", {
        method: 'POST',
        body: new FormData(document.querySelector("#signupForm"))
    });
    let response = await conn.json()
    if(response && response.created == true){
        loginNewUser()
    }
}

async function loginNewUser(){
    let conn = await fetch("api/api-login", {
        method: 'POST',
        body: new FormData(document.querySelector("#signupForm"))
    });
    let response = await conn.json()
    if(conn.ok){
        location.href = "index"
    }
}