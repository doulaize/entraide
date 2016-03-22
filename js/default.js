
function test_saisie_modif_data()
{
	if(document.getElementById(‘mdp’).value != document.getElementById(‘confirm_mdp’).value)
	{
		alert(‘vous avez mal retapé votre mot de passe !’);
		return 0;
	}
	if(document.getElementById(‘nom’).value == ““)
	{
		alert(‘votre nom est vide !’);
		return 0;
	}
	if(document.getElementById(‘prenom’).value == ““)
	{
		alert(‘votre prénom est vide !’);
		return 0;
	}
	if(document.getElementById(‘login’).value == ““)
	{
		alert(‘votre login est vide !’);
		return 0;
	}
	return 1;
}
