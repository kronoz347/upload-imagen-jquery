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
            <p><img id="myImg" src="#" alt="your image" height=400 ></p>
        </div>
        <canvas id="mycanvas"></canvas>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript">
            /* The uploader form */
            (function ($) {

                var site_url = "<?php echo $siteUrl; ?>";

                $(":file").change(function () {
                    if (this.files && this.files[0]) {
                        var reader = new FileReader();

                        reader.onload = imageIsLoaded;
                        reader.readAsDataURL(this.files[0]);
                    }
                });


                function imageIsLoaded(e) {
                    $('#myImg').attr('src', e.target.result);
                    $('#yourImage').attr('src', e.target.result);
                };

                $('#multi_file_upload').change(function (e) {
                    var file_id = e.target.id;
                    console.log(file_id);
                    var file_name_arr = new Array();
                    var process_path = site_url + 'public/uploads/';
                    console.log($("#" + file_id).prop("files"));
                    for (i = 0; i < $("#" + file_id).prop("files").length; i++) {

                        var form_data = new FormData();
                        var file_data = $("#" + file_id).prop("files")[i];
                        form_data.append("file_name", file_data);

                        if (check_multifile_logo($("#" + file_id).prop("files")[i]['name'])) {
                            $.ajax({
                                //url         :   site_url + "inc/upload_image.php?width=96&height=60&show_small=1",
                                url: site_url + "upload.php",
                                cache: false,
                                contentType: false,
                                processData: false,
                                async: false,
                                data: form_data,
                                type: 'post',
                                success: function (data) {
                                    console.log(data);
                                }
                            });
                        } else {
                            $("#" + html_div).html('');
                            alert('We only accept JPG, JPEG, PNG, GIF and BMP files');
                        }

                    }
                });

                function check_multifile_logo(file) {
                    var extension = file.substr((file.lastIndexOf('.') + 1))
                    if (extension === 'jpg' || extension === 'jpeg' || extension === 'gif' || extension === 'png' || extension === 'bmp') {
                        return true;
                    } else {
                        return false;
                    }
                }

                function sendFile(file) {
                    var uri = "/upload.php";
                    var xhr = new XMLHttpRequest();
                    var fd = new FormData();

                    xhr.open("POST", uri, true);
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            alert(xhr.responseText); // handle response.
                        }
                    };
                    fd.append('myFile', file);
                    // Initiate a multipart/form-data upload
                    xhr.send(fd);
                }

            }(jQuery));
        </script>
    </body>
</html>
