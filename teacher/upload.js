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