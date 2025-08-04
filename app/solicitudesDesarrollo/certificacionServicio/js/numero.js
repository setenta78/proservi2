function oNumero(numero){
	//Propiedades 
	this.valor = numero || 0
	this.dec = -1;
	
	//M�todos 
	this.formato = numFormat;
	this.ponValor = ponValor;
	
	//Definici�n de los m�todos 
	function ponValor(cad){
		if (cad =='-' || cad=='+') return
		if (cad.length ==0) return
		if (cad.indexOf('.') >=0)
		    this.valor = parseFloat(cad);
		else 
		    this.valor = parseInt(cad);
	}
	 
	function numFormat(dec, miles){
		var num = this.valor, signo=3, expr;
		var cad = ""+this.valor;
		var ceros = "", pos, pdec, i;
		for (i=0; i < dec; i++)
		ceros += '0';
		pos = cad.indexOf('.')
		if (pos < 0)
    		cad = cad+"."+ceros;
		else
    	{
    		pdec = cad.length - pos -1;
    		if (pdec <= dec)
        	{
        		for (i=0; i< (dec-pdec); i++)
            	cad += '0';
        	}
    		else
        	{
        		num = num*Math.pow(10, dec);
        		num = Math.round(num);
        		num = num/Math.pow(10, dec);
        		cad = new String(num);
        	}
    	}

		pos = cad.indexOf('.')
		if (pos < 0) pos = cad.lentgh
		if (cad.substr(0,1)=='-' || cad.substr(0,1) == '+') 
       		signo = 4;
		if (miles && pos > signo)
    	do{
        	expr = /([+-]?\d)(\d{3}[\.\,]\d*)/
        	cad.match(expr)
        	cad=cad.replace(expr, RegExp.$1+','+RegExp.$2)
        }

		while (cad.indexOf(',') > signo)
    	if (dec<0) cad = cad.replace(/\./,'')
        return cad;
}
}//Fin del objeto oNumero:


function formato_numero(numero, decimales, separador_decimal, separador_miles){ // v2007-08-06
    numero=parseFloat(numero);
    if(isNaN(numero)){
        return "";
    }

    if(decimales!==undefined){
        // Redondeamos
        numero=numero.toFixed(decimales);
    }

    // Convertimos el punto en separador_decimal
    numero=numero.toString().replace(".", separador_decimal!==undefined ? separador_decimal : ",");

    if(separador_miles){
        // A�adimos los separadores de miles
        var miles=new RegExp("(-?[0-9]+)([0-9]{3})");
        while(miles.test(numero)) {
            numero=numero.replace(miles, "$1" + separador_miles + "$2");
        }
    }

    return numero;
}