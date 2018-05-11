
// cette fonction teste si l'utilisateur a
// bien saisie une et une seule lettre dans 
// le champ de saisie
function tester() {

	let lettre=document.getElementById("l").value;
	lettre=lettre.trim();
	
	if (lettre.length!=1 || !/^[a-zA-Z]+$/.test(lettre)){
		errormsg("le caractère tapé est incorrect");
        return false;

	}
	else{
		resetform();
		return true;
	}
	
}

// écrit 'msg' dans l'élément où on affiche
// les messages d'erreur et montre cet élément
function errormsg(msg) {
    let div = document.getElementById("erreur");
    div.innerHTML = msg;
    div.style.visibility = "visible";
    }

// efface le contenu de l'élément où on affiche
// les messages d'erreur et cache cet élément
function resetform() {
    let div = document.getElementById("erreur");
    div.innerHTML = "";
    div.style.visibility = "hidden";
}