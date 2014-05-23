// JavaScript Document
	function reloadchat () {
		setInterval (
			function () {
				$("#chat").load("chat.php");
			},
			2000
		);
	}
	
function desloguear(id,sid){
	$.get( "common/killsession.php", { id: id, sId:sid} );
}