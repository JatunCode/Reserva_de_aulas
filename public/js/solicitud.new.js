/* eslint-disable prettier/prettier */
import Swal from 'sweetalert2'
import 'sweetalert2/src/sweetalert2.scss'

let countPendientes = 0
let countUrgentes = 0
fetch("http://localhost/api/fetch/solicitud/count")
	.then(response => response.json())
	.then(data => {
        countPendientes = data.pendeintes;
        countUrgentes = data.urgentes;
    })
	.catch(error => {
		console.log("Error al obtener los conteos de datos.", error)
	})
document.addEventListener("DOMContentLoaded", function () {

	Swal.fire({
		title: "<strong>Tiene solicitudes por atender</strong>",
		text: `Solicitudes pendientes: ${countPendientes},Solicitudes urgentes: ${countUrgentes}`,
		footer: `<a href="${"http://localhost/admin/reservas/atencion"}">Puede atenderlas por este enlace</a>`,
		icon: "info",
		showClass: {
			popup: `
            animate__animated
            animate__fadeInUp
            animate__faster
            `,
		},
		hideClass: {
			popup: `
            animate__animated
            animate__fadeOutDown
            animate__faster
            `,
		},
	})
})
