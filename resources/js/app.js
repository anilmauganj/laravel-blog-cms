import "./bootstrap";

import Alpine from "alpinejs";

import Swal from "sweetalert2";
import toastr from "toastr";
import "toastr/build/toastr.min.css";

window.Swal = Swal;
window.toastr = toastr;

window.Alpine = Alpine;

Alpine.start();
