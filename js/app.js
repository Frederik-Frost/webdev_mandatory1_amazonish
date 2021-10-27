function _one(q,from=document){return from.querySelector(q)}
function _all(q,from=document){return from.querySelectorAll(q)}

function onLogout(){
    _one("#logoutModal").style.display = 'block';
}
function cancel(){
    _one("#logoutModal").style.display = 'none';
}
function logout(){
    window.location.href = "logout";
}