let form= document.getElementById('lobby__form')
let form_wrapper=document.getElementById('form_name')

let displayName=sessionStorage.getItem('display_name')
if(displayName){
    form_wrapper.name= displayName
}

form.addEventListener('submit',(e)=>{
    e.preventDefault()

    sessionStorage.setItem('display_name',e.target.name.value)
    let inviteCode = e.target.room.value
    if(!inviteCode){
        inviteCode= String(Math.floor(Math.random()*10000))
    }
    window.location = `room.html?room=${inviteCode}`
})