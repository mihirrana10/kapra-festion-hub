<html>


 

<head>

    <base target="_top">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


 

    <style>

        form {

            margin-top: 10px;

            text-align: center;

        }


 

        input[type=file] {

            position: absolute;

            top: 0;

            right: 0;

            margin: 0;

            padding: 0;

            font-size: 20px;

            cursor: pointer;

            opacity: 0;

            filter: alpha(opacity=0);

        }


 

        #resp {

            border: 2px solid lightgrey;

            margin: 15px;

            padding: 15px;

            border-radius: 5px;

            text-align: center;

            overflow-x: scroll;


 

        }



 

    </style>

</head>



 

<body>


 

    <form id="myform">

        <div>

            <div class="input-group">

                <span class="input-group-btn">

                    <div class="btn btn-default browse-button">

                        <span class="browse-button-text">

                            <i class="fa fa-folder-open"></i> Browse</span>

                        <input type="file" name="File" mulitple />

                    </div>

                    <button type="button" class="btn btn-default clear-button" style="display:none;">

                        <span class="fa fa-times"></span> Clear

                    </button>

                </span>

                <input type="text" class="form-control filename" disabled="disabled"

                    placeholder="Please click on browse button and select a pdf file">

                <span class="input-group-btn">

                    <button class="btn btn-primary upload-button" type="button" id="submitBtn">

                        <i class="fa fa-upload"></i>

                        Upload

                    </button>

                </span>

            </div>

            <div id="resp"></div>

        </div>


 

    </form>


 

    <script>

        $(".browse-button input:file").change(function () {

            $("input[name='File']").each(function () {

                var fileName = $(this).val().split('/').pop().split('\\').pop();

                $(".filename").val(fileName);

                $(".browse-button-text").html('<i class="fa fa-refresh"></i> Change');

                $(".clear-button").show();

            });

        });


 

        $('.clear-button').click(function () {

            $('.filename').val("");

            $('.clear-button').hide();

            $('.browse-button input:file').val("");

            $(".browse-button-text").html('<i class="fa fa-folder-open"></i> Browse');

        });



 

        document.getElementById("submitBtn").addEventListener('click', function (){

          document.getElementById("resp").innerHTML = `<img src = "https://i.gifer.com/origin/b4/b4d657e7ef262b88eb5f7ac021edda87.gif" style="width:19px">`


 

          uploadFile(document.getElementById("myform"))

        });


 

        function onSuccess(data){

          document.getElementById("resp").innerHTML = `${data}`;


 

        }


 

        function onFailure(data){

          document.getElementById("resp").innerHTML = "Unable  To Upload This File . Try Again Later " + data;

          

        }


 

        function uploadFile(form){

          const file = form.File.files[0];

          const fr = new FileReader();

          fr.onload = function(e){

            const obj = {filename : file.name , mimeType : file.type , bytes : [...new Int8Array(e.target.result)]  };

            google.script.run.withSuccessHandler(onSuccess).withFailureHandler(onFailure).uploadFiles(obj);

          }

          fr.readAsArrayBuffer(file);

        }




 

    </script>

</body>


 

</html>