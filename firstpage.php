<?php
/**
 * File: firstpage.php
 * Purpose: Display a loader animation while redirecting to secondpage.php
 * Author: Alex Punay
 * Contact: alexpunay@gmail.com
 * Date: [Date of May 10]
 * Last modification: [Insert Date May 16, 2024]
 * Contents: This file contains HTML and JavaScript code to display a loader animation
 * while redirecting to the second page when a button is clicked.
 */

 
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    /* Loader styles */
    .loader {
      --path: #2f3545;
      --dot: #5628ee;
      --duration: 3s;
      width: 44px;
      height: 44px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      display: none;
    }

    .loader:before {
      content: '';
      width: 6px;
      height: 6px;
      border-radius: 50%;
      position: absolute;
      display: block;
      background: var(--dot);
      top: 37px;
      left: 19px;
      transform: translate(-18px, -18px);
      animation: dotRect var(--duration) cubic-bezier(0.785, 0.135, 0.15, 0.86) infinite;
    }

    .loader svg {
      display: block;
      width: 100%;
      height: 100%;
    }

    .loader svg rect, .loader svg polygon, .loader svg circle {
      fill: none;
      stroke: var(--path);
      stroke-width: 10px;
      stroke-linejoin: round;
      stroke-linecap: round;
    }

    .loader svg polygon {
      stroke-dasharray: 145 76 145 76;
      stroke-dashoffset: 0;
      animation: pathTriangle var(--duration) cubic-bezier(0.785, 0.135, 0.15, 0.86) infinite;
    }

    .loader svg rect {
      stroke-dasharray: 192 64 192 64;
      stroke-dashoffset: 0;
      animation: pathRect 3s cubic-bezier(0.785, 0.135, 0.15, 0.86) infinite;
    }

    .loader svg circle {
      stroke-dasharray: 150 50 150 50;
      stroke-dashoffset: 75;
      animation: pathCircle var(--duration) cubic-bezier(0.785, 0.135, 0.15, 0.86) infinite;
    }

    .loader.triangle {
      width: 48px;
    }

    .loader.triangle:before {
      left: 21px;
      transform: translate(-10px, -18px);
      animation: dotTriangle var(--duration) cubic-bezier(0.785, 0.135, 0.15, 0.86) infinite;
    }

    @keyframes pathTriangle {
      33% {
        stroke-dashoffset: 74;
      }

      66% {
        stroke-dashoffset: 147;
      }

      100% {
        stroke-dashoffset: 221;
      }
    }

    @keyframes dotTriangle {
      33% {
        transform: translate(0, 0);
      }

      66% {
        transform: translate(10px, -18px);
      }

      100% {
        transform: translate(-10px, -18px);
      }
    }

    @keyframes pathRect {
      25% {
        stroke-dashoffset: 64;
      }

      50% {
        stroke-dashoffset: 128;
      }

      75% {
        stroke-dashoffset: 192;
      }

      100% {
        stroke-dashoffset: 256;
      }
    }

    @keyframes dotRect {
      25% {
        transform: translate(0, 0);
      }

      50% {
        transform: translate(18px, -18px);
      }

      75% {
        transform: translate(0, -36px);
      }

      100% {
        transform: translate(-18px, -18px);
      }
    }

    @keyframes pathCircle {
      25% {
        stroke-dashoffset: 125;
      }

      50% {
        stroke-dashoffset: 175;
      }

      75% {
        stroke-dashoffset: 225;
      }

      100% {
        stroke-dashoffset: 275;
      }
    }
  </style>
</head>
<body>
  <div class="container-fluid d-flex align-items-center justify-content-center" style="height: 100vh;">
    <a href="secondpage.php" class="btn btn-danger btn-lg" id="load-btn">Create Resume with Easy Steps!</a>
    <div class="loader triangle" id="loader"></div>
  </div>

  <script>
    // Add event listener to button
    document.getElementById("load-btn").addEventListener("click", function() {
      // Show loader
      document.getElementById("loader").style.display = "block";

      // Hide loader after 5 seconds
      setTimeout(function() {
        document.getElementById("loader").style.display = "none";
      }, 5000);
    });
  </script>
</body>
</html>
