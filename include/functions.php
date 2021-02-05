<?php

    function criptografar_nome($valor){
        return md5(md5(base64_encode($valor)));
    }

    function criptografar_valor($valor){
        return base64_encode(base64_encode(base64_encode($valor)));
    }

    function descriptografar_valor($valor){
		return base64_decode(base64_decode(base64_decode($valor)));
	}
?>