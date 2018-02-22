<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/favicon.ico">
    <title>Error!</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Microsoft Yahei', sans-serif;
        }
        body {
            background: rgb(95, 66, 135);
            margin: 0;
        }
        .error {
            position: absolute;
            top: calc(50%);
            width: 100%;
        }
        .error p,
        .error h2 {
            color: #fff;
            text-align: center;
            margin: 0 0 10px;
        }
        .error a,
        .error a:hover,
        .error a:focus{
            margin: 20px auto 0;
            display: block;
            width: 100px;
            color: #fff;
            text-decoration: none;
            outline: none;
            border: 1px solid #fff;
            border-radius: 6px;
            text-align: center;
            line-height: 33px;
            transition: all .35s;
        }
        .error a:hover {
            background: rgba(255,255,255,.2);
        }
    </style>
</head>

<body>
<div class="error">
    <h2>Error!</h2>
    <p>你访问的页面,没有找到内容,已经失效</p>
    <a href="<?php $this->options->siteUrl(); ?>">返回首页</a>
</div>
</body>
</html>