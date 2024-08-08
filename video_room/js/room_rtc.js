const APP_ID="f1f3f26f0f154122b21fa8012f647de4"

let uid=sessionStorage.getItem('uid')
if(!uid){
    uid=String(Math.floor(Math.random()*10000))
    sessionStorage.setItem('uid',uid)
}


let token = null;
let client;

let rtmClient;
let channel;

const queryString=window.location.search
const urlParams=new URLSearchParams(queryString)
let roomID=urlParams.get('room')

if(!roomID){
    roomID='main'
}
let displayName=sessionStorage.getItem('display_name')
if(!displayName){
    window.location = 'lobby.html'
}

let LocalTrack=[]
let remoteUsers={}

let localScreenTracks;
let SharingScreen= false;

let joinRoomInit=async()=>{
    rtmClient =await AgoraRTM.createInstance(APP_ID)
    await rtmClient.login({uid,token})

    await rtmClient.addOrUpdateLocalUserAttributes({'name':displayName})

    channel = await rtmClient.createChannel(roomID)
    await channel.join()

    channel.on('MemberJoined',handleMemberjoined)
    channel.on('MemberLeft',handleMemberLeft)
    channel.on('ChannelMessage',handleChannelMessage)


    getMembers()

    addBotMessageToDom(`Welcome to the room ${displayName}`)

    client=AgoraRTC.createClient({mode:'rtc',codec:'vp8'})
    await client.join(APP_ID,roomID,token,uid)

    client.on('user-published',handleUserPoblished)
    client.on('user-left',handleUserLeft)
    joinStream()
}

let joinStream=async()=>{
    LocalTrack=await AgoraRTC.createMicrophoneAndCameraTracks({},{encoderConfig:{
        width:{min:640,ideal:1920,max:1920},
        height:{min:480,ideal:1080,max:1080}
    }})

    let player=` <div class="video_container" id="user-container-${uid}">
                    <div class="video-player" id="user-${uid}"
                </div>`
    
    document.getElementById('video-streams').insertAdjacentHTML('beforeend',player)
    document.getElementById(`user-container-${uid}`).addEventListener('click',expandVideoFrame)

    LocalTrack[1].play(`user-${uid}`)
    await client.publish([LocalTrack[0],LocalTrack[1]])
}

let switchToCamera= async ()=>{
    let  player=`<div class="video_container" id="user-container-${uid}">
                    <div class="video-player" id="user-${uid}"
                </div>`
       displayFrame.insertAdjacentHTML('beforeend',player)
           
        
        await LocalTrack[0].setMuted(false)
        await LocalTrack[1].setMuted(false)

    
    document.getElementById('screen-btn').classList.remove('active')

    LocalTrack[1].play(`user-${uid}`)
    await client.publish([LocalTrack[0],LocalTrack[1]])

}


let handleUserPoblished=async(user,mediaType)=>{
    remoteUsers[user.uid]=user

    await client.subscribe(user,mediaType)
    let player=document.getElementById(`user-container-${user.uid}`)
    if(player === null){
        player=` <div class="video_container" id="user-container-${user.uid}">
                    <div class="video-player" id="user-${user.uid}"
                </div>`
    document.getElementById('streams_container').insertAdjacentHTML('beforeend',player)
    document.getElementById(`user-container-${user.uid}`).addEventListener('click',expandVideoFrame)
    }

    if(displayFrame.style.display){
        let videoFrame=document.getElementById(`user-container-${user.uid}`)
        videoFrame.style.height='100px'
        videoFrame.style.width='100px'
    }

    if(mediaType==='video'){
        user.videoTrack.play(`user-${user.uid}`)
    }

    if(mediaType==='audio'){
        user.audioTrack.play()
    }
}

let handleUserLeft=async(user)=>{
    delete remoteUsers[user.uid]
    document.getElementById(`user-container-${user.uid}`).remove()

    if(userIDInDisplayFrame===`user-container-${user.uid}`){
        displayFrame.style.display=null

        let videoframe= document.getElementsByClassName('video_container')
        for(let i=0;videoframe.length>i;i++){
            videoframe[i].style.height='300px'
            videoframe[i].style.width='300px'
        }
    }
}

let toggleCamera= async()=>{
    if(LocalTrack[1].muted){
        await LocalTrack[1].setMuted(false)
        document.getElementById('camera-btn').classList.remove('active')
    }else{
        await LocalTrack[1].setMuted(true)
        document.getElementById('camera-btn').classList.add('active')

    }
}
let toggleMic= async()=>{
    

    if(LocalTrack[0].muted){
        await LocalTrack[0].setMuted(false)
        document.getElementById('mic-btn').classList.remove('active')
    }else{
        await LocalTrack[0].setMuted(true)
        document.getElementById('mic-btn').classList.add('active')
    }
}

let toggleScreen = async(e)=>{
    let cameraButton= document.getElementById('camera-btn')
    if(!SharingScreen){
        SharingScreen=true

        cameraButton.style.display='none'   
        
        localScreenTracks= await AgoraRTC.createScreenVideoTrack()

        document.getElementById(`user-container-${uid}`).remove()
        displayFrame.style.display='block'
        let player=` <div class="video_container" id="user-container-${uid}">
                    <div class="video-player" id="user-${uid}"
                </div>`
        displayFrame.insertAdjacentHTML('beforeend',player)
        
        document.getElementById(`user-container-${uid}`).addEventListener('click' , expandVideoFrame)

        userIDInDisplayFrame = `user-container-${uid}`
        localScreenTracks.play(`user-${uid}`)

        await client.unpublish(LocalTrack[1])
        await client.publish(localScreenTracks)

        document.getElementById('screen-btn').classList.add('active')

        let videoframe =document.getElementsByClassName('video_container')
        for(let i=0;videoframe.length>i;i++){
            if(videoframe[i].id !=userIDInDisplayFrame){
              videoframe[i].style.height='100px'
              videoframe[i].style.width='100px'
            }
        }
    }else{
        SharingScreen=false
        cameraButton.style.display='block'
        document.getElementById(`user-container-${uid}`).remove()
        await client.unpublish(localScreenTracks)

        switchToCamera()
    }
}


let leaveStream=async ()=>{
    window.location='lobby.html'
}

document.getElementById('camera-btn').addEventListener('click',toggleCamera)
document.getElementById('mic-btn').addEventListener('click',toggleMic)
document.getElementById('screen-btn').addEventListener('click',toggleScreen)
document.getElementById('leave-btn').addEventListener('click',leaveStream)

joinRoomInit()
