<?php
require('../connection.php');
require('../function.php');
if(isset($_GET['playlist'])){

$playlist=get_safe_value($con,$_GET['playlist']);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../favicon.svg" type="image/svg+xml">
    <title>LMS Video Playlist</title>
</head>
<body>
    <section>
        <h2 class="title"></h2>
        <div class="container">
            <div id="video_player">
                <video controls id="main-Video" src=""></video>
            </div>
            <div class="playlistBx">
                <div class="header">
                    <div class="row">
                        <span class="AllLessons"></span>
                    </div>
                    <input type="text" name="" id="searchInput" placeholder="Type Something ...."> 
                </div>
                <ul class="playlist" id="playlist">
                </ul>
            </div>
        </div>
    </section>
   
    <script>
        const searchInput = document.getElementById("searchInput");  
        searchInput.addEventListener("input", function() {
          const searchValue = searchInput.value.toLowerCase();
          for (const li of playlist.children) {
            const span = li.querySelector("span");
            const spanText = span.textContent;
            const spanTextLower = spanText.toLowerCase();
            const startIndex = spanTextLower.indexOf(searchValue);
            if (startIndex === -1) {
              li.style.display = "none";
            } else {
              li.style.display = "";
              span.innerHTML =
                spanText.slice(0, startIndex) +
                "<mark>" +
                spanText.slice(startIndex, startIndex + searchValue.length) +
                "</mark>" +
                spanText.slice(startIndex + searchValue.length);
            }
          }
        });

       
        // let's select all required tags or elements
        const mainVideo = document.querySelector('#main-Video');
        const musicList = document.querySelector('.music-list');
        const playlist = document.getElementById('playlist');
        const AllLessons = document.querySelector('.AllLessons');
        const videoTitle = document.querySelector('.title');

        const ulTag = document.querySelector("ul");

        
        function playMusic(){
            mainVideo.play();
            playlist.classList.add('active');
        }
        function loadMusic(indexNumb){
            mainVideo.src = `media/${allVideos[indexNumb - 1].src}.mp4`;
            videoTitle.innerHTML = `${indexNumb}. ${allVideos[indexNumb - 1].name}`;
        }
        function playingNow() {
            // Check if allLiTags array is not empty
            const allLiTags = playlist.querySelectorAll('li');
            if (allLiTags.length > 0) {
                for (let j = 0; j < allVideos.length; j++) {
                    if (allLiTags[j].classList.contains('playing')) {
                        allLiTags[j].classList.remove("playing");
                    }
                    if (allLiTags[j].getAttribute('li-index') == musicIndex) {
                        allLiTags[j].classList.add('playing');
                    }
                }
            }
        }
        

        function clicked(element){
                // getting li index of particular clicked li tag
                let getIndex = element.getAttribute("li-index");
                musicIndex = getIndex;
                loadMusic(musicIndex);
                playMusic();
                playingNow();
                }
                
        function updatePlaylist() {
            AllLessons.innerHTML = `${allVideos.length} Lessons`;

            let musicIndex = 1;
            window.addEventListener('load',()=>{
                loadMusic(musicIndex);
                playingNow();
            });


            

            for(let i = 0; i < allVideos.length; i++){
                let liTag = `<li li-index="${i + 1}">
                    <div class="row">
                        <span>${i + 1}. ${allVideos[i].name}</span>
                    </div>
                    <video class="${allVideos[i].id}" src="media/${allVideos[i].src}.mp4" style="display: none;" title="${allVideos[i].name}"></video>
                    <span id="${allVideos[i].id}" class="duration"></span>
                </li>`;
                playlist.insertAdjacentHTML('beforeend',liTag); 

                let liVideoDuration = ulTag.querySelector(`#${allVideos[i].id}`)
                let liVideoTag = ulTag.querySelector(`.${allVideos[i].id}`);
                

                liVideoTag.addEventListener("loadeddata", ()=>{
                    let videoDuration = liVideoTag.duration;
                    let totalMin = Math.floor(videoDuration / 60);
                    let totalSec = Math.floor(videoDuration % 60);
                    // if totalSec is less then 10 then add 0 at the beginging
                    totalSec < 10 ? totalSec = "0"+ totalSec : totalSec
                    liVideoDuration.innerText = `${totalMin}:${totalSec}`;
                    // adding t duration attribe which we'll use below
                    liVideoDuration.setAttribute("t-duration", `${totalMin}:${totalSec}`);
                })  
                }
                // let's work on play particular song on click
                const allLiTags = playlist.querySelectorAll('li');
                function playingNow(){
                for(let j = 0; j<allVideos.length; j++){
                    if(allLiTags[j].classList.contains('playing')){
                        allLiTags[j].classList.remove("playing")
                    }
                    if(allLiTags[j].getAttribute('li-index')==musicIndex){
                        allLiTags[j].classList.add('playing')
                    }
                    // adding onclick attribute in all li tags
                    allLiTags[j].setAttribute("onclick", "clicked(this)")
                }
                }

                playingNow();
                loadMusic(musicIndex);

        }
        let allVideos = [];

        // Fetching video data from video_list.php
        const video_ajax = new XMLHttpRequest();
        const method = "GET";
        const url = "video_list.php?playlist=<?php echo $playlist ?>";
        const asynchronous = true;
        video_ajax.open(method, url, asynchronous);

        // Receiving response from video_list.php
        video_ajax.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                const data = JSON.parse(this.responseText);
                console.log(data);

                // Insert fetched data into allVideos array
                allVideos = data.map((item) => ({
                    name: item.name,
                    src: item.src,
                    id: item.id,
                }));

                // Update playlist with the video names
                updatePlaylist();
            }
        };

        // Sending AJAX request
        video_ajax.send();

    </script>
</body>
</html>
