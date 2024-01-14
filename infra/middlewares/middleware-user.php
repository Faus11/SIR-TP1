<?php

session_start();

if (!isset($_SESSION['id'])) {
  if (isset($_COOKIE['id']) && isset($_COOKIE['firstname'])) {
    $_SESSION['id'] = $_COOKIE['id'];
    $_SESSION['firstname'] = $_COOKIE['firstname'];
  } else {
    header('Location: ../../');
  }
}