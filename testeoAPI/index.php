<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
  #loading {
    display: none;
  }
  </style>
  <script src="..\axios\dist\axios.js"></script>
</head>
<body>
  <button id="json_get">Request JSON GET</button> 
  <button id="json_post">Request JSON POST</button>
  <div id="mensaje"></div>
  <div id="loading">cargando...</div>
  
  <script>
var loading = document.getElementById('loading');
var mensaje = document.getElementById('mensaje');

    var boton = document.getElementById('json_get');
    boton.addEventListener('click', function() {
      loading.style.display = 'block';
      axios.get('https://jsonplaceholder.typicode.com/todos/1', {
        responseType: 'json'
      })
        .then(function(res) {
          if(res.status==200) {
            console.log(res.data);
            mensaje.innerHTML = res.data.title;
          }
          console.log(res);
        })
        .catch(function(err) {
          console.log(err);
        })
        .then(function() {
          loading.style.display = 'none';
        });
    });

    var boton = document.getElementById('json_post');
    boton.addEventListener('click', function() {
      loading.style.display = 'block';
      axios.post('https://jsonplaceholder.typicode.com/posts', {
        data: {
          userId: 1,
          title: 'Esto es un post nuevo',
          body: 'cuerpo de este post. Me gusta la librería Axios!!'
        }
      })
        .then(function(res) {
          if(res.status==201) {
            mensaje.innerHTML = 'El nuevo Post ha sido almacenado con id: ' + res.data.id;
          }
        })
        .catch(function(err) {
          console.log(err);
        })
        .then(function() {
          loading.style.display = 'none';
        });
    });
  </script>
</body>
</html>