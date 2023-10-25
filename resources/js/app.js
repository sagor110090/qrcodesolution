import {
    Datepicker, Input, initTE, Collapse, Select, Sticky, Modal,
    Ripple,LoadingManagement
} from "tw-elements";




initTE({ Datepicker, Input, Collapse, Select, Sticky, Modal, Ripple,LoadingManagement });

import Picker from 'vanilla-picker'

window.Picker = Picker;

import '../../node_modules/bootstrap-icons/font/bootstrap-icons.css';

import Swal from 'sweetalert2'
window.Swal = Swal;

const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
  });

window.swalWithBootstrapButtons = swalWithBootstrapButtons;

