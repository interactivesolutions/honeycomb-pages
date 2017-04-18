<meta name="csrf-token" content="{{ csrf_token() }}">

{!!

    Minify::stylesheet([
        '/assets/css/bootstrap.min.css',
        '/assets/css/custom.css'
    ])

!!}