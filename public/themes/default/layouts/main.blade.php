<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <meta name="keywords" content="{!! Theme::getKeywords() !!}">
    <meta name="description" content="{!! Theme::getDescription()  !!}">

    <title>{!! Theme::getTitle() !!}</title>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    {!! Theme::asset()->styles() !!}

    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68562444-1', 'auto');
  ga('send', 'pageview');

</script>


</head>

<body>

  {!! Theme::partial('header') !!}

    <!-- Page Content -->
    <div class="container">

        {!! Theme::content() !!}


        <!-- /.row -->

        <hr>

        <!-- Footer -->
        {!! Theme::partial('footer') !!}


    </div>
    <!-- /.container -->

    {!! Theme::asset()->scripts() !!}

</body>

</html>
