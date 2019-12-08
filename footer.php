<html>
  <head>
    <style>
      .footer {
         position: fixed;
         left: 0;
         bottom: 0;
         width: 100%;
         background-color: grey;
         color: white;
         text-align: center;
         padding: 5px;
      }
    </style>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

    <script>
      function disableCookieBanner() {
        var cookieBanner = document.getElementById("footer");
        cookieBanner.style.display = "none";
        setCookie('cookieConsent','Approved')
      }

      function setCookie(cname, cvalue) {
        document.cookie = cname + "=" + cvalue + ";path=/";
      }

      let cookieConsentValue = null;
      const consentValue =  c => {
        let allCookies = decodeURIComponent(document.cookie);
        let consentCookie = allCookies.split(';');
        consentCookie.forEach(ckie => {
          cookie = ckie.split('=');
          cName = cookie[0].trim();
          if (cName === c) {
            if (cookie[1] === "NonApproved") {
              cookieConsentValue = "NonApproved";
            } else {
              cookieConsentValue = "Approved";
            }
          }
        })
      }
      consentValue('cookieConsent');

      $(document).ready(function() {
          if(cookieConsentValue === "NonApproved"){
              $("#footer").show();
              console.log('NonApproved')
          }else{
              $("#footer").hide();
              console.log('Approved')
          }
      });

    </script>
  </head>
  <body>
    <footer>
      <div id="footer" class="footer">
        <label>PR-SYS uses cookies to understand how you use our site and to improve your experience.</label>
        <button type="button" class="btn btn-light btn-sm" onclick="disableCookieBanner()">Ok</button>
      </div>
    </footer>
  </body>
</html>
