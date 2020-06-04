<html lang="en">
  <head>
  </head>
  <body >
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
  $(document).ready([
    function() {
      function init() {
        // do stuff
        window.top.location.href = "welcomepost0"; 
      }
      // set `init` as property of `document`
      this.init = init;
    },
    function bla() {
      if ($.isReady /* blablabla */)
        document.init();
    }
  ])
</script>
</html>