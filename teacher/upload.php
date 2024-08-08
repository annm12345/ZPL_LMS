<?php
require('top.inc.php');
if(isset($_GET['playlistname'])){
  $playlist=get_safe_value($con,$_GET['playlistname']);
}
?>
<style>

.details {
    display: grid;
    grid-template-columns: 1fr;
  }

  a {
    text-decoration: none;
  }

  .cardHeader {
    background-color: #8C52FF;
    color: #fff;
    text-align: center;
    padding: 10px;
    border-radius: 5px 5px 0 0;
  }

  h2 {
    margin-top: 0;
    text-align: center;
    color: #8C52FF;
  }

  form {
    margin-top: 3rem;
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  .form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }

  form input {
    width: 100%;
    padding: 1rem 0.5rem;
    border: 1px solid gray;
    border-radius: 1rem;
    font-size: 1rem;
  }

  form textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
  }

  form textarea {
    height: 100px;
  }

  .form-group .cover-image-preview,
  .form-group .video-preview {
    max-width: 100%;
    margin-top: 10px;
  }

  .form-group .cover-image-preview img,
  .form-group .video-preview video {
    width: 100%;
    border-radius: 5px;
  }

  .form-group .submit-btn {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 3px;
    cursor: pointer;
  }

  .bar {
    display: grid;
    grid-template-columns: 1fr;
    border-radius: 3px;
    padding: 10px;
    background-color: #f2f2f2;
    margin-top: 20px;
  }

  button {
    border: 0px;
    width: 100px;
    padding: 10px 40px;
    border-radius: 3px;
    color: #8C52FF;
    cursor: pointer;
    text-align: center;
    font-weight: bold;
  }

  button:hover {
    background: #8C52FF;
    color: #fff;
  }

  .progress {
    background-color: #fff;
    height: 40px;
    border: 1px solid gray;
    border-radius: 4px;
  }

  .progress .progress-bar {
    width: 0%;
    height: 100%;
    background-color: #8C52FF;
    border-radius: 4px;
  }

  .action {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    background-color: #f2f2f2;
    padding: 10px;
    border-radius: 5px;
    margin-top: 10px;
  }

  .action span {
    line-height: 35px;
    text-align: center;
    font-weight: bold;
  }

  .custom-file {
  position: relative;
  display: inline-block;
}

.custom-file-input {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
  cursor: pointer;
}

.custom-file-label {
  display: block;
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.custom-file-label::after {
  content: "Choose a file";
}

.custom-file-input:focus ~ .custom-file-label,
.custom-file-input:valid ~ .custom-file-label {
  background-color: #0056b3;
}

.custom-file-input:valid ~ .custom-file-label::after {
  content: attr(data-file-name);
}


  @media screen and (max-width: 600px) {
    form input[type="submit"] {
      width: 50%;
    }
  }
        
  </style>
      

          <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Video Upload</h2>
                    </div>
                    <form id="form" action="" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="title">Video Title:</label>
                <input type="text" name="title" id="title" placeholder="Video Title" required>
              </div>
              <div class="form-group">
                <label for="video">Video File:</label>
                <input type="file" name="video" id="video" class="input-file"  required>
                
                <div class="video-preview"></div>
              </div>
              <div class="form-group">
                <input type="submit" name="upload" id="upload" value="Upload Video" class="submit-btn">
              </div>
            </form>
            <div class="bar">
                <div class="progress">
                    <div class="progress-bar"></div>
                </div>
                <div>
                    <span id="percent">0%</span>
                    <button id="cancel">Cancel</button>
                </div>
                
            </div>
            <div class="action">
                <span id="dataTransferred"></span>
                <span id="Mbps"></span>
                <span id="timeleft"></span>
            </div>
            </div>
            </div>
        </div>
    </div>
                

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </script>

  <script>


    // Video preview
    const videoInput = document.getElementById('video');
    const videoPreview = document.querySelector('.video-preview');

    videoInput.addEventListener('change', function (event) {
      const file = event.target.files[0];
      const reader = new FileReader();

      reader.onload = function () {
        const video = document.createElement('video');
        video.src = reader.result;
        video.controls = true;
        videoPreview.innerHTML = '';
        videoPreview.appendChild(video);
      }

      if (file) {
        reader.readAsDataURL(file);
      }
    });
    function displayFileName() {
        const fileInput = document.getElementById('file-input');
        const fileName = fileInput.value.split('\\').pop(); // Extract the file name from the file path
        const spanElement = document.querySelector('.file-label span');
        spanElement.textContent = fileName;
        }
        
        //upload
        $(document).ready(function(){
    $('#form').on('submit',function(e){
        e.preventDefault();
        var xhr=$.ajax({
            xhr:function(){
                var xhr=new XMLHttpRequest();
                var startTime=new Date().getTime();

                xhr.upload.addEventListener('progress',function(e){
                    if(e.lengthComputable){
                        var percentComplete=((e.loaded/e.total)*100);
                        var mbTotal=Math.floor(e.total/(1024*1024))
                        var mbloaded=Math.floor(e.loaded/(1024*1024))

                        var time=(new Date().getTime()-startTime)/1000
                        var bps=e.loaded/time
                        var Mbps=Math.floor(bps/(1024*1024))

                        var remTime=(e.total-e.loaded)/bps
                        var second=Math.floor(remTime % 60)
                        var minute=Math.floor(remTime /60)

                        $('#dataTransferred').html(`${mbloaded}/${mbTotal}MB`)
                        $('#Mbps').html(`${Mbps} Mbps`)
                        $('#timeleft').html(`${minute}m:${second}s`)
                        $('#percent').html(Math.floor(percentComplete)+'%')
                        $('.progress-bar').width(percentComplete + '%')
                        if(percentComplete> 0 && percentComplete<100){
                            $('#percent').prop('disabled',false);
                        }else{
                            $('#percent').prop('disabled',true);
                        }
                        
                    }
                },false);
                return xhr;
            },
            type:'POST',
            url:'video_upload.php?playlist=<?php echo $playlist ?>',
            data:new FormData(this),
            contentType:false,
            processData:false,
            beforeSend:function(){
                $('#percent').html('0%');
                $('.progress-bar').width('0%');
            },
            error:function(){
                console.log('Please try again')
            },
            success:function(response){
                $('#percent').html('uploaded');
                alert('upload sucessfully');
                window.location.href='index.php';
            }
        });
        $('#cancel').on('click',()=>{
            xhr.abort().then(
                $('#percent').html('canceled'),
                $('.progress-bar').width('0%')
            )
        });

    })
})
    
  </script>