window.alert = function(message, timeout=null){
    const alert = document.createElement('div');
    alert.classList.add('alert');
    alert.innerText = message;
    document.body.appendChild(alert);
}