
window.onload = function() { 
 let file = document.querySelector('input[type="file"]')
 let form =  document.querySelector('form')
 file.addEventListener('change',(e)=>{console.log(form.value)})

 form.addEventListener('onsubmit',(e)=>{console.log(e)})
}