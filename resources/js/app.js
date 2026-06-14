import "./bootstrap";

import Alpine from "alpinejs";

import Swal from "sweetalert2";
import toastr from "toastr";
import "toastr/build/toastr.min.css";

import $ from "jquery";
window.$ = window.jQuery = $;

import "select2";
import "select2/dist/css/select2.min.css";

window.Swal = Swal;
window.toastr = toastr;

window.Alpine = Alpine;

Alpine.start();
