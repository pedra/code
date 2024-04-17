const API_URL = '/inc/ajax-msg.php'
let PLM_HASH
let USER
let MSG

const _e = {},
	_ = (e, b = false) => {
		if (_e[e]) return _e[e]
		let x = document[`querySelector${b ? 'All' : ''}`](e) || false
		if (x) return _e[e] = x
	},
	_a = e => _(e, true)



window.onload = () => {
	resolveHash().then(res => {
		console.log('Res: ', res)

		_('#user_avatar').src = "/img/" + (!res.hash ? "avatar_800.jpg" : res.user.uid + ".jpg");
		_('#user_name').innerHTML = !res.hash ? "<button onclick=\"logout()\">Sign in</button>" : res.user.name;
	})
}

async function resolveHash() {
	const lh = localStorage.getItem('PLM_HASH') || false

	const formData = new FormData()
	lh && formData.set("hash", lh)

	const ft = await fetch(API_URL, {
		method: 'POST',
		body: formData
	})
	const res = await ft.json()

	USER = res.user || false
	MSG = res.msg || false
	PLM_HASH = res.hash || false

	if (PLM_HASH) localStorage.setItem('PLM_HASH', PLM_HASH)
	//else alert('No hash found!\n\nPlease click "LOGOUT" to login again.')

	return res
}

function logout() {
	localStorage.removeItem('PLM_HASH')
	location.reload()
}