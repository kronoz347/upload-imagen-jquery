<!DOCTYPE html>
<html>
    <body>
        <style>
            /* Image Designing Propoerties */
            .thumb {
                height: 75px;
                border: 1px solid #000;
                margin: 10px 5px 0 0;
            }
        </style>

        <div class="upload-imagen">
            <input type='file' />
   
        </div>
        <canvas id="mycanvas"></canvas>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">
            /* The uploader form */
            (function ($) {

                var site_url = "<?php echo $siteUrl; ?>";
                
                $(":file").change(function () {
                    var $inputFile = $(this);
                    $inputFile.fadeOut(300);
                    if (this.files && this.files[0]) {
                        
                        var reader = new FileReader();
                        reader.onload = imageIsLoaded;                        
                        reader.readAsDataURL( this.files[0] );
                        
                        var form_data = new FormData();
                        form_data.append('myFile', this.files[0]);
                        $.ajax({                               
                            url: site_url + "upload.php",
                            cache: false,
                            contentType: false,
                            processData: false,
                            async: false,
                            data: form_data,
                            type: 'post',
                            success: function (data) {
                                var button = document.createElement('button'); 
                                var $button = $(button);
                                $button.hide();
                                $button.val('eliminar');
                                $button.html('Eliminar');
                                $button.on('click', function(e){
                                    $button.fadeOut(300, function(e){
                                        $inputFile.fadeIn(300);
                                        $inputFile.val('');
                                        $('.upload-imagen').find('img').remove();
                                    });
                                });
                                $('.upload-imagen').append($button);
                                $button.fadeIn(300, function(){
                                    $inputFile.fadeOut(300);
                                });
                            }
                        });
                    }
                });


                function imageIsLoaded(e) {
                
                    var divContent = document.createElement('div'); 
                    var imgPreview = document.createElement('img'); 
                    imgPreview.className='img_preview';
                    imgPreview.height = '400';
                    imgPreview.src = e.target.result;
                    divContent.appendChild(imgPreview);
                    $('.upload-imagen').append(divContent);
            
                };

            }(jQuery));
        </script>
    </body>
</html>
