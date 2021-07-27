<!-- [IMPORT] -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

<script type="text/javascript">
	// Get value from form
	$vin = $('#vin').val()

	const options = {
		method: 'GET',
		url: 'https://vindecoder.p.rapidapi.com/decode_vin',
		params: { vin: $vin },
		headers: {
			'x-rapidapi-key': 'c404ea350amsh3a1bf345dd7386fp1bcde5jsnad8d954aa8d4',
			'x-rapidapi-host': 'vindecoder.p.rapidapi.com'
		}
	}
	axios.request(options)
		.then(function (res) {
			const makeElement = document.getElementById('make')
			const engineElement = document.getElementById('engine')
			const modelElement = document.getElementById('model')
			
			makeElement.innerHTML = res.data.specification.make
			modelElement.innerHTML = res.data.specification.model
			engineElement.innerHTML = res.data.specification.engine
		})
		.catch(function (err) { console.error('error:', err) })

</script>