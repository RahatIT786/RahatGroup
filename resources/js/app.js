import "./bootstrap";
import Swal from "sweetalert2";
window.Swal = Swal;

window.addEventListener("close-modal", (event) => {
    const data = event.detail;
    $(`#${data.modal}`).modal("hide");
});
