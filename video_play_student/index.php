<?php
require('../connection.php');
require('../function.php');
if(isset($_GET['playlist'])){

$playlist=get_safe_value($con,$_GET['playlist']);
}
if(isset($_SESSION['STUDENT_LOGIN']) && $_SESSION['STUDENT_LOGIN']!='')
        {
          $id=$_SESSION['STUDENT_ID'];
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
    let allVideos = [];
    let currentVideoIndex = 0;
    let musicIndex = 0;
    let lastWatchedVideoId = null;
    const playlist = document.getElementById('playlist');
    const AllLessons = document.querySelector('.AllLessons');
    const ulTag = document.querySelector("ul");
    const videoTitle = document.querySelector('.title');
    const mainVideo = document.querySelector('#main-Video');

    function initializePlayer() {
        // Add event listeners for search input and main video
        const searchInput = document.getElementById("searchInput");  
        searchInput.addEventListener("input", handleSearch);
        mainVideo.addEventListener('ended', handleVideoEnd);
        mainVideo.addEventListener('play', handleVideoPlay);
        mainVideo.addEventListener('pause', handleVideoPause);

        loadLastWatchedVideo(<?php echo $id ?>);
    }

    function handleSearch() {
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
    }

    function handleVideoEnd() {
        playNextVideo();
    }

    function handleVideoPlay() {
        // Add your logic to update last watched video when the video starts playing
        // For example:
        updateLastWatchedVideo(allVideos[currentVideoIndex].id, <?php echo $id ?>, mainVideo.currentTime);
    }

    function handleVideoPause() {
        // Add your logic to update last watched video when the video is paused
        // For example:
        updateLastWatchedVideo(allVideos[currentVideoIndex].id, <?php echo $id ?>, mainVideo.currentTime);
    }

    function updateLastWatchedVideo(videoId, studentId, currentTime) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', `update_last_watched_video.php?playlist=<?php echo $playlist ?>&video_id=${videoId}&student_id=${studentId}&current_time=${currentTime}`);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log('Last watched video updated successfully');
            } else {
                console.error('Failed to update last watched video');
            }
        };
        xhr.send(JSON.stringify({ videoId, studentId }));
    }

    function loadLastWatchedVideo(studentId) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `get_last_watched_video.php?student_id=${studentId}&playlist=<?php echo $playlist ?>`);
        xhr.onload = function () {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                if (data && data.video_id) {
                    lastWatchedVideoId = data.video_id;
                    const currentTime = data.current_time || 0;
                    const lastIndex = allVideos.findIndex(video => video.id === lastWatchedVideoId);
                    if (lastIndex !== -1) {
                        loadMusic(lastIndex + 1);
                        playMusic();
                        playingNow(lastIndex);
                        mainVideo.currentTime = currentTime;
                    }
                }
            } else {
                console.error('Failed to retrieve last watched video');
            }
        };
        xhr.send();
    }

    function playNextVideo() {
        currentVideoIndex++;
        if (currentVideoIndex < allVideos.length) {
            loadMusic(currentVideoIndex + 1);
            playMusic();
            playingNow(currentVideoIndex);
            const currentTime = mainVideo.currentTime;
            updateLastWatchedVideo(allVideos[currentVideoIndex].id, <?php echo $id ?>, currentTime);
        } else {
            if (!mainVideo.ended) {
                window.alert("Please watch the current video completely.");
                return;
            }
            window.alert("All videos have been played.");
        }
    }

    function playMusic() {
        mainVideo.play();
        playlist.classList.add('active');
    }

    function loadMusic(indexNumb) {
        mainVideo.src = `../video_play/media/${allVideos[indexNumb - 1].src}.mp4`;
        videoTitle.innerHTML = `${indexNumb}. ${allVideos[indexNumb - 1].name}`;
    }

    function playingNow(currentIndex) {
        const allLiTags = playlist.querySelectorAll('li');
        if (allLiTags.length > 0) {
            for (let j = 0; j < allVideos.length; j++) {
                if (j === currentIndex) {
                    allLiTags[j].classList.add('playing');
                } else {
                    allLiTags[j].classList.remove('playing');
                }
            }
        }
    }

    function clicked(element) {
        let getIndex = element.getAttribute("li-index");
        if (getIndex > currentVideoIndex) {
            window.alert("Please watch the current video completely before proceeding.");
            return;
        }
        musicIndex = getIndex;
        loadMusic(musicIndex);
        playMusic();
        playingNow();
    }

    function updatePlaylist() {
        AllLessons.innerHTML = `${allVideos.length} Lessons`;

        let musicIndex = 1;
        loadMusic(musicIndex);
        playingNow();

        for (let i = 0; i < allVideos.length; i++) {
            let liTag = `<li li-index="${i + 1}">
                <div class="row">
                    <span>${i + 1}. ${allVideos[i].name}</span>
                </div>
                <video class="${allVideos[i].id}" src="../video_play/media/${allVideos[i].src}.mp4" style="display: none;" title="${allVideos[i].name}"></video>
                <span id="${allVideos[i].id}" class="duration"></span>
            </li>`;
            playlist.insertAdjacentHTML('beforeend', liTag);

            let liVideoDuration = ulTag.querySelector(`#${allVideos[i].id}`)
            let liVideoTag = ulTag.querySelector(`.${allVideos[i].id}`);

            liVideoTag.addEventListener("loadeddata", () => {
                let videoDuration = liVideoTag.duration;
                let totalMin = Math.floor(videoDuration / 60);
                let totalSec = Math.floor(videoDuration % 60);
                totalSec < 10 ? totalSec = "0" + totalSec : totalSec
                liVideoDuration.innerText = `${totalMin}:${totalSec}`;
                liVideoDuration.setAttribute("t-duration", `${totalMin}:${totalSec}`);
            })
        }

        const allLiTags = playlist.querySelectorAll('li');
        for (let j = 0; j < allVideos.length; j++) {
            if (allLiTags[j].classList.contains('playing')) {
                allLiTags[j].classList.remove("playing")
            }
            if (allLiTags[j].getAttribute('li-index') == musicIndex) {
                allLiTags[j].classList.add('playing')
            }
            allLiTags[j].setAttribute("onclick", "clicked(this)")
        }
    }

    const video_ajax = new XMLHttpRequest();
    const method = "GET";
    const url = "video_list.php?playlist=<?php echo $playlist ?>";
    const asynchronous = true;
    video_ajax.open(method, url, asynchronous);

    video_ajax.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const data = JSON.parse(this.responseText);
            allVideos = data.map((item) => ({
                name: item.name,
                src: item.src,
                id: item.id,
            }));
            updatePlaylist();
            initializePlayer();
        }
    };

    video_ajax.send();
</script>
</body>
</html>
