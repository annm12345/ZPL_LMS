let allVideos=[]
const video_ajax = new XMLHttpRequest();
const method = "GET";
const url = "video_list.php";
const asynchronous = true;
video_ajax.open(method, url, asynchronous);

// Sending AJAX request
video_ajax.send();

// Receiving response from video_list.php
video_ajax.onreadystatechange = function () {
if (this.readyState == 4 && this.status == 200) {
   const data = JSON.parse(this.responseText);
   console.log(data);

   // Insert fetched data into allVideos array
   
   let allVideos =data.map((item) => ({
      name: item.name,
      src: item.src,
      id: item.id,
      }));
    }
  };