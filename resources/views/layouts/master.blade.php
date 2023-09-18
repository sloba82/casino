<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Casino Test</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        @include('_partials.header')

        @yield('content')

        @include('_partials.footer')

    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){

            $('#search').on('click', function() {
                let officeVal = $('#office').val();
                let distanceVal = $('#distance').val();
                let searchResult = $('#search_result');

                searchResult.empty();
                $('.error').hide();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/search_result',
                    method: 'POST',
                    data:{
                        office: officeVal,
                        distance: distanceVal,
                    },
                    success:function(response)
                    {
                        if(response){
                            searchResult.append(response);
                        }
                    },
                    error: function(response) {

                        if( response.status === 422 ){
                            let responseMessage = JSON.parse(response.responseText);
                            $.each( responseMessage.errors, function( key, value) {
                                $('#'+key+'_error').show()
                            });
                        }
                        else{
                            alert('Something went wrong!');
                        }
                    }
                });
            });

        });
    </script>

  </body>
</html>
