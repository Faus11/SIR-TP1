<?php

session_start();

if (!isset($_SESSION['id'])) {
  if (isset($_COOKIE['id']) && isset($_COOKIE['firstname'])) {
    $_SESSION['id'] = $_COOKIE['id'];
    $_SESSION['firstname'] = $_COOKIE['firstname'];
  } else {
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/SIR-TP1/';
    header('Location: ' . $home_url);
  }
}