<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Posts</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            
            $.get('/Posts/index_html', function(res) {
            $('#posts').html(res);
            });
            $('form').submit(function(){
            // there are three arguments that we are passing into $.post function
            //     1. the url we want to go to: '/quotes/create'
            //     2. what we want to send to this url: $(this).serialize()
            //            $(this) is the form and by calling .serialize() function on the form it will 
            //            send post data to the url with the names in the inputs as keys
            //     3. the function we want to run when we get a response:
            //            function(res) { $('#quotes').html(res) }
            $.post($(this).attr('action'), $(this).serialize(), function(res) {
                $('#posts').html(res);
            });
            // We have to return false for it to be a single page application. Without it,
            // jQuery's submit function will refresh the page, which defeats the point of AJAX.
            // The form below still contains 'action' and 'method' attributes, but they are ignored.
            return false;
            });
        });
    </script>
</head>
<body>
<!-- Main CONTAINER -->
    <div class="container-fluid">
        <!-- content container -->
        <div class="container p-2">
            <h1 class="display-4">My Posts:</h1>
            <div class="row row-cols-1 row-cols-md-4 g-3" id="posts">

            </div>
            <!-- container form -->
            <div class="container">
                <form action="/posts/post" method="post">
                    <div><?=$this->session->flashdata('input_errors');?></div>
                    <div class="form-floating my-3">
                        <textarea class="form-control" placeholder="Leave a comment here" name="my_post" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Enter your post here</label>
                    </div>
                    <input  class="btn btn-primary my-3" type="submit" value="Post It!">
                </form>
            </div>
            <!-- end container form -->
        </div>
        <!-- end content container -->
    </div>
<!-- END Main CONTAINER -->
</body>
</html>