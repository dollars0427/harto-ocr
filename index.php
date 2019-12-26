<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Harto OCR</title>
  <link rel="stylesheet"
  href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
  integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
  crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" integrity="sha256-0Z6mOrdLEtgqvj7tidYQnCYWG3G2GAIpatAWKhDx+VM=" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <div class="harto">
    <div class="container">
      <h1>Harto OCR</h1>
      <div class="harto-dropzone">
        <form method="post" action="/process.php" class="dropzone">
          <div class="fallback">
            <input name="file" type="file" multiple />
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js" integrity="sha256-awEOL+kdrMJU/HUksRrTVHc6GA25FvDEIJ4KaEsFfG4=" crossorigin="anonymous"></script>
</body>
</html>
