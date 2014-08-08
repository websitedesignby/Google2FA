<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php if(isset($page_title)): echo $page_title; endif; ?></title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?php if(isset($page_description)): echo $page_description; endif; ?>">
        <meta name="author" content="Ross Sabes - webdesignby.com">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <style type="text/css">
            .navbar-brand{
                font-size:11px;
            }
            body{padding-top:50px;}
            #main-content{padding:40px 15px;}
            </style>
    </head>
    <body>
        <div class="container" id="main-content">
