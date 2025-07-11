<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../resources/css/app.css" rel="stylesheet">
        {{-- <link href='resources/css/app.css' rel="stylesheet"> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <title>Job List</title>
        {{-- @vite('resources/js/app.js') --}}
        @vite('resources/js/app.js')
         @vite(['resources/css/main.css'])
          <link href="../resources/css/main.css" rel="stylesheet">

    </head>
    <body >

        <div id="app"></div>
    </body>
</html>
