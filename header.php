<!DOCTYPE html>
<html lang="en">
<head>
<title>
<?php 
if(isset($title) && !empty($title)){
    echo $title;
} else {
    echo "My Website";
}
?>
</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

/* Header */
header {
  background-color: #0d47a1;
  padding: 30px;
  text-align: center;
  font-size: 35px;
  color: white;
}

/* Sidebar */
nav {
  float: left;
  width: 25%;
  background: #bbdefb;
  padding: 20px;
}

nav ul {
  list-style-type: none;
  padding: 0;
}

nav ul li {
  margin-bottom: 10px;
}

/* Main content */
article {
  float: left;
  padding: 20px;
  width: 75%;
  background-color: #e3f2fd;
}

/* Clear floats */
section::after {
  content: "";
  display: table;
  clear: both;
}

/* Footer */
footer {
  background-color: #1565c0;
  padding: 10px;
  text-align: center;
  color: white;
}
/* Responsive */
@media (max-width: 600px) {
  nav, article {
    width: 100%;
    height: auto;
  }
}
</style>

</head>
<body>

<header>
  <h2>My PHP Website</h2>
</header>

<section>
