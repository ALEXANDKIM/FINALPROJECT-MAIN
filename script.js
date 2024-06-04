/**
 * Purpose: Handle the button click event to show a loader animation and redirect to secondpage.php
 * Author: Alex Punay
 * Contact: alexpunay@gmail.com
 * Date: [Date of May 10, 2024]
 * Last modification: [Insert Date May 16, 2024]
 * @param None
 * @returns None
 */

// Add event listener to button
document.getElementById("load-btn").addEventListener("click", function() {
  // Show loader
  document.getElementById("loader").style.display = "block";

  // Hide loader after 5 seconds
  setTimeout(function() {
    document.getElementById("loader").style.display = "none";
  }, 5000);
});
