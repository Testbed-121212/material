<?php 
  include_once('db.php');
  include_once('populate_db.php'); 
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Injection demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    
  <main>
  <div class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
      <a href="index.php" class="d-flex align-items-center text-dark text-decoration-none">
        <span class="fs-4">Why not brew a coffee while you wait...</span>
      </a>
    </header>

    <div class="p-5 mb-4 bg-dark text-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Injection</h1>
        <p class="col-md-8 fs-4">Enumerate me and fuzz for injection vulnerabilities.</p>
      </div>
    </div>

    <!-- sqli -->
    <div class="row align-items-md-stretch" style="margin-bottom: 1.5rem !important">
      <div class="col-md-6">
        <div class="h-100 p-5 bg-light border rounded-3">
          <h2>SQL injection demo</h2>
          <p>Get coffee by roast level.</p>
          <div class="form-group" style="margin-bottom: 10px">
            <label for="inputRoast">Roast level (1-5)</label>
            <input type="text" class="form-control" id="inputRoast" placeholder="Enter roast level">
          </div>
          <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modal" onclick="demo1()">Get coffee</button>
        </div>
      </div>
      <div class="col-md-6">
        <div class="h-100 p-5 bg-light border rounded-3">
          <h2>Login</h2>
          <p>Log yourself in as admin.</p>
          <div class="form-group" style="margin-bottom: 10px">
            <label for="inputTrack">Username</label>
            <input type="text" class="form-control" id="inputUsername" placeholder="Enter username">
          </div>
          <div class="form-group" style="margin-bottom: 10px">
              <label for="inputTrack">Password</label>
              <input type="password" class="form-control" id="inputPassword" placeholder="Enter password">
          </div>
          <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modal" onclick="demo2()">Login</button>
        </div>
      </div>
    </div>

    <!-- modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="modalLabel">Results</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="main-modal">
            <!-- results space -->
            <div class="clear: both"></div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
      </div>
      <!-- end modal -->

    <footer class="pt-3 mt-4 text-muted border-top">
      &copy; 2022
    </footer>
  </div>
</main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script>
        // 001
        const demo1 = async () => {
            let inputValue = document.getElementById('inputRoast').value;
            let roast = inputValue.toString();
            let uri = 'v1/001.php?roast=' + roast;
            const response1 = await fetch(uri);
            const responseJson = await response1.json();
            // update with response
            // clear the modal
            document.getElementById('main-modal').innerHTML = "";
            modalContainer = document.getElementById('main-modal');
            let para = document.createElement('p');
            responseJson.forEach(function(coffee) {
              para.innerHTML += "<h3>" + coffee.name + "</h3>";
              para.innerHTML += "ID: " + coffee.ID + "<br>";
              para.innerHTML += "Origin: " + coffee.origin + "<br>";
              para.innerHTML += "Roast Level: " + coffee.roast_level;
              para.innerHTML += "<hr>";
            });
            modalContainer.appendChild(para);
        }

        // 002
        const demo2 = async () => {
          let formUsername = document.getElementById('inputUsername').value;
          let formPassword = document.getElementById("inputPassword").value;
          let uri = 'v1/002.php';
          let data = {
              username: formUsername,
              password: formPassword
          };
          const response2 = await fetch(uri, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
          });
          const loginJson = await response2.json();
          document.getElementById('main-modal').innerHTML = "";
          modalContainer = document.getElementById('main-modal');
          let para = document.createElement('p');
          para.innerHTML += loginJson.toString();
          modalContainer.appendChild(para);
        }

        

    </script>
  </body>
</html>
