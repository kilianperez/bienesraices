// document.addE

document.addEventListener('DOMContentLoaded', function () {
	eventListeners();

	// modo oscuro
	// darkmode();

	// modo oscuro guardado en el LocalStorage

	darkmodeLocalStorage();
	mensajesTime();
});

function eventListeners() {
	const mobileMenu = document.querySelector('.mobile-menu');
	mobileMenu.addEventListener('click', navegacionResponsive);
}
function navegacionResponsive() {
	const navegacion = document.querySelector('.navegacion');
	navegacion.classList.toggle('ver');
}
function mensajesTime() {
	if (document.querySelector('.alerta')) {
		//Eliminar texto de confirmación de CRUD en admin/index.php
		setInterval(function () {
			const mensajeConfirm = document.querySelector('.alerta');
			const padre = mensajeConfirm.parentElement;
			padre.removeChild(mensajeConfirm);
		}, 3500);
	}
}
// function darkmode() {
// 	const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
// 	// console.log(prefiereDarkMode.matches);

// 	if (prefiereDarkMode.matches) {
// 		document.body.classList.add('dark-mode');
// 	} else {
// 		document.body.classList.remove('dark-mode');
// 	}

// 	prefiereDarkMode.addEventListener('change', () => {
// 		if (prefiereDarkMode.matches) {
// 			document.body.classList.add('dark-mode');
// 		} else {
// 			document.body.classList.remove('dark-mode');
// 		}
// 	});

// 	const botonDarkMode = document.querySelector('.dark-mode-boton');

// 	botonDarkMode.addEventListener('click', () => {
// 		document.body.classList.toggle('dark-mode');
// 	});
// }

function darkmodeLocalStorage() {
	const prefiereDarkMode = window.matchMedia('(prefers-color-scheme-dark)');
	if (prefiereDarkMode.matches) {
		document.body.classList.add('dark-mode');
	} else {
		document.body.classList.remove('dark-mode');
	}

	prefiereDarkMode.addEventListener('change', function () {
		if (prefiereDarkMode.matches) {
			document.body.classList.add('dark-mode');
		} else {
			document.body.classList.remove('dark-mode');
		}
	});

	//console.log(prefiereDarkMode.matches);
	//Boton DarkMode
	const botonDarkMode = document.querySelector('.dark-mode-boton');
	botonDarkMode.addEventListener('click', function () {
		document.body.classList.toggle('dark-mode');

		//Para que el modo elegido se quede guardado en local-storage
		if (document.body.classList.contains('dark-mode')) {
			localStorage.setItem('modo-oscuro', 'true');
		} else {
			localStorage.setItem('modo-oscuro', 'false');
		}
	});

	//Obtenemos el modo del color actual
	if (localStorage.getItem('modo-oscuro') === 'true') {
		document.body.classList.add('dark-mode');
	} else {
		document.body.classList.remove('dark-mode');
	}
}

/* (function () {
	'use strict';

    // modo oscuro desde la cookie 

	document.addEventListener('DOMContentLoaded', function () {
		eventListeners();
		checkBlackBackground();
		darkMode();
	});

	function eventListeners() {
		let mobileMenu = document.querySelector('.mobile-menu');
		mobileMenu.addEventListener('click', showNavPopUP);
	}

	function showNavPopUP() {
		let navigation = document.querySelector('.navegacion');

		navigation.classList.toggle('ver');
	}

	function darkMode() {
		let preferDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
		let btnDarkMode = document.querySelector('.dark-mode-boton');

		if (preferDarkMode.matches) {
			document.body.classList.add('dark-mode');
			setCookie('dark-mode', true, 30);
		} else {
			document.body.classList.add('dark-mode');
			setCookie('dark-mode', false, 30);
		}

		btnDarkMode.addEventListener('click', function () {
			document.body.classList.toggle('dark-mode');
			toggleCookie();
		});
	}

	// cookies
	function checkBlackBackground() {
		if (getValueCookie() == 'true') {
			document.body.classList.toggle('dark-mode');
		}
	}

	function toggleCookie() {
		if (getValueCookie() == 'true') {
			setCookie('dark-mode', false, 30);
		} else {
			setCookie('dark-mode', true, 30);
		}
	}

	function setCookie(cName, cValue, expDays) {
		let date = new Date();
		date.setTime(date.getTime() + expDays * 24 * 60 * 60 * 1000);
		const expires = 'expires=' + date.toUTCString();
		document.cookie = cName + '=' + cValue + '; ' + expires + '; path=/';
	}

	function getValueCookie() {
		return (document.cookie.match(/^(?:.*;)?\s*dark-mode\s*=\s*([^;]+)(?:.*)?$/) || [
			,
			null,
		])[1];
	}
})(); */
