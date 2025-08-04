<button onclick="obtenerToken()">TEST</button>

<script src=".\axios\dist\axios.js" ></script>
<script src="./js/toolsCookie.js" ></script>
<script>
//obtenerToken();

function obtenerToken(){
	
	axios.post('https://api-cil.hoscar.cl/api/v1/login', {
		usuario: 'proservipol',
		clave: '49epRYJrTzse'
	},
	{
		headers: { 
			'Access-Control-Allow-Origin': '*'
		}
    })
    .then(function(res) {
        console.log(res);
        if(res.status==200) {
            token	= res.data.access_token;
			type	= res.data.token_type;
			date	= res.data.expires_in;
            console.log(token);
            console.log(type);
            console.log(date);
			//max-age por milisegundos, 86400 24 horas, 43200 12 horas, 3600 1 hora, 600 10 minutos, 60 1 minuto, 1 1 segundo
			setCookie('accessToken_AutentificaTIC', token, {'max-age': 43200});
        }
    })
    .catch(function(err) {
        console.log(err);
    });
}

</script>