﻿<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="description" content="Devrama Bookのデモでーす。">
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="jquery.devrama.book.js"></script>  
<link rel="stylesheet" type="text/css" href="devrama-book.css"/>
<style>
#demo {
  margin: 50px 500px;
  text-align: center;
}
#demo h2 {
  padding 100px;
  color: #fff;
}
</style>
</head>
<body>
 
<h1>Devrama Book のデモでーす。</h1>
 
<div id="demo" class="devrama-book">
<ul class="front">
  <li class="front">
    <h2>本のタイトル</h2>
  </li>
  <li class="back">
    <h2>背表紙</h2>
  </li>
</ul>
<ul class="page">
  <li></li>
  <li>むかしむかしあるところに</li>
  <li>おじいさんと</li>
  <li>おばあさんがいました。</li>
  <li>おばあさんは川へ</li>
  <li>おじいさんは…</li>
</ul>
</div>
 
<script>
$(function(){
  $('.devrama-book').DrBook({
    width: 400,
    height: 500
  });
});
</script>
 
</body>
</html>
