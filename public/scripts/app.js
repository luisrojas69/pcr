//Aplicacion Personalizda:
// Desarrollada por Luis Rojas para Granja Boraure C.A
// 2020

new Vue({

	el: '#vehicle',

	created: function(){
		this.getVehicles();
	},

	data:{
		vehicles: [],
	},

	methods:{
		getVehicles: function(){
			var urlVehicles = 'get-vehicles';
			axios.get(urlVehicles).then(response => {
				this.vehicles = response.data;
			})
		}
	}

});

