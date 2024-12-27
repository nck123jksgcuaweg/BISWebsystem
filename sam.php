<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Input Placeholder to Legend Effect</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="input-container">
  <input type="text" id="myInput" placeholder="">
  <label for="myInput" class="input-label">Name</label>
</div>

<script src="script.js"></script>
</body>
</html>
<style>
    .input-container {
  position: relative;
  margin-bottom: 20px;
}

input[type="text"] {
  width: 200px;
  padding: 10px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.input-label {
  position: absolute;
  top: 10px;
  left: 10px;
  transition: all 0.3s ease;
  pointer-events: none;
  color: #999; /* Placeholder color */
}

input:focus + .input-label, input:not(:placeholder-shown) + .input-label {
  top: -5px;
  font-size: 12px;
  background-color: white;
  width: 2%;
  color: #333; /* Color when focused or input is not empty */
}

</style>

<script>
    document.getElementById('myInput').addEventListener('input', function() {
  this.classList.toggle('has-content', this.value.trim() !== '');
});

</script>