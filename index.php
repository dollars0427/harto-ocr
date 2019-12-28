<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Harto OCR</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/litera/bootstrap.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css"
  integrity="sha256-0Z6mOrdLEtgqvj7tidYQnCYWG3G2GAIpatAWKhDx+VM=" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>
  <nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">
      Harto
    </a>
  </nav>
  <div class="harto">
    <div class="container">
      <h1>Harto OCR</h1>
      <div class="dropzone-wrapper">
        <div id="hartoDropzone" class="dropzone"></div>
        <button class="btn btn-primary btn-upload">
          Upload and Process
        </button>
      </div>
      <div class="result-wrapper">
        <p class="result-label">Result:</p>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous">
</script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js" integrity="sha256-awEOL+kdrMJU/HUksRrTVHc6GA25FvDEIJ4KaEsFfG4=" crossorigin="anonymous"></script>
  <script>
  Dropzone.autoDiscover = false;
  const hartoDropzone = new Dropzone('#hartoDropzone', {
    url: 'process.php',
    maxFilesize: 10,
    acceptedFiles: 'image/*',
    addRemoveLinks: true,
    dictDefaultMessage: '將檔案拖至此或點擊上傳',
    autoProcessQueue: false,
    parallelUploads: 1000,
    uploadMultiple: true,
    successmultiple: function(file, response){
      hartoDropzone.removeAllFiles();
      const dropzoneText = document.querySelector('.dz-message span');
      dropzoneText.textContent = '上載完成！如要繼續，請再次將檔案拖至此或點擊上傳';
      console.log(response);
    }
  });
  $('.btn-upload').click(function(e){
    hartoDropzone.processQueue();
  });
</script>
</body>
</html>
