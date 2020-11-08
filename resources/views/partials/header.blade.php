<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="base-url" content="{{ url('/') }}">

    <link rel="icon" href="https://img.icons8.com/bubbles/2x/visible.png" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="https://img.icons8.com/bubbles/2x/visible.png" />

    <!-- Generated: 2019-04-04 16:55:45 +0200 -->
    <title>OLAP</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- <link rel="stylesheet" href="{{ asset('/assets/css/libraries/bootstrap.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('/assets/css/libraries/tabler.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/libraries/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/libraries/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/build/style.css') }}">
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.22/datatables.min.css"/>
    {{-- <script type="text/javascript">
      const doc = document, base_url = doc.querySelector('[name=base-url]').getAttribute('content'), level = doc.querySelector('[name=level]').getAttribute('content');
      function _url(url = ''){
        return base_url+url;
      }
    </script> --}}

  </head>
