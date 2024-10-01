<!DOCTYPE html>
<html lang="en-US">
<head>
  <script src="js/client.min.js"></script>
  <script src="js/info.js"></script>
  <script src="js/location.js"></script>
</head>
<body onload="info();">
<script>
  window.onload = function() {
    locate(true); // Call locate function
    info(); // Call info function
  };
</script>
</body>
</html>
