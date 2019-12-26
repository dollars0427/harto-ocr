<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Harto OCR</title>
  <link rel="stylesheet"
  href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
  integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
  crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <div class="harto">
    <div class="container">
      <h1>Harto OCR</h1>
      <div class="harto-dropzone">
        <form action="/process.php" class="dropzone">
          <input name="file" type="file" multiple />
          <div class="form-group">
            <input class="btn btn-primary" type="submit" value="上傳並處理圖片" />
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
